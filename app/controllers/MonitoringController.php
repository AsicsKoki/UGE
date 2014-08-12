 <?php

use Carbon\Carbon;

class MonitoringController extends BaseController {

    public function __construct()
	{
		// $this->beforeFilter('auth', array('except' => array('')));
		// Enforce user authentication on specified methods
		$this->beforeFilter('csrf', ['only' => ['authenticate']]);
		parent::__construct();
	}

	public function getMonitoring()
	{
		return View::make('monitoring/monitoring');
	}

	public function getTemperature()
	{
		$title = 'Temperatura';
		if (Input::get('date-start') AND Input::get('date-end')) {
			$startDate = Carbon::createFromTimeStamp(Input::get('date-start') / 1000);
			$endDate = Carbon::createFromTimeStamp(Input::get('date-end') / 1000);
		} else {
			$endDate = Carbon::now();
			$startDate = Carbon::now()->subDays(5);;
		}

		$measures = [];
		foreach ([1, 2, 3, 4, 5] as $analyzerId) {
			$data = Measure::where('key_analizator', '=', $analyzerId)->where('key_tip_merenja','=', 5)->select('vreme_iz_analizatora','vrednost')->where('vreme_iz_analizatora', '<', $endDate->toDateTimeString())->where('vreme_iz_analizatora', '>', $startDate->toDateTimeString())->get();

			foreach ($data as $item) {
				$item['vreme_iz_analizatora'] = strtotime($item['vreme_iz_analizatora']);
			}

			$measures[$analyzerId] = $data->toArray();
		}

		return View::make('monitoring/data')->with('dataSet', $measures)->with('title', $title);
	}

	public function getHumidity()
	{
		$title = 'Vlaznost vazduha';

		if (Input::get('date-start') AND Input::get('date-end')) {
			$startDate = Carbon::createFromTimeStamp(Input::get('date-start') / 1000);
			$endDate = Carbon::createFromTimeStamp(Input::get('date-end') / 1000);
		} else {
			$endDate = Carbon::now();
			$startDate = Carbon::now()->subDays(5);;
		}


		$data = Measure::where('key_tip_merenja', '=', 4)->select('vreme_iz_analizatora','vrednost')->where('vreme_iz_analizatora', '<', $endDate->toDateTimeString())->where('vreme_iz_analizatora', '>', $startDate->toDateTimeString())->take(1000)->get();

		foreach ($data as $item) {
			$item['vreme_iz_analizatora'] = strtotime($item['vreme_iz_analizatora']);
		}
		return View::make('monitoring/data')->with('title', $title)->with('title', $title)->with('dataSet', $data->toArray());
	}

	public function getCo()
	{
		$title = 'Co';

		if (Input::get('date-start') AND Input::get('date-end')) {
			$startDate = Carbon::createFromTimeStamp(Input::get('date-start') / 1000);
			$endDate = Carbon::createFromTimeStamp(Input::get('date-end') / 1000);
		} else {
			$endDate = Carbon::now();
			$startDate = Carbon::now()->subDays(5);;
		}


		$data = Measure::where('key_tip_merenja', '=', 1)->select('vreme_iz_analizatora','vrednost')->where('vreme_iz_analizatora', '<', $endDate->toDateTimeString())->where('vreme_iz_analizatora', '>', $startDate->toDateTimeString())->take(1000)->get();

		foreach ($data as $item) {
			$item['vreme_iz_analizatora'] = strtotime($item['vreme_iz_analizatora']);
		}
		return View::make('monitoring/data')->with('title', $title)->with('dataSet', $data->toArray());
	}

	public function getCo2()
	{

		$title = 'Co2';

		if (Input::get('date-start') AND Input::get('date-end')) {
			$startDate = Carbon::createFromTimeStamp(Input::get('date-start') / 1000);
			$endDate = Carbon::createFromTimeStamp(Input::get('date-end') / 1000);
		} else {
			$endDate = Carbon::now();
			$startDate = Carbon::now()->subDays(5);;
		}


		$data = Measure::where('key_tip_merenja', '=', 3)->select('vreme_iz_analizatora','vrednost')->where('vreme_iz_analizatora', '<', $endDate->toDateTimeString())->where('vreme_iz_analizatora', '>', $startDate->toDateTimeString())->take(1000)->get();

		foreach ($data as $item) {
			$item['vreme_iz_analizatora'] = strtotime($item['vreme_iz_analizatora']);
		}
		return View::make('monitoring/data')->with('title', $title)->with('dataSet', $data->toArray());
	}

