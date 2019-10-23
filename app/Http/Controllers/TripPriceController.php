<?php

namespace App\Http\Controllers;

use App\Models\TripPrices\TripPrice;
use App\Models\Locations\Location;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Facades\Toastr;
use DB;
use Carbon\Carbon;

class TripPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tripPrices'] = TripPrice::getTripPrices();
        $data['locations'] = Location::getLocations();
        return view('tripPrices.index')->with($data);
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
        // Get input elements values to be stiored in database
        $price_type = $request->input('price_type');
        $location_from = $request->input('location_from');
        $location_to = $request->input('location_to');
        $price = $request->input('price');

         // Initialize new Vehicle
         $Tprice = new TripPrice();

         //Assign form elemnts to table columns
         $Tprice->price_type = $price_type;
         $Tprice->location_from = $location_from;
         $Tprice->location_to = $location_to;
         $Tprice->price = $price;

         $Tprice->save();

         Toastr::success('Price added successfully');
         return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TripPrice  $tripPrice
     * @return \Illuminate\Http\Response
     */
    public function show(TripPrice $tripPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TripPrice  $tripPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(TripPrice $tripPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TripPrice  $tripPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TripPrice $tripPrice)
    {
        // Get current time with Carbon
        $now = Carbon::now('Africa/Nairobi');

         // Get input elements values to be stiored in database
         $price_id = $request->input('price_id');
         $price_type = $request->input('price_type');
         $location_from = $request->input('location_from');
         $location_to = $request->input('location_to');
         $price = $request->input('price');

        // Get new input elements and update the vehicle details
        $update_price = TripPrice::where("id", $price_id)->update([

            'price_type' => $price_type,
            'location_from' => $location_from,
            'location_to' => $location_to,
            'price' => $price

        ]);

        // Log the update action
        Log::info("TripPrice OF ID " . $price_id .  " UPDATED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);
        Toastr::success('TripPrice updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TripPrice  $tripPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TripPrice $tripPrice)
    {
        $price_id = $request->input('price_id');

        $now = Carbon::now('Africa/Nairobi');
        $delete_route = TripPrice::where("id", $price_id)->delete();

        Log::critical("ROUTE OF ID " . $price_id .  " DELETED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Price deleted successfully');
        return back();
    }
}
