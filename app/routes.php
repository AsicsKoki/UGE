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
Route::get('measurements/', array('as' => 'measurements', 'uses' => 'MonitoringController@getMeasurements'));

Route::get('temperature', array('as' => 'getTemperature', 'uses' => 'MonitoringController@getTemperature'));
Route::get('humidity', array('as' => 'getHumidity', 'uses' => 'MonitoringController@getHumidity'));
Route::get('co', array('as' => 'getCo', 'uses' => 'MonitoringController@getCo'));
Route::get('co2', array('as' => 'getCo2', 'uses' => 'MonitoringController@getCo2'));
Route::get('pm10', array('as' => 'getPm10', 'uses' => 'MonitoringController@getPm10'));
Route::get('pm25', array('as' => 'getPm25', 'uses' => 'MonitoringController@getPm25'));