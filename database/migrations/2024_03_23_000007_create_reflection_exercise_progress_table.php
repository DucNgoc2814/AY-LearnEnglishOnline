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
            $table->foreignId('user_id')->comment('ID của học viên')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('reflection_exercise_id')->comment('ID của bài tập reflection')
                ->constrained()
                ->onDelete('cascade');
            $table->boolean('has_watched_video')->default(false)->comment('Đã xem video hướng dẫn chưa');
            $table->boolean('has_completed_sentences')->default(false)->comment('Đã hoàn thành phần mẫu câu chưa');
            $table->boolean('has_submitted_reflection')->default(false)->comment('Đã nộp bài reflection chưa');
            $table->integer('total_questions')->default(0)->comment('Tổng số câu hỏi');
            $table->integer('completed_questions')->default(0)->comment('Số câu hỏi đã làm');
            $table->timestamp('started_at')->nullable()->comment('Thời gian bắt đầu làm bài');
            $table->timestamp('completed_at')->nullable()->comment('Thời gian hoàn thành');
            $table->timestamps();
            $table->softDeletes();

            // Đảm bảo mỗi học viên chỉ có một tiến độ cho mỗi bài tập
            $table->unique(['user_id', 'reflection_exercise_id'], 'unique_exercise_progress');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reflection_exercise_progress');
    }
};
