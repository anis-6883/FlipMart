<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnDelete()->restrictOnUpdate();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->enum('order_status', ['Pending', 'Halt', 'Processing', 'Shipping', 'Delivered', 'Completed', 'Cancelled', 'Refunded'])->default('Pending');
            $table->dateTimeTz('created_at');
            $table->dateTimeTz('updated_at');
            $table->foreign('coupon_id')->references('id')->on('coupons')->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
