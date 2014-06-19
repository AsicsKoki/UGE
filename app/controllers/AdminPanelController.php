<?php

class AdminPanelController extends BaseController {

    public function __construct()
	{
	 	// $this->beforeFilter('auth', array('except' => array('')));
		// Enforce user authentication on specified methods
		$this->beforeFilter('csrf', ['only' => ['authenticate']]);
		parent::__construct();
	}

	public function getAnalyzerList()
	{
		$data = Analyzer::with('customer', 'hub')->get()->toArray();
		return View::make('adminPanel.analyzers')->with('data', $data);
	}

	public function getClientList()
	{
		$data = Customer::with('user')->get()->toArray();
		return View::make('adminPanel.clients')->with('data', $data);
	}

	public function getRegisterClient()
	{
		return View::make('adminPanel.registerClient');
	}

	private $validationRules = [
			'name'           => 'required|min:3',
			'address'        => 'required',
			'contact_person' => 'required',
			'active'         => 'required',
		];

	public function postNewClient(){

		$validator = Validator::make(Input::all(),
		    $this->validationRules
		);
		if($validator->passes()){
			customer::createCustomer(Input::all());
			Session::flash('status_success', 'Client successfully created');
			return Redirect::route('clients');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}

	public function getCustomer($cid) {
		return View::make('adminPanel.customerUpdate')->with('customer', Customer::find($cid));
	}

	public function putClient($cid)
	{
		$customer = Customer::find($cid);
		$validator = Validator::make(Input::all(),
		    $this->validationRules
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
		return View::make('adminPanel.newAnalyzer');
	}

	private $validationRulesAnalyzer = [
		'name'                   => 'required|min:3',
		'modbus_slave_address'   => 'required',
		'current_measure_period' => 'required',
		'short_message_period'   => 'required',
		'alarm_message_period'   => 'required',
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
			Analyzer::createAnalyzer(Input::all());
			Session::flash('status_success', 'Analyzer successfully created');
			return Redirect::route('analyzers');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}

	public function getAnalyzer($aid) {
		return View::make('adminPanel.analyzerUpdate')->with('analyzer', Analyzer::find($aid));
	}

	public function putAnalyzer($aid)
	{
		$analyzer = Analyzer::find($aid);
		$validator = Validator::make(Input::all(),
		    $this->validationRules
		);


		if($validator->passes()){
			$analyzer->update(Input::all());
			Session::flash('status_success', 'Analyzer updated');
			return Redirect::route('analyzers');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}


	public function getHubs()
	{
		$data = Hub::with('analyzer')->get()->toArray();
		return View::make('adminPanel.hubs')->with('data', $data);
	}

	public function getRegisterHub()
	{
		return View::make('adminPanel.registerHub');
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

	public function postNewHub(){

		$validator = Validator::make(Input::all(),
		    $this->validationRulesHub
		);
		if($validator->passes()){
			Hub::createHub(Input::all());
			Session::flash('status_success', 'Hub successfully created');
			return Redirect::route('getHubs');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}

	public function getHub($hid) {
		return View::make('adminPanel.hubUpdate')->with('hub', Hub::find($hid));
	}

	public function putHub($hid)
	{
		$hub = Hub::find($hid);
		$validator = Validator::make(Input::all(),
		    $this->validationRules
		);


		if($validator->passes()){
			$hub->update(Input::all());
			Session::flash('status_success', 'Hub updated');
			return Redirect::route('hubs');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}

	public function getMeasuresManagement()
	{
		$data = MeasureType::all()->toArray();
		return View::make('adminPanel.measuresManagement')->with('data', $data);
	}

	public function getRegisterMeasure()
	{
		return View::make('adminPanel.newMeasure');
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
		return View::make('adminPanel.modbusConsole');
	}

	public function getAlarmManagement()
	{
		$alarms = AlarmType::all();
		return View::make('adminPanel.alarms')->with('alarms', $alarms);
	}

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
}