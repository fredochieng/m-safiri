<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_userdata', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('user_email')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('old_password')->nullable();
            $table->string('sentcode')->nullable();
            $table->string('mobile_number')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->text('photo');
            $table->string('country')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active')->nullable();
            $table->string('device_id')->nullable();
            $table->text('device_token')->nullable();
            $table->string('login_type')->nullable();
            $table->string('getcode')->nullable();
            $table->string('token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_userdata');
    }
}
