<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
    //return $request->user();
//})->middleware('auth:sanctum');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');

    Route::post('register', 'App\Http\Controllers\AuthController@register');
    Route::post('forgot_password', 'App\Http\Controllers\AuthController@forgot_password');

    // Nueva ruta para agendar citas desde la aplicación móvil
    Route::post('verificarYReservarApi', 'App\Http\Controllers\EventController@verificarYReservarApi');

});