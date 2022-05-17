<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('slider_name', 127);
            $table->string('slider_subtitle', 127)->nullable();
            $table->string('slider_title', 127);
            $table->text('slider_image_filename');
            $table->integer('slider_order')->nullable();
            $table->enum('slider_status', ['Active', 'Inactive'])->default('Inactive');
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
        Schema::dropIfExists('sliders');
    }
}
