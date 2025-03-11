<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoLessonsTable extends Migration
{
    public function up()
    {
        Schema::create('video_lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lessonId')->constrained('lessons');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('videoUrl');
            $table->integer('duration')->nullable()->comment('Độ dài video (giây)');
            $table->string('videoType')->nullable()->comment('Định dạng video');
            $table->string('thumbnailUrl')->nullable()->comment('Ảnh thumbnail của video');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_lessons');
    }
}
