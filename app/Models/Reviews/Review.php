<?php

namespace App\Models\Reviews;

use Illuminate\Database\Eloquent\Model;
use DB;

class Review extends Model
{
    protected $table = 'tbl_reviews';

    public static function getReviews(){

        $reviews = DB::table('tbl_reviews')
                 ->select(
                     DB::raw('tbl_reviews.*')
                 )
                 ->get();

        return $reviews;

    }
}
