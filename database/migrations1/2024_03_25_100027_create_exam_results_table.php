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
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('final_exam_id')->constrained('final_exams');
            $table->integer('score');
            $table->integer('time_taken')->comment('Thời gian làm bài (giây)');
            $table->integer('attempt_number')->comment('Số lần thử');
            $table->string('status')->comment('Trạng thái: pass/fail');
            $table->dateTime('start_time')->comment('Thời gian bắt đầu làm bài');
            $table->dateTime('end_time')->comment('Thời gian nộp bài');
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
