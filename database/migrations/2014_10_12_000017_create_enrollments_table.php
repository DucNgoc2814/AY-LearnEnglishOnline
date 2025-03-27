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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('class_id')->nullable()->constrained('classes')->onDelete('cascade');
            $table->enum('enrollment_type', ['course', 'class'])->default('course');
            $table->enum('payment_status', ['pending', 'paid', 'refunded', 'cancelled'])->default('pending');
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->date('enroll_date')->comment('Ngày bắt đầu học');
            $table->date('expire_date')->nullable();
            $table->enum('status', ['active', 'completed', 'expired', 'suspended'])->default('active');
            $table->integer('progress_percentage')->default(0)->comment('Tiến độ học tập (%)');
            $table->dateTime('last_access_date')->nullable()->comment('Ngày học gần nhất');
            $table->dateTime('completion_date')->nullable()->comment('Ngày hoàn thành khóa học');
            $table->text('notes')->nullable()->comment('Ghi chú');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
}; 