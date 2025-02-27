<?php
	//filter jobs
	$router->get('/listings/search', 'ListingController@search');
	
	//Job list
	$router->get('/', 'HomeController@index');
	$router->get('/listings', 'ListingController@index');
	$router->get('/listings/create', 'ListingController@create', ['auth']);
	$router->get('/listings/{id}', 'ListingController@show');
	$router->get('/listings/edit/{id}', 'ListingController@edit', ['auth']);

	$router->post('/listings', 'ListingController@store', ['auth']);

	$router->put('/listings/{id}', 'ListingController@update', ['auth']);

	$router->delete('/listings/{id}', 'ListingController@destroy', ['auth']);


	//User
	$router->get('/auth/register', 'UserController@register', ['guest']);
	$router->get('/auth/login', 'UserController@login', ['guest']);

	$router->post('/auth/register', 'UserController@store', ['guest']);
	$router->post('/auth/logout', 'UserController@logout', ['auth']);
	$router->post('/auth/login', 'UserController@signin', ['guest']);

