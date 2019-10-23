<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use DB;

class Users extends Model
{
    protected $table = 'tbl_userdata';

    public static function getUsers(){
       $users = DB::table('tbl_userdata as tb')
              ->select(
                  DB::raw('tb.*'),
                  DB::raw('id as user_id'),
                  DB::raw('CONCAT(lname, fname) AS full_name'),
                  )
                  ->orderBy('created_at')
                  ->get();

        return $users;
    }

    public static function getUser($user_id){
        $user = DB::table('tbl_userdata as tb')
               ->select(
                   DB::raw('tb.*'),
                   DB::raw('tb.id as user_id'),
                   DB::raw('CONCAT(lname, fname) AS full_name')
                   )->where('id', $user_id)
                   ->first();


         return $user;
     }
}
