<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$router->get('/', 'HomeController@index');

$router->group([
    "prefix" => "api",
], function ($router) {
    $router->get("/messages", "MessagesController@index");
    $router->post("/messages", "MessagesController@store");
});

$router->controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
