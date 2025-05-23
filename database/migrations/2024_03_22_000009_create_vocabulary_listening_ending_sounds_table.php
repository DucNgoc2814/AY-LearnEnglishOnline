<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_ending_sounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->comment('ID của bài học')->constrained('lessons')->onDelete('cascade');
            $table->string('word')->comment('Từ gốc (ví dụ: Class)');
            $table->string('word_with_ending')->comment('Từ khi thêm s/es (ví dụ: Classes)');
            $table->string('base_phonetic')->comment('Phiên âm gốc không có âm cuối (ví dụ: klæ)');
            $table->string('ending_phonetic')->comment('Âm cuối cần kéo thả (s, z, ɪz)');
            $table->string('full_phonetic')->comment('Phiên âm đầy đủ của từ gốc (ví dụ: /klæs/)');
            $table->string('full_phonetic_with_ending')->comment('Phiên âm đầy đủ khi thêm s/es (ví dụ: /klæsɪz/)');
            $table->enum('sound_group', [1, 2, 3])->comment('Nhóm âm: 1-Voiceless, 2-Fricative/Affricate, 3-Other');
            $table->integer('display_order')->default(0)->comment('Thứ tự hiển thị');
            $table->boolean('is_active')->default(true)->comment('Trạng thái kích hoạt');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_ending_sounds');
    }
};
