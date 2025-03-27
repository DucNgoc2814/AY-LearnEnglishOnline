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
            $table->foreignId('exam_result_id')->constrained('exam_results'); 
            $table->foreignId('question_final_exam_id')->constrained('question_final_exams');
            $table->foreignId('answer_final_exam_id')->constrained('answer_final_exams');
            $table->boolean('is_correct')->comment('Đáp án đúng/sai');
            $table->integer('time_taken')->comment('Thời gian trả lời (giây)');
            $table->dateTime('answered_at')->comment('Thời điểm trả lời');
            $table->text('note')->nullable()->comment('Ghi chú');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_result_items');
    }
} 