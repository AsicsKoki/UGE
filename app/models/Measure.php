<?php
class Measure extends Eloquent {
	public function measureTypeInAnalyzer()
	{
		return $this->hasOne('measureTypeInAnalyzer');
	}
}