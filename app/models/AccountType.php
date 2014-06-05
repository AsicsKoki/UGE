<?php
class AccountType extends Eloquent {
	public function users()
	{
		return $this->hasMany('user');
	}
}