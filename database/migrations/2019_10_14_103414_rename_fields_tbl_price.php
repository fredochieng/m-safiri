<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameFieldsTblPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_trip_price', function (Blueprint $table) {
            $table->renameColumn('lacation_from','location_from');
            $table->renameColumn('lacation_to','location_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_trip_price', function (Blueprint $table) {
            $table->renameColumn('location_from','lacation_from');
            $table->renameColumn('location_to','lacation_to');
        });
    }
}
