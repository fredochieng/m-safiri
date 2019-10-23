<?php

namespace App\Models\Api;
use DB;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $table = 'tbl_preferences';

    public static function getPreferences($user_id){
        $preference = DB::table('tbl_preferences')
                    ->select(
                        DB::raw('tbl_preferences.id'),
                        DB::raw('tbl_preferences.trip_id'),
                        DB::raw('tbl_preferences.user_id'),
                        DB::raw('tbl_preferences.driver_id'),
                        DB::raw('tbl_preferences.music'),
                        DB::raw('tbl_preferences.medical'),
                    )
                    ->where('user_id', '=', $user_id)
                    ->get();

        return $preference;
    }

    public static function get_user_trip_preferences($user_id,$trip_id)
    {
        $checkPreference = DB::table('tbl_preferences')
                    ->where( [['user_id', '=', $user_id],['trip_id', '=', $trip_id],['status', '=', 'booked']])
                    ->first();

        return $checkPreference;
    }
}
