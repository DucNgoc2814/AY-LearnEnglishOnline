<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reflection_sentence_progress', function (Blueprint $table) {
            $table->id()->comment('ID của tiến độ');
            $table->foreignId('user_id')->comment('ID của học viên')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('reflection_sentence_structure_id')->comment('ID của mẫu câu')
                ->constrained()
                ->onDelete('cascade');
            $table->text('practice_text')->nullable()->comment('Câu học viên đã viết');
            $table->boolean('is_completed')->default(false)->comment('Đã hoàn thành chưa');
            $table->timestamp('completed_at')->nullable()->comment('Thời gian hoàn thành');
            $table->timestamps();
            $table->softDeletes();

            // Đảm bảo mỗi học viên chỉ có một tiến độ cho mỗi mẫu câu
            $table->unique(['user_id', 'reflection_sentence_structure_id'], 'unique_sentence_progress');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reflection_sentence_progress');
    }
};
