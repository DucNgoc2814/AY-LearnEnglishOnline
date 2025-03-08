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
            $table->string('videoUrl');
            $table->integer('duration')->nullable()->comment('Độ dài video (giây)');
            $table->string('videoType')->default('mp4')->comment('Định dạng video');
            $table->string('thumbnailUrl')->nullable()->comment('Ảnh thumbnail của video');
            $table->boolean('isProcessed')->default(false)->comment('Trạng thái xử lý video');
            $table->json('videoQuality')->nullable()->comment('Các chất lượng video có sẵn');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_lessons');
    }
}
