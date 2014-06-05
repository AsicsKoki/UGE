<?php
class Analyzer extends Eloquent {

	public function user()
	{
		return $this->hasOne('user');
	}

	public function hub()
	{
		return $this->hasOne('hub');
	}

	public function measureTypeInAnalyzer()
	{
		return $this->hasMany('MeasureTypeInAnalyzer', 'analyzer_id');
	}
}