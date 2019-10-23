<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewPanelistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_panelists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('int_id');
            $table->longText('panelists');
            $table->timestamps();
            // $table->foreign('int_id')
            //     ->references('interviews')->on('id')
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
        Schema::dropIfExists('interview_panelists');
    }
}