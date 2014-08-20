<?php
class MeasureType extends Eloquent {
	protected $table = 'measure_types';
	protected $fillable = array('name_en', 'name_sr', 'unit', 'active');
	public $timestamps = false;

	public static function createMeasureType($data){
		$measureType = new MeasureType($data);
   		return $measureType->save();
	}

	public function measureTypeInAnalyzer()
	{
		return $this->hasMany('MeasureTypeInAnalyzer', 'measure_types_id');
	}
}