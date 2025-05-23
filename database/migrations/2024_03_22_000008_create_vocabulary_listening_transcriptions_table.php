<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_transcriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->comment('ID của bài học')->constrained('lessons')->onDelete('cascade');
            $table->string('word')->comment('Từ cần phiên âm');
            $table->string('correct_phonetic')->comment('Phiên âm đúng');
            $table->integer('max_retries')->default(3)->comment('Số lần tối đa được làm lại');
            $table->decimal('min_required_score', 5, 2)->default(80)->comment('Điểm số tối thiểu cần đạt (%)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_transcriptions');
    }
};
