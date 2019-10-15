<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_trips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trip_id');
            $table->string('driver_name');
            $table->string('pickup_location');
            $table->string('destination_location');
            $table->string('start_trip_time');
            $table->string('end_trip_time');
            $table->string('travel_time');
            $table->float('payment');
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
        Schema::dropIfExists('tbl_trips');
    }
}
