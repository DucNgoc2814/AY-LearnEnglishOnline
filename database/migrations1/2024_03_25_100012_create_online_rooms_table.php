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
        Schema::create('online_rooms', function (Blueprint $table) {
            $table->id();
            $table->morphs('roomable'); // Polymorphic relationship (course, lesson, exam, etc)
            $table->string('name');
            $table->enum('room_type', ['course', 'class_session', 'exam', 'consultation'])->default('class_session');
            $table->string('meeting_id')->unique();
            $table->string('platform')->default('zoom'); // zoom, google_meet, ms_teams
            $table->string('host_id')->nullable(); // Zoom Host ID
            $table->string('host_email');
            $table->string('join_url');
            $table->string('host_url')->nullable();
            $table->string('password')->nullable();
            $table->dateTime('scheduled_start');
            $table->dateTime('scheduled_end');
            $table->integer('duration_minutes')->nullable();
            $table->boolean('is_recurring')->default(false);
            $table->json('recurrence_pattern')->nullable(); // For recurring meetings
            $table->json('meeting_settings')->nullable(); // Zoom specific settings
            $table->string('recording_url')->nullable();
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'cancelled'])->default('scheduled');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('original_zoom_session_id')->nullable()->comment('Liên kết tới zoom_sessions cũ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_rooms');
    }
}; 