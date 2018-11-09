<?php

Route::get('/', function () { return 'ICT302 PT3 AppointmentMate API'; });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::apiResource('me', 'ProfileController', ['only' => ['index', 'store']]);
	Route::post('register', 'AuthController@register');
});

// Admin Panel
Route::group([
    'middleware' => ['auth:api', 'role:convenor'],
], function ($router) {
    Route::apiResource('users','UserController');
    Route::apiResource('locations','LocationController');
    Route::apiResource('appointments','AppointmentController');
});