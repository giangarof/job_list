<?php
// Run locally
// php -S localhost:8000 -t public

require '../helpers.php';
require getBasePath('Router.php');
require getBasePath('Database.php');
// $db->resetDB('jobs');
$router = new Router();
$routes = require getBasePath('routes.php');

// GET THE CURRENT URI AND METHODS
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// ROUTE THE REQUEST
$router->route($uri,$method);
   
?>