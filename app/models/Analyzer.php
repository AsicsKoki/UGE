<?php
class Analyzer extends Eloquent {

	protected $fillable = array('name', 'description', 'comment', 'modbus_slave_address', 'current_measure_period', 'long_message_period', 'active', 'short_message_period', 'alarm_measure_period', 'measures_before_alarm', 'hubs_id', 'input_position', 'customers_id', 'analyzer_types_id');
	public $timestamps = false;

	public function user()
	{
		return $this->hasOne('user');
	}

	public function hub()
	{
		return $this->belongsTo('hub', 'hubs_id');
	}

	public function measureTypeInAnalyzer()
	{
		return $this->hasMany('MeasureTypeInAnalyzer', 'analyzer_id');
	}

	public function measures()
	{
		return $this->hasMany('Measure', 'key_analizator');
	}

	public function customer()
	{
		return $this->belongsTo('Customer', 'customers_id');
	}

	public static function createAnalyzer($data){
		$analyzer = new Analyzer($data);
   		return $analyzer->save();
	}
}