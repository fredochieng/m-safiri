<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->string('phone_no')->after('company_id');
            $table->string('dob')->after('phone_no');
            $table->string('gender')->after('dob');
            $table->unsignedBigInteger('country_id')->after('gender');
            $table->unsignedBigInteger('city_id')->after('country_id');
            $table->string('zipcode')->after('city_id');
            $table->string('address')->after('zipcode');
            $table->string('licence_file')->after('address');
            $table->string('address_file')->after('licence_file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn('phone_no');
            $table->dropColumn('dob');
            $table->dropColumn('gender');
            $table->dropColumn('country_id');
            $table->dropColumn('city_id');
            $table->dropColumn('zipcode');
            $table->dropColumn('address');
            $table->dropColumn('licence_file');
            $table->dropColumn('address_file');
        });
    }
}