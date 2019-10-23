<?php

namespace App\Models\Api;
use DB;

use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    protected $table = 'tbl_user_trips';

    public static function get_canceltrip($user_id,$trip_id) {

        $cancelled = DB::table('tbl_user_trips')
                 ->select( [['user_id', '=', $user_id],['trip_id', '=', $trip_id],['status', '=', 'booked']])
                 ->first();

        return $cancelled;
    }

    public static function get_userReview($trip_id,$user_id){
        $reviews = DB::table('tbl_user_trips')
                    ->select(
                        DB::raw('tbl_user_trips.*'),
                        DB::raw('tbl_userdata.lname'),
                        DB::raw('tbl_userdata.fname'),
                        DB::raw('tbl_userdata.photo'),

                    )
                    ->leftJoin('tbl_userdata', 'tbl_user_trips.user_id', '=', 'tbl_userdata.id')
                    ->where([['trip_id', '=', $trip_id], ['user_id', '=', $user_id]])
                    ->get();

         $reviews;
    }
    //
}
