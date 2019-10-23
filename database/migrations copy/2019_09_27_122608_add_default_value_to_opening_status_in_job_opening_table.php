<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultValueToOpeningStatusInJobOpeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('job_openings')) {
            Schema::table('job_openings', function (Blueprint $table) {
                if (Schema::hasColumn('job_openings', 'opening_status')) {
                    $table->unsignedBigInteger('opening_status')->default(0)->change();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_openings', function (Blueprint $table) {
            //
        });
    }
}
