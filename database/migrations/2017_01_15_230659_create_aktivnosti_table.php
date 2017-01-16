<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAktivnostiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktivnosti', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('id_korisnik');
            $table->string('description');
            $table->timestamp('vreme');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('aktivnosti');
    }
}
