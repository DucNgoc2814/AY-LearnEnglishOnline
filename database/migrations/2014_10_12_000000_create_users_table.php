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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->string('auth_google_id')->nullable();
            $table->enum('role', ['admin', 'user'])->default('user')->comment('Vai trò người dùng');
            $table->string('role_token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->string('device_id')->nullable();
            $table->text('active_token')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('login_lock')->nullable();
            $table->timestamp('login_lock_expires_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
} 