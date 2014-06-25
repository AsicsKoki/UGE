<?php
class Measure extends Eloquent {

	public function measureTypeInAnalyzer()
	{
		return $this->hasOne('measureTypeInAnalyzer');
	}

	public function analyzer()
	{
		return $this->hasOne('analyzer');
	}
}