<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reflection_student_answers', function (Blueprint $table) {
            $table->id()->comment('ID của câu trả lời');
            $table->foreignId('user_id')->comment('ID của học viên')
                ->constrained()
                ->onDelete('cascade')
                ->name('ref_answer_user_fk');
            $table->foreignId('reflection_exercise_id')->comment('ID của bài tập reflection')
                ->constrained()
                ->onDelete('cascade')
                ->name('ref_answer_exercise_fk');
            $table->foreignId('reflection_exercise_question_id')->comment('ID của câu hỏi')
                ->constrained()
                ->onDelete('cascade')
                ->name('ref_answer_question_fk');
            $table->text('answer_text')->comment('Nội dung câu trả lời');
            $table->boolean('is_submitted')->default(false)->comment('Trạng thái nộp bài');
            $table->timestamp('submitted_at')->nullable()->comment('Thời gian nộp bài');
            $table->timestamps();
            $table->softDeletes();

            // Thêm unique constraint để đảm bảo mỗi học viên chỉ có một câu trả lời cho mỗi câu hỏi
            $table->unique(['user_id', 'reflection_exercise_question_id'], 'unique_student_answer');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reflection_student_answers');
    }
};
