<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use DB;

class BankDetailModel extends Model
{
    protected $table = 'tbl_driver_bankdetails';

    public static function getBanksDetails()
    {
        $bank_details = DB::table('tbl_driver_bankdetails')->get();
        return $bank_details;
    }
}