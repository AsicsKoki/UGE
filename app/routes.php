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

Route::get('monitoring', array('as' => 'monitoring', 'uses' => 'MonitoringController@getMonitoring'));
Route::get('controlPanel', array('as' => 'controlPanel', 'uses' => 'MonitoringController@getControlPanel'));
Route::get('consumption', array('as' => 'consumption', 'uses' => 'MonitoringController@getConsumption'));
Route::get('measurements/{startDate?}/{endDate?}', array('as' => 'measurements', 'uses' => 'MonitoringController@getMeasurements'))->where('startDate', '\d+')->where('endDate', '\d+');
Route::get('measurements', array('as' => 'measurements', 'uses' => 'MonitoringController@getMeasurements'));
Route::get('/voltageUpdate', array('as' => 'getLatestVoltage', 'uses' => 'MonitoringController@getLatestVoltage'));



Route::get('clients', array('as' => 'clients', 'uses' => 'AdminPanelController@getClientList'));
Route::get('registerClients', array('as' => 'registerClient', 'uses' => 'AdminPanelController@getRegisterClient'));
Route::post('registerClient', array('as'=>'postNewClient', 'uses' => 'AdminPanelController@postNewClient'));
Route::put('clients/{clientId}', array('as'=>'putClient', 'uses' => 'AdminPanelController@putClient'))->where('clientId', '\d+');
Route::get('clients/{clientId}', array('as' => 'getClient',  'uses' => 'AdminPanelController@getCustomer'))->where('clientId', '\d+');


Route::get('analyzers', array('as' => 'analyzers', 'uses' => 'AdminPanelController@getAnalyzerList'));
Route::get('registerAnalyzer', array('as' => 'registerAnalyzer', 'uses' => 'AdminPanelController@getRegisterAnalyzer'));
Route::post('registerAnalyzer', array('as'=>'postNewAnalyzer', 'uses' => 'AdminPanelController@postNewAnalyzer'));
Route::put('analyzers/{analyzerId}', array('as'=>'putAnalyzer', 'uses' => 'AdminPanelController@putAnalyzer'))->where('analyzerId', '\d+');
Route::get('analyzers/{analyzerId}', array('as' => 'getAnalyzer',  'uses' => 'AdminPanelController@getAnalyzer'))->where('analyzerId', '\d+');



Route::get('hubs', array('as' => 'getHubs', 'uses' => 'AdminPanelController@getHubs'));
Route::get('registerHub', array('as' => 'getRegisterHub', 'uses' => 'AdminPanelController@getRegisterHub'));
Route::post('registerHub', array('as'=>'postNewHub', 'uses' => 'AdminPanelController@postNewHub'));
Route::put('hubs/{hubId}', array('as'=>'putHub', 'uses' => 'AdminPanelController@putHub'))->where('hubId', '\d+');
Route::get('hubs/{hubId}', array('as' => 'getHub',  'uses' => 'AdminPanelController@getHub'))->where('hubId', '\d+');



Route::get('measuresManagement', array('as' => 'getMeasuresManagement', 'uses' => 'AdminPanelController@getMeasuresManagement'));
Route::post('measuresManagement', array('as'=>'postNewMeasure', 'uses' => 'AdminPanelController@postNewMeasure'));
Route::get('registerMeasure', array('as'=>'registerMeasure', 'uses' => 'AdminPanelController@getRegisterMeasure'));

Route::get('modbusConsole', array('as' => 'getModbusConsole', 'uses' => 'AdminPanelController@getModbusConsole'));
Route::post('modbusConsole', array('as' => 'sendModbusQuery', 'uses' => 'AdminPanelController@sendModbusQuery'));

Route::get('alarmManagement', array('as' => 'getAlarmManagement', 'uses' => 'AdminPanelController@getAlarmManagement'));
Route::post('alarmManagement', array('as'=>'postNewAlarm', 'uses' => 'AdminPanelController@postNewAlarm'));
Route::get('registerAlarm', array('as' => 'getRegisterAlarm', 'uses' => 'AdminPanelController@getRegisterAlarm'));

Route::get('signalManagement', array('as' => 'getSignalManagement', 'uses' => 'AdminPanelController@getSignalManagement'));
Route::post('signalManagement', array('as'=>'postNewSignal', 'uses' => 'AdminPanelController@postNewSignal'));
Route::get('registerSignal', array('as' => 'getRegisterSignal', 'uses' => 'AdminPanelController@getRegisterSignal'));