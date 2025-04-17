<?php

namespace App\controllers;

use Framework\Database;

class ErrorController {
    protected $db; //backlog - write to error log
    public function __construct()
    {
        $config = require basePath('/config/db.php');
        $this->db = new Database($config);
    }

    static function notFound($message='Resource not found!') {

        http_response_code(404);
        $err = new \stdClass();
        $err->message = $message;
        $err->code = 404;

        global $modelError;
        $modelError->setErrorMessage($err);

        loadView('error/error'); //error/error.view.php

    }

    static function notAuthorized($message='Not Authorized user!') {

        http_response_code(403);
        $err = new \stdClass();
        $err->message = $message;
        $err->code = 403;

        global $modelError;
        $modelError->setErrorMessage($err);

        loadView('error/error'); //error/error.view.php

    }

}