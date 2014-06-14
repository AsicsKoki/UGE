<?php
class SignalType extends Eloquent {
	protected $fillable = array('name_en', 'name_sr', 'active');
	protected $table = 'signal_types';
	public $timestamps = false;

	public static function createSignal($data){
		$signal = new SignalType($data);
   		return $signal->save();
	}

}