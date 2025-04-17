<?php

//php -S localhost:8000
//php -S localhost:8000 -t public

use App\models\ModelErrorClass;
use App\models\ModelJobClass;
use Framework\Router;

require __DIR__ . '/../vendor/autoload.php';

require '../helpers.php';

global $modelJob;   $modelJob   = new ModelJobClass();
global $modelError; $modelError = new ModelErrorClass();

//inspect($modelJob);

$router = new Router();

$routes = require basePath('routes.php');

//echo json_encode($routes);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$method = $_SERVER['REQUEST_METHOD'];

//inspect($uri);
//inspect($method);

$router->route($uri, $method);
