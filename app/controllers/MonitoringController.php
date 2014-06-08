<?php

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
		return View::make('monitoring/controlPanel');
	}

	public function getMeasurements()
	{
		return View::make('monitoring/measurements');
	}

}
