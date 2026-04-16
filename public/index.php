<?php

require __DIR__ . '/../vendor/autoload.php';
// Run locally
// php -S localhost:8000 -t public

require '../helpers.php';
use Framework\Router;
use Framework\Database;
use Framework\Session;
use Framework\Env;

Session::start_session();
Env::load(__DIR__ . '/../config/.env');
// inspect(__DIR__ . '/../config/.env');

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