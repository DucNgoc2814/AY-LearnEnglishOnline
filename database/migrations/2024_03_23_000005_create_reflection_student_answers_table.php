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
            $table->foreignId('reflection_exercise_question_id')->comment('ID của câu hỏi')
                ->constrained()
                ->onDelete('cascade')
                ->name('ref_answer_question_fk');
            $table->text('answer_text')->comment('Nội dung câu trả lời');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['reflection_exercise_question_id'], 'unique_answer_question');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reflection_student_answers');
    }
};
