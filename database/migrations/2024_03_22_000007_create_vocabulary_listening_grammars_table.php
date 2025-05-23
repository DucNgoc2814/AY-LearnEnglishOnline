<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_grammars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->comment('ID của bài học')->constrained('lessons')->onDelete('cascade');
            $table->text('sentence')->comment('Câu gốc chứa từ tiếng Việt cần tìm từ đồng nghĩa (VD: My hometown is a khá rộng town)');
            $table->string('vietnamese_word')->comment('Từ tiếng Việt cần tìm từ đồng nghĩa (VD: khá rộng)');
            $table->string('correct_synonym')->comment('Từ đồng nghĩa tiếng Anh tương ứng (VD: fairly large)');
            $table->integer('max_retries')->default(3)->comment('Số lần tối đa được làm lại');
            $table->decimal('min_required_score', 5, 2)->default(80)->comment('Điểm số tối thiểu cần đạt (%)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_grammars');
    }
};
