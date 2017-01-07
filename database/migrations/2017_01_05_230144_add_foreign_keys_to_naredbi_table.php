<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToNaredbiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('naredbi', function(Blueprint $table)
		{
			$table->foreign('id_ured', 'Naredbi_ibfk_1')->references('id')->on('ured')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_korisnik', 'naredbi_korisnik')->references('id')->on('korisnik')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('naredbi', function(Blueprint $table)
		{
			$table->dropForeign('Naredbi_ibfk_1');
			$table->dropForeign('naredbi_korisnik');
		});
	}

}
