<?php

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class AboutController{
    private TemplateEngine $view;

    public function __construct()
    {
        $this->view = new TemplateEngine(Paths::VIEW);
    }
    public function about()
    {
//        dd($this->view);
//OK!
//        echo 'About Page';

        //buffer4 => echo
        echo $this->view->render("about.php", array(
            'title' => 'About Title Text!',
            'dangerousData' => '<script> alert(123)  </script>  '
        ));
    }
}