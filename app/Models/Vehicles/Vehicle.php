<?php

namespace App\Models\Vehicles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Vehicle extends Model
{
    // use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'vehicles';
    protected $primaryKey = 'id';

    public static function getVehicles()
    {
        $user = Auth::user();
        $country_id = Auth::user()->company_id;

        ~$user_role = $user->getRoleNames()->first();
        if ($user_role == "Admin") {
            dd('fred');
            $compare_field = "vehicles.id";
            $compare_operator = ">=";
            $compare_value = 1;
        } elseif ($user_role == "Company") {
            dd('Fred');
            $compare_field = "vehicles.company_id";
            $compare_operator = ">=";
            $compare_value = $country_id;
        }

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
            ->where($compare_field, $compare_operator, $compare_value)
            ->get();

        dd($vehicles);

        return $vehicles;
    }
}