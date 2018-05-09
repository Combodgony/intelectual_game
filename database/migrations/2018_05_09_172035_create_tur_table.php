<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tur', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->integer('championship_id')->unsigned();
            $table->foreign('championship_id')->references('id')->on('championship');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tur', function (Blueprint $table) {
            //
        });
    }
}
