<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('video_exercise_progress', function (Blueprint $table) {
            $table->id()->comment('ID của tiến độ');
            $table->foreignId('user_id')->comment('ID của học viên')->constrained('users')->onDelete('cascade');
            $table->foreignId('lesson_id')->comment('ID bài học')->constrained('video_exercise_lessons')->onDelete('cascade');

            // Tiến độ từng bước
            $table->decimal('step1_progress', 5, 2)->default(0)->comment('Tiến độ bước 1 - Xem video (%)');
            $table->decimal('step2_progress', 5, 2)->default(0)->comment('Tiến độ bước 2 - Làm bài tập (%)');
            $table->decimal('step3_progress', 5, 2)->default(0)->comment('Tiến độ bước 3 - Luyện nói (%)');

            // Thông tin chi tiết
            $table->integer('video_watch_time')->default(0)->comment('Thời gian đã xem video (giây)');
            $table->json('completed_questions')->nullable()->comment('Danh sách câu hỏi đã hoàn thành (JSON array)');
            $table->json('completed_clips')->nullable()->comment('Danh sách clip đã luyện tập (JSON array)');

            // Tổng tiến độ
            $table->decimal('total_progress', 5, 2)->default(0)->comment('Tổng tiến độ hoàn thành (%)');

            // Thời gian
            $table->timestamp('last_accessed_at')->nullable()->comment('Lần truy cập gần nhất');
            $table->timestamp('completed_at')->nullable()->comment('Thời điểm hoàn thành');
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->unique(['user_id', 'lesson_id']);
            $table->index('total_progress');
            $table->index('last_accessed_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_exercise_progress');
    }
};
