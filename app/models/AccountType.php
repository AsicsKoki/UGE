<?php
class AccountType extends Eloquent {
	protected $table = 'account_type';

	public function user()
	{
		return $this->hasMany('user');
	}
}