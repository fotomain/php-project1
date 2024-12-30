<?php

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class HomeController{
    private TemplateEngine $view;

    public function __construct()
    {
        $this->view = new TemplateEngine(Paths::VIEW);
        $d['text'] = "ahoy!";
        $this->view->assign('data', $d);
    }
    public function home()
    {
//        dd($this->view);
//        echo 'Home Page';

        $this->view->render("/index.php",[
            'title' => 'Title Parameter1',
        ]);
    }
}