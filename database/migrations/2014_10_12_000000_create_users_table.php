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
            $table->string('auth_facebook_id')->nullable();
            $table->enum('auth_type', ['email', 'facebook'])->default('email');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('device_id')->nullable();
            $table->string('browser_id')->nullable();
            $table->timestamp('last_active_at')->nullable();
            $table->text('active_token')->nullable();
            $table->text('refresh_token')->nullable();
            $table->boolean('is_testing')->default(false);
            $table->string('login_lock')->nullable();
            $table->timestamp('login_lock_expires_at')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
