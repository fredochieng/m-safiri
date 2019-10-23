<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_opening_id');
            $table->string('interview_name');
            $table->unsignedBigInteger('interview_status')->default(0);
            $table->unsignedBigInteger('funct_head_id')->nullable();
            $table->string('interview_date');
            $table->string('interview_time');
            $table->string('started_at')->nullable();
            $table->string('ended_at')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            // $table->foreign('job_opening_id')
            //     ->references('job_openings')->on('id')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interviews');
    }
}