<?php
class Customer extends Eloquent {

	protected $fillable = array('name', 'address', 'contact_person', 'contact_address', 'contact_phone', 'contact_email', 'active');
	public $timestamps = false;
	public function analyzer()
	{
		return $this->hasMany('analyzer');
	}

	public function hub()
	{
		return $this->hasMany('hub');
	}

	public function user()
	{
		return $this->hasMany('user', 'customers_id');
	}

	public static function createCustomer($data){
		$customer = new Customer($data);
   		return $customer->save();
	}

	public static function updateCustomer($data)
	{
		return Customer::find($cid)->update($data);
	}
}