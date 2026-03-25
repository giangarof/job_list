<?php

require '../helpers.php';

// Run locally
// php -S localhost:8000 -t public


// Run sql
//

require getBasePath('Database.php');
$config = require getBasePath('config/db.php');

// instantiate DB
$db = new Database($config);
// $db->resetDB('jobs');

require getBasePath('Router.php');

$router = new Router();
$routes = require getBasePath('routes.php');

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];


$router->route($uri,$method);
   
?>