<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@getLogout');

    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', 'AuthController@getLogin');
        Route::post('login', 'AuthController@postLogin');
        Route::get('logout', 'AuthController@getLogout');
    });
});

Route::group(['namespace' => 'Backend', 'middleware' => ['auth','Entrust']], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

    Route::resource('user', 'UserController');
    Route::resource('menu', 'MenuController');
    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
});

Route::group(['namespace' => 'Business', 'middleware' => ['auth','Entrust']], function () {
    Route::resource('doctor', 'DoctorController');
    Route::resource('patient', 'PatientController');

    Route::group(['prefix' => 'verify'], function () {
        Route::get('already', ['as' => 'verify.already', 'uses' => 'VerifyController@already']);
        Route::get('todo', ['as' => 'verify.todo', 'uses' => 'VerifyController@todo']);
        Route::get('not', ['as' => 'verify.not', 'uses' => 'VerifyController@not']);
        Route::get('pending', ['as' => 'verify.pending', 'uses' => 'VerifyController@pending']);
    });
    Route::resource('verify', 'VerifyController'); // resource注册的路由需要放在自定义路由下方
});
