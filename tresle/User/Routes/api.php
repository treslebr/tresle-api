<?php

$version = "v1";

Route::prefix("api/{$version}/user")->group(function() {
    Route::post("/", "\Tresle\User\Http\Auth\AuthController@store");
    Route::post("/login", "\Tresle\User\Http\Auth\AuthController@login");

    Route::group([
        'middleware' => ['auth:api']
    ], function() {
        Route::get('/logout', '\Tresle\User\Http\Auth\AuthController@logout');
        Route::get('/logged', '\Tresle\User\Http\Auth\AuthController@getUserLogged');
    });

});