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

Route::get('/', array('as' => 'homePage', 'uses' => 'HomeController@showWelcome'));

// Log in;
Route::get('login', array('uses' => 'UsersController@login'));
Route::post('login', array('as' => 'authenticate', 'uses' => 'UsersController@authenticate'));
Route::get('register', array('as' => 'register', 'uses' => 'UsersController@getRegister'));
Route::post('register', array('as'=>'postNewUser', 'uses' => 'UsersController@postNewUser'));
