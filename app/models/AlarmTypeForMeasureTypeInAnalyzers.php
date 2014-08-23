<?php
class AlarmType extends Eloquent {
	protected $fillable = array('*');
	protected $table = 'alarm_types_for_measure_types_in_analyzer';
	public $timestamps = false;

	public static function createAlarm($data){
		$alarm = new AlarmType($data);
   		return $alarm->save();
	}

	public function alarmType()
	{
		return $this->belongsTo('AlarmType', 'alarm_types_id');
	}

}