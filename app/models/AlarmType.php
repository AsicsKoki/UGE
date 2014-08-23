<?php
class AlarmType extends Eloquent {
	protected $fillable = array('name_en', 'name_sr', 'active');
	protected $table = 'alarm_types';
	public $timestamps = false;

	public static function createAlarm($data){
		$alarm = new AlarmType($data);
   		return $alarm->save();
	}
	

}