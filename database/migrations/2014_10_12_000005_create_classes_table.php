<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại liên kết với khóa học
            $table->foreignId('course_id')->constrained('courses')->nullable()->onDelete('cascade');
            // Tên lớp học (VD: Lớp IELTS 7.0 - A1)
            $table->string('name');
            // Mã lớp học duy nhất (VD: IELTS7-A1-2024)
            $table->string('code')->unique();
            // Giáo viên phụ trách lớp
            $table->foreignId('teacher_id')->constrained('employees')->onDelete('cascade');
            // Thời gian bắt đầu khóa học
            $table->dateTime('start_date')->nullable();
            // Số học viên tối đa của lớp
            $table->integer('max_students')->default(20)->nullable();
            // Số học viên tối thiểu để mở lớp
            $table->integer('min_students')->default(1)->nullable();
            // Trạng thái lớp học: chưa bắt đầu, đang diễn ra, đã hoàn thành, đã hủy
            $table->enum('status', ['pending', 'active', 'completed', 'cancelled'])->default('pending');
            // Mô tả chi tiết về lớp học
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
