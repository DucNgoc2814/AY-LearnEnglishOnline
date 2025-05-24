<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reflection_exercise_questions', function (Blueprint $table) {
            $table->foreignId('lesson_id')->comment('ID của bài học')->constrained('lessons')->onDelete('cascade');
            $table->id()->comment('ID của câu hỏi');
            $table->foreignId('reflection_exercise_id')->comment('ID của bài tập reflection')
                ->constrained()
                ->onDelete('cascade');
            $table->string('question_text')->comment('Nội dung câu hỏi');
            $table->text('description')->nullable()->comment('Mô tả hoặc hướng dẫn cho câu hỏi');
            $table->integer('order')->default(0)->comment('Thứ tự hiển thị');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reflection_exercise_questions');
    }
};
