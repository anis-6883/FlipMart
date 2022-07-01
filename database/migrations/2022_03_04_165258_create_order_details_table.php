<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->unique();
            $table->string('username');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->string('payment_type'); 
            $table->string('payment_method');
            $table->string('transaction_id');
            $table->string('currency');
            $table->string('order_number');
            $table->string('invoice_no');
            $table->dateTimeTz('order_date');
            $table->string('order_month');
            $table->string('order_year');
            $table->double('delivery_charge', 8, 2);
            $table->string('discount_coupon')->nullable();
            $table->double('discount_amount', 8, 2)->nullable();
            $table->double('total_before_discount', 8, 2)->nullable();
            $table->double('grand_total', 8, 2);
            $table->dateTimeTz('delivered_date')->nullable();
            $table->string('return_date')->nullable();
            $table->string('return_reason')->nullable();
            $table->dateTimeTz('created_at');
            $table->dateTimeTz('updated_at');
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order__details');
    }
}
