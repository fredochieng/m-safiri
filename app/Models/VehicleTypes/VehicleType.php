<?php

namespace App\Models\VehicleTypes;

use Illuminate\Database\Eloquent\Model;
use DB;

class VehicleType extends Model
{
    protected $table = 'vehicle_types';

    public static function getVehicleTypes()
    {
        $vehicle_types = DB::table('vehicle_types')
            ->select(
                DB::raw('vehicle_types.*')
            )->get();

        return $vehicle_types;
    }
}
