<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResetAnalizatoraTable extends Migration {

	public function up()
	{
		Schema::create('reset_analizatora', function(Blueprint $table) {
			$table->timestamps();
			$table->integer('key_reset_analizatora', true);
			$table->datetime('originalno_vreme');
			$table->smallInteger('originalno_vreme_ms');
			$table->datetime('vreme_prijema');
			$table->smallInteger('vreme_prijema_ms');
			$table->smallInteger('tip');
		});
	}

	public function down()
	{
		Schema::drop('reset_analizatora');
	}
}