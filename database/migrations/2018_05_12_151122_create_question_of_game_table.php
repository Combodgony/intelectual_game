<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionOfGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_of_game', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();

            $table->integer('game_id')->unsigned();
            $table->integer('bal')->unsigned()->nullable();
            $table->integer('question_id')->unsigned();
            $table->integer('championship_id')->unsigned();
            $table->integer('participant_of_game_id')->unsigned();

            $table->foreign('game_id')->references('id')->on('game');
            $table->foreign('championship_id')->references('id')->on('championship');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('participant_of_game_id')->references('id')->on('participant_of_game');



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
        Schema::dropIfExists('question_of_game');
    }
}
