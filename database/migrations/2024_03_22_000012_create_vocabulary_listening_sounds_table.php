<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_sounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->comment('ID của nhóm âm')->constrained('vocabulary_listening_sound_groups')->onDelete('cascade');
            $table->string('phonetic_symbol')->comment('Ký hiệu phiên âm (ví dụ: /p/, /t/, /k/)');
            $table->string('description')->nullable()->comment('Mô tả về âm');
            $table->string('example_word')->nullable()->comment('Từ ví dụ');
            $table->string('audio_url')->nullable()->comment('URL file audio phát âm');
            $table->integer('order')->default(0)->comment('Thứ tự hiển thị trong nhóm');
            $table->boolean('is_active')->default(true)->comment('Trạng thái kích hoạt');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_sounds');
    }
};
