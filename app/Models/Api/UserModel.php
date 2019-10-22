<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserModel extends Model
{
    protected $table = 'tbl_userdata';


    // check register data already exist or not
    public static function checkUserdata($user_email)
    {
        $userEmail = DB::table('tbl_userdata')->where('user_email', '=', $user_email)->get();
        $res = $userEmail->toArray();
        if ($userEmail->count() > 0){

            return $res;
        }
        else{
            return false;
        }
    }

    // user login
    public static function loginUserdata()
    {

        $user =  DB::table('tbl_userdata')->get();

        return $user;
    }

    public static function getUserdata($user_id)
    {
        $userData = DB::table('tbl_userdata')
                  ->select(['fname','lname','user_email','username','mobile_number',
                            'gender','photo','country', 'device_id', 'status'])
                  ->where('id', '=', $user_id)->get();
        $res = $userData->toArray();
        if ($userData->count() > 0){
            return $res;
        }
        else{
            return false;
        }
    }

    public static function user_checkCodedata($email, $sentcode)
    {
        $userEmail = DB::table('tbl_userdata')
                   ->select(['id','user_email','sentcode'])
                   ->where([['user_email', '=', $email],['sentcode', '=' , $sentcode]])
                   ->get();
        $res = $userEmail->toArray();
        if ($userEmail->count() > 0){

            return $res;
        }
        else{
            return false;
        }
    }

    public static function userChangePass($user_id, $password)
    {
        $userPass = DB::table('tbl_userdata')
                   ->select(['id','password'])
                   ->where([['id', '=', $user_id],['password', '=' , $password]])
                   ->get();
        $res = $userPass->toArray();
        if ($userPass->count() > 0){

            return $res;
        }
        else{
            return false;
        }
    }

    public static function get_bookid($book_id)
    {
        $book_id = $request->input('book_id');
        $passanger = DB::table('tbl_trip_passanger')
                   ->where('book_id', '=', $book_id)
                   ->get();

        return $passanger;
    }

     // serch driver trips
     public static function getdriverTrips($from_title,$to_title,$get_date,$seats,$rating,$price)
     {
        $driverTrips = DB::table('tbl_driver_setlocation AS t1')
        ->select(
            DB::raw('t1.*'),
            DB::raw('t2.fullname'),
            DB::raw('t2.status as driver_status'),
            DB::raw('t3.gender'),
            DB::raw('t3.photo'),
            DB::raw('t3.mobile_number'),
            DB::raw('t4.vehicle_number'),
            DB::raw('t4.type'),
            DB::raw('t4.vehicle_name'),
            DB::raw('t4.seats'),

        )
        ->leftJoin('tbl_driverdata as t2', 't1.driver_id', '=', 't2.id')
        ->join('tbl_driverdetails as t3', 't1.driver_id', '=', 't3.driver_id')
        ->join('vehicles as t4', 't1.driver_id', '=', 't4.driver_id',)
        ->where([
            ['t1.from_title', '=', $from_title],
            ['t1.to_title', '=', $to_title],
            ['t1.datetime', '=', $get_date],
            ['t1.status', '=', 'pending'],
            ['t1.trip_price', '!=', ''],
            ['t1.trip_price', '=', '0'],
            ['t2.status', '=', 'active'],
            ['t2.online_status', '=', 'active'],

        ])
        ->get();

    return $driverTrips;

     }

     public static function check_availabeltrips($trip_id)

     {
        $availableTrips = DB::table('tbl_user_trips')
                     ->where([['trip_id', '=', $trip_id],['status', '=', 'booked']])
                     ->get();

        return $availableTrips;

     }

     public static function getsingleTrip($id)
     {

        $singleTrip = DB::table('tbl_driver_setlocation AS t1')
                    ->select(
                        DB::raw('t1.*'),
                        DB::raw('t2.fullname'),
                        DB::raw('t3.gender'),
                        DB::raw('t3.photo'),
                        DB::raw('t3.mobile_number'),
                        DB::raw('t4.vehicle_number'),
                        DB::raw('t4.type'),
                        DB::raw('t4.vehicle_name'),
                        DB::raw('t5.status as user_trip_status'),
                        DB::raw('t5.rating as user_rating'),

                    )
                    ->leftJoin('tbl_driverdata as t2', 't1.driver_id', '=', 't2.id')
                    ->join('tbl_driverdetails as t3', 't1.driver_id', '=', 't3.driver_id')
                    ->join('vehicles as t4', 't1.driver_id', '=', 't4.driver_id',)
                    ->join('tbl_user_trips as t5', 't1.id', '=', 't5.trip_id',)
                    ->where('t1.id', '=', $id)
                    ->get();

        return $singleTrip;
     }

     public static function getAllfromlist()
     {
            $allTrips = DB::table('tbl_driver_setlocation AS t1')
                        ->select('t1.*')
                        //->group_by('from_title')
                        ->where('status', '=' ,'pending')
                        ->get();
            return $allTrips;

     }

      // get current trips
      public static function getAlltolist($from_title)
      {
        $allTrips = DB::table('tbl_driver_setlocation AS t1')
                ->select('t1.*')
                //->group_by('from_title')
                ->where([['from_title', '=' ,$from_title],['status', '=' ,'pending']])
                ->get();
       return $allTrips;

      }

       // get current trips
       public static function check_jointrip($trip_id,$user_id)
       {
            $joinTrips = DB::table('tbl_user_trips AS t1')
                        ->select('t1.*')
                        //->group_by('from_title')
                        ->where([['trip_id', '=' ,$trip_id],['user_id', '=' ,$user_id],['status', '!=' ,'cancel'],['status', '!=' ,'0']])
                        ->get();
            return $joinTrips;

       }


}



