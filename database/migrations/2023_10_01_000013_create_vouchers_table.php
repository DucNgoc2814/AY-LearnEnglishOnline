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
            $table->decimal('sale', 8, 2)->comment('Giá trị giảm giá');
            $table->dateTime('startDate')->comment('Ngày bắt đầu');
            $table->dateTime('endDate')->comment('Ngày kết thúc');
            $table->integer('usageCount')->default(0)->comment('Số lần đã sử dụng');
            $table->integer('maxUsage')->nullable()->comment('Số lần tối đa được sử dụng');
            $table->decimal('minOrderValue', 12, 2)->nullable()->comment('Giá trị đơn hàng tối thiểu');
            $table->decimal('maxDiscount', 12, 2)->nullable()->comment('Giá trị giảm tối đa');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
