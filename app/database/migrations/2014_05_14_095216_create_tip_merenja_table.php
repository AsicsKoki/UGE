<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipMerenjaTable extends Migration {

	public function up()
	{
		Schema::create('tip_merenja', function(Blueprint $table) {
			$table->timestamps();
			$table->integer('key_tip_merenja', true);
			$table->string('naziv', 100);
			$table->string('jedinica_mere', 30)->nullable()->default('NULL');
			$table->smallInteger('pozicija_u_duzoj_poruci')->nullable()->default('NULL');
			$table->smallInteger('pozicija_u_kracoj_poruci')->nullable()->default('NULL');
			$table->float('koeficijent_proporcionalnosti')->default('1');
			$table->float('pomeraj');
			$table->float('prag');
			$table->tinyInteger('aktivno')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('tip_merenja');
	}
}