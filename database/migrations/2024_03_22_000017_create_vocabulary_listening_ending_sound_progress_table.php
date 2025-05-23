<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_ending_sound_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->comment('ID của học viên')->constrained('students')->onDelete('cascade')->name('vl_es_progress_student_fk');
            $table->foreignId('ending_sound_id')->comment('ID của bài ending sound')->constrained('vocabulary_listening_ending_sounds')->onDelete('cascade')->name('vl_es_progress_sound_fk');
            $table->integer('last_position')->default(0)->comment('Vị trí từ cuối cùng đã làm');
            $table->decimal('progress', 5, 2)->default(0)->comment('Tiến độ hoàn thành (%)');
            $table->json('completed_items')->nullable()->comment('Danh sách các từ đã hoàn thành');
            $table->timestamp('last_attempt')->nullable()->comment('Thời gian làm bài gần nhất');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['student_id', 'ending_sound_id'], 'vl_ending_sound_progress_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_ending_sound_progress');
    }
};
