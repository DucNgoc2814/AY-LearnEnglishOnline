<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonResultItemsTable extends Migration
{
    public function up()
    {
        Schema::create('lesson_result_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lessonResultId')->constrained('lesson_results');
            $table->foreignId('questionLessonTestId')->constrained('question_lesson_tests');
            $table->foreignId('answerLessonTestId')->constrained('answer_lesson_tests');
            $table->boolean('isCorrect')->comment('Đáp án đúng/sai');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_result_items');
    }
} 