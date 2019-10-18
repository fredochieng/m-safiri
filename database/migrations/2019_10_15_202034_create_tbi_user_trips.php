<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbiUserTrips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_user_trips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trip_id');
            $table->integer('user_id');
            $table->integer('driver_id');
            $table->string('rating');
            $table->text('comments');
            $table->text('cancel_reason');
            $table->enum('status',  ['0', 'confirm', 'cancel', 'booked', 'onboard'])->default('0');
            $table->text('trip_screenshot');
            $table->datetime('datetime');
            $table->datetime('notify_datetime');
            $table->tinyInteger('notify_count');


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
        Schema::dropIfExists('tbl_user_trips');
    }
}
