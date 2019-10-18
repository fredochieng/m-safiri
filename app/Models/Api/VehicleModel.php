<?php

namespace App\Models\Api;

use DB;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    protected $table = 'vehicles';
    public static function getVehicle()
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
}