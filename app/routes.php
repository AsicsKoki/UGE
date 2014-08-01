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

Route::get('temperature', array('as' => 'getTemperature', 'uses' => 'MonitoringController@getTemperature'));

Route::get('measurements/', array('as' => 'measurements', 'uses' => 'MonitoringController@getMeasurements'));