<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('users');

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users');

            $table->unsignedBigInteger('creator_id');
            $table->foreign('creator_id')->references('id')->on('users');

            $table->enum('week_day',['monday','tuesday','wednesday','thursday','friday','saturday','sunday'])->default('monday');
            $table->enum('status',['pending','reserved','canceled','rejected','completed'])->default('pending');
            $table->enum('type',['chat','phone','on_site','on_clinic'])->default('on_clinic');
            $table->date('date');
            $table->string('session_duration');
            $table->time('start_time');

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
        Schema::dropIfExists('appointments');
    }
};
