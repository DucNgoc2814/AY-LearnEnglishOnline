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
        Schema::create('session_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('class_sessions')->onDelete('cascade');
            $table->foreignId('student_id')->nullable()->constrained('students')->nullOnDelete(); // null nếu là giáo viên
            $table->enum('type', ['question', 'answer', 'chat', 'reaction', 'poll', 'quiz', 'raise_hand']);
            $table->text('content')->nullable(); // Nội dung câu hỏi, trả lời, chat
            $table->string('reaction_type')->nullable(); // Loại reaction (nếu type là reaction)
            $table->datetime('interaction_time'); // Thời gian tương tác
            $table->boolean('is_private')->default(false); // Tương tác riêng tư
            $table->boolean('is_highlighted')->default(false); // Được giáo viên highlight
            $table->boolean('is_answered')->default(false); // Câu hỏi đã được trả lời
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_interactions');
    }
}; 