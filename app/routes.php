<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'homePage', 'uses' => 'HomeController@getHome'));

// Log in;
Route::get('users', array('as' => 'getUsers',  'uses' => 'UsersController@getUsers'));
Route::get('users/{userId}', array('as' => 'getUser',  'uses' => 'UsersController@getUser'))->where('userId', '\d+');

Route::get('login', array('uses' => 'UsersController@login'));
Route::post('login', array('as' => 'authenticate', 'uses' => 'UsersController@authenticate'));
Route::get('register', array('as' => 'register', 'uses' => 'UsersController@getRegister'));

Route::post('register', array('as'=>'postNewUser', 'uses' => 'UsersController@postNewUser'));
Route::put('users/{userId}', array('as'=>'putUser', 'uses' => 'UsersController@putUser'))->where('userId', '\d+');

Route::get('users/{userId}/delete', array('as' => 'deleteUser',  'uses' => 'UsersController@deleteUser'))->where('userId', '\d+');

Route::get('logout', array('as' => 'logout', 'uses' => 'UsersController@logout'));

// Route::get('analyzers', array('as' => 'analyzers', 'uses' => 'ChartController@getAnalyzerList'));
Route::get('monitoring', array('as' => 'monitoring', 'uses' => 'MonitoringController@getMonitoring'));
Route::get('controlPanel', array('as' => 'controlPanel', 'uses' => 'MonitoringController@getControlPanel'));
Route::get('consumption', array('as' => 'consumption', 'uses' => 'MonitoringController@getConsumption'));
Route::get('measurements', array('as' => 'measurements', 'uses' => 'MonitoringController@getMeasurements'));