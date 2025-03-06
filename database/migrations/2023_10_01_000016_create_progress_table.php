<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressTable extends Migration
{
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollmentId')->constrained('enrollments');
            $table->foreignId('lessonId')->nullable()->constrained('lessons');
            $table->integer('watchedTime')->default(0)->comment('Thời gian đã xem (giây)');
            $table->integer('totalTime')->default(0)->comment('Tổng thời gian bài học (giây)');
            $table->string('status')->default('in_progress')->comment('Trạng thái: in_progress/completed');
            $table->dateTime('lastWatchedAt')->nullable()->comment('Thời điểm xem gần nhất');
            $table->dateTime('completedAt')->nullable()->comment('Thời điểm hoàn thành');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('progress');
    }
}
