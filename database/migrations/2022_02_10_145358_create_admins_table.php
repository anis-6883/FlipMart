<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('admin_fullname', 255);
            $table->string('admin_username', 255)->unique();
            $table->string('admin_password', 255);
            $table->enum('admin_status', ['Active', 'Inactive'])->default('Active');
            $table->enum('admin_type', ['Root Admin', 'Manager'])->default('Root Admin');
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
        Schema::dropIfExists('admins');
    }
}
