<?php

require __DIR__ . '/../vendor/autoload.php';
require '../helpers.php';

use Framework\Session;
Session::start();

use App\models\ModelErrorClass;
use App\models\ModelJobClass;
use App\models\ModelUserClass;
use Framework\Router;

global $modelUser;  $modelUser  = new ModelUserClass();
global $modelJob;   $modelJob   = new ModelJobClass();
global $modelError; $modelError = new ModelErrorClass();

$router = new Router();

$routes = require basePath('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->route($uri);


