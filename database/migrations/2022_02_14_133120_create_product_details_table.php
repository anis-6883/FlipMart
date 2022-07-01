<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->unique();
            $table->string('product_name', 255);
            $table->string('product_slug', 255);
            $table->string('product_code', 255)->nullable();
            $table->string('product_tags', 255)->nullable();
            $table->string('product_sizes', 255)->nullable();
            $table->string('product_colors', 255)->nullable();
            $table->integer('product_order')->nullable();
            $table->text('product_summary')->nullable();
            $table->longText('product_description')->nullable();
            $table->text('product_master_image')->nullable();
            $table->double('product_regular_price', 8, 2);
            $table->integer('product_discounted_price')->nullable();
            $table->dateTimeTz('discount_start_date')->nullable();
            $table->dateTimeTz('discount_end_date')->nullable();
            $table->integer('product_quantity');
            $table->bigInteger('total_sold')->nullable();
            $table->boolean('featured')->default(0);
            $table->boolean('hot_deals')->default(0);
            $table->boolean('best_selling')->default(0);
            $table->index('product_name');
            $table->dateTimeTz('created_at');
            $table->dateTimeTz('updated_at');
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete()->cascadeOnUpdate();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product__details');
    }
}
