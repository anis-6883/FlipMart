<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name', 63);
            $table->string('customer_mobile', 15)->nullable();
            $table->string('customer_otp', 7)->nullable();
            $table->string('customer_email', 63);
            $table->string('password', 127);
            $table->string('customer_verify_key', 31)->nullable();
            $table->date('customer_dob')->nullable();
            $table->enum('customer_gender', ['Male', 'Female', 'Other'])->nullable();
            $table->enum('customer_status', ['Active', 'Inactive'])->default('Active');
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
        Schema::dropIfExists('customers');
    }
}
