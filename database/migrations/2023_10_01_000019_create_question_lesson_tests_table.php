<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionLessonTestsTable extends Migration
{
    public function up()
    {
        Schema::create('question_lesson_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lessonTestId')->constrained('lesson_tests');
            $table->string('question');
            $table->integer('order_number')->comment('Số thứ tự của câu hỏi');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_lesson_tests');
    }
}
