<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNaredbiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('naredbi', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_ured')->index('id_ured');
			$table->integer('id_korisnik')->index('id_korisnik')->comment('ID na korisnik koj ja dal naredbata');
			$table->timestamp('vreme_vklucuvanje');
			$table->timestamp('vreme_isklucuvanje');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('naredbi');
	}

}
