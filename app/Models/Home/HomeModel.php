<?php

namespace App\Models\Home;

use App\Models\Companies\Company;
use App\Models\Drivers\DriverData;
use App\Models\Vehicles\Vehicle;
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
        $latest_drivers = DriverData::getDrivers();

        return $latest_drivers;
    }

    public static function getLatestVehicles()
    {
        $latest_vehicles = Vehicle::getVehicles();
        return $latest_vehicles;
    }
}