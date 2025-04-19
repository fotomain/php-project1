<?php

namespace App\models;

class ModelUserClass extends ModelAbstractClass{

    public static $allowedFields=['name', 'email', 'password', 'password_confirmation', 'city', 'state'];
    public static $requiredFields=['name', 'email', 'password', 'password_confirmation'];
    public static $defalultDataCreate=[
        'name'=>'User',
        'email'=>'',
        'city'=>'',
        'state'=>'',
        'password'=>'123456',
        'password_confirmation'=>'123456'
    ];
    public function __construct($dataList=null,$currentElement=null)
    {
        parent::__construct($dataList,$currentElement);
        $this->modelName='userModel';
    }

}