<?php

Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[a-z0-9-]+');

Route::get('/', function () {
    return view('welcome');
}
);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'check_permission'], function () {

    //--Dashboard
    Route::get('dashboard', 'Backend\DashboardController@index')->name('dashboard');
    Route::get('/', 'Backend\DashboardController@index');

    //users
    Route::get('users/anyData', 'Backend\UserController@anyData')->name('users.anyData');
    Route::resource('user', 'Backend\UserController');
    Route::resource('profile', 'Backend\ProfileController')
        ->only(['show', 'edit', 'update']);
    Route::resource('setting', 'Backend\SettingController');

    //impersonate
    Route::get('impersonate', 'Backend\ImpersonateController@index')->name('impersonate');
    Route::post('impersonate', 'Backend\ImpersonateController@impersonate')->name('impersonate');
    Route::delete('impersonate/stop', 'Backend\ImpersonateController@stop')->name('impersonate.stop');


    //UserActivity
    Route::resource('activity_log', 'Backend\ActivityLogController')->only([
        'index',
        'show']
    );

    //Role
    Route::resource('role', 'Backend\RoleController');

    //Permission
    Route::resource('permission', 'Backend\PermissionController');


    //--Logs
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs'
    )->middleware(\App\Http\Middleware\LogViewer::class);
}
);


//--Authy Two Factor Auth
Route::get('/auth/token', 'Auth\AuthTokenController@getToken');
Route::post('/auth/token', 'Auth\AuthTokenController@postToken');
Route::get('/auth/token/resend', 'Auth\AuthTokenController@getResend');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/settings/twofactor', 'TwoFactorSettingsController@index');
    Route::put('/settings/twofactor', 'TwoFactorSettingsController@update');
}
);

//Social Media Logins
Route::get('/redirect/{service}', 'Auth\SocialAuthController@redirect');
Route::get('/callback/{service}', 'Auth\SocialAuthController@callback');

//impersonate for basic roles without permission
Route::delete('impersonate/stop', 'Backend\ImpersonateController@stop')->name('impersonate.stop');

//create passport token
Route::post('/passport/token/create', 'Auth\PassportAuthController@store')->name('passport.token.create');

//todo
Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d-/_.]+)?');