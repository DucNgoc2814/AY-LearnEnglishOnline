<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamResultsTable extends Migration
{
    public function up()
    {
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users');
            $table->foreignId('finalExamId')->constrained('final_exams');
            $table->integer('score');
            $table->integer('timeTaken')->comment('Thời gian làm bài (giây)');
            $table->integer('attemptNumber')->comment('Số lần thử');
            $table->string('status')->comment('Trạng thái: pass/fail');
            $table->dateTime('startTime')->comment('Thời gian bắt đầu làm bài');
            $table->dateTime('endTime')->comment('Thời gian nộp bài');
            $table->text('feedback')->nullable()->comment('Nhận xét của giáo viên');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_results');
    }
}
