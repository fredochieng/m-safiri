<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function index()
    {
        $route = ':8001/api';
        $drivers_api = 'drivers';
        $data['app_url'] =  env('APP_URL');
        // $data['sys_url'] = env('APP_URL');
        // echo $data['sys_url'];
        //dd('Christine Fredrick');
        return view('api.index')->with($data);
    }
}