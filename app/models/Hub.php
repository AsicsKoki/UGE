<?php
class Hub extends Eloquent {

	protected $fillable = array('name', 'description', 'comment', 'postal_address', 'interface_type', 'ip_address', 'active', 'port', 'rc_address', 'serial_port_speed', 'serial_port_parity', 'serial_port_stop_bits');
	public $timestamps = false;
	public function analyzer()
	{
		return $this->hasMany('analyzer', 'hubs_id');
	}

	public function customer()
	{
		return $this->belongsTo('customer', 'customers_id');
	}

	public static function createHub($data){
		$hub = new Hub($data);
   		return $hub->save();
	}
}