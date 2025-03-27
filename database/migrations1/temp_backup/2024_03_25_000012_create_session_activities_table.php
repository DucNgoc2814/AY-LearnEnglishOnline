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
        Schema::create('session_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('class_sessions')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('type', ['quiz', 'poll', 'group_work', 'presentation', 'exercise', 'discussion']);
            $table->json('content'); // Nội dung hoạt động (câu hỏi, đáp án, v.v.)
            $table->integer('duration')->nullable(); // Thời gian làm bài (phút)
            $table->datetime('start_time')->nullable(); // Thời gian bắt đầu
            $table->datetime('end_time')->nullable(); // Thời gian kết thúc
            $table->boolean('is_graded')->default(false); // Có tính điểm không
            $table->boolean('is_mandatory')->default(true); // Bắt buộc hay không
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_activities');
    }
}; 