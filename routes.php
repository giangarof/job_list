<?php


$router->get('/','HomeController@index');

// User controllers
$router->get('/user/login', 'UserController@login');
$router->get('/user/signup', 'UserController@signup');
$router->get('/user/profile', 'UserController@profile');


// display jobs 
$router->get('/listings', 'ListingsController@index');

// job details by id
$router->get('/listings/listing_details/{id}',  'ListingsController@listing_details');


// display form
$router->get('/listings/create', 'ListingsController@create');

// action
$router->post('/listings/create', 'ListingsController@store');

$router->get('/404', 'ErrorController@error404');
$router->get('/403', 'ErrorController@error403');
?>