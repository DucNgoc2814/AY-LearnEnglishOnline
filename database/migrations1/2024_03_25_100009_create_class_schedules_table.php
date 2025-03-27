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
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->enum('day_of_week', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
            $table->time('start_time');
            $table->time('end_time');
            $table->date('start_date')->nullable(); // Ngày bắt đầu áp dụng lịch này
            $table->date('end_date')->nullable(); // Ngày kết thúc áp dụng lịch này
            $table->string('room_number')->nullable(); // Phòng học
            $table->text('notes')->nullable(); // Ghi chú
            $table->boolean('is_repeating')->default(true); // Lịch lặp lại hàng tuần
            $table->boolean('is_active')->default(true); // Trạng thái hoạt động
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