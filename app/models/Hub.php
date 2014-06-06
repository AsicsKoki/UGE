<?php
class Hub extends Eloquent {
	protected $table = 'hub';
	public function analyzer()
	{
		return $this->hasMany('analyzer');
	}
}