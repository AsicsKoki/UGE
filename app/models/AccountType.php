<?php
class AccountType extends Eloquent {
	protected $table = 'account_types';

	public function user()
	{
		return $this->hasMany('user');
	}
}