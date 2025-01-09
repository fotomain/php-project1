<?php

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class AboutController{
    //version1 private TemplateEngine $view;

    public function __construct(private TemplateEngine $view)
    {
        //version1 $this->view = new TemplateEngine(Paths::VIEW);
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