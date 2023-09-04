<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->text('avatar')->nullable();
            $table->integer('id_card')->nullable();
            $table->string('mobile',100);
            $table->enum('verify_level', ['none', 'basic', 'advanced'])->default('none');
            $table->string('active_code')->nullable();
            $table->string('medical_number')->nullable();
            $table->timestamp('birthDate')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
