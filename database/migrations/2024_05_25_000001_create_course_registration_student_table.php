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
        Schema::create('course_registration_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_registration_id')->constrained('course_registrations')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            // Thêm các trường bổ sung nếu cần
            $table->timestamps();

            // Tạo unique constraint để tránh trùng lặp
            $table->unique(['course_registration_id', 'student_id'], 'unique_registration_student');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_registration_student');
    }
};
