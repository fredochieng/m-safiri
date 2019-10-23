<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('int_id');
            $table->longText('candidates');
            $table->timestamps();

            // $table->foreign('int_id')
            //     ->references('interviews')->on('interview_id')
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
        Schema::dropIfExists('interview_candidates');
    }
}