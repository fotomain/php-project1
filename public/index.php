<?php
require __DIR__ . '/../vendor/autoload.php';
require '../helpers.php';

//php -S localhost:8000
//php -S localhost:8000 -t public

use Framework\Session; //auto call
Session::start();
//inspectAndDie(session_status());

use App\models\ModelErrorClass;
use App\models\ModelJobClass;
use App\models\ModelUserClass;
use Framework\Router;


global $modelUser;  $modelUser  = new ModelUserClass();
global $modelJob;   $modelJob   = new ModelJobClass();
global $modelError; $modelError = new ModelErrorClass();

//inspect($modelJob);

$router = new Router();

$routes = require basePath('routes.php');

//echo json_encode($routes);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//inspect($uri);
//inspect($method);

$router->route($uri);
