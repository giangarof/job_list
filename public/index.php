<?php
// Run locally
// php -S localhost:8000 -t public

require '../helpers.php';
require getBasePath('Router.php');
require getBasePath('Database.php');
// $config= require getBasePath('config/db.php');
// $db = new Database($config);
// $db->resetDB('jobs');
$router = new Router();
$routes = require getBasePath('routes.php');

// GET THE CURRENT URI AND METHODS
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// ROUTE THE REQUEST
$router->route($uri,$method);
   
?>