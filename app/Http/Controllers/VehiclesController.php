<?php

namespace App\Http\Controllers;

use App\Models\Drivers\DriverData;
use App\Models\Drivers\Driver;
use App\Models\Vehicles\Vehicle;
use App\Models\VehicleTypes\VehicleType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Facades\Toastr;
use DB;
use Carbon\Carbon;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get details of authenticated user
        $auth_user = User::where('id', Auth::id())->first();

        // Get company id of authenticated user
        $data['company_id'] = $auth_user->company_id;

        // Fetch vehicles from the database through the Vehicle Model
        $data['vehicles'] = Vehicle::getVehicles()->where('company_id',  $data['company_id']);

        // Get vehicle types form the databes through the VehicleType Model
        $data['vehicle_types'] = VehicleType::getVehicleTypes();
        // dd($data['vehicles']);

        return view('vehicles.index')->with($data);
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

    // Store vehicle details in the database
    public function store(Request $request)
    {
        // Get input elements values to be stiored in database
        $company_id = $request->input('company_id');
        $vehicle_name = strtoupper($request->input('vehicle_name'));
        $vehicle_type_id = $request->input('vehicle_type_id');
        $vehicle_number = strtoupper($request->input('vehicle_number'));
        $seats = $request->input('seats');

        // Get file attachments form the form for vehicle image
        if ($request->hasFile('vehicle_picture') && $request->file('vehicle_picture')->isValid()) {
            $file = $request->file('vehicle_picture');
            $file_name = $vehicle_number .  '_' . $file->getClientOriginalExtension();
            $file->move('uploads/vehicle_images', $file_name);
            $vehicle_image = 'uploads/vehicle_images/' . $file_name;
        }

        // Get file attachments form the form for vehicle document
        if ($request->hasFile('vehicle_document') && $request->file('vehicle_document')->isValid()) {
            $file = $request->file('vehicle_document');
            $file_name = $vehicle_number .  '_' . $file->getClientOriginalExtension();
            $file->move('uploads/vehicle_documents', $file_name);
            $vehicle_document = 'uploads/vehicle_documents/' . $file_name;
        }

        // Initialize new Vehicle
        $vehicle = new Vehicle();

        //Assign form elemnts to table columns
        $vehicle->company_id = $company_id;
        $vehicle->vehicle_name = $vehicle_name;
        $vehicle->vehicle_number = $vehicle_number;
        $vehicle->type = $vehicle_type_id;
        $vehicle->seats = $seats;
        $vehicle->vehicle_picture = $vehicle_image;
        $vehicle->vehicle_document = $vehicle_document;

        $vehicle->save();

        Toastr::success('Vehicle added successfully');
        return back();
    }

    // Manage a single vehicle
    public function manageVehicle($vehicle_id)
    {
        // Get the selected vehicle, vehicle id passed
        $data['vehicles'] = Vehicle::getVehicles()->where('vehicle_id', $vehicle_id)->first();

        // Get vehicle types
        $data['vehicle_types'] = VehicleType::getVehicleTypes();

        // Get drivers who are not assigned to any vehicle

        $data['unassigned_drivers'] = DriverData::getUnassignedDrivers()
            ->where('vehicle_driver_id', '=', '')
            ->where('status', '=', 'active')
            ->where('approved', '=', 'yes');

        //dd($data['unassigned_drivers']);
        return view('vehicles.manage')->with($data);
    }

    public function assignDriver(Request $request)
    {
        $driver_id = $request->input('driver_id');
        $vehicle_id = $request->input('vehicle_id');

        $assign_driver = Vehicle::where("id", $vehicle_id)->update([
            'driver_id' => $driver_id
        ]);

        Toastr::success('Vehicle assigned successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */

    // Update vehicle details
    public function update(Request $request, Vehicle $vehicle, $vehicle_id)
    {
        // Get current time with Carbon
        $now = Carbon::now('Africa/Nairobi');

        $vehicle_number = $request->input('vehicle_number');
        // Get file attachments form the form for vehicle image
        if ($request->hasFile('vehicle_picture') && $request->file('vehicle_picture')->isValid()) {
            $file = $request->file('vehicle_picture');
            $file_name = $vehicle_number .  '_' . $file->getClientOriginalExtension();
            $file->move('uploads/vehicle_images', $file_name);
            $vehicle_image = 'uploads/vehicle_images/' . $file_name;
        } else {
            $vehicle_image = Vehicle::where('id', $vehicle_id)->first();
            $vehicle_image = $vehicle_image->vehicle_picture;
        }

        // Get file attachments form the form for vehicle document
        if ($request->hasFile('vehicle_document') && $request->file('vehicle_document')->isValid()) {
            $file = $request->file('vehicle_document');
            $file_name = $vehicle_number .  '_' . $file->getClientOriginalExtension();
            $file->move('uploads/vehicle_documents', $file_name);
            $vehicle_document = 'uploads/vehicle_documents/' . $file_name;
        } else {
            $vehicle_document = Vehicle::where('id', $vehicle_id)->first();
            $vehicle_document = $vehicle_document->vehicle_document;
        }

        // Get new input elements and update the vehicle details
        $update_vehicle = Vehicle::where("id", $vehicle_id)->update([
            'vehicle_name' => strtoupper($request->input('vehicle_name')),
            'type' => $request->input('vehicle_type_id'),
            'vehicle_number' => strtoupper($request->input('vehicle_number')),
            'seats' => $request->input('seats'),
            'vehicle_picture' => $vehicle_image,
            'vehicle_document' => $vehicle_document
        ]);

        // Log the update action
        Log::info("VEHICLE OF ID " . $vehicle_id .  " UPDATED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);
        Toastr::success('Vehicle updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Vehicle $vehicle)
    {
        $vehicle_id = $request->input('vehicle_id');

        $now = Carbon::now('Africa/Nairobi');
        $update_vehicle = Vehicle::where("id", $vehicle_id)->delete();

        Log::critical("VEHICLE OF ID " . $vehicle_id .  " DELETED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Vehicle deleted successfully');
        return back();
    }
}