<?php
class ModbusResponse extends Eloquent {
	protected $table = 'modbus_responses';

	public $timestamps = false;

	public function modbusQuery()
	{
		return $this->hasOne('ModbusQuery');
	}
}