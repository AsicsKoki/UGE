<?php
class Analyzer extends Eloquent {
	public function user()
	{
		return $this->hasOne('user');
	}

	public function hub()
	{
		return $this->hasOne('hub');
	}
}