<?php

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class HomeController{

//version1    private TemplateEngine $view;

    public function __construct(private TemplateEngine $view)
    {
        //version1 $this->view = new TemplateEngine(Paths::VIEW);
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