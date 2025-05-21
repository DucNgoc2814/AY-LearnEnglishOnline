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
        Schema::create('video_exercise_clips', function (Blueprint $table) {
            $table->id()->comment('ID của clip');
            $table->foreignId('video_exercise_lesson_id')->comment('ID bước 1')->constrained('video_exercise_lessons')->onDelete('cascade');
            $table->string('title')->comment('Tiêu đề clip');
            $table->integer('start_time')->comment('Thời điểm bắt đầu trong video (giây)');
            $table->string('audio_url')->nullable()->comment('URL của file audio (nếu tách riêng)');
            $table->text('transcript')->comment('Nội dung lời thoại của clip');
            $table->text('translation')->nullable()->comment('Bản dịch lời thoại (tiếng Việt)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_exercise_clips');
    }
};
