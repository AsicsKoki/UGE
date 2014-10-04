<?php

use Carbon\Carbon;

class AdminPanelController extends BaseController {

    public function __construct()
	{
	 	$this->beforeFilter('auth', array('except' => array('')));
		// Enforce user authentication on specified methods.
		$this->beforeFilter('csrf', ['only' => ['authenticate']]);
		parent::__construct();
	}
	public function getAnalyzerList()
	{
		$data = Analyzer::with('customer', 'hub')->get()->toArray();
		return View::make('adminPanel.analyzers')->with('data', $data);
	}
	//Return the list of clients to the clients page. NOTE: Clients are also refered to as customers.
	public function getClientList()
	{
		$data = Customer::with('user')->get()->toArray();
		return View::make('adminPanel.clients')->with('data', $data);
	}
	//Generate the view that holds the registration form.
	public function getRegisterClient()
	{
		return View::make('adminPanel.registerClient')->with('accountTypes', AccountType::all()->toArray());
	}

	private $validationRules = [
			'name'     => 'required|min:3',
			'password' => 'required|min:5',
			'username' => 'required|min:4',
			'contact_email' => 'required',
		];

		private $validationRulesUpdate = [
			'name'     => 'required|min:3',
			'contact_email' => 'required',
		];

		private $validationRulesClient = [
			'name'     => 'required|min:3',
			'password' => 'required|min:4',
			'username' => 'required|min:4',
			'contact_email' => 'required',
		];
	public function postNewClient(){

		$validator = Validator::make(Input::all(),
		    $this->validationRulesClient
		);
		if($validator->fails()){
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
		$customer = new Customer;
		$customer->name = Input::get('client_name');
		$customer->contact_person = Input::get('contact_person');
		$customer->address = Input::get('client_address');
		$customer->contact_phone = Input::get('client_contact_phone');
		$customer->contact_email = Input::get('client_contact_email');
		$customer->active = Input::get('client_active');
		$customer->save();

		$user = new User;
		$user->customers_id = $customer->id;
		$user->username = Input::get('username');
		$user->password = Hash::make(Input::get('password'));
		$user->name = Input::get('name');
		$user->contact_sms = Input::get('contact_sms');
		$user->contact_email = Input::get('contact_email');
		$user->account_types_id = Input::get('account_types_id');
		$user->save();
		Session::flash('status_success', 'Client successfully created');
		return Redirect::route('clients');
	}
	public function getCustomer($cid) {
		return View::make('adminPanel.customerUpdate')
				->with('customer', Customer::find($cid))
				->with('users', Customer::find($cid)->user);
	}
	public function putClient($cid)
	{
		$customer = Customer::find($cid);
		$validator = Validator::make(Input::all(),
		    $this->validationRulesUpdate
		);


		if($validator->passes()){
			$customer->update(Input::all());
			Session::flash('status_success', 'Profile updated');
			return Redirect::route('clients');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}
	public function getRegisterAnalyzer()
	{
		return View::make('adminPanel.newAnalyzer')
				->with('hubs', Hub::lists('id', 'name'))
				->with('customers', Customer::lists('id', 'name'))
				->with('analyzers', DB::table('analyzer_types')->lists('id', 'name'));
	}
	//This function is used to list all alarms for a certain measure type for a certain analyzer type.
	private function listAnalyzerAlarms($analyzerId) {
		$measures = MeasureTypeInAnalyzer::where('analyzers_id', $analyzerId)->lists('id');

		if (!count($measures)) return [];

		$alarms = AlarmTypeForMeasureTypeInAnalyzers::whereIn('measure_types_in_analyzers_id', $measures)->with('alarmType', 'measureTypeInAnalyzer.measureType')->get()->toArray();

		if (!count($alarms)) return [];

		return $alarms;
	}

	public function getAnalyzerAlarmTypesEdit($aid) {
		$analyzer = Analyzer::find($aid);

		$alarms = $this->listAnalyzerAlarms($aid);

		return View::make('partials.alarms')
				->with('alarms', $alarms)
				->with('analyzerId', $aid);
	}
	//This function is used to list all measure types for a certain analyzer type.
	public function getAnalyzerMeasureTypes($aid) {
		$res = DB::table('measure_types_in_analyzer_types')->where('analyzer_types_id', $aid)->lists('measure_types_id');

		if (count($res))
			$measures = MeasureType::whereIn('id', $res)->lists('id', 'name_en');
		else
			$measures = [];

		return View::make('partials.measures')
				->with('measures', $measures);
	}

	public function getAnalyzerMeasureTypesEdit($atid, $aid) {
		$analyzer = Analyzer::find($aid);

		if ($analyzer->analyzer_types_id != $atid) {
			return $this->getAnalyzerMeasureTypes($atid);
		} else {
			$measures = MeasureTypeInAnalyzer::where('analyzers_id', $analyzer->id)->with('measureType')->get()->toArray();

			if (!count($measures))
				$measures = [];
			return View::make('partials.measuresEdit')
					->with('measures', $measures)
					->with('analyzerId', $analyzer->id);
		}
	}

	private function listAlarms($analyzerTypesId) {
		$measureTypesInAnalyzerTypesIds = MeasureTypeInAnalyzerType::where('analyzer_types_id', $analyzerTypesId)->lists('id');

		if (!count($measureTypesInAnalyzerTypesIds)) return [];

		$alarmTypes = AlarmTypeForMeasureTypeInAnalyzersType::whereIn('measure_types_in_analyzer_types_id', $measureTypesInAnalyzerTypesIds)->lists('alarm_types_id');

		if (!count($alarmTypes)) return [];

		return  AlarmType::whereIn('id', $alarmTypes)->get();
	}

	public function getMeasureAlarmTypes($atid) {
		$analyzer = Analyzer::find($atid);

		return View::make('adminPanel.measureAlarms')
				->with('analyzer', $analyzer)
				->with('alarmTypes', $this->listAlarms($analyzer->analyzer_types_id));
	}

	public function getMeasureAlarmTypesEdit($aid, $mid, $alid) {
		$analyzer = Analyzer::find($aid);
		$alarm = AlarmTypeForMeasureTypeInAnalyzers::find($alid);
		return View::make('adminPanel.editMeasureAlarm')
			->with('analyzer', $analyzer)
			->with('alarm', $alarm->toArray())
			->with('alarmTypes', $this->listAlarms($analyzer->analyzer_types_id));
	}

	public function postMeasureAlarmTypes($atid, $aid) {
		if (!MeasureTypeInAnalyzer::find($aid)) {
			Session::flash('status_error', 'The measure type for analyzer does not exist');
			return Redirect::route('analyzers');
		}

		$validator = Validator::make(Input::all(),
		    $this->validationMeasureAlarm
		);

		if($validator->fails()) return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());

		$alarmTypes = new AlarmTypeForMeasureTypeInAnalyzers;
		$alarmTypes->alarm_types_id                = Input::get('alarm_id');
		$alarmTypes->active                        = Input::get('active');
		$alarmTypes->alarm_level                   = Input::get('alarm_level');
		$alarmTypes->alarm_high_flag               = Input::get('alarm_high_flag');
		$alarmTypes->measure_types_in_analyzers_id = $aid;
		$alarmTypes->save();

		Session::flash('status_success', 'Measure Alarm successfully created');
		return Redirect::to('analyzers/'.$atid.'#section3');
	}

	public function postMeasureAlarmTypesEdit($aid, $alid) {
		$validator = Validator::make(Input::all(),
		    $this->validationMeasureAlarm
		);

		if($validator->fails()) return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());

		$alarm = AlarmTypeForMeasureTypeInAnalyzers::find($alid);
		$alarm->active              = Input::get('active');
		$alarm->alarm_types_id      = Input::get('alarm_id');
		$alarm->alarm_level         = Input::get('alarm_level');
		$alarm->alarm_high_flag               = Input::get('alarm_high_flag');
		$alarm->save();
		Session::flash('status_success', 'Measure Alarm successfully updated');
		return Redirect::to('analyzers/'.$aid.'#section3');
	}

