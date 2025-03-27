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
        Schema::create('activity_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained('session_activities')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->json('answers')->nullable(); // Câu trả lời của học viên
            $table->decimal('score', 5, 2)->nullable(); // Điểm số
            $table->decimal('max_score', 5, 2)->nullable(); // Điểm tối đa
            $table->float('completion_percentage', 5, 2)->nullable(); // Phần trăm hoàn thành
            $table->datetime('start_time')->nullable(); // Thời gian bắt đầu làm bài
            $table->datetime('submit_time')->nullable(); // Thời gian nộp bài
            $table->text('feedback')->nullable(); // Phản hồi của giáo viên
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_results');
    }
}; 