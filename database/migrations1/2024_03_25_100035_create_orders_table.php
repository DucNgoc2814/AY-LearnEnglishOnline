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
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('order_status_id')->constrained('order_statuses');

            $table->string('transaction_id')->nullable()->comment('Mã giao dịch từ cổng thanh toán');
            $table->integer('payment_amount')->comment('Số tiền thanh toán thực tế');
            $table->integer('price')->comment('Giá gốc khóa học');
            $table->integer('sale_percentage')->nullable()->comment('Phần trăm giảm giá');
            $table->string('voucher_code')->nullable()->comment('Mã giảm giá nếu có');
            $table->string('payment_method')->comment('Phương thức thanh toán: momo/vnpay/bank_transfer/...');
            $table->dateTime('payment_date')->nullable()->comment('Thời gian thanh toán thành công');
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
