<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use DB;

class User_Adress extends Model
{
    protected $table = 'tbl_my_address';

    public static function checkAddress($title, $address)
    {
        $address = DB::table('tbl_my_address')
                 ->where([['title', '=', $title],['address', '=' , $address]])
                 ->get();

        return $address;

    }

    public static function getUserAddress($user_id)
    {
        $address = DB::table('tbl_my_address')
                ->where('user_id', '=' , $user_id)
                 ->get();

        return $address;
    }

}
