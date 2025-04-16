<?php

//php -S localhost:8000
//php -S localhost:8000 -t public

use App\models\ModelJobClass;
use Framework\Router;

require __DIR__ . '/../vendor/autoload.php';

require '../helpers.php';
//require basePath('Framework/Router.php');
//require basePath('Framework/Database.php');
//require basePath('App/models/ModelJobClass.php');

//spl_autoload_register(function ($class) {
//    $path = basePath('Framework/' . $class . '.php'  );
//    if (file_exists($path)) {
//        require $path;
//    }
//});

//spl_autoload_register(function ($class) {
//   $path = basePath('App/models/' . $class . '.php'  );
//   if (file_exists($path)) {
//       require $path;
//   }
//});

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
