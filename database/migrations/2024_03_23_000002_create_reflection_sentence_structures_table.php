<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reflection_sentence_structures', function (Blueprint $table) {
            $table->id()->comment('ID của mẫu câu');
            $table->foreignId('lesson_id')->comment('ID của bài học')->constrained('lessons')->onDelete('cascade');
            $table->string('pattern_text')->comment('Nội dung mẫu câu tiếng Anh');
            $table->string('pattern_translation')->comment('Bản dịch tiếng Việt của mẫu câu');
            $table->string('example')->comment('Ví dụ minh họa cho mẫu câu');
            $table->integer('order')->default(0)->comment('Thứ tự hiển thị');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reflection_sentence_structures');
    }
};
