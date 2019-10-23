<?php

namespace App\Http\Controllers;

use App\Models\Locations\Location;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Facades\Toastr;
use DB;
use Carbon\Carbon;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['locations'] = Location::getLocations();
        return view('locations.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Location $location)
    {
        $location_id = $request->input('location_id');

        $now = Carbon::now('Africa/Nairobi');
        $delete_location = Location::where("id", $location_id)->delete();

        Log::critical("ROUTE OF ID " . $location_id .  " DELETED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Location deleted successfully');
        return back();
    }
}
