<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandHasGamerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('command_hash_gamer', function (Blueprint $table) {
            $table->integer('gamer_id')->unsigned();
            $table->integer('command_id')->unsigned();

            $table->foreign('gamer_id')->references('id')->on('gamer');
            $table->foreign('command_id')->references('id')->on('command');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('command_hash_gamer');
    }
}
