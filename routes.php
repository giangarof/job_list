<?php


$router->get('/','HomeController@index');

// USER
$router->get('/user/login', 'UserController@login');
$router->get('/user/signup', 'UserController@signup');
$router->get('/user/profile', 'UserController@profile');

// LISTINGS

// display jobs 
$router->get('/listings', 'ListingsController@index');

// job details by id
$router->get('/listings/listing_details/{id}',  'ListingsController@listing_details');

// display form
$router->get('/listings/create', 'ListingsController@create');

// submit new job
$router->post('/listings/create', 'ListingsController@store');

// update job
$router->put('/listings/update/{id}', 'ListingsController@updateListing');

//delete job
$router->delete('/listings/delete/{id}', 'ListingsController@deleteListing');



// ERRORS
$router->get('/404', 'ErrorController@error404');
$router->get('/403', 'ErrorController@error403');
?>