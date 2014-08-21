 <?php

use Carbon\Carbon;

class MonitoringController extends BaseController {

    public function __construct()
	{
		$this->beforeFilter('auth', array('except' => array('')));
		// Enforce user authentication on specified methods
		$this->beforeFilter('csrf', ['only' => ['authenticate']]);
		parent::__construct();
	}

	public function getMonitoring()
	{
		return View::make('monitoring/monitoring');
	}

	public function getControlPanel()
	{
		$latestVoltage = Measure::select('value');

		// $latestPower = Analyzer::with(['measures' => function($query){
		// $query->orderBy('vreme_iz_analizatora','DESC')->first()->where('key_tip_merenja', '=', 10);
		// 	}])->get()->toArray();


		// $latestPmax = Analyzer::with(['measures' => function($query){
		// $query->orderBy('vreme_iz_analizatora','DESC')->first()->where('key_tip_merenja', '=', 30);
		// 	}])->get()->toArray();

		return View::make('monitoring/controlPanel');
	}

	public function getMeasurements()
	{
		// if (Input::get('date-start') AND Input::get('date-end')) {
		// 	$startDate = Carbon::createFromTimeStamp(Input::get('date-start') / 1000);
		// 	$endDate = Carbon::createFromTimeStamp(Input::get('date-end') / 1000);
		// } else {
		// 	$startDate = $endDate = false;
		// }

		// if (!Input::get('chart-type') || Input::get('chart-type') == 1)
		// 	$measureSetIds = [1, 2, 3];
		// else if(Input::get('chart-type') == 2)
		// 	$measureSetIds = [4, 5, 6];
		// else
		// 	$measureSetIds = [7, 8, 9, 10];

		// $chartMeasureSet = [];
		// foreach ($measureSetIds as $measureType) {
		// 	$analyzerSet = Analyzer::with(['measures' => function($query) use ($measureType, $startDate, $endDate)
		// 		{
		// 		    $query->take(300)
		// 		    		->where('key_tip_merenja', '=', $measureType);

		// 		    if ($startDate AND $endDate)
		// 		    	$query->where('originalno_vreme', '<', $endDate->toDateTimeString())
		// 		    			->where('originalno_vreme', '>', $startDate->toDateTimeString());
		// 		}])->get();

		// 	foreach ($analyzerSet as $dataSet) {
		// 		if (!isset($chartMeasureSet[$dataSet->key_analizator]))
		// 			$chartMeasureSet[$dataSet->key_analizator] = [];
		// 		$chartMeasureSet[$dataSet->key_analizator][$measureType] = array_map(function($item){
		// 			return [
		// 			'x' => strtotime($item['vreme_iz_analizatora'])*1000,
		// 			'y' => round($item['vrednost'], 2),
		// 			];
		// 		}, $dataSet->measures->toArray());
		// 	};
		// }

		d(Analyzer::with('measureTypeInAnalyzer')->get()->toArray());
		exit;

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
