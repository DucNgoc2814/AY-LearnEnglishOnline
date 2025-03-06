<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamResultItemsTable extends Migration
{
    public function up()
    {
        Schema::create('exam_result_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('examResultId')->constrained('exam_results');
            $table->foreignId('questionFinalExamId')->constrained('question_final_exams');
            $table->foreignId('answerFinalExamId')->constrained('answer_final_exams');
            $table->boolean('isCorrect')->comment('Đáp án đúng/sai');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_result_items');
    }
} 