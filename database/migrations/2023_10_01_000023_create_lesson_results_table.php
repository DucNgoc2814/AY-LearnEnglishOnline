<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonResultsTable extends Migration
{
    public function up()
    {
        Schema::create('lesson_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users');
            $table->foreignId('lessonTestId')->constrained('lesson_tests');
            $table->integer('score');
            $table->integer('timeTaken')->comment('Thời gian làm bài (giây)');
            $table->integer('attemptNumber')->comment('Số lần thử');
            $table->string('status')->comment('Trạng thái: pass/fail');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_results');
    }
} 