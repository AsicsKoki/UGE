<?php
class AlarmTypeForMeasureTypeInAnalyzers extends Eloquent {
	protected $fillable = array('*');
	protected $table = 'alarm_types_for_measure_types_in_analyzers';
	public $timestamps = false;

	public function alarmType()
	{
		return $this->belongsTo('AlarmType', 'alarm_types_id');
	}

	public function measureTypeInAnalyzer() {
		return $this->belongsTo('MeasureTypeInAnalyzer', 'measure_types_in_analyzers_id');
	}

}