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
        Schema::create('medical_centers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('owner_id');
            $table->string('name');
            $table->string('slug');
            $table->string('phone');
            $table->boolean('on_site_visit')->default(0);
            $table->text('image')->nullable();
            $table->text('certificate')->nullable();
            $table->enum('status', ['active', 'pending' ,'inactive'])->default('pending');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('medical_center_types')->onDelete('cascade');
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
        Schema::dropIfExists('medical_center');
    }
};
