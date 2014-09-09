<?php
class AnalyzerType extends Eloquent {
	protected $fillable = ['*'];
	protected $table = 'analyzer_types';
	public $timestamps = false;

	public function AnalyzerType()
	{
		return $this->hasMany('MeasureTypeInAnalyzerType', 'analyzer_types_id');
	}
}