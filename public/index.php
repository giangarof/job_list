<?php

require __DIR__ . '/../vendor/autoload.php';
// Run locally
// php -S localhost:8000 -t public

require '../helpers.php';
use Framework\Router;
use Framework\Database;
use Framework\Session;

Session::start_session();
// inspect(session_status());

// $config= require getBasePath('config/db.php');
// $db = new Database($config);
// $db->resetDB('jobs');
$router = new Router();
$routes = require getBasePath('routes.php');

// GET THE CURRENT URI AND METHODS
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


// ROUTE THE REQUEST
$router->route($uri);
   
?>