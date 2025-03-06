<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoryId')->nullable()->constrained('categories');
            $table->string('name');
            $table->text('description');
            $table->string('sortDescription')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('salePrice', 8, 2)->nullable();
            $table->string('thumbnail')->nullable()->comment('Ảnh đại diện khóa học');
            $table->integer('totalStudent')->default(0)->comment('Tổng số học viên đã đăng ký');
            $table->integer('rating')->default(0)->comment('Đánh giá trung bình');
            $table->integer('totalRating')->default(0)->comment('Tổng số đánh giá');
            $table->dateTime('releaseTime')->nullable()->comment('Thời gian phát hành');
            $table->integer('type')->default(0)->comment('Loại khóa học: 1 - free, 0 - trả phí');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
