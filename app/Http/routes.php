<?php

$router->get('/', 'HomeController@index');

// User signup/login
$router->get('/signup', 'UserController@signup');
$router->get('/login', 'UserController@login');
$router->post('/signup', 'UserController@signupRequest');
$router->post('/login', 'UserController@loginRequest');
$router->get('/logout', 'UserController@logout');

// API
$router->group([
    "prefix" => "api",
], function ($router) {
    $router->get("/messages", "MessagesController@index");
    $router->post("/messages", "MessagesController@store");

    $router->get("/current", "UserController@current");
});
