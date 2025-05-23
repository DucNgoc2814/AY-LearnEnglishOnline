<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('video_handout_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('ID của người dùng')->constrained('users')->onDelete('cascade');
            $table->foreignId('lesson_id')->comment('ID của bài học')->constrained('video_handout_lessons')->onDelete('cascade');
            $table->decimal('video_progress', 5, 2)->default(0)->comment('Tiến độ xem video (%)');
            $table->integer('current_time')->default(0)->comment('Thời điểm dừng xem video (giây)');
            $table->boolean('is_completed')->default(false)->comment('Đã xem xong video chưa');
            $table->timestamp('last_watched_at')->nullable()->comment('Thời điểm xem video gần nhất');
            $table->timestamps();
            $table->softDeletes();

            // Đảm bảo mỗi user chỉ có một bản ghi tiến độ cho mỗi video
            $table->unique(['user_id', 'lesson_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_handout_progress');
    }
};
