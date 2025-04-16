<?php

//php -S localhost:8000
//php -S localhost:8000 -t public

require '../helpers.php';
require basePath('Framework/Router.php');
require basePath('Framework/Database.php');
require basePath('App/models/ModelJob.php');

global $modelJob;
$modelJob = new ModelJobClass();
//inspect($modelJob);

$router = new Router();

$routes = require basePath('routes.php');

//echo json_encode($routes);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$method = $_SERVER['REQUEST_METHOD'];

//inspect($uri);
//inspect($method);

$router->route($uri, $method);
