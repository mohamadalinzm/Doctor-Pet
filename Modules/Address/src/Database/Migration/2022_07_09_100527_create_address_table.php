<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Address\Support\Enum\Type;

class CreateAddressTable extends Migration
{
    public function up()
    {

        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('code',5);
            $table->string('capital',50);
            $table->string('hash', 32)->nullable();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->string('name',100);
            $table->string('code',5);
            $table->foreign('province_id', 'city_province_id_foreign')->references('id')->on('provinces')->onUpdate('cascade');
            $table->string('hash', 32)->nullable();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->enum('type', ['Home','OTHER','Work'])->nullable();
            $table->string('area',100)->nullable();
            $table->string('building',100)->nullable();
            $table->unsignedTinyInteger('floor')->nullable();
            $table->string('apartment')->nullable();
            $table->double('latitude', 10, 8)->nullable();
            $table->double('longitude', 11, 8)->nullable();
            $table->string('address1',400)->nullable();
            $table->string('address2',400)->nullable();
            $table->boolean('is_active')->default(true);
            $table->char('postal_code',10)->nullable();
            $table->boolean('is_default')->default(false);
            $table->string('hash', 32)->nullable();
            $table->foreign('province_id', 'addresses_province_id_foreign')->references('id')->on('provinces')->onUpdate('cascade');
            $table->foreign('city_id', 'addresses_city_id_foreign')->references('id')->on('cities')->onUpdate('cascade');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });


    }

    public function down()
    {
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('provinces');
        Schema::dropIfExists('cities');
    }
}
