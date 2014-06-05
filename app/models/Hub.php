<?php
class Hub extends Eloquent {
	public function analyzers()
	{
		return $this->hasMany('analyzer')
	}
}