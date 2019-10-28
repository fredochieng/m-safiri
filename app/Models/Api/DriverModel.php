<?php

namespace App\Models\Api;

use DB;

use Illuminate\Database\Eloquent\Model;

class DriverModel extends Model
{
    protected $table = 'tbl_driverdata';
    protected $fillable = [
        'type', 'company_id', 'fullname', 'email', 'password', 'sentcode', 'device_id', 'device_token'
    ];
    public static function getDriverdata()
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

        // dd($drivers);

        return $drivers;
    }

    public static function loginDriver()
    {
        $driver = DB::table('tbl_driverdata')->get();

        return $driver;
    }

    public static function driverData()
    {
        $driver = DB::table('tbl_driverdata')->get();
        return $driver;
    }

    public static function checkDriverProfile()
    {
        $driver = DB::table('tbl_driverdetails')
            ->select(
                DB::raw('tbl_driverdetails.*'),
                DB::raw('countries.id as country_id'),
                DB::raw('countries.country'),
                DB::raw('cities.id as city_id'),
                DB::raw('cities.city')
            )
            ->leftJoin('countries', 'tbl_driverdetails.country_id', '=', 'countries.id')
            ->leftJoin('cities', 'tbl_driverdetails.city_id', '=', 'cities.id')
            ->get();

        return $driver;
    }

    public static function getDriverVehicle()
    {
        $vehicles = DB::table('vehicles')
            ->select(
                DB::raw('vehicles.*'),
                DB::raw('vehicles.id as vehicle_id'),
                DB::raw('vehicles.created_at as vehicle_created_at'),
                DB::raw('vehicle_types.id as vehicle_type_id'),
                DB::raw('vehicle_types.vehicle_type'),
                DB::raw('companies.id'),
                DB::raw('tbl_driverdata.id as user_id'),
                DB::raw('tbl_driverdata.fullname')
            )
            ->leftJoin('vehicle_types', 'vehicles.type', '=', 'vehicle_types.id')
            ->leftJoin('companies', 'vehicles.company_id', '=', 'companies.id')
            ->leftJoin('tbl_driverdata', 'vehicles.driver_id', '=', 'tbl_driverdata.id')
            ->get();

        return $vehicles;
    }

    public static function getAllCountries()
    {
        $countries = DB::table('countries')
            ->select(
                DB::raw('countries.id'),
                DB::raw('countries.country')
            )
            // ->orderbBy('id', '=', 'asc')
            ->get();

        return $countries;
    }

    public static function getaAllCities()
    {
        $countries = DB::table('cities')
            ->select(
                DB::raw('cities.country_id'),
                DB::raw('cities.id'),
                DB::raw('cities.city')
            )
            //->orderbBy('id', '=', 'asc')
            ->get();

        return $countries;
    }

    public static function get_driver_vehicle()
    {
        $seats = DB::table('vehicles')
            ->select(
                DB::raw('vehicles.seats')
            )
            ->get();

        return $seats;
    }

    public static function getdriverRating($driver_id)
    {
        $query = DB::table('tbl_user_trips as t')
            ->select(

                DB::raw('avg(t.rating) as avg_rating')
            )
            ->where('driver_id', '=', $driver_id)
            ->get();

        return $query;
    }

    public static function calculate_triptime($id)
    {
        $query = DB::table('tbl_driver_setlocation as t')
            ->selectRaw(
                ' SEC_TO_TIME(SUM(UNIX_TIMESTAMP("t.end_datetime") - UNIX_TIMESTAMP("t.datetime")))'
            )
            ->where('id', '=', $id)
            ->get();

        return $query;
    }
}