<?php
class SignalTypeInHub extends Eloquent {
	protected $table = 'signal_types_in_hubs';

	protected $fillable = array('*');
	public $timestamps = false;

	public function signalType()
	{
		return $this->belongsTo('signalType', 'signal_types_id');
	}
}