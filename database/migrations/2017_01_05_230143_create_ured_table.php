<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUredTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ured', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_kukja')->index('id_kukja');
			$table->integer('id_kategorija')->index('id_kategorija_3');
			$table->integer('id_soba')->index('id_soba_2');
			$table->string('ime');
			$table->boolean('vklucena_sostojba')->comment('True - ako uredot e vklucen; False - ako uredot e isklucen');
			$table->integer('br_izvod')->comment('Broj na izvodot od strujnoto kolo so koj se kontrolira releto za uredot.');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ured');
	}

}
