<?php 
	
	require __DIR__ . '/../vendor/autoload.php';
		

	use Framework\Router;
	use Framework\Session;

	Session::start();
	require '../helpers/helpers.php'; 
	$router = new Router();
	$routes = require basePath('../' . 'routes.php');


	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

	// $method = $_SERVER['REQUEST_METHOD'];

	$router->route($uri);