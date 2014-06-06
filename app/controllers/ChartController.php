<?php

class ChartController extends BaseController {

	    public function __construct()
	{
	 	$this->beforeFilter('auth', array('except' => array('')));
		// Enforce user authentication on specified methods
		$this->beforeFilter('csrf', ['only' => ['authenticate']]);
		parent::__construct();
	}

	public function getAnalyzerList()
	{

		// d(Auth::User()->analyzer->measureTypeInAnalyzer->with('measure')->get()->toArray());
		d(Analyzer::where('user_id','=', Auth::User()->id)->get()->toArray());

		exit;
		return View::make('charts.chart');
	}

}
