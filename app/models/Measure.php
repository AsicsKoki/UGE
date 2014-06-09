<?php
class Measure extends Eloquent {
	protected $table = 'merenje';
	protected $primaryKey = 'key_merenje';
	public function measureTypeInAnalyzer()
	{
		return $this->hasOne('measureTypeInAnalyzer');
	}

	public function analyzer()
	{
		return $this->hasOne('analyzer');
	}
}