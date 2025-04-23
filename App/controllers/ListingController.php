<?php

namespace App\controllers;

use App\models\ModelJobClass;
use Framework\Database;
use Framework\Permissions;
use Framework\Session;
use Framework\Validation;

class ListingController {
    protected $db;
    public function __construct()
    {
        $config = require basePath('/config/db.php');
        $this->db = new Database($config);
    }

    public function index() {

        global $modelJob;

        $listings=$modelJob::readCollection($this->db);

        $modelJob->setDataList($listings);

        loadView("listings/index");

    }

    public function create() {
        global $modelJob;

        $defalultDataCreate=ModelJobClass::$defalultDataCreate;
        $defalultDataCreate=json_decode(json_encode($defalultDataCreate));
        $modelJob->setCurrentElement($defalultDataCreate);

        loadView("listings/create");
    }
    public function show($params) {
        $id = $params['id'] ?? '';

        $params = ['id' => $id];

        global $modelJob;

        $listing=$modelJob::readElement($this->db, $params);

        if(!$listing){
            ErrorController::notFound('Listing not found');
            return;
        }

        //data for page
        $modelJob->setCurrentElement($listing);

        loadView('listings/show');

    }

    public function store($params) {

        global $modelJob;

        $allowedFields=ModelJobClass::$allowedFields;
        $requiredFields = ModelJobClass::$requiredFields;

        $newListingData=array_intersect_key($_POST, array_flip($allowedFields));

        $newListingData['user_id']=Session::get('user')['id'];

        $newListingData=array_map('sanitize', $newListingData);


        $errors = [];

        foreach ($requiredFields as $field) {
            if(empty($newListingData[$field]) || !Validation::string($newListingData[$field])) {
                $errors[$field] = ucfirst($field).' <- Field is required';
            }
        }

        $modelJob->setCurrentElement(json_decode(json_encode($newListingData)));
//        inspect($modelJob->getCurrentElement());

        if(!empty($errors)) {
            //Reload THIS vies with errors
            $err = new \stdClass();
            $err->message = $errors;
            $err->code = 503;

            global $modelError;
            $modelError->setErrorMessage($err);

            loadView('listings/create');

        } else {
            $fieldsNames=[];
            foreach(
                $newListingData as $field=>$value
            ){
                $fieldsNames[]=$field;
            }

            $fieldsNames=implode(',', $fieldsNames);

            $valuesNames=[];
            foreach(
                $newListingData as $field=>$value
            ){
                $valuesNames[]=':'.$field;
            }

            $valuesNames=implode(',', $valuesNames);

            $listings=$modelJob::createElement(
                $this->db
                ,$fieldsNames
                ,$valuesNames
                ,$newListingData
            );

            Session::setFlashMessqge('success_message',"Listing created successfully");

            redirect("/listings");
            exit;

        }

    }

    public function destroy($params) {

        $id = $params['id'] ?? '';
        $params = ['id' => $id];

        global $modelJob;
        $listing=$modelJob::readElement($this->db, $params);

        if(!$listing){
            ErrorController::notFound('Element not found with ID: '.$id);
            return;
        }

        if(!Permissions::deleteJob($listing->user_id)){
            Session::setFlashMessqge('error_message',"You can't delete this listing");
            return redirect("/listing/" .$id);
        }

        $modelJob::deleteElement($this->db, $params);

        Session::setFlashMessqge('success_message',"Listing deleted successfully");

        redirect("/listings");

    }

    public function edit($params) {
        $id = $params['id'] ?? '';
//inspect($id);

        $params = ['id' => $id];

        global $modelJob;
        $listing=$modelJob::readElement($this->db, $params);

        if(!$listing){
            ErrorController::notFound('Listing not found');
            return;
        }

        $modelJob->setCurrentElement($listing);

        loadView('listings/edit');

    }

    public function update($params) {

        $id = $params['id'] ?? '';

        $params = ['id' => $id];

        global $modelJob;
        $listing=$modelJob::readElement($this->db, $params);

        if(!$listing){
            ErrorController::notFound('Listing not found');
            return;
        }

        if(!Permissions::updateJob($listing->user_id)){
            Session::setFlashMessqge('error_message',"You can't update this listing");
            return redirect("/listing/" .$id);
        }

        //data for page

        $modelJob->setCurrentElement($listing);

        $allowedFields=ModelJobClass::$allowedFields;

        $updatedValues=array_intersect_key($_POST, array_flip($allowedFields));

        $updatedValues=array_map('sanitize', $updatedValues);

        $requiredFields = ModelJobClass::$requiredFields;

        $errors = [];

        foreach ($requiredFields as $field) {
            if(empty($updatedValues[$field]) || !Validation::string($updatedValues[$field])) {
                $errors[$field] = ucfirst($field).' <- Field is required';
            }
        }

//        inspectAndDie($errors);

        if(!empty($errors)) {
            //Reload THIS vies with errors
            $err = new \stdClass();
            $err->message = $errors;
            $err->code = 503;

            global $modelError;
            $modelError->setErrorMessage($err);

            loadView('listings/edit');
            exit;
        } else {
//            echo '$updatedValues';
//            inspectAndDie($updatedValues);

            $updateFields=[];
            foreach (array_keys($updatedValues) as $field) {
                $updateFields[]="{$field} = :{$field}";
            }

            $updateFields=implode(',', $updateFields);
            $updatedValues['id']=$id;

            $modelJob::updateElement(
                $this->db
                ,$updateFields
                ,$updatedValues
            );

            Session::setFlashMessqge('success_message','Listing updated successfully');

            redirect("/listing/".$id);
            exit;
        }
    }

    public function search() {
//        inspectAndDie($_GET);
        $keywords=isset($_GET['keywords']) ? trim($_GET['keywords']) : '';
        $location=isset($_GET['location']) ? trim($_GET['location']) : '';

        $query = " 
            SELECT * FROM listings1 
                WHERE ( 
                        title LIKE :keywords
                        OR  description LIKE :keywords
                        OR  tags LIKE :keywords 
                    )
                    AND (
                        state LIKE :location
                        OR city LIKE :location
                        OR address LIKE :location
                    )                    
          ";

        $params=[
            'keywords'=>'%'.$keywords.'%',
            'location'=>'%'.$location.'%',
        ];

        $listings=$this->db->query($query,$params)->fetchAll();

        global $modelJob;
        $modelJob->setDataList($listings,$params);

        loadView('listings/index');

    }


}
