<?php

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

	public function getControlPanel()
	{

		return View::make('monitoring/controlPanel');
	}

	public function getMeasurements()
	{
		$chartMeasureSet = [];

		foreach ([1, 2, 3] as $measureType) {
			$analyzerSet = Analyzer::with(['measures' => function($query) use ($measureType)
				{
				    $query->take(300)
				    		->where('key_tip_merenja', '=', $measureType);
				}])->get();

			foreach ($analyzerSet as $dataSet) {
				if (!isset($chartMeasureSet[$dataSet->key_analizator]))
					$chartMeasureSet[$dataSet->key_analizator] = [];
				$chartMeasureSet[$dataSet->key_analizator][$measureType] = array_map(function($item){
					return [
					'x' => strtotime($item['vreme_iz_analizatora'])*1000,
					'y' => $item['vrednost'],
					];
				}, $dataSet->measures->toArray());
			};
		}

		return View::make('monitoring/measurements')->with('dataSet', $chartMeasureSet);
	}

}
