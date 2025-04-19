<?php

namespace App\controllers;

use Framework\Database;
use Framework\Validation;

class UserController extends \stdClass {
    static $dg;
    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db=new Database($config);
    }

    public function login() {
        loadView('users/login');
    }
    public function create() {
        loadView('users/create');
    }

    public function store() {

        $name=$_POST['name'];
        $email=$_POST['email'];
        $city=$_POST['city'];
        $state=$_POST['state'];
        $password=$_POST['password'];
        $passwordConfirmation=$_POST['password_confirmation'];

        $errors=[];

        if(!Validation::email($email)) {
            $errors['email']="Please enter valid email address";
        }

        if(!Validation::string($name,2,50)) {
            $errors['name']="Please enter valid name between 2 and 50 characters";
        }
        if(!Validation::string($password,6,50)) {
            $errors['password']="Please enter valid name password at least 6 characters";
        }
        if(!Validation::match($password,$passwordConfirmation,50)) {
            $errors['password_confirmation']="Please enter valid matched passwords !";
        }


        if($errors){

            $err = new \stdClass();
            $err->message = $errors;
            $err->code = 503;

            global $modelError;
            $modelError->setErrorMessage($err);

            loadView('users/create', $err);

        }

        inspectAndDie("store");

    }

}