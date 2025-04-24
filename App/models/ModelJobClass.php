<?php

namespace App\models;

class ModelJobClass extends ModelAbstractClass{

    public static $allowedFields=['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];
    public static $requiredFields=['title', 'description', 'salary', 'email', 'city', 'state'];
    public static $defalultDataCreate=[
        'title'=>'Title',
        'description'=>'',
        'salary'=>'000',
        'tags'=>'',
        'company'=>'',
        'address'=>'',
        'city'=>'',
        'state'=>'',
        'phone'=>'',
        'email'=>'',
        'requirements'=>'',
        'benefits'=>''
    ];
    public function __construct($dataList=null,$currentElement=null)
    {
        parent::__construct($dataList,$currentElement);
        $this->modelName='jobModel';
    }

    public static function readFavorites($db=null){

        $result=$db->query('
            SELECT * FROM listings1
                ORDER BY created_at DESC
                LIMIT 3
        ')->fetchAll();

        return $result;

    }
    public static function readCollection($db=null){

        $result=$db->query('
            SELECT * FROM listings1
                ORDER BY created_at DESC                
        ')->fetchAll();

        return $result;

    }
    public static function readElement($db=null,$params=null){

        $result=$db->query(
        "SELECT * FROM listings1 WHERE id = :id "
        ,$params
        )->fetchAll();

        if(!$result){
            return false;
        }

        return $result[0];

    }

    public static function deleteElement($db=null,$params=null){

        $db->query(
            'DELETE FROM listings1 WHERE id = :id '
            ,$params
        );

    }
    public static function updateElement($db=null,$updateFields=null,$updatedValues=null){

        $query = "UPDATE listings1 SET ".$updateFields." WHERE id = :id";

        $db->query(
            $query
            ,$updatedValues
        );

    }

    public static function createElement($db=null,$fieldsNames=null,$valuesNames=null,$newData=null){

        $query = "INSERT INTO listings1 (".$fieldsNames.") VALUES (".$valuesNames.")";

        $db->query(
            $query
            ,$newData
        );

    }

}

