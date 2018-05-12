<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantOfGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_of_game', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();

            $table->integer('game_id')->unsigned();
            $table->integer('command_id')->unsigned();

            $table->foreign('game_id')->references('id')->on('game');
            $table->foreign('command_id')->references('id')->on('command');

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
        Schema::dropIfExists('participant_of_game');
    }
}
