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
            $table->foreignId('lesson_id')->comment('ID của bài học')->constrained('lessons')->onDelete('cascade');
            $table->string('title')->comment('Tiêu đề bài tập');
            $table->text('description')->nullable()->comment('Mô tả về bài tập');
            $table->string('video_url')->nullable()->comment('Video cách làm Reflection');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reflection_exercises');
    }
};
