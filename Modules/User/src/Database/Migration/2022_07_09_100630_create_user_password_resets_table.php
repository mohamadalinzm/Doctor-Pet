<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPasswordResetsTable extends Migration
{
    public function up()
    {
        Schema::create('user_password_resets', function (Blueprint $table) {
            $table->string('email')->index('user_password_resets_email_index');
            $table->string('token')->index('user_password_resets_token_index');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_password_resets');
    }
}
