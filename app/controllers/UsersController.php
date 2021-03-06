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

	private $validationRules = [
			'username'              => 'required|min:3|unique:user,username',
			'password'              => 'required|min:3',
			'password_confirmation' => 'required|min:3',
			'name'                  => 'required',
			'contact_address'       => 'required',
			'contact_person'        => 'required',
			'contact_phone'         => 'required',
			'contact_sms'           => 'required',
			'account_type_id'       => 'required'
		];

	public function postNewUser(){

		$validator = Validator::make(Input::all(),
		    $this->validationRules
		);
		if($validator->passes()){
			User::createUser(Input::all());
			Session::flash('status_success', 'User successfully created');
			return Redirect::route('homePage');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}

	public function getUsers() {

		return View::make('users.users')->with('users', User::all());
	}

	public function getUser($uid) {
		if (!$user = User::find($uid)) {
			Session::flash('status_error', 'The user does not exist');
			return Redirect::route('getUsers');
		}

		return View::make('users.user')->with('user', User::find($uid));
	}

	public function putUser($uid) {
		if (!$user = User::find($uid)) {
			Session::flash('status_error', 'The user does not exist');
			return Redirect::back();
		}

		$this->validationRules['username'] .= ','. $uid;

		$validator = Validator::make(Input::all(),
		    $this->validationRules
		);

		if($validator->passes()){
			$user->update(Input::all());
			Session::flash('status_success', 'Profile updated');
			return Redirect::route('getUsers');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validator->errors());
		}
	}

	public function deleteUser($uid) {
		if (!$user = User::find($uid)) {
			Session::flash('status_error', 'The user does not exist');
			return Redirect::back();
		}

		$user->delete();
		Session::flash('status_success', 'User successfully deleted');
		return Redirect::route('getUsers');
	}
}