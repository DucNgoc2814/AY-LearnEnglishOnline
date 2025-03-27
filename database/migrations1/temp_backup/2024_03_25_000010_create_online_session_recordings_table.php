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
        Schema::create('online_session_recordings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('online_room_id')->constrained('online_rooms')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('recording_url');
            $table->string('download_url')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->dateTime('recorded_at');
            $table->enum('recording_type', ['cloud', 'local'])->default('cloud');
            $table->string('file_size')->nullable(); // in MB
            $table->json('chapters')->nullable(); // Timestamps for different parts/topics
            $table->json('transcript')->nullable(); // Auto-generated transcript
            $table->boolean('is_processed')->default(false); // For post-processing status
            $table->boolean('requires_authentication')->default(true);
            $table->boolean('downloadable')->default(false);
            $table->integer('view_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('original_video_record_id')->nullable()->comment('Liên kết tới video_records cũ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_session_recordings');
    }
}; 