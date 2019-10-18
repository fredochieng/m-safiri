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

    public static function getDriverTrips()
    {
        $trips = DB::table('tbl_driver_setlocation')
            ->select(
                DB::raw('tbl_driver_setlocation.*'),
                DB::raw('tbl_driver_setlocation.id as location_id'),
                DB::raw('tbl_driver_setlocation.status as trip_status'),
                DB::raw('tbl_driverdata.*'),
                DB::raw('tbl_driverdata.id as driverid'),
                DB::raw('tbl_driverdata.status as driver_status')
            )
            ->leftJoin('tbl_driverdata', 'tbl_driver_setlocation.driver_id', '=', 'tbl_driverdata.id')
            ->get();
        return $trips;
    }
}