<?php
class Hub extends Eloquent {
	public function analyzer()
	{
		return $this->hasMany('analyzer')
	}
}