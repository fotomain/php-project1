<?php

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;
use App\Services\ValidatorService;
class AuthController{
    //version1 private TemplateEngine $view;

    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService
    )
    {
        //version1 $this->view = new TemplateEngine(Paths::VIEW);
    }
    public function registerView()
    {
//        dd($this->view);
//OK!
//        echo 'About Page';

        //buffer4 => echo
        echo $this->view->render("register.php", array(
            'title' => 'Register Page!'
        ));
    }

    public function register()
    {
        dd($_POST);
    }


}