<?php

namespace App\Http\Controllers;

use App\Models\Home\HomeModel;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['total_drivers'] = HomeModel::getTotalDrivers();
        $data['total_vehicles'] = HomeModel::getTotalVehicles();
        $data['total_companies'] = HomeModel::getTotalCompanies();
        $data['assigned_drivers'] = HomeModel::getAssignedDrivers();
        $data['unassigned_drivers'] = HomeModel::getUnassignedDrivers();
        $data['latest_drivers'] = HomeModel::getLatestDrivers();
        $data['latest_vehicles'] = HomeModel::getLatestVehicles();
        $data['total_mechanics'] = HomeModel::getTotalMechanics();
        // dd($data['latest_drivers']);

        Toastr::success('Welcome to M-Safiri Turyde');
        return view('home')->with($data);
    }
}