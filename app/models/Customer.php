<?php
class Customer extends Eloquent {

	public function user()
	{
		return $this->hasOne('user');
	}

	public function analyzer()
	{
		return $this->hasMany('analyzer');
	}
}