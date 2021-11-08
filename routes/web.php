<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});

$router->get('all', 'ItemsController@index');
$router->get('show/{id:[0-9]+}', 'ItemsController@show');
$router->post('store', 'ItemsController@store');
$router->put('update/{id:[0-9]+}', 'ItemsController@update');
$router->delete('destroy/{id:[0-9]+}', 'ItemsController@destroy');


