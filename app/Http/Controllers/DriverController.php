<?php

namespace App\Http\Controllers;

use App\Models\Cities\City;
use App\Models\Countries\Country;
use App\Models\Drivers\Driver;
use App\Models\Drivers\DriverData;
use App\Models\Drivers\DriverDetails;
use App\Models\Drivers\DriverDocuments;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Kamaln7\Toastr\Facades\Toastr;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['countries'] = Country::getCountries();
        $data['cities'] = City::getCities();
        $data['drivers'] = DriverData::getDrivers();
        //dd($data['drivers']);

        return view('drivers.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get details of authenticated user
        $auth_user = User::where('id', Auth::id())->first();


        // Get company id of authenticated user
        $company_id = $auth_user->company_id;

        $name = strtoupper($request->input('driver_name'));
        $email = $request->input('email');
        $phone_no = $request->input('phone_no');
        $dob = $request->input('dob');
        $gender = $request->input('gender');
        $country_id = $request->input('country_id');
        $city_id = $request->input('city_id');
        $postal_code = $request->input('postal_code');
        $address = strtoupper($request->input('address'));
        $password = '12345678';

        // Get file attachments form the form 
        if ($request->hasFile('driver_image') && $request->file('driver_image')->isValid()) {
            $file = $request->file('driver_image');
            $file_name = $phone_no .  '_' . $file->getClientOriginalExtension();
            $file->move('uploads/driver_images', $file_name);
            $driver_image = 'uploads/driver_images/' . $file_name;
        }

        if ($request->hasFile('driver_license') && $request->file('driver_license')->isValid()) {
            $file = $request->file('driver_license');
            $file_name = $phone_no .  '_' . $file->getClientOriginalExtension();
            $file->move('uploads/driver_licences', $file_name);
            $driver_license = 'uploads/driver_licences/' . $file_name;
        }

        if ($request->hasFile('address_proof') && $request->file('address_proof')->isValid()) {
            $file = $request->file('address_proof');
            $file_name = $phone_no .  '_' . $file->getClientOriginalExtension();
            $file->move('uploads/driver_address_proof', $file_name);
            $address_file = 'uploads/driver_address_proof/' . $file_name;
        }

        // Save driver data
        $driver_data = new DriverData();
        $driver_data->fullname = $name;
        $driver_data->email = $email;
        $driver_data->company_id = $company_id;
        $driver_data->type = 'company';
        $driver_data->password =  Hash::make($password);
        $driver_data->sentcode = '';
        $driver_data->authentication_code = '';
        $driver_data->device_id = '';
        $driver_data->device_token = '';

        $driver_data->save();

        $saved_driver_id = $driver_data->id;

        // Save driver details
        $driver_details = new DriverDetails();
        $driver_details->driver_id = $saved_driver_id;
        $driver_details->mobile_number = $phone_no;
        $driver_details->dob = $dob;
        $driver_details->gender = $gender;
        $driver_details->country_id = $country_id;
        $driver_details->city_id = $city_id;
        $driver_details->postal_code = $postal_code;
        // $driver_details->address = $address;
        $driver_details->photo = $driver_image;
        $driver_details->licence_file = $driver_license;
        $driver_details->address_file = $address_file;
        $driver_details->save();

        Toastr::success('Driver added successfully');
        return back();
    }

    public function manageDriver($driver_id)
    {
        $data['countries'] = Country::getCountries();
        $data['cities'] = City::getCities();
        $data['drivers'] = DriverData::getDrivers()->where('driver_id', $driver_id)->first();
        // dd($data['drivers']);

        return view('drivers.manage')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $driver_id)
    {
        // Get current time with Carbon
        $now = Carbon::now('Africa/Nairobi');


        // Get new input elements and update the user details
        $update_user_details = DriverData::where("id", $driver_id)->update([
            'fullname' => $request->input('driver_name'),
            'email' => $request->input('email')
        ]);

        $phone_no = $request->input('phone_no');
        // Get file attachments form the form 
        if ($request->hasFile('driver_image') && $request->file('driver_image')->isValid()) {
            $file = $request->file('driver_image');
            $file_name = $phone_no .  '_' . $file->getClientOriginalExtension();
            $file->move('uploads/driver_images', $file_name);
            $driver_image = 'uploads/driver_images/' . $file_name;
        } else {
            $driver_image = DriverDetails::where('driver_id', $driver_id)->first();
            $driver_image = $driver_image->photo;
        }

        if ($request->hasFile('driver_license') && $request->file('driver_license')->isValid()) {
            $file = $request->file('driver_license');
            $file_name = $phone_no .  '_' . $file->getClientOriginalExtension();
            $file->move('uploads/driver_licences', $file_name);
            $driver_license = 'uploads/driver_licences/' . $file_name;
        } else {
            $driver_license = DriverDetails::where('driver_id', $driver_id)->first();
            $driver_license = $driver_license->licence_file;
        }

        if ($request->hasFile('address_proof') && $request->file('address_proof')->isValid()) {
            $file = $request->file('address_proof');
            $file_name = $phone_no .  '_' . $file->getClientOriginalExtension();
            $file->move('uploads/driver_address_proof', $file_name);
            $address_file = 'uploads/driver_address_proof/' . $file_name;
        } else {
            $address_file = DriverDetails::where('driver_id', $driver_id)->first();
            $address_file = $address_file->address_file;
        }

        // Get new input elements and update the driver details
        $update_driver_details = DriverDetails::where("driver_id", $driver_id)->update([
            'mobile_number' => $request->input('phone_no'),
            'dob' => $request->input('dob'),
            'gender' => $request->input('gender'),
            'country_id' => $request->input('country_id'),
            'city_id' => $request->input('city_id'),
            'postal_code' => $request->input('postal_code'),
            //'address' => $request->input('address'),
            'photo' => $driver_image,
            'licence_file' => $driver_license,
            'address_file' => $address_file
        ]);

        // Log the update action
        Log::info("DRIVER OF ID " . $driver_id .  " UPDATED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);
        Toastr::success('Driver updated successfully');
        return back();
        dd($driver_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy($driver_id)
    {
        $now = Carbon::now('Africa/Nairobi');
        $delete_driver = DriverData::where("id", $driver_id)->delete();
        $delete_driver = DriverDetails::where("driver_id", $driver_id)->delete();
        $delete_driver = DriverDocuments::where("driver_id", $driver_id)->delete();

        Log::critical("DRIVER OF ID " . $driver_id .  " DELETED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Vehicle deleted successfully');
        return back();
    }
}