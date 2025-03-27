<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestResultDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('test_result_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_result_id')->constrained('test_results');
            $table->foreignId('question_id')->constrained('questions');
            $table->foreignId('answer_id')->nullable()->constrained('answers')
                ->comment('Câu trả lời đã chọn');
            $table->text('text_answer')->nullable()->comment('Câu trả lời dạng text (nếu có)');
            $table->boolean('is_correct')->comment('Câu trả lời có đúng không');
            $table->integer('score')->default(0)->comment('Điểm số cho câu này');
            $table->integer('time_spent')->nullable()->comment('Thời gian làm câu này (giây)');
            $table->integer('order_number')->comment('Thứ tự câu hỏi trong bài thi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_result_details');
    }
} 