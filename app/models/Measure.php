<?php
class Measure extends Eloquent {
	public $timestamps = false;


	public function measureTypeInAnalyzer()
	{
		return $this->hasOne('measureTypeInAnalyzer');
	}

	public function analyzer()
	{
		return $this->hasOne('analyzer');
	}
}