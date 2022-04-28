<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_title', 127);
            $table->string('coupon_code', 127)->unique();
            $table->enum('discount_type', ['Fixed', 'Percentage'])->default('Percentage');
            $table->double('discount_amount', 8, 2);
            $table->integer('usable_per_person')->nullable();
            $table->integer('usable_in_total')->nullable();
            $table->dateTimeTz('coupon_start_date')->nullable();
            $table->dateTimeTz('coupon_end_date')->nullable();
            $table->enum('coupon_status', ['Active', 'Inactive'])->default('Inactive');
            $table->dateTimeTz('created_at');
            $table->dateTimeTz('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
