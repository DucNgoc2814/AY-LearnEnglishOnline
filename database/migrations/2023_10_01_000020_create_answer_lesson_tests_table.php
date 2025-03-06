<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerLessonTestsTable extends Migration
{
    public function up()
    {
        Schema::create('answer_lesson_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questionLessonTestId')->constrained('question_lesson_tests');
            $table->string('answer');
            $table->boolean('isCorrect');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('answer_lesson_tests');
    }
}
