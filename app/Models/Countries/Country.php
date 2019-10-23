<?php

namespace App\Models\Countries;

use DB;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public static function getCountries()
    {
        $countries = DB::table('countries')
            ->select(
                DB::raw('countries.*')
            )
            ->orderBy('id', 'asc')
            ->get();

        return $countries;
    }
}
