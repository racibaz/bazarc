<?php

Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[a-z0-9-]+');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'check_permission'], function() {

    //--Dashboard
    Route::get('dashboard', 'Backend\DashboardController@index')->name('dashboard');
    Route::get('/', 'Backend\DashboardController@index');

    //users
    Route::resource('user', 'Backend\UserController');
    Route::resource('profile', 'Backend\ProfileController')
        ->only(['show', 'edit', 'update']);
    Route::resource('setting', 'Backend\SettingController');
    Route::get('users.data', 'Backend\DashboardController@anydata')->name('users.data');

    Route::get('impersonate', 'Backend\ImpersonateController@index')->name('impersonate');
    Route::post('impersonate', 'Backend\ImpersonateController@impersonate')->name('impersonate');
    Route::delete('impersonate', 'Backend\ImpersonateController@stop');

    //--Logs
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs')->middleware(\App\Http\Middleware\LogViewer::class);
});


//--Authy Two Factor Auth
Route::get('/auth/token', 'Auth\AuthTokenController@getToken');
Route::post('/auth/token', 'Auth\AuthTokenController@postToken');
Route::get('/auth/token/resend', 'Auth\AuthTokenController@getResend');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/settings/twofactor', 'TwoFactorSettingsController@index');
    Route::put('/settings/twofactor', 'TwoFactorSettingsController@update');
});

//Social Media Logins
Route::get ( '/redirect/{service}', 'Auth\SocialAuthController@redirect' );
Route::get ( '/callback/{service}', 'Auth\SocialAuthController@callback' );