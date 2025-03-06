<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users');
            $table->foreignId('courseId')->constrained('courses');
            $table->string('status')->default('active')->comment('Trạng thái: active/completed');
            $table->integer('progress')->default(0)->comment('Tiến độ học tập (%)');
            $table->dateTime('startDate')->comment('Ngày bắt đầu học');
            $table->dateTime('completionDate')->nullable()->comment('Ngày hoàn thành khóa học');
            $table->dateTime('lastAccessDate')->nullable()->comment('Ngày học gần nhất');
            $table->text('note')->nullable()->comment('Ghi chú');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
}
