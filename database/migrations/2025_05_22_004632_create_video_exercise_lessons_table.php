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
        Schema::create('video_exercise_lessons', function (Blueprint $table) {
            $table->id()->comment('ID của bài tập video');
            $table->foreignId('lesson_id')->comment('ID của bài học')->constrained('lessons')->onDelete('cascade');
            $table->string('title')->comment('Tiêu đề bài tập video');
            $table->string('video_url')->comment('URL của video bài học');
            $table->text('description')->nullable()->comment('Mô tả bài tập');
            $table->string('section')->default('before_class')->comment('Phần học (before_class, during_class, after_class)');
            $table->boolean('is_active')->default(true)->comment('Trạng thái kích hoạt');
            $table->integer('order')->default(0)->comment('Thứ tự hiển thị');
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('lesson_id');
            $table->index(['section', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_exercise_lessons');
    }
};
