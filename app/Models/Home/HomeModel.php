<?php

namespace App\Models\Home;

use App\Models\Companies\Company;
use App\Models\Drivers\DriverData;
use App\Models\Vehicles\Vehicle;
use Illuminate\Support\Facades\Auth;
use DB;

use Illuminate\Database\Eloquent\Model;

class HomeModel extends Model
{
    // Dashboard statistics
    // Get total drivers
    public static function getTotalDrivers()
    {
        $total_drivers = DriverData::getDrivers()->count();
        return $total_drivers;
    }

    public static function getTotalMechanics()
    {
        $mechanics = DB::table('tbl_mechanics')->count();
        return $mechanics;
    }

    // Get total companies
    public static function getTotalCompanies()
    {
        $total_companies = Company::getCompanies()->count();
        return $total_companies;
    }

    // Get total vehicles
    public static function getTotalVehicles()
    {
        $total_vehicles = Vehicle::getVehicles()->count();
        return $total_vehicles;
    }

    // Get total assigned drivers

    public static function getAssignedDrivers()
    {
        $assigned_drivers = DriverData::getUnassignedDrivers()
            ->where('vehicle_driver_id', '!=', '')
            ->where('status', '=', 'active')
            ->where('approved', '=', 'yes')
            ->count();

        return $assigned_drivers;
    }

    // Get total unassigned drivers

    public static function getUnassignedDrivers()
    {
        $assigned_drivers = DriverData::getUnassignedDrivers()
            ->where('vehicle_driver_id', '=', '')
            ->where('status', '=', 'active')
            ->where('approved', '=', 'yes')
            ->count();

        return $assigned_drivers;
    }
    // Get total latest drivers

    public static function getLatestDrivers()
    {
        $user = Auth::user();
        $company_id = Auth::user()->company_id;

        ~$user_role = $user->getRoleNames()->first();
        if ($user_role == "Admin") {
            $compare_field = "tbl_driverdata.id";
            $compare_operator = ">=";
            $compare_value = 1;
        } elseif ($user_role == "Company") {
            $compare_field = "tbl_driverdata.company_id";
            $compare_operator = "=";
            $compare_value = $company_id;
        }
        $latest_drivers = DB::table('tbl_driverdata')
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
            ->where($compare_field, $compare_operator, $compare_value)
            ->orderBy('tbl_driverdata.id', 'desc')
            ->limit(10)
            ->get();

        return $latest_drivers;
    }

    //Get the latest vehicles
    public static function getLatestVehicles()
    {
        $user = Auth::user();
        $company_id = Auth::user()->company_id;


        ~$user_role = $user->getRoleNames()->first();
        if ($user_role == "Admin") {
            $compare_field = "vehicles.id";
            $compare_operator = ">=";
            $compare_value = 1;
        } elseif ($user_role == "Company") {
            $compare_field = "vehicles.company_id";
            $compare_operator = "=";
            $compare_value = $company_id;
        }

        $latest_vehicles = DB::table('vehicles')
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
            ->where($compare_field, $compare_operator, $compare_value)
            ->orderBy('vehicles.id', 'desc')
            ->limit(10)
            ->get();
        return $latest_vehicles;
    }
}