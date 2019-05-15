<?php

Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[a-z0-9-]+');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::group(['prefix' => 'admin', 'middleware' => 'checkperm'], function() {
Route::group(['prefix' => 'admin'], function() {

    Route::get('dashboard', 'Backend\DashboardController@index')->name('dashboard');

    Route::resource('user', 'Backend\DashboardController');
    Route::get('users.data', 'Backend\DashboardController@anydata')->name('users.data');
});
