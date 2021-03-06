<?php

$version = "v1";

Route::prefix("api/{$version}/customers/orders")->group(function() {
    Route::group([
        'middleware' => ['auth:api', 'authCustomer']
    ], function() {
        Route::get('/', '\Tresle\Order\Http\Controllers\OrderController@getOrderCustomerLogged');
        Route::get('/{id}', '\Tresle\Order\Http\Controllers\OrderController@getOrderCustomerLoggedById');
    });
});

Route::prefix("api/{$version}/customers")->group(function() {
    Route::post("/", "\Tresle\Customer\Http\Controllers\CustomerController@store");
    Route::post("/login", "\Tresle\User\Http\Auth\AuthController@login");

    Route::group([
        'middleware' => ['auth:api', 'authCustomer']
    ], function() {
        Route::get('/logout', '\Tresle\User\Http\Auth\AuthController@logout');
        Route::get('/logged', '\Tresle\Customer\Http\Controllers\CustomerController@getCustomerLogged');
    });

    Route::group([
        'middleware' => ['auth:api', 'admin']
    ], function() {
        Route::get('/', '\Tresle\Customer\Http\Controllers\CustomerController@index');
        Route::get('/{id}', '\Tresle\Customer\Http\Controllers\CustomerController@show');
    });

});

Route::prefix("api/{$version}/customers/{idCustomer}/addresses")->group(function() {
    Route::group([
        'middleware' => ['auth:api', 'admin']
    ], function() {
        Route::post("/", "\Tresle\Customer\Http\Controllers\CustomerAddressController@store");
        Route::delete('/{idAddress}', '\Tresle\Customer\Http\Controllers\CustomerAddressController@destroy');
        Route::put('/{idAddress}', '\Tresle\Customer\Http\Controllers\CustomerAddressController@update');
        Route::patch('/{idAddress}', '\Tresle\Customer\Http\Controllers\CustomerAddressController@update');
    });
});

Route::prefix("api/{$version}/customers/addresses")->group(function() {
    Route::group([
        'middleware' => ['auth:api', 'authCustomer']
    ], function() {
        Route::post("/", "\Tresle\Customer\Http\Controllers\CustomerAddressController@addAddressCustomerLogged");
        Route::delete('/{idAddress}', '\Tresle\Customer\Http\Controllers\CustomerAddressController@deleteAddressCustomerLogged');
        Route::put('/{idAddress}', '\Tresle\Customer\Http\Controllers\CustomerAddressController@updateAddressCustomerLogged');
        Route::patch('/{idAddress}', '\Tresle\Customer\Http\Controllers\CustomerAddressController@updateAddressCustomerLogged');
    });
});
