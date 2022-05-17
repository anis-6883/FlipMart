<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('subcategory_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('sub_subcategory_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('product_order')->nullable();
            $table->string('product_name', 255);
            $table->string('product_slug', 255);
            $table->string('product_code', 255)->nullable();
            $table->string('product_tags', 255)->nullable();
            $table->string('product_size', 255)->nullable();
            $table->string('product_color', 255)->nullable();
            $table->text('product_summary')->nullable();
            $table->longText('product_description')->nullable();
            $table->text('product_master_image')->nullable();
            $table->double('product_regular_price', 8, 2);
            $table->integer('product_discounted_price')->nullable();
            $table->dateTimeTz('discount_start_date')->nullable();
            $table->dateTimeTz('discount_end_date')->nullable();
            $table->integer('product_quantity');
            $table->enum('product_offer', ['Regular', 'Hot Deals', 'Featured', 'Special Offer', 'Special Deals'])->default('Regular');
            $table->enum('product_status', ['Active', 'Inactive'])->default('Inactive');
            $table->dateTimeTz('created_at');
            $table->dateTimeTz('updated_at');
            $table->index('product_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
