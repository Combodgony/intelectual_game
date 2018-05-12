<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->default("$2y$10$4lBzphSVkvfdXAfiAm4wl.wimfFrOkqS0BnZ/uNFxtVk6p0lFa6nu");//qweqwe
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
