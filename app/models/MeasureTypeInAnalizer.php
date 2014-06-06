<?php
class MeasureTypeInAnalyzer extends Eloquent {
	protected $table = 'measure_type_in_analyzer';

	public function measure()
	{
		return $this->hasMany('measure');
	}

	public function measureType()
	{
		return $this->belongsTo('measureType');
	}
	public function analyzer()
	{
		return $this->belongsTo('analyzer');
	}
}