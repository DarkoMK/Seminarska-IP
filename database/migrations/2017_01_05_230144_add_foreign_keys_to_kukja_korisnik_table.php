<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToKukjaKorisnikTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('kukja_korisnik', function(Blueprint $table)
		{
			$table->foreign('id_korisnik', 'id_korisnik')->references('id')->on('korisnik')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_kukja', 'id_kukja')->references('id')->on('kukja')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('kukja_korisnik', function(Blueprint $table)
		{
			$table->dropForeign('id_korisnik');
			$table->dropForeign('id_kukja');
		});
	}

}
