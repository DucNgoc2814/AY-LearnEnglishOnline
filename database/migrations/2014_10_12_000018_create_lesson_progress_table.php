<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonProgressTable extends Migration
{
    public function up()
    {
        Schema::create('lesson_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained('enrollments');
            $table->foreignId('lesson_id')->nullable()->constrained('lessons');
            $table->integer('watched_time')->default(0)->comment('Thời gian đã xem (giây)');
            $table->integer('total_time')->default(0)->comment('Tổng thời gian bài học (giây)');
            $table->string('status')->default('in_progress')->comment('Trạng thái: in_progress/completed');
            $table->dateTime('last_watched_at')->nullable()->comment('Thời điểm xem gần nhất');
            $table->dateTime('completed_at')->nullable()->comment('Thời điểm hoàn thành');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_progress');
    }
} 