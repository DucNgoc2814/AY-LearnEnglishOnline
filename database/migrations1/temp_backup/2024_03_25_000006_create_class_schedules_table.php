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
            $table->foreignId('classId')->constrained('classes')->onDelete('cascade');
            $table->enum('dayOfWeek', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
            $table->time('startTime');
            $table->time('endTime');
            $table->date('startDate')->nullable(); // Ngày bắt đầu áp dụng lịch này
            $table->date('endDate')->nullable(); // Ngày kết thúc áp dụng lịch này
            $table->string('roomNumber')->nullable(); // Phòng học
            $table->text('notes')->nullable(); // Ghi chú
            $table->boolean('isRepeating')->default(true); // Lịch lặp lại hàng tuần
            $table->boolean('isActive')->default(true); // Trạng thái hoạt động
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