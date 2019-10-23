<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblMechanics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_mechanics', function (Blueprint $table) {

            $table->string('phone_no')->after('fullname');
            $table->string('pwd')->after('email');
            $table->string('con_pwd')->after('pwd');
            $table->string('city')->after('street');
            $table->string('state')->after('city');
            $table->string('country')->after('state');
            $table->string('email_code')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_mechanics', function (Blueprint $table) {

            $table->dropColumn('phone_no');
            $table->dropColumn('pwd');
            $table->dropColumn('con_pwd');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('country');
            $table->dropColumn('email_code');
        });
    }
}
