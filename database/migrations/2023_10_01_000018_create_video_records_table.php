<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('video_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zoomSessionId')->constrained('zoom_sessions');
            $table->string('linkVideo');
            $table->dateTime('uploadDate');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_records');
    }
}
