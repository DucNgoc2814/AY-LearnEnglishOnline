<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('short_description')->nullable();
            $table->enum('course_type', ['self_paced', 'instructor_led', 'hybrid'])->default('self_paced');
            $table->enum('course_format', ['online', 'offline', 'hybrid'])->default('online');
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->integer('estimated_hours')->nullable();
            $table->boolean('has_certificate')->default(false);
            $table->boolean('requires_enrollment')->default(true);
            $table->string('thumbnail')->nullable();
            $table->string('preview_video')->nullable();
            $table->integer('total_students')->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_ratings')->default(0);
            $table->json('course_outline')->nullable();
            $table->json('requirements')->nullable();
            $table->json('learning_outcomes')->nullable();
            $table->dateTime('release_date')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
}; 