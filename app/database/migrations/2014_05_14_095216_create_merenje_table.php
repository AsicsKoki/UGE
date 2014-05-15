<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMerenjeTable extends Migration {

	public function up()
	{
		Schema::create('merenje', function(Blueprint $table) {
			$table->timestamps();
			$table->integer('key_merenje', true);
			$table->integer('key_analizator');
			$table->integer('key_tip_merenja');
			$table->tinyInteger('redovno');
			$table->datetime('originalno_vreme');
			$table->smallInteger('originalno_vreme_ms');
			$table->datetime('vreme_iz_analizatora');
			$table->datetime('vreme_prijema');
			$table->smallInteger('vreme_prijema_ms');
			$table->float('vrednost');
		});
	}

	public function down()
	{
		Schema::drop('merenje');
	}
}