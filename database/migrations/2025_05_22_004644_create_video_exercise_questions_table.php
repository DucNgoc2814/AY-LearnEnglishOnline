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
        Schema::create('video_exercise_questions', function (Blueprint $table) {
            $table->id()->comment('ID của câu hỏi');
            $table->foreignId('video_exercise_lesson_id')->comment('ID bước 1')->constrained('video_exercise_lessons')->onDelete('cascade');
            $table->integer('time_point')->comment('Thời điểm xuất hiện trong video (giây)');
            $table->text('question_text')->comment('Nội dung câu hỏi');
            $table->text('context_text')->nullable()->comment('Ngữ cảnh hoặc đoạn văn liên quan');
            $table->string('correct_answer')->comment('Đáp án đúng');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_exercise_questions');
    }
};
