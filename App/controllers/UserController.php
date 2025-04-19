<?php

namespace App\controllers;

use Framework\Database;

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

}