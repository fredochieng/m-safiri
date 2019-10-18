<?php

namespace App\Models\Trips;

use Illuminate\Database\Eloquent\Model;

use DB;

class Trip extends Model
{
    protected $table = 'tbl_trips';

    public static function getTrips()
    {

        $trips = DB::table('tbl_trips')
            ->select(
                DB::raw('tbl_trips.*'),
                DB::raw('tbl_trips.pickup_location as p_location'),
                DB::raw('tbl_trips.destination_location as d_location'),
                DB::raw('tbl_trips.start_trip_time as trip_start'),
                DB::raw('tbl_trips.end_trip_time as trip_end')
            )
            ->get();
        return $trips;
    }
}