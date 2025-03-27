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
            $table->foreignId('lesson_test_id')->constrained('lesson_tests');
            $table->enum('type', ['text', 'image', 'video', 'audio']);
            $table->string('question');
            $table->string('media_url')->nullable();
            $table->integer('order_number');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_lesson_tests');
    }
}