	public function removeAlarmType($aid){
		AlarmType::find($aid)->delete();
		Session::flash('status_success', 'Alarm successfully deleted');
		return Redirect::to('alarmManagement');
	}

	public function getEditAlarm($aid){
		return View::make('adminPanel.editAlarm')->with('alarmType', AlarmType::find($aid));
	}

	public function postEditAlarm($aid){
		$alarm = AlarmType::find($aid);
		$alarm->name_en = Input::get('name_en');
		$alarm->name_sr = Input::get('name_sr');
		$alarm->active = Input::get('active');
		$alarm->save();
		Session::flash('status_success', 'Alarm successfully updated');
		return Redirect::to('alarmManagement');
	}

	private $validationMeasureAlarm = [
		'active'            => 'required',
		'alarm_level'       => 'required|numeric',
		'alarm_id' => 'required'
	];


	private $validationRulesAnalyzer = [
		'name'                   => 'required|min:3',
		'modbus_slave_address'   => 'required',
		'current_measure_period' => 'required',
		'short_message_period'   => 'required',
		'long_message_period'    => 'required',
		'alarm_measure_period'   => 'required',
		'measures_before_alarm'  => 'required',
		'hubs_id'                => 'required',
		'input_position'         => 'required',
		'customers_id'           => 'required',
		'active'                 => 'required',
	];

