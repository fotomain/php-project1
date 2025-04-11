<?php

//php -S localhost:8000
//php -S localhost:8000 -t public

require '../helpers.php';

//loadView('home');

$routesArray = [
    "/"=>'controllers/home.php',
    "/listings"=>'controllers/listings/index.php',
    "/listings/create"=>'controllers/listings/create.php',
    "404"=>'controllers/error/404.php',
];

$uri = $_SERVER['REQUEST_URI'];

echo $uri;

if(array_key_exists($uri, $routesArray)){
    require basePath($routesArray[$uri]);
} else {
    require basePath($routesArray['404']);
}

//echo '<pre>';
//echo '<h1>'.$uri.'</h1>';

