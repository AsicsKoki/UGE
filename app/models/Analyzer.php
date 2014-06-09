<?php
class Analyzer extends Eloquent {

	protected $table = 'analizator';
	protected $primaryKey = 'key_analizator';

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

	public function measures()
	{
		return $this->hasMany('Measure', 'key_analizator');
	}
}