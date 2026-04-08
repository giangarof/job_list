<?php

// Display home
$router->get('/','HomeController@index');

// USER

// Display 
$router->get('/user/login', 'UserController@login');
$router->get('/user/signup', 'UserController@signup');
$router->get('/user/profile', 'UserController@profile');

// Authenticate the user LOGIN
$router->post('/auth/loginPost', 'UserController@authenticate');
// Register new user Sign up
$router->post('/auth/signup','UserController@store');
// Logout user
$router->post('/auth/logout','UserController@logout');

// Jobs

// display All jobs
$router->get('/jobs', 'JobsController@index');

// job details by id
$router->get('/job/job_details/{id}',  'JobsController@job_details');

// display form to create a job
$router->get('/job/create', 'JobsController@create');

// submit new job
$router->post('/job/create', 'JobsController@store');

// display form to edit a job
$router->get('/job/edit/{id}', 'JobsController@updateJobForm');

// update job
$router->put('/job/update/{id}', 'JobsController@updateJob');

// delete job
$router->delete('/job/delete/{id}', 'JobsController@deleteJob');



// ERRORS
$router->get('/404', 'ErrorController@error404');
$router->get('/403', 'ErrorController@error403');
?>