<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_grammar_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->comment('ID của học viên')->constrained('students')->onDelete('cascade');
            $table->foreignId('grammar_id')->comment('ID của bài grammar')->constrained('vocabulary_listening_grammars')->onDelete('cascade');
            $table->decimal('progress', 5, 2)->default(0)->comment('Tiến độ làm bài ngữ pháp (%)');
            $table->integer('retries')->default(0)->comment('Số lần đã làm lại toàn bộ bài tập');
            $table->decimal('highest_score', 5, 2)->default(0)->comment('Điểm số cao nhất đạt được (%)');
            $table->json('completed_items')->nullable()->comment('Danh sách các câu đã hoàn thành');
            $table->json('scores_history')->nullable()->comment('Lịch sử điểm số các lần làm');
            $table->integer('current_position')->default(0)->comment('Vị trí câu hiện tại đang làm');
            $table->timestamp('last_attempt')->nullable()->comment('Thời gian làm bài gần nhất');
            $table->boolean('min_score_achieved')->default(false)->comment('Đã đạt điểm tối thiểu yêu cầu');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['student_id', 'grammar_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_grammar_progress');
    }
};
