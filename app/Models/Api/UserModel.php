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
    public static function loginUserdata($user_email, $password)
    {
        $userLogin = DB::table('tbl_userdata')
                   ->where([['user_emai', '=', $user_email], ['password', '=', $password]])
                   ->get();

        $res = $userLogin->toArray();

        if ($userLogin->count() > 0){
            return $res;
        }
        else{
            return false;
        }
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



}



