<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_dictation_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->comment('ID của học viên')->constrained('students')->onDelete('cascade');
            $table->foreignId('dictation_id')->comment('ID của bài dictation')->constrained('vocabulary_listening_dictations')->onDelete('cascade');
            $table->decimal('progress', 5, 2)->default(0)->comment('Tiến độ làm bài nghe điền từ (%)');
            $table->integer('retries')->default(0)->comment('Số lần đã làm lại bài dictation');
            $table->decimal('highest_score', 5, 2)->default(0)->comment('Điểm số cao nhất đạt được (%)');
            $table->json('scores_history')->nullable()->comment('Lịch sử điểm số các lần làm');
            $table->json('completed_blanks')->nullable()->comment('Danh sách các ô trống đã điền đúng');
            $table->timestamp('last_activity')->nullable()->comment('Thời gian hoạt động cuối cùng');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['student_id', 'dictation_id'], 'vl_dictation_progress_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_dictation_progress');
    }
};
