<?php
class MeasureTypeInAnalyzer extends Eloquent {
	protected $table = 'measure_types_in_analyzers';

	protected $fillable = array('analyzers_id', 'measure_types_id', 'short_message_position', 'long_message_position', 'current_message_position', 'active');
		public $timestamps = false;

	public function measure()
	{
		return $this->hasMany('measure');
	}

	public function measureType()
	{
		return $this->belongsTo('measureType', 'measure_types_id');
	}

	public function measureTypeInAnalyzerType()
	{
		return $this->belongsTo('measureTypeInAnalyzerType', 'measure_types_id');
	}

	public function analyzer()
	{
		return $this->belongsTo('analyzer', 'analyzers_id');
	}

	public static function createMeasure($short, $long, $current, $analyzerId, $typeId){
		$measureTypeInAnalyzer = new MeasureTypeInAnalyzer;
		$measureTypeInAnalyzer->analyzers_id = $analyzerId;
		$measureTypeInAnalyzer->measure_types_id = $typeId;
		$measureTypeInAnalyzer->long_message_position = $long;
		$measureTypeInAnalyzer->short_message_position = $short;
		$measureTypeInAnalyzer->current_message_position = $current;
		$measureTypeInAnalyzer->active = 1;
   		return $measureTypeInAnalyzer->save();
	}
}