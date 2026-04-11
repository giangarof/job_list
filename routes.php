<?php

// Structure
// $router->[METHOD](URI - CONTROLLER, MIDDLEWARE)

// Display home
$router->get('/','HomeController@index');

                // USER

                // Display 
$router->get('/user/login', 'UserController@login', ['guest']);
$router->get('/user/signup', 'UserController@signup', ['guest']);
$router->get('/user/profile', 'UserController@profile', ['auth']);


                // Actions
// Authenticate the user LOGIN
$router->post('/auth/loginPost', 'UserController@authenticate',['guest']);
// Register new user Sign up
$router->post('/auth/signup','UserController@store',['guest']);
// Logout user
$router->post('/auth/logout','UserController@logout', ['auth']);




                // Jobs

                // Display

// display All jobs
$router->get('/jobs', 'JobsController@index');

// job details by id
$router->get('/job/job_details/{id}',  'JobsController@job_details');

// display form to create a job
$router->get('/job/create', 'JobsController@create', ['auth']);

// display form to edit a job
$router->get('/job/edit/{id}', 'JobsController@updateJobForm', ['auth']);

                // Actions
// submit new job
$router->post('/job/create', 'JobsController@store', ['auth']);

// update job
$router->put('/job/update/{id}', 'JobsController@updateJob', ['auth']);

// delete job
$router->delete('/job/delete/{id}', 'JobsController@deleteJob', ['auth']);

// save job
$router->post('/job/save/{id}', 'JobsController@saveJob', ['auth']);

// apply job
$router->post('/job/apply/{id}', 'JobsController@applyJob', ['auth']);

// Update Status
$router->put('/job/application/update-status/{id}', 'JobsController@updateJobStatus', ['auth']);


// Cancel Application
$router->post('/job/application/cancel/{id}', 'JobsController@cancelJobApplication', ['auth']);


                // Search bar
$router->get('/search', 'JobsController@search');


                // ERRORS
$router->get('/404', 'ErrorController@error404');
$router->get('/403', 'ErrorController@error403');
?>