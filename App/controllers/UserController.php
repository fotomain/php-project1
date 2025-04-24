<?php

namespace App\controllers;

use App\models\ModelJobClass;
use App\models\ModelUserClass;
use Framework\Database;
use Framework\Session;
use Framework\Validation;

class UserController extends \stdClass {
    static $dg;
    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db=new Database($config);
    }

    public function login() {

        if(isset($_POST['email'])) {
            $email=$_POST['email'];
        } else {
            $email='';
        }
        if(isset($_POST['password'])) {
            $password=$_POST['password'];
        } else {
            $password='';
        }

        $formState = [
            "email"=>$email,
            "password"=>$password,
        ];
        $formState=json_decode(json_encode($formState));
        global $modelUser;
        $modelUser->setCurrentElement($formState);

        loadView('users/login');
    }
    public function create() {

        global $modelUser;
        $defalultDataCreate=ModelUserClass::$defalultDataCreate;
        $defalultDataCreate=json_decode(json_encode($defalultDataCreate));
        $modelUser->setCurrentElement($defalultDataCreate);

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

        $formState = [
            "name"=>$name,
            "email"=>$email,
            "city"=>$city,
            "state"=>$state,
            "password"=>$password,
            "password_confirmation"=>$passwordConfirmation,
        ];
        $formState=json_decode(json_encode($formState));
        global $modelUser;
        $modelUser->setCurrentElement($formState);

        if($errors){

            $err = new \stdClass();
            $err->message = $errors;
            $err->code = 503;

            global $modelError;
            $modelError->setErrorMessage($err);

            loadView('users/create');
            exit;

        } else {
            //check if email exist
            $params = [
                'email' => $email,
            ];
            $user = $this->db->query('SELECT * FROM users1 WHERE email=:email', $params)->fetch();

                if($user) {

                    $errors['user']="User already exists";
                    $err = new \stdClass();
                    $err->message = $errors;
                    $err->code = 503;

                    global $modelError;
                    $modelError->setErrorMessage($err);

                    loadView('users/create', $err);
                    exit;
                }

            $params=$formState;
            unset($params->password_confirmation);
            $params->password=password_hash($params->password,PASSWORD_DEFAULT);

            $this->db->query('INSERT INTO users1 (
                    name, 
                    email, 
                    city, 
                    state, 
                    password
                    ) 
                    VALUES (:name, :email, :city, :state, :password)'
                , $params);

            $userId = $this->db->conn->lastInsertId();
            Session::set('user',[
                "id"=>(int) $userId,
                "name"=>$name,
                "email"=>$email,
            ]);

            redirect('/');

        }
    }

    public function logout() {
        Session::clearAll();
        $params = session_get_cookie_params();
        setcookie("PHPSESSID", '', time() - 86400, $params['path'], $params['domain']);
        redirect('/');
    }

    function authenticate()
    {

        $email=$_POST['email'];
        $password=$_POST['password'];
        $errors=[];
        if(!Validation::email($email)) {
            $errors['email']="Please enter a valid email address";
        }
        if(!Validation::string($password,6)) {
            $errors['password']="Please enter valid name between 2 and 50 characters";
        }

        $email=$_POST['email'];
        $password=$_POST['password'];

        $formState = [
            "email"=>$email,
            "password"=>$password,
        ];
        $formState=json_decode(json_encode($formState));
        global $modelUser;
        $modelUser->setCurrentElement($formState);

        if(!empty($errors))
        {
            $err = new \stdClass();
            $err->message = $errors;
            $err->code = 503;
            global $modelError;
            $modelError->setErrorMessage($err);
            loadView('users/login');
            exit;
        }

        $params = [
            'email' => $email,
        ];

        $user = $this->db->query('SELECT * FROM users1 WHERE email=:email', $params)->fetch();

        if(!$user) {
            $errors['user']="Incorrect email";
            $err = new \stdClass();
            $err->message = $errors;
            $err->code = 503;
            global $modelError;
            $modelError->setErrorMessage($err);
            loadView('users/login');
            exit;
        }

        if(!password_verify($password, $user->password)) {
            $errors['password']="Incorrect password";
            $err = new \stdClass();
            $err->message = $errors;
            $err->code = 503;
            global $modelError;
            $modelError->setErrorMessage($err);
            loadView('users/login');
            exit;
        }

        Session::set('user',[
            "id"=>$user->id,
            "name"=>$user->name,
            "email"=>$user->email
        ]);

        redirect('/');

    }

}