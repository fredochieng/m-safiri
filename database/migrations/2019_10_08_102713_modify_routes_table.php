<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->string('pickup_lat')->nullable()->change();
            $table->string('pickup_long')->nullable()->change();
            $table->string('destination_lat')->nullable()->change();
            $table->string('destination_long')->nullable()->change();
            $table->unsignedBigInteger('driver_id')->after('company_id');
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
            $table->dropColumn('driver_id');
        });
    }
}
