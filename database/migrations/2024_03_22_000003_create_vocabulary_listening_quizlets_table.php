<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_quizlets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->comment('ID của bài học')->constrained('lessons')->onDelete('cascade');
            $table->string('title')->comment('Tiêu đề của Quizlet');
            $table->string('quizlet_url')->comment('URL của Quizlet');
            $table->string('guide_url')->nullable()->comment('URL hướng dẫn sử dụng');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_quizlets');
    }
};
