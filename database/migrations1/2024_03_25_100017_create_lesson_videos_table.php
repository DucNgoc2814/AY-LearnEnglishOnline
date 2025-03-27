<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonVideosTable extends Migration
{
    public function up()
    {
        Schema::create('lesson_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('video_url');
            $table->integer('duration')->nullable()->comment('Độ dài video (giây)');
            $table->string('video_type')->nullable()->comment('Định dạng video');
            $table->string('thumbnail_url')->nullable()->comment('Ảnh thumbnail của video');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_videos');
    }
}
