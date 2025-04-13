<?php

//php -S localhost:8000
//php -S localhost:8000 -t public

require '../helpers.php';
require basePath('Router.php');
require basePath('Database.php');

$router = new Router();

$routes = require basePath('routes.php');

//echo json_encode($routes);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

//inspect($uri);
//inspect($method);

$router->route($uri, $method);
