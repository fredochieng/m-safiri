<?php

namespace App\Models\mechanics;

use Illuminate\Database\Eloquent\Model;
use DB;

class Mechanic extends Model
{
    protected $table = 'tbl_mechanics';

    public static function getMechanics(){
        $mechanics = DB::table('tbl_mechanics')
                   ->select(
                       DB::raw('tbl_mechanics.*'),
                       DB::raw('tbl_mechanics.id as mechanic_id'),
                       DB::raw('tbl_mechanics.created_at as mechanic_created_at')
                       )
                   ->get();

        return $mechanics;
    }
}
