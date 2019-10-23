<?php

namespace App\Http\Controllers;

use App\Models\Routes\Route;
use App\Models\Drivers\Driver;
use App\Models\Locations\Location;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Facades\Toastr;
use DB;
use Carbon\Carbon;

class RoutesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['drivers'] = Driver::getDrivers();
        $data['routes'] = Route::getRoutes();
        $data['locations'] = Location::getLocations();

        //dd($data['routes']);
        return view('routes.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['drivers'] = Driver::getDrivers();
        $data['locations'] = Location::getLocations();
        return view('routes.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $pickup_id = strtoupper($request->input('pickup_id'));
        $pickup_time = $request->input('pickup_time');
        $destination_id = strtoupper($request->input('destination_id'));
        $destination_time = $request->input('destination_time');
        $driver_name = $request->input('driver_name');

         // Initialize new Route
         $route = new Route();

         //Assign form elemnts to table columns
         $route->pickup_id = $pickup_id;
         $route->pickup_time = $pickup_time;
         $route->destination_id = $destination_id;
         $route->destination_time = $destination_time;
         $route->driver_id = $driver_name;

         $route->save();

         Toastr::success('Route added successfully');
         return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Route $route)
    {

        // Get current time with Carbon
        $now = Carbon::now('Africa/Nairobi');

        $route_id = $request->input('route_id');
        $pickup_id = $request->input('pickup_id');
        $pickup_time = $request->input('pickup_time');
        $destination_id = $request->input('destination_id');
        $destination_time = $request->input('destination_time');
        $driver_id = $request->input('driver_id');

        // Get new input elements and update the vehicle details
        $update_route = Route::where("id", $route_id)->update([
            'pickup_id' => $pickup_id,
            'pickup_time' => $pickup_time,
            'destination_id' => $destination_id,
            'destination_time' => $destination_time,
            'driver_id' => $driver_id

        ]);

        // Log the update action
        Log::info("ROUT OF ID " . $route_id .  " UPDATED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);
        Toastr::success('Vehicle updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Route $route)
    {
        $route_id = $request->input('route_id');

        $now = Carbon::now('Africa/Nairobi');
        $delete_route = Route::where("id", $route_id)->delete();

        Log::critical("ROUTE OF ID " . $route_id .  " DELETED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Route deleted successfully');
        return back();
    }
}
