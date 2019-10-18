<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTblTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_trips', function (Blueprint $table) {
            $table->dropColumn('driver_name');
            //$table->dropColumn('trip_id');
            $table->unsignedBigInteger('driver_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_trips', function (Blueprint $table) {
            $table->string('driver_name');
            $table->dropColumn('driver_id');
            // $table->unsignedBigInteger('trip_id');
        });
    }
}