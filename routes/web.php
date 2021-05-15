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
    $user = [
        'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
        'name' => 'eae',
        'email' => 'fake@danielheart.dev',
        'password' => \Illuminate\Support\Facades\Hash::make('123123'),
        'document_id' => 123
    ];
    \App\Models\User::create($user);
    return $router->app->version();
});

$router->post('/auth/{provider}', ['as' => 'authenticate', 'uses' => 'AuthController@postAuthenticate']);
$router->get('/test', 'TestController@test');

$router->get('users/me', 'User\MeController@getMe');
