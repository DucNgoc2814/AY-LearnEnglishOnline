<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResetPasswordsTable extends Migration
{
    public function up()
    {
        Schema::create('reset_passwords', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users');
            $table->string('token');
            $table->dateTime('expiresAt');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reset_passwords');
    }
}
