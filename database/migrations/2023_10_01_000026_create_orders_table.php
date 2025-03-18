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
            $table->foreignId('orderStatusId')->constrained('order_statuses');
            
            $table->string('transactionId')->nullable()->comment('Mã giao dịch từ cổng thanh toán');
            $table->decimal('paymentAmount', 8, 2)->comment('Số tiền thanh toán thực tế');
            $table->decimal('price', 8, 2)->comment('Giá gốc khóa học');
            $table->decimal('salePercentage')->nullable()->comment('Phần trăm giảm giá');
            $table->string('voucherCode')->nullable()->comment('Mã giảm giá nếu có');
            $table->string('paymentMethod')->comment('Phương thức thanh toán: momo/vnpay/bank_transfer/...');
            $table->dateTime('paymentDate')->nullable()->comment('Thời gian thanh toán thành công');
            $table->text('note')->nullable()->comment('Ghi chú đơn hàng');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
