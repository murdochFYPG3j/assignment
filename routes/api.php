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
    Route::post('reset-password', 'AuthController@resetPassword');
});

// Admin Panel
Route::group([
    'middleware' => ['auth:api', 'role:convenor'],
], function ($router) {
    Route::apiResource('users','UserController');
    // Route::apiResource('locations','LocationController');
    Route::apiResource('appointments','AppointmentController');
});

// Any logged in users
Route::group([
    'middleware' => ['auth:api'],
], function ($router) {
    Route::get('my-appointments','MyAppointmentController@index');
    
    Route::get('appointment-slots/all','AppointmentSlotController@getAll');
    Route::get('appointment-slots/available','AppointmentSlotController@getAvailable');

    Route::post('appointment-slot/{appointment}/book', 'AppointmentSlotController@book');
    Route::post('appointment-slot/{appointment}/cancel', 'AppointmentSlotController@cancel');
});