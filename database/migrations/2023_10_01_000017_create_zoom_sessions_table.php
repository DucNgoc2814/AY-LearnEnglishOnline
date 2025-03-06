<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('zoom_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lessonId')->constrained('lessons');
            $table->dateTime('releaseTime');
            $table->string('recordingLink')->nullable();
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('zoom_sessions');
    }
}
