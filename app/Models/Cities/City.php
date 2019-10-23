<?php

namespace App\Models\Cities;

use Illuminate\Database\Eloquent\Model;

use DB;

class City extends Model
{
    public static function getCities()
    {
        $cities = DB::table('cities')
            ->select(
                DB::raw('cities.*')
            )
            ->orderBy('id', 'asc')
            ->get();
        return $cities;
    }
}
