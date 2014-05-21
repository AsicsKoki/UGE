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
	 	$this->beforeFilter('auth', array('except' => array('login', 'authenticate')));
		// Enforce user authentication on specified methods
		$this->beforeFilter('csrf', ['only' => ['authenticate']]);
		parent::__construct();
    }


	public function login(){
		return View::make('auth.login');
	}

	public function authenticate(){

		$validator = Validator::make(
		Input::all(),
		    array(
				'username' => 'required|min:3',
				'password' => 'required|min:3'
		    )
		);
		if($validator->passes()){
			$credentials = array(
				'username' => Input::get('username'),
				'password' => Input::get('password')
			);

			if(Auth::attempt($credentials)){
				return Redirect::intended('/');
			} else {
				return Redirect::intended('/login');
			}
		} else {
			return Redirect::intended('/login');
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
		$credentials = array(
			'username'              => 'required|min:3',
			'password'              => 'required|min:3',
			'password_confirmation' => 'required|min:3',
			'name'                  => 'required',
			'contact_address'       => 'required',
			'contact_person'        => 'required',
			'contact_phone'         => 'required',
			'contact_sms'           => 'required',
			'account_type_id'       => 'required',
			);
		if($validator->passes()){
			User::createUser(Input::all());
			return Redirect::intended('/');
		} else {
			return Redirect::intended('/register');
		}
	}

	public function getUsers() {

		return View::make('users.users')->with('users', User::all());
	}

	public function getUser($uid) {

		return View::make('users.user')->with('user', User::find($uid));
	}

	public function putUser($uid) {
		return "put!";
	}
}