<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courseId')->constrained('courses');
            $table->string('name');
            $table->string('videoUrl')->nullable();
            $table->text('description')->nullable();
            $table->integer('duration')->nullable()->comment('Độ dài bài học (giây)');
            $table->integer('orderNumber')->default(0)->comment('Thứ tự bài học trong khóa học');
            $table->boolean('isPreview')->default(false)->comment('Bài học xem thử');
            $table->integer('totalView')->default(0)->comment('Tổng số lượt xem');
            $table->integer('totalComment')->default(0)->comment('Tổng số bình luận');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
