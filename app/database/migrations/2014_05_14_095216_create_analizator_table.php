<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnalizatorTable extends Migration {

	public function up()
	{
		Schema::create('analizator', function(Blueprint $table) {
			$table->timestamps();
			$table->integer('key_analizator', true);
			$table->string('naziv', 100)->nullable();
			$table->string('adresa', 30)->nullable()->default('NULL');
			$table->string('port', 10)->nullable()->default('NULL');
			$table->integer('rc_adresa')->nullable()->default('NULL');
			$table->tinyInteger('aktivno')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('analizator');
	}
}