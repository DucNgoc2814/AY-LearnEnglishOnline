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
            $table->foreignId('lessonId')->constrained('lessons');
            $table->string('name')->comment('Tên bài kiểm tra');
            $table->text('description')->nullable()->comment('Mô tả bài kiểm tra');
            $table->integer('duration')->nullable()->comment('Thời gian làm bài (giây)');
            $table->integer('minScore')->comment('Điểm tối thiểu để đạt');
            $table->integer('maxScore')->default(100)->comment('Điểm tối đa');
            $table->integer('orderNumber')->default(0)->comment('Thứ tự bài kiểm tra trong bài học');
            $table->boolean('isRequired')->default(true)->comment('Bắt buộc phải làm bài kiểm tra');
            $table->integer('totalAttempt')->default(0)->comment('Tổng số lần làm bài');
            $table->integer('maxAttempt')->nullable()->comment('Số lần được phép làm lại');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_tests');
    }
}
