<?php

use Illuminate\Support\MessageBag;
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
		
		/*$t = User::find(3);
		dd($t->accountType->type);*/

		return View::make('auth.login');
	}

	public function authenticate(){
		$user = User::whereUsername(Input::get('username'))->first();
		if ($user) {
			if (strstr($user->accountType->type, 'admin') === false) {
				Session::flash('status_error', 'You do not have admin privileges');
				return Redirect::back();
			}
		}
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
				'password' => Input::get('password'),
				'active' => 1
			);

			if(Auth::attempt($credentials)){
				return Redirect::to('analyzers');
			} else {
				Session::flash('status_error', 'Your Username and/or password is invalid.');
				return Redirect::back();
			}
		} else {
			return Redirect::intended('/login')->withErrors($validator->errors())->withInput(Input::except('password'));
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
			'username'              => 'required|min:3|unique:users,username',
			'password'              => 'required|min:3',
			'password_confirmation' => 'required|min:3',
			'name'                  => 'required',
			'contact_sms'           => 'required',
			'account_types_id'       => 'required'
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

		return View::make('users.users')
				->with('users', User::all());
	}

	public function getUser($uid) {
		if (!$user = User::find($uid)) {
			Session::flash('status_error', 'The user does not exist');
			return Redirect::route('getUsers');
		}

		return View::make('users.user')
				->with('accountTypes', AccountType::all())
				->with('user', User::find($uid));
	}

	public function putUser($uid) {
		if (!$user = User::find($uid)) {
			Session::flash('status_error', 'The user does not exist');
			return Redirect::back();
		}

		if (!Input::get('password')) {
			unset($this->validationRules['password']);
			unset($this->validationRules['password_confirmation']);
		}

		$this->validationRules['username'] .= ','. $uid;

		$validator = Validator::make(Input::all(),
		    $this->validationRules
		);


		if($validator->passes()){
			$user->updateUser(Input::all());
			Session::flash('status_success', 'Profile updated');
			return Redirect::route('clients');
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
		return Redirect::back();
	}
}