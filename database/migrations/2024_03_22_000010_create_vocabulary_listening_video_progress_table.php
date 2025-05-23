<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_video_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->comment('ID của học viên')->constrained('students')->onDelete('cascade');
            $table->foreignId('video_id')->comment('ID của video')->constrained('vocabulary_listening_videos')->onDelete('cascade');

            // Tiến độ cho video
            $table->decimal('video_progress', 5, 2)->default(0)->comment('Tiến độ xem video (%)');
            $table->timestamp('video_last_position')->nullable()->comment('Vị trí cuối cùng xem video');

            $table->timestamps();
            $table->softDeletes();

            // Đảm bảo mỗi user chỉ có một bản ghi tiến độ cho mỗi bài học
            $table->unique(['student_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_video_progress');
    }
};
