<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reflection_exercise_progress', function (Blueprint $table) {
            $table->id()->comment('ID của tiến độ');
            $table->foreignId('student_id')->comment('ID của học viên')
                ->constrained('students')
                ->onDelete('cascade');
            $table->foreignId('reflection_exercise_id')->comment('ID của bài tập reflection')
                ->constrained()
                ->onDelete('cascade');
            $table->boolean('has_watched_video')->default(false)->comment('Đã xem video hướng dẫn chưa');
            $table->timestamp('last_watched_at')->nullable()->comment('Thời gian xem video gần nhất');
            $table->integer('last_video_position')->default(0)->comment('Vị trí xem video gần nhất (tính bằng giây)');
            $table->boolean('has_completed_video')->default(false)->comment('Đã xem hết video chưa');
            $table->timestamp('completed_at')->nullable()->comment('Thời gian hoàn thành xem video');
            $table->timestamps();
            $table->softDeletes();

            // Đảm bảo mỗi học viên chỉ có một tiến độ cho mỗi bài tập
            $table->unique(['student_id', 'reflection_exercise_id'], 'unique_exercise_progress');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reflection_exercise_progress');
    }
};
