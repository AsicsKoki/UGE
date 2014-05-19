<?php
class UsersController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Auth/Sessions Controller
	|--------------------------------------------------------------------------
	|
	|
	*/
    public function __construct()
    {
	 	$this->beforeFilter('auth', array('except' => array('login', 'authenticate','getRegister', 'postNewUser')));
		// Enforce user authentication on specified methods
		$this->beforeFilter('csrf', ['only' => ['authenticate']]);
		parent::__construct();
    }


	public function login(){
		return View::make('auth.login');
	}

	public function authenticate(){
		 $credentials = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		  );

		if(Auth::attempt($credentials)){
			return Redirect::intended('/');
		} else {
			return Redirect::to('/register');
		}
	}

	public function logout(){
		Auth::logout();
		Session::flush();
		return Redirect::to('/login');
	}

	/**
	 * Create user registration page and save a new user.
	 * @return [type] [description]
	 */
	public function getRegister(){
		return View::make('auth.register');
	}

	public function postNewUser(){
		User::createUser(Input::all());
		return Redirect::intended('login');
	}
}