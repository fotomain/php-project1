<?php

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class HomeController{
    private TemplateEngine $view;

    public function __construct()
    {
        $this->view = new TemplateEngine(Paths::VIEW);
    }
    public function home()
    {
//        dd($this->view);
//        echo 'Home Page';

        //buffer4 => echo
        echo $this->view->render("/index.php",[
            'title' => 'Title Parameter1',
        ]);
    }
}