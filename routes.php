<?php

global $router;

$router->get('/','HomeController@index');
$router->get('/listings','ListingController@index');
$router->get('/listings/create','ListingController@create');
$router->get('/listing/{id}','ListingController@show');

$router->post('/listings','ListingController@store');

$router->delete('/listing/{id}','ListingController@destroy');

$router->get('/listing/edit/{id}','ListingController@edit');
$router->put('/listing/{id}','ListingController@update');

//echo inspect($router);
