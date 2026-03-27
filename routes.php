<?php


$router->get('/','HomeController@index');

// User controllers
$router->get('/user/login', 'UserController@login');
$router->get('/user/signup', 'UserController@signup');


// Listings - Jobs
$router->get('/listings', 'ListingsController@index');
$router->get('/listings/listing_details/{id}',  'ListingsController@listing_details');
$router->get('/listings/create', 'ListingsController@create');

$router->get('/404', 'ErrorController@error404');
$router->get('/403', 'ErrorController@error403');
?>