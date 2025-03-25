<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('online_attendance_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('online_room_id')->constrained('online_rooms')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('join_time');
            $table->dateTime('leave_time')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->string('participant_id')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->string('location')->nullable();
            $table->string('video_url')->nullable();
            $table->integer('video_duration')->nullable();
            $table->integer('video_progress')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->json('participation_data')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('original_attendance_detail_id')->nullable()->comment('Liên kết tới online_attendances_details cũ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_attendance_details');
    }
}; 