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
            $table->foreignId('lesson_id')->constrained('lessons')->nullable()->onDelete('cascade');
            $table->integer('day_of_week');  // 1-7 tương ứng với Thứ 2 - Chủ nhật
            $table->time('start_time');
            $table->time('end_time');
            $table->string('room_number')->nullable();
            $table->string('meeting_url')->nullable();
            $table->boolean('is_repeating')->default(true);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_online')->default(false);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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