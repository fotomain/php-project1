<?php

global $router;

$router->get('/','HomeController@index');
$router->get('/listings','ListingController@index');
$router->get('/listings/create','ListingController@create');
$router->get('/listing/{id}','ListingController@show');

$router->post('/listings','ListingController@store');

//echo inspect($router);
