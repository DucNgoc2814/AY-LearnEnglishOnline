<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_dictations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->comment('ID của bài học')->constrained('lessons')->onDelete('cascade');
            $table->string('title')->comment('Tiêu đề của bài dictation');
            $table->string('audio_url')->comment('URL của file audio');
            $table->text('correct_text')->comment('Văn bản đúng của bài dictation');
            $table->text('display_text')->comment('Văn bản hiển thị với các khoảng trống');
            $table->json('blank_words')->comment('Danh sách các từ bị ẩn');
            $table->integer('max_retries')->default(3)->comment('Số lần tối đa được làm lại');
            $table->decimal('min_required_score', 5, 2)->default(80)->comment('Điểm số tối thiểu cần đạt (%)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_dictations');
    }
};
