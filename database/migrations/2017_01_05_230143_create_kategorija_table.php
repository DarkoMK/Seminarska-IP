<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKategorijaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kategorija', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('vid_na_ured')->unique('vid_na_ured');
			$table->integer('mokjnost_vati');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kategorija');
	}

}
