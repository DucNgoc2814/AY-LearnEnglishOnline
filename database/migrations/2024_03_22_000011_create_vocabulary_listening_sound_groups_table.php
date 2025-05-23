<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_sound_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên nhóm (Nhóm 1, Nhóm 2, ...)');
            $table->string('description')->comment('Mô tả nhóm (ví dụ: Các âm cuối vô thanh)');
            $table->integer('order')->default(0)->comment('Thứ tự hiển thị của nhóm');
            $table->boolean('is_active')->default(true)->comment('Trạng thái kích hoạt');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_sound_groups');
    }
};
