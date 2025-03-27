<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineAttendanceDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('online_attendance_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_id')->constrained('attendances')->onDelete('cascade');
            $table->dateTime('join_time');
            $table->dateTime('leave_time')->nullable();
            $table->integer('duration_seconds')->default(0);
            $table->string('device_info')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('connection_quality')->nullable();
            $table->boolean('camera_on')->default(false);
            $table->boolean('microphone_on')->default(false);
            $table->boolean('screen_sharing')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('online_attendance_details');
    }
} 