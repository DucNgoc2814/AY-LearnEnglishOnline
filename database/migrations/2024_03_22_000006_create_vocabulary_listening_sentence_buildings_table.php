<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_sentence_buildings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->comment('ID của bài học')->constrained('lessons')->onDelete('cascade');
            $table->string('sentence_number')->comment('Số thứ tự câu');
            $table->string('correct_sentence')->comment('Câu đúng sau khi sắp xếp');
            $table->integer('max_retries')->default(3)->comment('Số lần tối đa được làm lại mỗi câu');
            $table->decimal('min_required_score', 5, 2)->default(80)->comment('Điểm số tối thiểu cần đạt (%)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_sentence_buildings');
    }
};
