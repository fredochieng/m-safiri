<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use DB;

class TripModel extends Model
{
    protected $table = 'tbl_driver_setlocation';

    public static function getTrips()
    {
        $trips = DB::table('tbl_driver_setlocation')->select(
            DB::raw('tbl_driver_setlocation.*')
        )->get();

        return $trips;
    }
}