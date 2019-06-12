<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

 Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
//Route::group(['prefix' => 'v1'], function () {

    /*
     * User
     * */
    Route::resource('users', 'Api\User\UserController', ['only' => ['index', 'show']]);

});


