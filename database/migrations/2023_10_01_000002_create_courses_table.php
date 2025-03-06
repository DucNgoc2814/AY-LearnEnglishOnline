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
            $table->decimal('price', 8, 2)->nullable();
            $table->string('type');
            $table->string('learningPath')->nullable();
            $table->json('lessons')->nullable();
            $table->text('paymentContent')->nullable();
            $table->decimal('totalRating', 3, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
