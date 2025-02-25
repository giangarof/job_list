<?php 
	session_start();
	require __DIR__ . '/../vendor/autoload.php';

	require '../helpers/helpers.php'; 

	use Framework\Router;
	
	$router = new Router();
	$routes = require basePath('../' . 'routes.php');


	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

	// $method = $_SERVER['REQUEST_METHOD'];

	$router->route($uri);