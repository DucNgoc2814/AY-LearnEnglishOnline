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
        Schema::create('class_students', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại liên kết với lớp học
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            // Khóa ngoại liên kết với học viên
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            // Khóa ngoại liên kết với đăng ký khóa học
            $table->foreignId('registration_id')->constrained('course_registrations')->onDelete('cascade');
            // Ngày bắt đầu học trong lớp
            $table->date('start_date');
            // Ghi chú về học viên trong lớp
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Một học viên chỉ có thể xuất hiện một lần trong một lớp tại một thời điểm
            $table->unique(['class_id', 'student_id', 'registration_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_students');
    }
};
