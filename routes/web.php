<?php

Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[a-z0-9-]+');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'check_permission'], function() {

    Route::get('dashboard', 'Backend\DashboardController@index')->name('dashboard');

    Route::resource('user', 'Backend\UserController');
    Route::resource('profile', 'Backend\ProfileController')
        ->only(['show', 'edit', 'update']);
    Route::get('users.data', 'Backend\DashboardController@anydata')->name('users.data');
});



Route::get ( '/redirect/{service}', 'Auth\SocialAuthController@redirect' );
Route::get ( '/callback/{service}', 'Auth\SocialAuthController@callback' );