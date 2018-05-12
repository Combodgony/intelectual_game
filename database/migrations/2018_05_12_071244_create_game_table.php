<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Models\Game;


class CreateGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();
            $table->string('place')->nullable();
            $table->string('status')->default(Game::STATUS_NEW);
            $table->dateTime('date')->nullable();
            $table->integer('tur_id')->unsigned();
            $table->foreign('tur_id')->references('id')->on('tur');
            $table->integer('next_game_id')->nullable()->unsigned();
            $table->foreign('next_game_id')->references('id')->on('game');
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
        Schema::dropIfExists('game');
    }
}
