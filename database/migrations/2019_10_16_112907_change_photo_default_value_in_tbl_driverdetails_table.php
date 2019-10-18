<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePhotoDefaultValueInTblDriverdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_driverdetails', function (Blueprint $table) {
            $table->string('photo')->default('uploads/driver_images/no_user_png')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_driverdetails', function (Blueprint $table) {
            //
        });
    }
}
