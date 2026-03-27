<?php


$router->get('/','controllers/home.php');
$router->get('/user/login', 'controllers/user/login.php');
$router->get('/user/signup', 'controllers/user/signup.php');

$router->get('/listings',  'controllers/listings/index.php');
$router->get('/listings/listing_details',  'controllers/listings/listing_details.php');
$router->get('/listings/create', 'controllers/listings/create.php');
$router->get('/listings/index', 'controllers/listings/index.php');

$router->get('/404', 'controllers/error/404.php');
?>