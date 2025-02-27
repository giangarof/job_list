<?php
	//Job list
	$router->get('/', 'HomeController@index');
	$router->get('/listings', 'ListingController@index');
	$router->get('/listings/create', 'ListingController@create');
	$router->get('/listings/{id}', 'ListingController@show');
	$router->get('/listings/edit/{id}', 'ListingController@edit');

	$router->post('/listings', 'ListingController@store');

	$router->put('/listings/{id}', 'ListingController@update');

	$router->delete('/listings/{id}', 'ListingController@destroy');


	//User
	$router->get('/auth/register', 'UserController@register');
	$router->get('/auth/login', 'UserController@login');

	$router->post('/auth/register', 'UserController@store');
	$router->post('/auth/logout', 'UserController@logout');
