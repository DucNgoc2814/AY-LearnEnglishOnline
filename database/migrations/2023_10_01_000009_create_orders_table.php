<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users');
            $table->foreignId('courseId')->constrained('courses');
            $table->string('orderStatus');
            $table->string('transactionId')->nullable();
            $table->decimal('paymentAmount', 8, 2);
            $table->decimal('price', 8, 2);
            $table->decimal('salePercentage')->nullable();
            $table->string('voucherCode')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
