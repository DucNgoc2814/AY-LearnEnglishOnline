<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('ID của người dùng')->constrained('users')->onDelete('cascade');
            $table->foreignId('lesson_id')->comment('ID của bài học')->constrained('lessons')->onDelete('cascade');

            // Tiến độ cho từng bước
            $table->decimal('video_progress', 5, 2)->default(0)->comment('Tiến độ xem video (%)');
            $table->decimal('quizlet_progress', 5, 2)->default(0)->comment('Tiến độ học từ vựng trên Quizlet (%)');
            $table->decimal('dictation_progress', 5, 2)->default(0)->comment('Tiến độ làm bài nghe điền từ (%)');
            $table->decimal('key_phrase_progress', 5, 2)->default(0)->comment('Tiến độ làm bài điền từ (%)');
            $table->decimal('sentence_building_progress', 5, 2)->default(0)->comment('Tiến độ làm bài sắp xếp câu (%)');
            $table->decimal('grammar_progress', 5, 2)->default(0)->comment('Tiến độ làm bài ngữ pháp (%)');
            $table->decimal('transcription_progress', 5, 2)->default(0)->comment('Tiến độ làm bài phiên âm (%)');
            $table->decimal('ending_sound_progress', 5, 2)->default(0)->comment('Tiến độ làm bài âm cuối (%)');

            // Tiến độ tổng thể
            $table->decimal('total_progress', 5, 2)->default(0)->comment('Tiến độ tổng thể của tất cả các bước (%)');

            // Thông tin bổ sung
            $table->json('completed_items')->nullable()->comment('Chi tiết các mục đã hoàn thành trong mỗi bước');
            $table->timestamp('last_activity')->nullable()->comment('Thời gian hoạt động cuối cùng');
            $table->timestamps();
            $table->softDeletes();

            // Đảm bảo mỗi user chỉ có một bản ghi tiến độ cho mỗi bài học
            $table->unique(['user_id', 'lesson_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_progress');
    }
};
