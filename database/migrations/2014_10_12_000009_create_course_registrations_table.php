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
        Schema::create('course_registrations', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại liên kết với khóa học
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            // Trạng thái đăng ký: chờ xử lý, đang học, hoàn thành, đã nghỉ
            $table->enum('status', ['pending', 'active', 'completed', 'dropped'])->default('pending');
            // Học phí của khóa học
            $table->decimal('fee_amount', 10, 2)->nullable();
            // Trạng thái thanh toán: chờ thanh toán, đã thanh toán, đã hoàn tiền, thanh toán thất bại
            $table->enum('payment_status', ['pending', 'paid', 'refunded', 'failed'])->default('pending');
            // Phương thức thanh toán
            $table->string('payment_method')->nullable();
            // Ngày thanh toán
            $table->date('payment_date')->nullable();
            // Số hóa đơn
            $table->string('invoice_number')->nullable();
            // Ngày đăng ký
            $table->date('enrollment_date')->nullable();
            // Ngày hoàn thành khóa học
            $table->date('completion_date')->nullable();
            // Ghi chú về đăng ký
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
        Schema::dropIfExists('course_registrations');
    }
};
