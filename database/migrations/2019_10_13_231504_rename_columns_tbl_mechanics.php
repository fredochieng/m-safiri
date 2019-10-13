<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnsTblMechanics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_mechanics', function (Blueprint $table) {
            $table->renameColumn('fullname', 'full_name');
            $table->renameColumn('email', 'email_id');
            $table->renameColumn('address', 'data_time');

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
            $table->renameColumn('full_name', 'fullname');
            $table->renameColumn('email_id', 'email');
            $table->renameColumn('data_time', 'address');
        });
    }
}
