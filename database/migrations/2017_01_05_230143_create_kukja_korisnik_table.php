<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKukjaKorisnikTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kukja_korisnik', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_kukja')->index('id_kukja');
			$table->integer('id_korisnik')->index('id_korisnik');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kukja_korisnik');
	}

}