	public function postNewAnalyzer(){

		$validator = Validator::make(Input::all(),
		    $this->validationRulesAnalyzer
		);
		if($validator->passes()){
			$analyzer       = Analyzer::createAnalyzer(Input::get());
			$measureTypesId = Input::get('measure_types_id');
			$lMessPos       = Input::get('long_message_position');
			$sMessPos       = Input::get('short_message_position');
			$cMessPos       = Input::get('current_message_position');

			foreach ($measureTypesId as $key => $typeId) {
				MeasureTypeInAnalyzer::createMeasure($lMessPos[$key], $sMessPos[$key], $cMessPos[$key], $analyzer->id, $typeId);
			}
			Session::flash('status_success', 'Analyzer successfully created');
			return Redirect::route('analyzers');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}

	private function isAnalyzerTypeDisabled($analyzer) {
		$list = $analyzer->measureTypeInAnalyzer()->lists('id');
		if (!count($list)) return false;
		return Measure::whereIn('measure_types_in_analyzers_id', $list)->count() > 0;

	}

	public function getAnalyzer($aid) {

		$analyzer = Analyzer::find($aid);

		if (!$analyzer) {
			Session::flash('status_error', 'The analyzer does not exist');
			return Redirect::route('analyzers');
		}

		return View::make('adminPanel.analyzerUpdate')
				->with('analyzer', $analyzer)
				->with('analyzers', DB::table('analyzer_types')->lists('id', 'name'))
				->with('customers', Customer::lists('id', 'name'))
				->with('analyzerTypeDisabled', $this->isAnalyzerTypeDisabled($analyzer))
				->with('hubs', Hub::lists('id', 'name'));
	}

	public function putAnalyzer($aid)
	{
		$analyzer = Analyzer::find($aid);
		$validator = Validator::make(Input::all(),
		    $this->validationRulesAnalyzer
		);

		if($validator->passes()){
			$type = $analyzer->analyzer_types_id;
			$analyzer->update(Input::all());

			if ($this->isAnalyzerTypeDisabled($analyzer)) {
				$analyzer->analyzer_types_id = $type;
				$analyzer->save();
			}

			$lMessPos = Input::get('long_message_position');
			$sMessPos = Input::get('short_message_position');
			$cMessPos = Input::get('current_message_position');

			if (Input::get('measure_types_in_analyzers_id')) {
				foreach (Input::get('measure_types_in_analyzers_id') as $index => $key) {
					$measure = MeasureTypeInAnalyzer::find($key);
					if ($measure) {
						$measure->update([
							'long_message_position' => $lMessPos[$index],
							'short_message_position' => $sMessPos[$index],
							'current_message_position' => $cMessPos[$index],
						]);
					}
				}
			}
			else {
				$mes = MeasureTypeInAnalyzer::where('analyzers_id', $aid)->lists('id');
				if (count($mes))
					AlarmTypeForMeasureTypeInAnalyzers::whereIn('measure_types_in_analyzers_id', $mes)->delete();

				MeasureTypeInAnalyzer::where('analyzers_id', $aid)->delete();
				$measureTypesId = Input::get('measure_types_id');
				foreach ($measureTypesId as $key => $typeId) {
					MeasureTypeInAnalyzer::createMeasure($lMessPos[$key], $sMessPos[$key], $cMessPos[$key], $analyzer->id, $typeId);
				}
			}

			Session::flash('status_success', 'Analyzer updated');
			return Redirect::route('analyzers');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}

	public function deleteMeasureTypeAlarm($alid){
		AlarmTypeForMeasureTypeInAnalyzers::find($alid)->delete();
		Session::flash('status_success', 'Alarm successfully deleted');
		return Redirect::back();
	}

	public function getHubs()
	{
		$data = Hub::with('analyzer')->get()->toArray();
		return View::make('adminPanel.hubs')->with('data', $data);
	}

	public function getRegisterHub()
	{
		$signalTypes = SignalType::all();
		return View::make('adminPanel.registerHub')->with('signalTypes', $signalTypes);
	}

	private $validationRulesHub = [
		'name'                  => 'required|min:3',
		'interface_type'        => 'required',
		'ip_address'            => 'required',
		'active'                => 'required',
		'port'                  => 'required',
		'rc_address'            => 'required',
		'serial_port_speed'     => 'required',
		'serial_port_parity'    => 'required',
		'serial_port_speed'     => 'required',
		'serial_port_stop_bits' => 'required',
	];

	public function getHub($hid) {
		$signals = SignalTypeInHub::with('signalType')->where('hubs_id', '=', $hid)->get()->toArray();
		return View::make('adminPanel.hubUpdate')->with('hub', Hub::find($hid))->with('signalTypes', $signals);
	}

	public function removeSignalType($hid, $sid){
		SignalTypeInHub::find($sid)->delete();
		Session::flash('status_success', 'Signal successfully removed');
		return Redirect::to('hubs/'.$hid);
	}

	public function getEditSignal($hid, $sid){
		$hub = Hub::find($hid)->toArray();
		$signal = SignalTypeInHub::find($sid)->toArray();
		return View::make('adminPanel.editSignal')->with('hub', $hub)->with('signal', $signal);
	}

	public function postEditSignal($hid, $sid){
		$signal = SignalTypeInHub::find($sid);
		$signal->input_position = Input::get('input_position');
		$signal->negative_logic = Input::get('negative_logic');
		$signal->active = Input::get('active');
		$signal->save();
		Session::flash('status_success', 'Signal successfully updated');
		return Redirect::to('/hubs/'.$hid);
	}

	public function getAssignSignal($hid){
		$hub = Hub::find($hid)->toArray();
		$signal = SignalType::all()->toArray();
		return View::make('adminPanel.assignSignal')->with('hub', $hub)->with('signals', $signal);
	}

	public function postAssignSignal($hid){
		$signal = new SignalTypeInHub;
		$signal->hubs_id = $hid;
		$signal->signal_types_id = Input::get('signal_types_id');
		$signal->input_position = Input::get('input_position');
		$signal->negative_logic = Input::get('negative_logic');
		$signal->active = Input::get('active');
		$signal->save();
		Session::flash('status_success', 'Signal successfully added');
		return Redirect::to('/hubs/'.$hid);
	}

	public function postHub($hubId){
		$hub = Hub::find($hubId);
		$validator = Validator::make(Input::all(),
		    $this->validationRulesHub
		);


		if($validator->passes()){
			$hub->update(Input::all());
			Session::flash('status_success', 'Hub updated');
			return Redirect::route('getHubs');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}

	public function putHub()
	{
		$validator = Validator::make(Input::all(),
		    $this->validationRulesHub
		);
		if($validator->passes()){
			$hub = Hub::createHub(Input::all());
			Session::flash('status_success', 'Hub successfully created');
			return Redirect::to('hubs/'.$hub);
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}

	public function getMeasuresManagement()
	{
		$data = MeasureType::all()->toArray();
		$measureTypeInAnalyzerType = MeasureTypeInAnalyzerType::with('MeasureType')->with('analyzerType')->get()->toArray();
		d($measureTypeInAnalyzerType);
		exit;
		return View::make('adminPanel.measuresManagement')->with('data', $data)->with('measureTypeInAnalyzerType', $measureTypeInAnalyzerType);
	}

	public function getRegisterMeasure()
	{
		return View::make('adminPanel.newMeasure');
	}

	public function getRegisterMeasureTypeInAnalyzer()
	{
		$analyzerTypes= AnalyzerType::all();
		return View::make('adminPanel.newMeasureTypeInAnalyzer')->with('analyzerTypes', $analyzerTypes);
	}

	private $validationRulesMeasureTypeInAnalyzerType = [
			'name_en' => 'required|min:3',
			'name_sr' => 'required',
			'unit'    => 'required',
			'active'  => 'required',
			'threshold'  => 'required',
			'offset'  => 'required',
			'coefficient_of_proportionality'  => 'required',
			'modbus_measure_function'  => 'required',
			'modbus_measure_register'  => 'required',
			'analyzer_types_id'  => 'required'
	];

	public function postRegisterMeasureTypeInAnalyzer(){

		$validator = Validator::make(Input::all(),
		    $this->validationRulesMeasureTypeInAnalyzerType
		);
		if($validator->fails()){
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
		$measureType = new MeasureType;
		$measureType->name_en = Input::get('name_en');
		$measureType->name_sr = Input::get('name_sr');
		$measureType->unit = Input::get('unit');
		$measureType->active = Input::get('active');
		$measureType->save();

		$measureTypeInAnalyzerType = new MeasureTypeInAnalyzerType;
		$measureTypeInAnalyzerType->measure_types_id = $measureType->id;
		$measureTypeInAnalyzerType->analyzer_types_id = Input::get('analyzer_types_id');
		$measureTypeInAnalyzerType->modbus_measure_function = Input::get('modbus_measure_function');
		$measureTypeInAnalyzerType->modbus_measure_register = Input::get('modbus_measure_register');
		$measureTypeInAnalyzerType->coefficient_of_proportionality = Input::get('coefficient_of_proportionality');
		$measureTypeInAnalyzerType->offset = Input::get('offset');
		$measureTypeInAnalyzerType->threshold = Input::get('threshold');
		$measureTypeInAnalyzerType->active = Input::get('active_measureType');
		$measureTypeInAnalyzerType->save();
		Session::flash('status_success', 'Measure successfully created');
		return Redirect::to('measuresManagement');
	}

	private $validationRulesMeasure = [
		'name_en' => 'required|min:3',
		'name_sr' => 'required',
		'unit'    => 'required',
		'active'  => 'required',
	];

	public function postNewMeasure(){

		$validator = Validator::make(Input::all(),
		    $this->validationRulesMeasure
		);
		if($validator->passes()){
			MeasureType::createMeasureType(Input::all());
			Session::flash('status_success', 'Measure successfully created');
			return Redirect::route('getMeasuresManagement');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}

	public function getModbusConsole()
	{
		$analyzerData = Analyzer::all()->toArray();
		$modbusData = ModbusQuery::with('modbusResponse')->with('analyzer')->with('user')->get()->toArray();
		return View::make('adminPanel.modbusConsole')->with('modbusData', $modbusData)->with('analyzerData', $analyzerData);
	}
	private $validationRulesModbus = [
		'function' => 'required|max:2|min:2',
		'comment'    => 'required',
		'data_bytes'  => 'required',
	];
	public function sendModbusQuery()
	{
		$validator = Validator::make(Input::all(),
		    $this->validationRulesModbus
		);
		if($validator->fails()){
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
		$data = Input::all();
		$data['time'] = Carbon::now();
		ModbusQuery::create($data);
		Session::flash('status_success', 'Query successfully created');
		return Redirect::back();
	}

	public function getAlarmManagement()
	{
		$alarms = AlarmType::all();
		return View::make('adminPanel.alarms')
			->with('alarms', $alarms)
			->with('analyzerTypes', AnalyzerType::all());
	}

	public function getAlarmTypesForMeasureTypesInAnalyzerList($atid) {
		$mes = MeasureTypeInAnalyzerType::where('analyzer_types_id', $atid)->lists('id');

		$res = [];

		if (count($mes)) {
			$res = AlarmTypeForMeasureTypeInAnalyzersType::with('alarmType')->with('measureTypeInAnalyzerType.measureType')->whereIn('measure_types_in_analyzer_types_id', $mes)->get()->toArray();
		}

		return View::make('partials.AlarmTypesForMeasureTypesInAnalyzer')
					->with('alarms', $res)
					->with('atid', $atid);
	}

	public function getAlarmTypesForMeasureTypesInAnalyzer($atid, $mid) {
		return View::make('adminPanel.editAlarmTypesForMeasureTypesInAnalyzerTypes')
					->with('atmtat', AlarmTypeForMeasureTypeInAnalyzersType::find($mid))
					->with('alarmTypes', AlarmType::all())
					->with('measureTypes', MeasureTypeInAnalyzerType::with('measureType')->where('analyzer_types_id', $atid)->get());
	}

	public function postAlarmTypesForMeasureTypesInAnalyzer($atid, $mid) {

		$validator = Validator::make(Input::all(),
		    $this->validationRulesAlarmTypesForMeasureTypesInAnalyzer
		);
		if ($validator->fails()) return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());

		$alarmType = AlarmTypeForMeasureTypeInAnalyzersType::find($mid);

		$alarmType->update(Input::all());
		Session::flash('status_success', 'Alarm Type for Measure Type in Analyzer Type successfully updated');
		return Redirect::route('getAlarmManagement');
	}

	private $validationRulesAlarmTypesForMeasureTypesInAnalyzer = [
		'measure_types_in_analyzer_types_id' => 'required|integer',
		'modbus_alarm_state_function'        => 'required|integer',
		'modbus_alarm_state_register'        => 'required|integer',
		'alarm_types_id'                     => 'required|integer'
	];

	private $validationRulesAlarm = [
		'name_sr' => 'required',
		'active'  => 'required',
	];

	public function postNewAlarm(){

		$validator = Validator::make(Input::all(),
		    $this->validationRulesAlarm
		);
		if($validator->passes()){
			AlarmType::createAlarm(Input::all());
			Session::flash('status_success', 'Alarm successfully created');
			return Redirect::route('getAlarmManagement');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}

	public function getRegisterAlarm()
	{
		return View::make('adminPanel.newAlarmType');
	}

	public function getRegisterAlarmTypesForMeasureTypesInAnalyzer($aid)
	{
		$analyzer = AnalyzerType::find($aid);
		if(!$analyzer){
			Session::flash('status_error', 'Analyzer type not found');
			return Redirect::to('alarmManagement');
		}
		$analyzerTypes = AnalyzerType::all();
		$alarmType = AlarmType::all();
		$measureType = MeasureTypeInAnalyzerType::with('measureType')->where('analyzer_types_id', $aid)->get()->toArray();
		return View::make('adminPanel.newAlarmTypesForMeasureTypesInAnalyzer')->with('alarms', $alarmType)->with('measures', $measureType)->with('analyzerTypes', $analyzerTypes)->with('analyzer', $analyzer)->with('aid', $aid);
	}

	public function putAlarmTypesForMeasureTypesInAnalyzer($aid) {

		$validator = Validator::make(Input::all(),
		    $this->validationRulesAlarmTypesForMeasureTypesInAnalyzer
		);
		if ($validator->fails()) return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());

		$alarmType = new AlarmTypeForMeasureTypeInAnalyzersType;
		$alarmType->alarm_types_id = Input::get('alarm_types_id');
		$alarmType->measure_types_in_analyzer_types_id = Input::get('measure_types_in_analyzer_types_id');
		$alarmType->modbus_alarm_state_function = Input::get('modbus_alarm_state_function');
		$alarmType->modbus_alarm_state_register = Input::get('modbus_alarm_state_register');
		$alarmType->save();
		Session::flash('status_success', 'Alarm Type for Measure Type in Analyzer Type successfully added');
		return Redirect::route('getAlarmManagement');
	}

	public function getRegisterSignal()
	{
		return View::make('adminPanel.newSignalType');
	}

	public function getSignalManagement()
	{
		$signals = SignalType::all();
		return View::make('adminPanel.signals')->with('signals', $signals);
	}

	private $validationRulesSignal = [
		'name_sr' => 'required',
		'active'  => 'required',
	];

	public function postNewSignal(){

		$validator = Validator::make(Input::all(),
		    $this->validationRulesSignal
		);
		if($validator->passes()){
			SignalType::createSignal(Input::all());
			Session::flash('status_success', 'Signal successfully created');
			return Redirect::route('getSignalManagement');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}

	public function changeAlarmForMeasureState(){
		$alarm = AlarmTypeForMeasureTypeInAnalyzers::find(Input::get('id'));
		$alarm->active = Input::get('state');
		$alarm->save();
		return 1;
	}

	public function changeAnalyzerState(){
		$analyzer = Analyzer::find(Input::get('id'));
		$analyzer->active = Input::get('state');
		$analyzer->save();
		return 1;
	}

	public function changeClientState(){
		$customer = Customer::find(Input::get('id'));
		$customer->active = Input::get('state');
		$customer->save();
		return 1;
	}

	public function changeHubState(){
		$hub = Hub::find(Input::get('id'));
		$hub->active = Input::get('state');
		$hub->save();
		return 1;
	}

	public function changeMeasureTypeState(){
		$measureType = MeasureType::find(Input::get('id'));
		$measureType->active = Input::get('state');
		$measureType->save();
		return 1;
	}

	public function changeSignalState(){
		$signalType = SignalType::find(Input::get('id'));
		$signalType->active = Input::get('state');
		$signalType->save();
		return 1;
	}

	public function changeAlarmState(){
		$alarmType = AlarmType::find(Input::get('id'));
		$alarmType->active = Input::get('state');
		$alarmType->save();
		return 1;
	}

	public function changeMeasureState(){
		$measure = MeasureTypeInAnalyzer::find(Input::get('id'));
		$measure->active = Input::get('state');
		$measure->save();
		return 1;
	}

	public function cancelAnalyzerAction(){
		return Redirect::intended('analyzers');
	}

	public function cancelHubAction(){
		return Redirect::intended('hubs');
	}

	public function cancelClientAction(){
		return Redirect::intended('clients');
	}

	public function cancelUserAction(){
		return Redirect::intended('clients');
	}

	public function getAddUser($cid){
		return View::make('adminPanel.addUser')->with('cid', $cid)->with('accountTypes', AccountType::all()->toArray());
	}


	private $validationRulesUser = [
			'username'              => 'required|min:3|unique:name,username',
			'password'              => 'required|min:3',
			'password_confirmation' => 'required|min:3',
			'account_types_id'       => 'required'
		];

	public function addUser(){
		$validator = Validator::make(Input::all(),
		    $this->validationRules
		);
		if($validator->fails()){
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
		User::createUser(Input::all());
		Session::flash('status_success', 'User successfully created');
		return Redirect::to("/clients/".Input::get('customers_id'));
	}
}
