<?php

require '../helpers.php';

// php -S localhost:8000 -t public


require getBasePath('Router.php');

$router = new Router();
$routes = require getBasePath('routes.php');

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];


$router->route($uri,$method);
   
?>