<?php

class AdminPanelController extends BaseController {

    public function __construct()
	{
	 	$this->beforeFilter('auth', array('except' => array('')));
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
		return View::make('adminPanel.customerUpdate')
				->with('customer', Customer::find($cid))
				->with('users', Customer::find($cid)->user);
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
		return View::make('adminPanel.newAnalyzer')
				->with('hubs', Hub::lists('id', 'name'))
				->with('customers', Customer::lists('id', 'name'))
				->with('analyzers', DB::table('analyzer_types')->lists('id', 'name'))
				/*->with('measures', DB::table('measure_types')->lists('id', 'name_en'))*/;
	}

	public function getAnalyzerAlarmTypes($aid) {
		$analyzer = Analyzer::find($aid);

		$mtatId = DB::table('measure_types_in_analyzer_types')->where('analyzer_types_id', $analyzer->analyzer_types_id)->lists('id');

		if (!count($mtatId )) $mtatId = [];


		if (count($mtatId))	{
			$res = DB::table('alarm_types_for_measure_types_in_analyzer_types')->whereIn('measure_types_in_analyzer_types_id', $mtatId)->lists('alarm_types_id');

			if (count($res))
				$alarms = AlarmType::whereIn('id', $res)->lists('id', 'name_en');
			else
				$alarms = [];
		} else {
			$alarms = [];
		}

		// dd(MeasureTypeInAnalyzer::where('analyzers_id', $aid)->with('measureType')->get()->toArray());

		return View::make('partials.alarms')
				->with('alarms', $alarms)
				->with('measureTypeInAnalyzerIds', MeasureTypeInAnalyzer::where('analyzers_id', $aid)->with('measureType')->get()->toArray());
	}

	public function getAnalyzerAlarmTypesEdit($atid, $aid) {
		$analyzer = Analyzer::find($aid);

		if ($analyzer->analyzer_types_id != $atid) {
			return $this->getAnalyzerAlarmTypes($atid);
		} else {
			$alarms = MeasureTypeInAnalyzer::where('analyzers_id', $analyzer->id)->with('alarmsType')->get()->toArray();

			if (!count($alarms))
				$alarms = [];

			return View::make('partials.alarmsEdit')
					->with('alarms', $alarms);
		}
	}


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
					->with('measures', $measures);
		}
	}

	private $validationRulesAnalyzer = [
		'name'                   => 'required|min:3',
		'modbus_slave_address'   => 'required',
		'current_measure_period' => 'required',
		'short_message_period'   => 'required',
		'long_message_period'   => 'required',
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
			$analyzer = Analyzer::createAnalyzer(Input::get());
			$measureTypesId = Input::get('measure_types_id');
			$lMessPos = Input::get('long_message_position');
			$sMessPos = Input::get('short_message_position');
			$cMessPos = Input::get('current_message_position');

			foreach ($measureTypesId as $key => $typeId) {
				MeasureTypeInAnalyzer::createMeasure($lMessPos[$key], $sMessPos[$key], $cMessPos[$key], $analyzer->id, $typeId);
			}
			Session::flash('status_success', 'Analyzer successfully created');
			return Redirect::route('analyzers');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}

	public function getAnalyzer($aid) {

		$analyzer = Analyzer::find($aid);

		return View::make('adminPanel.analyzerUpdate')
				->with('analyzer', $analyzer)
				->with('analyzers', DB::table('analyzer_types')->lists('id', 'name'))
				->with('customers', Customer::lists('id', 'name'))
				->with('hubs', Hub::lists('id', 'name'));
	}

	public function putAnalyzer($aid)
	{
		$analyzer = Analyzer::find($aid);
		$validator = Validator::make(Input::all(),
		    $this->validationRulesAnalyzer
		);

		if($validator->passes()){
			$analyzer->update(Input::all());

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
				MeasureTypeInAnalyzer::where('analyzers_id', $aid)->delete();
				$measureTypesId = Input::get('measure_types_id');
				$lMessPos = Input::get('long_message_position');
				$sMessPos = Input::get('short_message_position');
				$cMessPos = Input::get('current_message_position');

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
		$analyzerData = Analyzer::all()->toArray();
		$modbusResponses = ModbusResponses::all()->toArray();
		// d($analyzerData, $modbusResponses);
		// exit;
		return View::make('adminPanel.modbusConsole')->with('analyzerData', $analyzerData);
	}

	public function sendModbusQuery()
	{
		$data = Input::all();
		ModbusQuery::create($data);
		return Redirect::back();
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
}
