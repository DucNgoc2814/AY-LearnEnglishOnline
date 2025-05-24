<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_key_phrase_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->comment('ID của học viên')->constrained('students')->onDelete('cascade');
            $table->foreignId('key_phrase_id')->comment('ID của bài key phrase')->constrained('vocabulary_listening_key_phrases')->onDelete('cascade');
            $table->decimal('progress', 5, 2)->default(0)->comment('Tiến độ làm bài điền từ (%)');
            $table->integer('retries')->default(0)->comment('Số lần đã làm lại bài Key Phrases');
            $table->decimal('highest_score', 5, 2)->default(0)->comment('Điểm số cao nhất đạt được (%)');
            $table->json('scores_history')->nullable()->comment('Lịch sử điểm số các lần làm');
            $table->json('completed_items')->nullable()->comment('Danh sách các câu đã hoàn thành');
            $table->integer('current_position')->default(0)->comment('Vị trí câu hiện tại đang làm');
            $table->timestamp('last_attempt')->nullable()->comment('Thời gian làm bài gần nhất');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['student_id', 'key_phrase_id'], 'vl_key_phrase_progress_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_key_phrase_progress');
    }
};
