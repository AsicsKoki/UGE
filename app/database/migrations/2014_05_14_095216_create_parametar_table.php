<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParametarTable extends Migration {

	public function up()
	{
		Schema::create('parametar', function(Blueprint $table) {
			$table->timestamps();
			$table->integer('key_parametar', true);
			$table->string('naziv', 50);
			$table->string('opis', 200)->nullable()->default('NULL');
			$table->string('vrednost', 100);
		});
	}

	public function down()
	{
		Schema::drop('parametar');
	}
}