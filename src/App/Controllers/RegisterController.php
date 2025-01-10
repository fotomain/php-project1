<?php

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class RegisterController{
    //version1 private TemplateEngine $view;

    public function __construct(private TemplateEngine $view)
    {
        //version1 $this->view = new TemplateEngine(Paths::VIEW);
    }
    public function register()
    {
//        dd($this->view);
//OK!
//        echo 'About Page';

        //buffer4 => echo
        echo $this->view->render("register.php", array(
            'title' => 'Register Page!'
        ));
    }
}