<?php

use Illuminate\Support\Facades\Route;

//Route::middleware('auth:api')->prefix('v1')->group(function () {
Route::prefix('v1')->group(function () {
    /*
     * User
     * */
    Route::apiResource('users', 'Api\User\UserController');
    Route::apiResource('activity_logs', 'Api\ActivityLogController')->only(['index', 'show']);
    Route::apiResource('roles', 'Api\RoleController');
    Route::apiResource('permissions', 'Api\PermissionController');
}
);
