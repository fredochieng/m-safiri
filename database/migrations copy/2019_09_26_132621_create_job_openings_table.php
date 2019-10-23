<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOpeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_openings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('opening_ticket');
            $table->string('opening_name');
            $table->unsignedBigInteger('opening_type');
            $table->unsignedBigInteger('opening_status');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->foreign('opening_type')
                ->references('id')->on('job_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_openings');
    }
}