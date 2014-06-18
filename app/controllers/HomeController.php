<?php

class HomeController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('auth', array('except' => array('')));
		// Enforce user authentication on specified methods
		$this->beforeFilter('csrf', ['only' => ['authenticate']]);
		parent::__construct();
	}

	public function getHome()
	{
		return View::make('hello');
	}

}
