<?php

namespace App\Models\Drivers;

use Illuminate\Database\Eloquent\Model;
use DB;

class DriverData extends Model
{
    protected $table = 'tbl_driverdata';

    public static function getDrivers()
    {
        $drivers = DB::table('tbl_driverdata')
            ->select(
                DB::raw('tbl_driverdata.*'),
                DB::raw('tbl_driverdata.id driver_id'),
                DB::raw('tbl_driverdata.created_at driver_created_at'),
                DB::raw('tbl_driverdetails.*'),
                DB::raw('tbl_driverdetails.photo as driver_image'),
                DB::raw('countries.id as country_id'),
                DB::raw('countries.country'),
                DB::raw('cities.id as city_id'),
                DB::raw('cities.city')
            )
            ->leftJoin('tbl_driverdetails', 'tbl_driverdata.id', '=', 'tbl_driverdetails.driver_id')
            ->leftJoin('countries', 'tbl_driverdetails.country_id', '=', 'countries.id')
            ->leftJoin('cities', 'tbl_driverdetails.city_id', '=', 'cities.id')
            ->get();

        return $drivers;
    }

    public static function getUnassignedDrivers()
    {
        $drivers = DB::table('tbl_driverdata')
            ->select(
                DB::raw('tbl_driverdata.id as driver_id'),
                DB::raw('tbl_driverdata.fullname'),
                DB::raw('tbl_driverdata.status'),
                DB::raw('tbl_driverdata.approved'),
                DB::raw('vehicles.driver_id as vehicle_driver_id')
            )
            ->join('vehicles', 'vehicles.driver_id', '=', 'tbl_driverdata.id', 'left outer')
            ->get();

        return $drivers;
    }
}