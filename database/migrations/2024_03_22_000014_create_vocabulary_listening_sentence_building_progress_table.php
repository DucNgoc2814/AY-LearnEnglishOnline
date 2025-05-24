<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_sentence_building_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->comment('ID của học viên')->constrained('students')->onDelete('cascade')->name('vl_sb_progress_student_fk');
            $table->foreignId('sentence_building_id')->comment('ID của bài sentence building')->constrained('vocabulary_listening_sentence_buildings')->onDelete('cascade')->name('vl_sb_progress_sentence_fk');
            $table->decimal('progress', 5, 2)->default(0)->comment('Tiến độ làm bài sắp xếp câu (%)');
            $table->integer('retries')->default(0)->comment('Số lần đã làm lại toàn bộ bài tập');
            $table->integer('current_position')->default(0)->comment('Vị trí câu hiện tại đang làm');
            $table->integer('completed_count')->default(0)->comment('Số câu đã làm đúng');
            $table->json('attempts')->nullable()->comment('Chi tiết số lần làm lại của từng câu');
            $table->json('scores_history')->nullable()->comment('Lịch sử điểm số các lần làm');
            $table->timestamp('last_attempt')->nullable()->comment('Thời gian làm bài gần nhất');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['student_id', 'sentence_building_id'], 'vl_sentence_building_progress_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_sentence_building_progress');
    }
};
