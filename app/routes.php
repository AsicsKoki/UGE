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
Route::get('clientUser', array('as' => 'cancelUserAction',  'uses' => 'AdminPanelController@cancelUserAction'));

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
Route::post('clients/changeClientState', array('as' => 'changeClientState',  'uses' => 'AdminPanelController@changeClientState'));
Route::get('clientCancel', array('as' => 'cancelClientAction',  'uses' => 'AdminPanelController@cancelClientAction'));
Route::get('clients/{cid}/newUser', array('as' => 'getAddUser', 'uses' => 'AdminPanelController@getAddUser'));
Route::post('clients/{cid}/addUser', array('as' => 'addUser', 'uses' => 'AdminPanelController@addUser'));


Route::get('analyzers', array('as' => 'analyzers', 'uses' => 'AdminPanelController@getAnalyzerList'));
Route::get('registerAnalyzer', array('as' => 'registerAnalyzer', 'uses' => 'AdminPanelController@getRegisterAnalyzer'));
Route::post('registerAnalyzer', array('as'=>'postNewAnalyzer', 'uses' => 'AdminPanelController@postNewAnalyzer'));
Route::put('analyzers/{analyzerId}', array('as'=>'putAnalyzer', 'uses' => 'AdminPanelController@putAnalyzer'))->where('analyzerId', '\d+');
Route::get('analyzers/{analyzerId}', array('as' => 'getAnalyzer',  'uses' => 'AdminPanelController@getAnalyzer'))->where('analyzerId', '\d+');
Route::post('analyzers/changeAnalyzerState', array('as' => 'changeAnalyzerState',  'uses' => 'AdminPanelController@changeAnalyzerState'));
Route::post('analyzers/changeMeasureState', array('as' => 'changeMeasureState',  'uses' => 'AdminPanelController@changeMeasureState'));
Route::get('analyzersCancel', array('as' => 'cancelAnalyzerAction',  'uses' => 'AdminPanelController@cancelAnalyzerAction'));


Route::post('analyzers/changeAlarmForMeasureState', array('as' => 'changeAlarmForMeasureState',  'uses' => 'AdminPanelController@changeAlarmForMeasureState'));

Route::get('analyzerMeasureTypes/{aid}', array('as' => 'analyzerMeasureTypes', 'uses' => 'AdminPanelController@getAnalyzerMeasureTypes'))->where('aid', '\d+');
Route::get('analyzerMeasureTypesEdit/{atid}/{aid}', array('as' => 'analyzerMeasureTypes', 'uses' => 'AdminPanelController@getAnalyzerMeasureTypesEdit'))->where('aid', '\d+')->where('atid', '\d+');

Route::get('analyzerAlarmTypesEdit/{aid}', array('as' => 'analyzerAlarmTypes', 'uses' => 'AdminPanelController@getAnalyzerAlarmTypesEdit'))->where('aid', '\d+');
Route::get('analyzer/{aid}/measure/{mid}/alarms', array('as' => 'analyzerMeasureAlarmTypes', 'uses' => 'AdminPanelController@getMeasureAlarmTypes'))->where('aid', '\d+')->where('atid', '\d+');
Route::post('analyzer/{aid}/measure/{mid}/alarms', array('as' => 'analyzerMeasureAlarmTypes', 'uses' => 'AdminPanelController@postMeasureAlarmTypes'))->where('aid', '\d+')->where('atid', '\d+');
Route::get('analyzer/alarms/{alid}', array('as' => 'deleteMeasureTypeAlarm', 'uses' => 'AdminPanelController@deleteMeasureTypeAlarm'))->where('alid', '\d+');
Route::get('analyzer/{aid}/measure/{mid}/alarms/{alid}', array('as' => 'analyzerMeasureAlarmTypesEdit', 'uses' => 'AdminPanelController@getMeasureAlarmTypesEdit'));
Route::post('analyzer/{aid}/alarms/{alid}', array('as' => 'postAnalyzerMeasureAlarmTypesEdit', 'uses' => 'AdminPanelController@postMeasureAlarmTypesEdit'));


Route::get('hubs', array('as' => 'getHubs', 'uses' => 'AdminPanelController@getHubs'));
Route::get('registerHub', array('as' => 'getRegisterHub', 'uses' => 'AdminPanelController@getRegisterHub'));
Route::put('registerHub', array('as'=>'putNewHub', 'uses' => 'AdminPanelController@putHub'));
Route::post('hubs/{hubId}', array('as'=>'postHub', 'uses' => 'AdminPanelController@postHub'))->where('hubId', '\d+');
Route::get('hubs/{hubId}', array('as' => 'getHub',  'uses' => 'AdminPanelController@getHub'))->where('hubId', '\d+');
Route::post('hubs/changeHubState', array('as' => 'changeHubState',  'uses' => 'AdminPanelController@changeHubState'));
Route::get('hubsCancel', array('as' => 'cancelHubAction',  'uses' => 'AdminPanelController@cancelHubAction'));

