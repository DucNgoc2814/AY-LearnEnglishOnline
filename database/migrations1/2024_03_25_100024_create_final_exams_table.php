<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalExamsTable extends Migration
{
    public function up()
    {
        Schema::create('final_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses');
            $table->string('slug')->unique()->comment('Slug bài thi cuối khóa');
            $table->string('name')->comment('Tên bài thi cuối khóa');
            $table->text('description')->nullable()->comment('Mô tả bài thi');
            $table->integer('duration')->nullable()->comment('Thời gian làm bài (giây)');
            $table->integer('min_score')->comment('Điểm tối thiểu để đạt');
            $table->integer('max_score')->default(100)->comment('Điểm tối đa');
            $table->integer('total_attempt')->default(0)->comment('Tổng số lần làm bài');
            $table->integer('max_attempt')->nullable()->comment('Số lần được phép làm lại');
            $table->boolean('is_required')->default(true)->comment('Bắt buộc phải làm bài thi');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('final_exams');
    }
}
