<?php

namespace App\Models\Routes;

use Illuminate\Database\Eloquent\Model;

use DB;

class Route extends Model
{
    public static function getRoutes(){
        $routes = DB::table('routes')
                ->select(
                    DB::raw('routes.*'),
                    DB::raw('routes.id as route_id'),
                    DB::raw('locations.address location'),
                    DB::raw('locations.id location_id'),
                    DB::raw('users.name as driver_name')
                )
                ->leftJoin('locations', 'routes.pickup_id', '=', 'locations.id')
                ->leftJoin('users', 'routes.driver_id', '=', 'users.id')
                ->get();

                $routes->map(function($item){
                    $location = DB::table('locations')
                    ->select(
                        DB::raw('locations.address as destination_loc')

                    )->where('locations.id', $item->destination_id)->get();

                    $item->dest_address = json_encode($location);
                    $item->dest_address = str_replace('[{"destination_loc":"', '', $item->dest_address);
                    $item->dest_address = str_replace('"}]', '', $item->dest_address);
                    return $item;
                });

        return $routes;
    }
}
