<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameLocationNameAndDestinationNameInRoutesTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->renameColumn('pickup_location', 'pickup_id');
            $table->renameColumn('destination_location', 'destination_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->renameColumn('pickup_id', 'pickup_location');
            $table->renameColumn('destination_id', 'destination_location');
        });
    }
}
