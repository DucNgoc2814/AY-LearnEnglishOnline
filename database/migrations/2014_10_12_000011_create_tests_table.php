<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->nullable()->onDelete('cascade'); 
            $table->string('slug')->unique()->comment('Slug bài kiểm tra/thi');
            $table->string('name')->comment('Tên bài kiểm tra/thi');
            $table->text('description')->nullable()->comment('Mô tả bài kiểm tra/thi');
            $table->integer('duration')->nullable()->comment('Thời gian làm bài (giây)');
            $table->integer('min_score')->comment('Điểm tối thiểu để đạt');
            $table->integer('max_score')->default(100)->comment('Điểm tối đa');
            $table->boolean('is_required')->default(true)->comment('Bắt buộc phải làm bài');
            $table->integer('total_attempt')->default(0)->comment('Tổng số lần làm bài');
            $table->integer('max_attempt')->nullable()->comment('Số lần được phép làm lại');
            $table->enum('type', [
                'lesson_test',     // Bài kiểm tra của bài học
                'entrance_test',   // Bài test đầu vào
                'after_class',     // Bài kiểm tra sau buổi học
                'before_class',    // Bài kiểm tra trước buổi học
            ])->comment('Loại bài kiểm tra');
            $table->integer('role')->default(0)->nullable()->comment('Thứ tự sắp xếp');
            $table->json('settings')->nullable()->comment('Cài đặt thêm cho từng loại test');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tests');
    }
} 