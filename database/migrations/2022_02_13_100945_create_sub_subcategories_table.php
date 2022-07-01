<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('subcategory_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('sub_subcategory_name', 127);
            $table->integer('sub_subcategory_order')->default(0);
            $table->enum('sub_subcategory_status', ['Active', 'Inactive'])->default('Inactive');
            $table->dateTimeTz('created_at');
            $table->dateTimeTz('updated_at');
            $table->unique(['category_id', 'subcategory_id', 'sub_subcategory_name'], 'category_id_subcategory_id_sub_subcategory_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_subcategories');
    }
}
