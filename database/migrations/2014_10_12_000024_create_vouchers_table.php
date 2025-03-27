<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->comment('Mã voucher');
            $table->integer('sale')->comment('Giá trị giảm giá');
            $table->dateTime('start_date')->comment('Ngày bắt đầu');
            $table->dateTime('end_date')->comment('Ngày kết thúc');
            $table->integer('usage_count')->default(0)->comment('Số lần đã sử dụng');
            $table->integer('max_usage')->nullable()->comment('Số lần tối đa được sử dụng');
            $table->integer('min_order_value')->nullable()->comment('Giá trị đơn hàng tối thiểu');
            $table->integer('max_discount')->nullable()->comment('Giá trị giảm tối đa');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
} 