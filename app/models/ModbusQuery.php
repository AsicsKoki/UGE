<?php
class ModbusQuery extends Eloquent {
	protected $table = 'modbus_querys';
	protected $fillable = array('analyzers_id', 'users_id', 'time', 'time_ms', 'comment', 'function', 'data_bytes');
	public $timestamps = false;

	public function user()
	{
		return $this->belongsTo('user', 'users_id');
	}

	public function analyzer()
	{
		return $this->hasOne('analyzer', 'analyzers_id');
	}
}