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

}