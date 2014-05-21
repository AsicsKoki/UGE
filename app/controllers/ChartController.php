<?php

class ChartController extends BaseController {

	    public function __construct()
	{
	 	$this->beforeFilter('auth', array('except' => array('')));
		// Enforce user authentication on specified methods
		$this->beforeFilter('csrf', ['only' => ['authenticate']]);
		parent::__construct();
	}

	public function getChartPage()
	{
		$analyzer = Auth::User()->analyzer()->first();

		d($analyzer->measureTypeInAnalyzer()->with('measure', 'measureType')->get()->toArray()); 

		exit;
		return View::make('charts.chart');
	}

}
