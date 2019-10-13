<?php

namespace App\Models\Drivers;

use DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Driver extends Model
{
    protected $table = 'drivers';

    public static function getDrivers()
    {
        $user = Auth::user();
        $company_id = Auth::user()->company_id;

        ~$user_role = $user->getRoleNames()->first();
        if ($user_role == "Admin") {
            $compare_field = "drivers.id";
            $compare_operator = ">=";
            $compare_value = 1;
        } elseif ($user_role == "Company") {
            $compare_field = "drivers.company_id";
            $compare_operator = "=";
            $compare_value = $company_id;
        }

        $drivers = DB::table('drivers')
            ->select(
                DB::raw('drivers.*'),
                DB::raw('drivers.created_at as driver_created_at'),
                DB::raw('users.id'),
                DB::raw('users.name'),
                DB::raw('users.email'),
                DB::raw('countries.id as country_id'),
                DB::raw('countries.country'),
                DB::raw('cities.id as city_id'),
                DB::raw('cities.city')
            )
            ->leftJoin('users', 'drivers.driver_id', '=', 'users.id')
            ->leftJoin('countries', 'drivers.country_id', '=', 'countries.id')
            ->leftJoin('cities', 'drivers.city_id', '=', 'cities.id')
            ->where($compare_field, $compare_operator, $compare_value)
            ->get();

        // dd($drivers);

        return $drivers;
    }

    public static function getUnassignedDrivers()
    {
        $user = Auth::user();
        $company_id = Auth::user()->company_id;

        ~$user_role = $user->getRoleNames()->first();
        if ($user_role == "Admin") {
            $compare_field = "drivers.id";
            $compare_operator = ">=";
            $compare_value = 1;
        } elseif ($user_role == "Company") {
            $compare_field = "drivers.company_id";
            $compare_operator = "=";
            $compare_value = $company_id;
        }

        $drivers = DB::table('drivers')
            ->select(
                DB::raw('drivers.driver_id'),
                DB::raw('drivers.driver_status'),
                DB::raw('users.id'),
                DB::raw('users.name'),
                DB::raw('vehicles.driver_id as vehicle_driver_id')

            )
            ->leftJoin('users', 'drivers.driver_id', '=', 'users.id')
            ->join('vehicles', 'vehicles.driver_id', '=', 'drivers.driver_id', 'left outer')
            ->where($compare_field, $compare_operator, $compare_value)
            ->get();

        return $drivers;
    }
}