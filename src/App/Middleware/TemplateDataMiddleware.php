<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;


class TemplateDataMiddleware implements MiddlewareInterface
{

    public function __construct(private TemplateEngine $view)
    {
//        var_dump($this->view);
//        echo  "<br>";
//        exit(0);
    }
    public function process(callable $next) : void
    {
        //  echo "TemplateDataMiddleware->process";
        $this->view->addGlobalData("title", "Expense Tracking App");
        $next();
    }
}