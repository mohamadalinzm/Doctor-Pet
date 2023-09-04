<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Pet\Support\Enum\Type;

class CreatePetTable extends Migration
{
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('animal_id');
            $table->string('race');
            $table->integer('age');
            $table->string('type');
            $table->string('kind');
            $table->string('avatar')->nullable();
            $table->date('birthDate');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('pets');
    }
}
