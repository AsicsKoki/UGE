<?php
class MeasureTypeInAnalyzer extends Eloquent {
	protected $table = 'measure_types_in_analyzers';

	public function measures()
	{
		return $this->hasMany('measure');
	}

	public function measureTypes()
	{
		return $this->belongsTo('measureType');
	}
}