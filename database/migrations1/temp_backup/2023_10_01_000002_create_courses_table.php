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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->string('title');
            $table->string('slug')->unique()->comment('Slug khóa học');
            $table->text('description')->nullable();
            $table->string('short_description')->nullable()->comment('Mô tả ngắn');
            $table->enum('course_type', ['self_paced', 'instructor_led', 'hybrid'])->default('instructor_led');
            $table->enum('course_format', ['online', 'offline', 'hybrid'])->default('online');
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->integer('estimated_hours')->nullable();
            $table->boolean('has_certificate')->default(false);
            $table->boolean('requires_enrollment')->default(true);
            $table->string('thumbnail')->nullable()->comment('Ảnh đại diện khóa học');
            $table->string('preview_video')->nullable();
            $table->integer('total_students')->default(0)->comment('Tổng số học viên đã đăng ký');
            $table->decimal('rating', 3, 2)->default(0)->comment('Đánh giá trung bình');
            $table->integer('total_ratings')->default(0)->comment('Tổng số đánh giá');
            $table->json('course_outline')->nullable();
            $table->json('requirements')->nullable();
            $table->json('learning_outcomes')->nullable();
            $table->dateTime('release_date')->nullable()->comment('Thời gian phát hành');
            $table->integer('order')->default(0);
            $table->boolean('is_featured')->default(false)->comment('Hiển thị trang chủ');
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
        Schema::dropIfExists('courses');
    }
}; 