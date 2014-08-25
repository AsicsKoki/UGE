<?php
class MeasureTypeInAnalyzerType extends Eloquent {
	protected $table = 'measure_types_in_analyzer_types';

	protected $fillable = array('*');
	public $timestamps = false;

	public function measureType()
	{
		return $this->belongsTo('measureType', 'measure_types_id');
	}
}