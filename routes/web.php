<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[a-z0-9-]+');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::group(['prefix' => 'admin', 'middleware' => 'checkperm'], function() {
Route::group(['prefix' => 'admin'], function() {

    Route::get('dashboard', 'Backend\DashboardController@index')->name('backend.dashboard');
    Route::get('users', 'Backend\DashboardController@index')->name('backend.users');
//    Route::get('index', 'Backend\DashboardController@index');
//    Route::get('dashboard', 'Backend\DashboardController@index');
});
