<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reflection_question_progress', function (Blueprint $table) {
            $table->id()->comment('ID của tiến độ');
            $table->foreignId('student_id')->comment('ID của học viên')
                ->constrained('students')
                ->onDelete('cascade');
            $table->foreignId('reflection_exercise_question_id')->comment('ID của câu hỏi')
                ->constrained()
                ->onDelete('cascade')
                ->name('ref_question_progress_question_fk');
            $table->text('answer_text')->nullable()->comment('Câu trả lời của học viên');
            $table->timestamp('submitted_at')->nullable()->comment('Thời gian nộp câu trả lời');
            $table->timestamps();
            $table->softDeletes();

            // Đảm bảo mỗi học viên chỉ có một tiến độ cho mỗi câu hỏi
            $table->unique(['student_id', 'reflection_exercise_question_id'], 'unique_question_progress');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reflection_question_progress');
    }
};
