<?php

Route::get('/', function () { return 'ICT302 PT3 AppointmentMate API'; });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::apiResource('me', 'ProfileController', ['only' => ['index', 'store']]);
});