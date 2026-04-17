<?php

require __DIR__ . '/../vendor/autoload.php';

require '../helpers.php';
use Framework\Router;
use Framework\Database;
use Framework\Session;
use Framework\Env;

Session::start_session();
Env::load(__DIR__ . '/../config/.env');


$router = new Router();
$routes = require getBasePath('routes.php');

// GET THE CURRENT URI AND METHODS
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


// ROUTE THE REQUEST
$router->route($uri);

// Run locally
// php -S localhost:8000 -t public

// seed render
// psql postgresql://admin:knFomvNwXBlH2atY5dreUeYv0V7v5j8n@dpg-d7gpppj7uimc73cu5ikg-a.oregon-postgres.render.com/jobs_32p6 -f script.sql

// connect
// psql postgresql://admin:knFomvNwXBlH2atY5dreUeYv0V7v5j8n@dpg-d7gpppj7uimc73cu5ikg-a.oregon-postgres.render.com/jobs_32p6


// Locally restar db
// $config= require getBasePath('config/db.php');
// $db = new Database($config);
// $db->resetDB('jobs');
   
?>