<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonTestsTable extends Migration
{
    public function up()
    {
        Schema::create('lesson_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons');
            $table->string('slug')->unique()->comment('Slug bài kiểm tra');
            $table->string('name')->comment('Tên bài kiểm tra');
            $table->text('description')->nullable()->comment('Mô tả bài kiểm tra');
            $table->integer('duration')->nullable()->comment('Thời gian làm bài (giây)');
            $table->integer('min_score')->comment('Điểm tối thiểu để đạt');
            $table->integer('max_score')->default(100)->comment('Điểm tối đa');
            $table->boolean('is_required')->default(true)->comment('Bắt buộc phải làm bài kiểm tra');
            $table->integer('total_attempt')->default(0)->comment('Tổng số lần làm bài');
            $table->integer('max_attempt')->nullable()->comment('Số lần được phép làm lại');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_tests');
    }
}
