<?php

use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->prefix('v1')->group(function () {
 Route::prefix('v1')->group(function () {
    /*
     * User
     * */
    Route::apiResource('users', 'Api\User\UserController');

});