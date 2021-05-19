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

use App\Models\User;

$router->get('/', function () use ($router) {
    User::factory()->create(['email' => 'hey@danielheart.dev']);
    return $router->app->version();
});

$router->post('/auth/{provider}', ['as' => 'authenticate', 'uses' => 'AuthController@postAuthenticate']);

$router->get('/users/me', ['as' => 'usersMe', 'uses' => 'MeController@getMe']);

$router->post('/transactions', ['as' => 'postTransaction', 'uses' => 'Transactions\TransactionsController@postTransaction']);
