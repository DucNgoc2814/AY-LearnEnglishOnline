<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->comment('ID của học viên')->constrained('students')->onDelete('cascade');
            $table->foreignId('lesson_id')->comment('ID của bài học')->constrained('lessons')->onDelete('cascade');

            // Tiến độ cho từng bước
            $table->decimal('video_progress', 5, 2)->default(0)->comment('Tiến độ xem video (%)');

            // Chi tiết tiến độ Quizlet
            $table->boolean('quizlet_flashcards_completed')->default(false)->comment('Đã hoàn thành phần Flashcards');
            $table->boolean('quizlet_learn_completed')->default(false)->comment('Đã hoàn thành phần Learn');
            $table->boolean('quizlet_write_completed')->default(false)->comment('Đã hoàn thành phần Write');
            $table->boolean('quizlet_test_completed')->default(false)->comment('Đã hoàn thành phần Test');
            $table->decimal('quizlet_progress', 5, 2)->default(0)->comment('Tiến độ học từ vựng trên Quizlet (%)');

            // Chi tiết cho phần Dictation
            $table->decimal('dictation_progress', 5, 2)->default(0)->comment('Tiến độ làm bài nghe điền từ (%)');
            $table->integer('dictation_retries')->default(0)->comment('Số lần đã làm lại bài dictation');
            $table->decimal('dictation_highest_score', 5, 2)->default(0)->comment('Điểm số cao nhất đạt được (%)');
            $table->json('dictation_scores_history')->nullable()->comment('Lịch sử điểm số các lần làm');
            $table->json('dictation_completed_blanks')->nullable()->comment('Danh sách các ô trống đã điền đúng');

            // Chi tiết cho phần Key Phrases
            $table->decimal('key_phrase_progress', 5, 2)->default(0)->comment('Tiến độ làm bài điền từ (%)');
            $table->integer('key_phrase_retries')->default(0)->comment('Số lần đã làm lại bài Key Phrases');
            $table->decimal('key_phrase_highest_score', 5, 2)->default(0)->comment('Điểm số cao nhất đạt được (%)');
            $table->json('key_phrase_scores_history')->nullable()->comment('Lịch sử điểm số các lần làm');
            $table->json('key_phrase_completed_items')->nullable()->comment('Danh sách các câu đã hoàn thành');
            $table->integer('key_phrase_current_position')->default(0)->comment('Vị trí câu hiện tại đang làm');
            $table->timestamp('key_phrase_last_attempt')->nullable()->comment('Thời gian làm bài gần nhất');

            // Chi tiết cho phần Sentence Building
            $table->decimal('sentence_building_progress', 5, 2)->default(0)->comment('Tiến độ làm bài sắp xếp câu (%)');
            $table->integer('sentence_building_retries')->default(0)->comment('Số lần đã làm lại toàn bộ bài tập');
            $table->integer('sentence_building_current_position')->default(0)->comment('Vị trí câu hiện tại đang làm');
            $table->integer('sentence_building_completed_count')->default(0)->comment('Số câu đã làm đúng');
            $table->json('sentence_building_attempts')->nullable()->comment('Chi tiết số lần làm lại của từng câu');
            $table->json('sentence_building_scores_history')->nullable()->comment('Lịch sử điểm số các lần làm');
            $table->timestamp('sentence_building_last_attempt')->nullable()->comment('Thời gian làm bài gần nhất');

            // Chi tiết cho phần Grammar
            $table->decimal('grammar_progress', 5, 2)->default(0)->comment('Tiến độ làm bài ngữ pháp (%)');
            $table->integer('grammar_retries')->default(0)->comment('Số lần đã làm lại toàn bộ bài tập');
            $table->decimal('grammar_highest_score', 5, 2)->default(0)->comment('Điểm số cao nhất đạt được (%)');
            $table->json('grammar_completed_items')->nullable()->comment('Danh sách các câu đã hoàn thành');
            $table->json('grammar_scores_history')->nullable()->comment('Lịch sử điểm số các lần làm');
            $table->integer('grammar_current_position')->default(0)->comment('Vị trí câu hiện tại đang làm');
            $table->timestamp('grammar_last_attempt')->nullable()->comment('Thời gian làm bài gần nhất');
            $table->boolean('grammar_min_score_achieved')->default(false)->comment('Đã đạt điểm tối thiểu yêu cầu');

            // Chi tiết cho phần Transcription
            $table->decimal('transcription_progress', 5, 2)->default(0)->comment('Tiến độ làm bài phiên âm (%)');
            $table->integer('transcription_retries')->default(0)->comment('Số lần đã làm lại toàn bộ bài tập');
            $table->decimal('transcription_highest_score', 5, 2)->default(0)->comment('Điểm số cao nhất đạt được (%)');
            $table->json('transcription_completed_items')->nullable()->comment('Danh sách các từ đã phiên âm đúng');
            $table->json('transcription_scores_history')->nullable()->comment('Lịch sử điểm số các lần làm');
            $table->integer('transcription_current_position')->default(0)->comment('Vị trí từ hiện tại đang làm');
            $table->timestamp('transcription_last_attempt')->nullable()->comment('Thời gian làm bài gần nhất');
            $table->boolean('transcription_min_score_achieved')->default(false)->comment('Đã đạt điểm tối thiểu yêu cầu');

            // Chi tiết cho phần Ending Sound Exercise
            $table->integer('ending_sound_last_position')->default(0)->comment('Vị trí từ cuối cùng đã làm');
            $table->timestamp('ending_sound_last_attempt')->nullable()->comment('Thời gian làm bài gần nhất');

            // Tiến độ tổng thể
            $table->decimal('total_progress', 5, 2)->default(0)->comment('Tiến độ tổng thể của tất cả các bước (%)');

            // Thông tin bổ sung
            $table->json('completed_items')->nullable()->comment('Chi tiết các mục đã hoàn thành trong mỗi bước');
            $table->timestamp('last_activity')->nullable()->comment('Thời gian hoạt động cuối cùng');
            $table->timestamps();
            $table->softDeletes();

            // Đảm bảo mỗi user chỉ có một bản ghi tiến độ cho mỗi bài học
            $table->unique(['student_id', 'lesson_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_progress');
    }
};
