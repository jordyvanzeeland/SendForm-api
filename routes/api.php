<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiKeyValidationMiddleware;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
});

Route::post("register", 'App\Http\Controllers\UserController@registerUser');

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get('/clients', 'App\Http\Controllers\ClientsController@getAllClients');
    Route::get('/clients/{clientid}', 'App\Http\Controllers\ClientsController@getClientByID');
    Route::post('/clients', 'App\Http\Controllers\ClientsController@newClient');
    Route::put ('/clients/{clientid}', 'App\Http\Controllers\ClientsController@updateClient');
    Route::delete ('/clients/{clientid}', 'App\Http\Controllers\ClientsController@deleteClient');

    Route::get('/apikeys', 'App\Http\Controllers\ApiKeysController@getAllKeys');
    Route::get('/apikeys/{keyid}', 'App\Http\Controllers\ApiKeysController@getKeyByID');
    Route::post('/apikeys', 'App\Http\Controllers\ApiKeysController@newKey');
    Route::put ('/apikeys/{keyid}', 'App\Http\Controllers\ApiKeysController@updateKey');
    Route::delete ('/apikeys/{keyid}', 'App\Http\Controllers\ApiKeysController@deleteKey');
});

Route::group([
    'middleware' => ApiKeyValidationMiddleware::class,
    'prefix' => 'mail'
], function ($router) {
    Route::post('/send', 'App\Http\Controllers\MailController@send');
    // Route::post('/woocommerce/order-email', [WooMailController::class, 'sendOrderMail']);
});


