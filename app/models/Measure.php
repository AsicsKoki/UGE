<?php
class Measure extends Eloquent {
	protected $table = 'merenje';
	protected $primaryKey = 'key_merenje';
	public $timestamps = false;
}