	public function getPm10()
	{
		$title = 'PM10';

		if (Input::get('date-start') AND Input::get('date-end')) {
			$startDate = Carbon::createFromTimeStamp(Input::get('date-start') / 1000);
			$endDate = Carbon::createFromTimeStamp(Input::get('date-end') / 1000);
		} else {
			$endDate = Carbon::now();
			$startDate = Carbon::now()->subDays(5);;
		}


		$data = Measure::where('key_tip_merenja', '=', 8)->select('vreme_iz_analizatora','vrednost')->where('vreme_iz_analizatora', '<', $endDate->toDateTimeString())->where('vreme_iz_analizatora', '>', $startDate->toDateTimeString())->take(1000)->get();

		foreach ($data as $item) {
			$item['vreme_iz_analizatora'] = strtotime($item['vreme_iz_analizatora']);
		}
		return View::make('monitoring/data')->with('title', $title)->with('dataSet', $data->toArray());
	}

	public function getPm25()
	{
		$title = 'PM25';

		if (Input::get('date-start') AND Input::get('date-end')) {
			$startDate = Carbon::createFromTimeStamp(Input::get('date-start') / 1000);
			$endDate = Carbon::createFromTimeStamp(Input::get('date-end') / 1000);
		} else {
			$endDate = Carbon::now();
			$startDate = Carbon::now()->subDays(5);;
		}


		$data = Measure::where('key_tip_merenja', '=', 7)->select('vreme_iz_analizatora','vrednost')->where('vreme_iz_analizatora', '<', $endDate->toDateTimeString())->where('vreme_iz_analizatora', '>', $startDate->toDateTimeString())->take(1000)->get();

		foreach ($data as $item) {
			$item['vreme_iz_analizatora'] = strtotime($item['vreme_iz_analizatora']);
		}
		return View::make('monitoring/data')->with('title', $title)->with('dataSet', $data->toArray());
	}

	public function getPm03(){

		$title = 'PM03';
		if (Input::get('date-start') AND Input::get('date-end')) {
			$startDate = Carbon::createFromTimeStamp(Input::get('date-start') / 1000);
			$endDate = Carbon::createFromTimeStamp(Input::get('date-end') / 1000);
			$analyzer = Input::get('key_analizator');
		} else {
			$endDate = Carbon::now();
			$startDate = Carbon::now()->subDays(5);;
			$analyzer = 1;
		}


		$data = Measure::where('key_tip_merenja', '=', 6)->where('key_analizator', '=', $analyzer)->select('vreme_iz_analizatora','vrednost')->where('vreme_iz_analizatora', '<', $endDate->toDateTimeString())->where('vreme_iz_analizatora', '>', $startDate->toDateTimeString())->take(1000)->get();

		foreach ($data as $item) {
			$item['vreme_iz_analizatora'] = strtotime($item['vreme_iz_analizatora']);
		}
		return View::make('monitoring/data')->with('title', $title)->with('dataSet', $data->toArray());
	}

	public function getMeasurements()
	{
		if (Input::get('date-start') AND Input::get('date-end')) {
			$startDate = Carbon::createFromTimeStamp(Input::get('date-start') / 1000);
			$endDate = Carbon::createFromTimeStamp(Input::get('date-end') / 1000);
		} else {
			$startDate = $endDate = false;
		}

		if (!Input::get('chart-type') || Input::get('chart-type') == 1)
			$measureSetIds = [1, 2, 3];
		else if(Input::get('chart-type') == 2)
			$measureSetIds = [4, 5, 6];
		else
			$measureSetIds = [7, 8, 9, 10];

		$chartMeasureSet = [];
		foreach ($measureSetIds as $measureType) {
			$analyzerSet = Analyzer::with(['measures' => function($query) use ($measureType, $startDate, $endDate)
				{
				    $query->take(300)
				    		->where('key_tip_merenja', '=', $measureType);

				    if ($startDate AND $endDate)
				    	$query->where('originalno_vreme', '<', $endDate->toDateTimeString())
				    			->where('originalno_vreme', '>', $startDate->toDateTimeString());
				}])->get();

			foreach ($analyzerSet as $dataSet) {
				if (!isset($chartMeasureSet[$dataSet->key_analizator]))
					$chartMeasureSet[$dataSet->key_analizator] = [];
				$chartMeasureSet[$dataSet->key_analizator][$measureType] = array_map(function($item){
					return [
					'x' => strtotime($item['vreme_iz_analizatora'])*1000,
					'y' => round($item['vrednost'], 2),
					];
				}, $dataSet->measures->toArray());
			};
		}

		return View::make('monitoring/measurements')->with('dataSet', $chartMeasureSet);
	}

	public function getLatestVoltage()
	{
	return $data = Analyzer::with(['measures' => function($query){
		$query->orderBy('vreme_iz_analizatora','DESC')->first()->where('key_tip_merenja', '=', 1);
			}])->get()->toArray();
	}

	public function getConsumption(){
		return View::make('monitoring/consumption');
	}
}
