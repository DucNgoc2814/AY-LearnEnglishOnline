<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerFinalExamsTable extends Migration
{
    public function up()
    {
        Schema::create('answer_final_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_final_exam_id')->constrained('question_final_exams');
            $table->string('answer');
            $table->boolean('is_correct');
            $table->integer('order_number')->comment('Số thứ tự của câu trả lời');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('answer_final_exams');
    }
}
