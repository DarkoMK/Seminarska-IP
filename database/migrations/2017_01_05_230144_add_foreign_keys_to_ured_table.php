<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUredTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ured', function(Blueprint $table)
		{
			$table->foreign('id_kukja', 'Ured_ibfk_1')->references('id')->on('kukja')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_kategorija', 'ured_kategorija')->references('id')->on('kategorija')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_soba', 'ured_soba')->references('id')->on('soba')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ured', function(Blueprint $table)
		{
			$table->dropForeign('Ured_ibfk_1');
			$table->dropForeign('ured_kategorija');
			$table->dropForeign('ured_soba');
		});
	}

}
