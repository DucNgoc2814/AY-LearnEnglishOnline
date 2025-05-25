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
            // Thời gian kết thúc khóa học
            $table->dateTime('end_date')->nullable();
            // Hạn chót đăng ký vào lớp
            $table->date('enrollment_deadline')->nullable();
            // Số học viên tối đa của lớp
            $table->integer('max_students')->default(30);
            // Số học viên tối thiểu để mở lớp
            $table->integer('min_students')->default(5);
            // Số học viên hiện tại trong lớp
            $table->integer('current_students')->default(0);
            // Trạng thái lớp học: chưa bắt đầu, đang diễn ra, đã hoàn thành, đã hủy
            $table->enum('status', ['pending', 'active', 'completed', 'cancelled'])->default('pending');
            // Mô tả chi tiết về lớp học
            $table->text('description')->nullable();
            // Lịch học dự kiến dạng JSON (các ngày trong tuần và giờ học)
            $table->json('schedule')->nullable();
            // Trạng thái hoạt động của lớp
            $table->boolean('is_active')->default(true);
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
