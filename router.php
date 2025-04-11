<?php

global $uri;
$routesArray = require basePath('routes.php');

if(array_key_exists($uri, $routesArray)){
    require basePath($routesArray[$uri]);
} else {
    http_response_code(404);
    require basePath($routesArray['404']);
}
