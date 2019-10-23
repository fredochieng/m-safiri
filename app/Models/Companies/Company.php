<?php

namespace App\Models\Companies;

use DB;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    public static function getCompanies()
    {
        $companies = DB::table('companies')
            ->select(
                DB::raw('companies.*'),
                DB::raw('companies.id as company_id'),
                DB::raw('companies.created_at as company_created_at'),
                DB::raw('users.id'),
                DB::raw('users.name'),
                DB::raw('users.email')
            )
            ->join('users', 'companies.id', '=', 'users.company_id', 'left outer')
            ->get();

        return $companies;
    }
}