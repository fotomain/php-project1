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

$router->get('/auth/register','UserController@create');
$router->post('/auth/register','UserController@store');

$router->get('/auth/login','UserController@login');
$router->post('/auth/logout','UserController@logout');
$router->post('/auth/login','UserController@authenticate');



