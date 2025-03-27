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
            $table->foreignId('question_lesson_test_id')->constrained('question_lesson_tests');
            $table->string('answer');
            $table->boolean('is_correct');
            $table->enum('answer_type', [
                'single_choice',
                'fill_in_blank',
                'multiple_choice'
            ])->comment('Loại câu trả lời:single_choice-chọn đáp án, fill_in_blank-điền đáp án, multiple_choice-chọn nhiều đáp án');
            $table->integer('order_number')->comment('Số thứ tự của câu trả lời');
            $table->boolean('case_sensitive')->default(false)->comment('Có phân biệt chữ hoa/thường không');
            $table->string('alternative_answers')->nullable()->comment('Các đáp án thay thế, phân cách bằng dấu |');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('answer_lesson_tests');
    }
}
