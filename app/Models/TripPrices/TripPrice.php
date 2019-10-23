<?php

namespace App\Models\TripPrices;

use Illuminate\Database\Eloquent\Model;
use DB;

class TripPrice extends Model
{
    protected $table = 'tbl_trip_price';

    public static function getTripPrices(){
        $tripPrices = DB::table('tbl_trip_price')
                    ->select(
                        DB::raw('tbl_trip_price.*'),
                        DB::raw('tbl_trip_price.id as price_id'),
                        DB::raw('tbl_trip_price.created_at as price_created_at'),
                        DB::raw('locations.address location'),
                        DB::raw('locations.id as location_id')
                    )
                    ->leftJoin('locations', 'tbl_trip_price.location_from', '=', 'locations.id')
                    ->get();

                    $tripPrices->map(function($item){
                        $location = DB::table('locations')
                        ->select(
                            DB::raw('locations.address as destination_loc')

                        )->where('locations.id', $item->location_to)->get();

                        $item->dest_address = json_encode($location);
                        $item->dest_address = str_replace('[{"destination_loc":"', '', $item->dest_address);
                        $item->dest_address = str_replace('"}]', '', $item->dest_address);
                        return $item;
                    });

        return $tripPrices;

    }
}
