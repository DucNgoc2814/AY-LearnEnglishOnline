<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reflection_exercises', function (Blueprint $table) {
            $table->id()->comment('ID của bài tập reflection');
            $table->string('title')->comment('Tiêu đề bài tập');
            $table->text('description')->nullable()->comment('Mô tả về bài tập');
            $table->string('padlet_url')->nullable()->comment('URL của Padlet để nộp bài');
            $table->string('oxford_dictionary_url')->nullable()->comment('URL từ điển Oxford');
            $table->string('sample_answer_url')->nullable()->comment('URL bài làm mẫu');
            $table->boolean('is_active')->default(true)->comment('Trạng thái hiển thị của bài tập');
            $table->integer('order')->default(0)->comment('Thứ tự hiển thị');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reflection_exercises');
    }
};
