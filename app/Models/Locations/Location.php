<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Model;

use DB;

class Location extends Model
{
    public static function getLocations(){

        $locations = DB::table('locations')
                   ->select(
                       DB::raw('locations.*'),
                       DB::raw('locations.id as location_id'),
                       DB::raw('locations.address as location_address')
                       )
                   ->get();

        return  $locations;
    }
}