Route::get('measuresManagement', array('as' => 'getMeasuresManagement', 'uses' => 'AdminPanelController@getMeasuresManagement'));
Route::post('measuresManagement', array('as'=>'postNewMeasure', 'uses' => 'AdminPanelController@postNewMeasure'));
Route::get('registerMeasure', array('as'=>'registerMeasure', 'uses' => 'AdminPanelController@getRegisterMeasure'));
Route::post('measuresManagement/changeMeasureTypeState', array('as' => 'changeMeasureTypeState',  'uses' => 'AdminPanelController@changeMeasureTypeState'));
Route::get('getRegisterMeasureTypeInAnalyzer', array('as'=>'getRegisterMeasureTypeInAnalyzer', 'uses' => 'AdminPanelController@getRegisterMeasureTypeInAnalyzer'));
Route::post('postRegisterMeasureTypeInAnalyzer', array('as'=>'postRegisterMeasureTypeInAnalyzer', 'uses' => 'AdminPanelController@postRegisterMeasureTypeInAnalyzer'));

Route::get('modbusConsole', array('as' => 'getModbusConsole', 'uses' => 'AdminPanelController@getModbusConsole'));
Route::post('modbusConsole', array('as' => 'sendModbusQuery', 'uses' => 'AdminPanelController@sendModbusQuery'));

Route::get('alarmManagement', array('as' => 'getAlarmManagement', 'uses' => 'AdminPanelController@getAlarmManagement'));
Route::post('alarmManagement', array('as'=>'postNewAlarm', 'uses' => 'AdminPanelController@postNewAlarm'));
Route::get('registerAlarm', array('as' => 'getRegisterAlarm', 'uses' => 'AdminPanelController@getRegisterAlarm'));
Route::post('alarmManagement/changeAlarmState', array('as' => 'changeAlarmState',  'uses' => 'AdminPanelController@changeAlarmState'));
Route::get('alarmManagement/{aid}/delete', array('as' => 'removeAlarmType', 'uses' => 'AdminPanelController@removeAlarmType'))->where('id', '\d+');
Route::get('alarmManagement/{aid}', array('as' => 'getEditAlarm', 'uses' => 'AdminPanelController@getEditAlarm'));
Route::post('alarmManagement/{aid}', array('as' => 'postEditAlarm', 'uses' => 'AdminPanelController@postEditAlarm'));

Route::get('alarmManagement/alarmTypes/{atid}', array('as' => 'getAlarmTypesForMeasureTypesInAnalyzerList', 'uses' => 'AdminPanelController@getAlarmTypesForMeasureTypesInAnalyzerList'))->where('atid', '\d+');

Route::get('alarmManagement/alarmTypes/{atid}/{mid}', array('as' => 'getAlarmTypesForMeasureTypesInAnalyzer', 'uses' => 'AdminPanelController@getAlarmTypesForMeasureTypesInAnalyzer'))->where('atid', '\d+')->where('mid', '\d+');
Route::post('alarmManagement/alarmTypes/{atid}/{mid}', array('as' => 'postAlarmTypesForMeasureTypesInAnalyzer', 'uses' => 'AdminPanelController@postAlarmTypesForMeasureTypesInAnalyzer'))->where('atid', '\d+')->where('mid', '\d+');

//////////////////////
Route::get('registerAnalyzerAlarm/{aid}', array('as' => 'getRegisterAlarmTypesForMeasureTypesInAnalyzer', 'uses' => 'AdminPanelController@getRegisterAlarmTypesForMeasureTypesInAnalyzer'));
Route::post('registerAnalyzerAlarm/{aid}', array('as' => 'putAlarmTypesForMeasureTypesInAnalyzer', 'uses' => 'AdminPanelController@putAlarmTypesForMeasureTypesInAnalyzer'));


Route::get('signalManagement', array('as' => 'getSignalManagement', 'uses' => 'AdminPanelController@getSignalManagement'));
Route::post('signalManagement', array('as'=>'postNewSignal', 'uses' => 'AdminPanelController@postNewSignal'));
Route::get('registerSignal', array('as' => 'getRegisterSignal', 'uses' => 'AdminPanelController@getRegisterSignal'));
Route::post('signalManagement/changeSignalState', array('as' => 'changeSignalState',  'uses' => 'AdminPanelController@changeSignalState'));
Route::get('hubs/{hid}/delete/{sid}', array('as' => 'removeSignalType', 'uses' => 'AdminPanelController@removeSignalType'))->where('sid', '\d+')->where('hid', '\d+');
Route::get('hubs/{hid}/signal/{sid}', array('as' => 'getEditSignal', 'uses' => 'AdminPanelController@getEditSignal'));
Route::post('hubs/{hid}/signal/{sid}', array('as' => 'postEditSignal', 'uses' => 'AdminPanelController@postEditSignal'));
Route::get('hubs/{hid}/newSignal', array('as' => 'getAssignSignal', 'uses' => 'AdminPanelController@getAssignSignal'));
Route::post('hubs/{hid}/newSignal', array('as' => 'postAssignSignal', 'uses' => 'AdminPanelController@postAssignSignal'));