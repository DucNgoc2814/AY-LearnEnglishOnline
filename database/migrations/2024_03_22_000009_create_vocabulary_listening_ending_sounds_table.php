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
            $table->foreignId('sound_id')->comment('ID của âm')->constrained('vocabulary_listening_sounds')->onDelete('cascade');
            $table->string('word')->comment('Từ cần thực hành');
            $table->string('base_phonetic')->comment('Phiên âm gốc');
            $table->string('ending_phonetic')->comment('Phiên âm khi thêm "s/es"');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_ending_sounds');
    }
};
