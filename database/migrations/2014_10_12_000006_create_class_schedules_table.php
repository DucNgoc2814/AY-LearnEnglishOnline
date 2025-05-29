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
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại liên kết với lớp học
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            // Thứ trong tuần (1-7 tương ứng với Thứ 2 - Chủ nhật)
            $table->integer('day_of_week');
            // Giờ bắt đầu buổi học
            $table->time('start_time');
            // Giờ kết thúc buổi học
            $table->time('end_time');
            // Số phòng học (nếu học offline)
            $table->string('room_number')->nullable();
            // Link học trực tuyến (nếu học online)
            $table->string('meeting_url')->nullable();
            // Có lặp lại hàng tuần không
            $table->boolean('is_repeating')->default(true);
            // Trạng thái hoạt động của lịch học
            $table->boolean('is_active')->default(true);
            // Hình thức học (online/offline)
            $table->boolean('is_online')->default(false);
            // Ngày bắt đầu áp dụng lịch học
            $table->date('start_date')->nullable();
            // Ngày kết thúc lịch học
            $table->date('end_date')->nullable();
            // Ghi chú về lịch học
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_schedules');
    }
};
