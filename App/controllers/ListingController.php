<?php

namespace App\controllers;

use App\models\ModelJobClass;
use Framework\Database;
use Framework\Validation;

class ListingController {
    protected $db;
    public function __construct()
    {
        $config = require basePath('/config/db.php');
        $this->db = new Database($config);
    }

    public function index() {

//       inspectAndDie(Validation::email('aa@gmail.com'));

        $listings=$this->db->query('SELECT * FROM listings1 ')->fetchAll();

        global $modelJob;
        $modelJob->setDataList($listings);

        loadView("listings/index");

    }

    public function create() {
        global $modelJob;

        $defalultDataCreate=ModelJobClass::$defalultDataCreate;
//        $defalultDataCreate=array_flip($defalultDataCreate);
        $defalultDataCreate=json_decode(json_encode($defalultDataCreate));
        $modelJob->setCurrentElement($defalultDataCreate);

        loadView("listings/create");
    }
    public function show($params) {
        $id = $params['id'] ?? '';
//inspect($id);

        $params = ['id' => $id];

        $listing = $this->db->query(
            "SELECT * FROM listings1 WHERE id = :id "
            ,$params
        )->fetchAll();

//inspect($listing);

        if(!$listing){
            ErrorController::notFound('Listing not found');
            return;
        }

        global $modelJob;
        $modelJob->setCurrentElement($listing[0]);

//global $showData;
//$showData = $listing[0];


        loadView('listings/show');

    }

    public function store($params) {

        global $modelJob;

        $allowedFields=ModelJobClass::$allowedFields;
        $requiredFields = ModelJobClass::$requiredFields;

        $newListingData=array_intersect_key($_POST, array_flip($allowedFields));

        $newListingData['user_id']=1;

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
            $fields=[];
            foreach(
                $newListingData as $field=>$value
            ){
                $fields[]=$field;
            }

            $fields=implode(',', $fields);

            $values=[];
            foreach(
                $newListingData as $field=>$value
            ){
                $values[]=':'.$field;
            }

//            inspect($values);
//            inspect($newListingData);

            $values=implode(',', $values);

            $query = "INSERT INTO listings1 (".$fields.") VALUES (".$values.")";

//            inspectAndDie($query);

            $this->db->query($query,$newListingData);

            redirect("/listings");
            exit;

        }

    }

    public function destroy($params) {

        $id = $params['id'] ?? '';
        $params = ['id' => $id];
        $listing = $this->db->query('SELECT * FROM listings1 WHERE id = :id ', $params)->fetch();
        if(!$listing){
            ErrorController::notFound('Element not found with ID: '.$id);
            return;
        }

        $this->db->query('DELETE FROM listings1 WHERE id = :id ', $params);

        $_SESSION['success_message'] = 'Listing deleted successfully';

        redirect("/listings");

    }

}