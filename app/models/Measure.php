<?php
class Measure extends Eloquent {
	protected $table = 'measure';
	public function measureTypeInAnalyzer()
	{
		return $this->hasOne('measureTypeInAnalyzer');
	}
}