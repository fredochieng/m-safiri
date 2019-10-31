<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\Api\DriverModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Api\BankDetailModel;
use App\Models\Api\TripModel;
use App\Models\Api\VehicleModel;
use App\Models\Drivers\DriverDetails;
use DB;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = DriverModel::getDriverdata();

        return response()->json($drivers, 200);
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
        $driver = new DriverModel();
        $driver->type = $request->input('type');
        $driver->fullname = strtoupper($request->input('fullname'));
        $driver->email = $request->input('email');
        $driver->password = md5($request->input('password'));
        $driver->sentcode = $request->input('sentcode');
        $driver->device_id = $request->input('device_id');
        $driver->device_token = $request->input('device_token');
        $driver->save();

        return response()->json($driver, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $driver_id = $request->input('driver_id');
        $driver = DriverModel::getDriverdata()->where('id', $driver_id)->first();

        if (count($driver) > 0) {

            return response()->json($driver, 200);
        } else {
            $message = array("Message" => "No driver found");
            return response()->json($message, 400);
        }
        //dd($driver);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method != 'POST') {
            $message = array("Message" => "Bad Request");
            return response()->json($message, 400);
        } else {
            $driver_id = $request->input('driver_id');
            $driver_exists = DriverModel::where("id", $driver_id)->first();

            if (count($driver_exists) > 0) {
                $update_driver = DriverModel::where("id", $driver_id)->update([
                    'fullname' => strtoupper($request->input('fullname')),
                    'email' => $request->input('email'),
                ]);

                // Get new input elements and update the driver details
                $phone_no = $request->input('mobile_number');
                // Get file attachments form the form 
                if ($request->hasFile('driver_image') && $request->file('driver_image')->isValid()) {
                    $file = $request->file('driver_image');
                    $file_name = $phone_no .  '_' . $file->getClientOriginalExtension();
                    $file->move('uploads/driver_images', $file_name);
                    $driver_image = 'uploads/driver_images/' . $file_name;
                } else {
                    //$driver_image = DriverDetails::where('driver_id', $driver_id)->first();
                    $driver_image = 'uploads/driver_images/no_user.png';
                }

                DB::table('tbl_driverdetails')->where('driver_id', '=', $driver_id)->upsert(
                    [
                        'driver_id' => $driver_id,
                        'mobile_number' => $request->input('mobile_number'),
                        'dob' => $request->input('dob'),
                        'gender' => $request->input('gender'),
                        'country_id' => $request->input('country_id'),
                        'city_id' => $request->input('city_id'),
                        'postal_code' => $request->input('postal_code'),
                        'photo' => $driver_image,
                        'licence_file' => 'license.png',
                        'address_file' => 'address.png',
                    ],
                    ['driver_id'],
                    ['mobile_number', 'dob', 'gender', 'country_id', 'city_id', 'postal_code', 'photo', 'licence_file', 'address_file', 'updated_at']
                );

                return response()->json($update_driver, 200);
            } else {
                $message = array("Message" => "No user found");
                return response()->json($message, 400);
            }
        }
    }

    public function loginDriver(Request $request)
    {
        $user_email = $request->input('email');
        $password = $request->input('password');

        $driver_login = DriverModel::loginDriver()->where('email', $user_email)
            ->where('password', '=', md5($password))
            ->where('status', '=', 'active');

        if (count($driver_login) > 0) {
            return $driver_login;
        } else {
            $message = array("Message" => "Email/passsword incorrect");
            return response()->json($message, 400);
        }
    }

    public function getDriverapproval(Request $request)
    {
        $email = $request->input('email');
        $driver = DriverModel::driverData()->where('email', $email)->first();

        if (count($driver) > 0) {

            $data['result'] = $driver;
            $result[] = array(
                'driver_id' => $driver->id, 'type' => $driver->type, 'fullname' => $driver->fullname,
                'email' => $driver->email, 'device_id' => $driver->device_id, 'device_token' => $driver->device_token,
                'status' => $driver->status, 'created_at' => $driver->created_at, 'approved' => $driver->approved
            );

            $json = array("status" => 1, "message" => "success", "data" => $result);
            return response()->json($json, 200);
        } else {
            $message = array("Message" => "Driver not found");
            return response()->json($message, 400);
        }
    }

    public function getDriverprofile(Request $request)
    {
        $driver_id = $request->input('driver_id');
        $driver = DriverModel::checkDriverProfile()->where('driver_id', $driver_id)->first();

        if (count($driver) > 0) {

            $data['result'] = $driver;
            $result[] = array(
                'driver_id' => $driver->driver_id, 'gender' => $driver->gender, 'dob' => $driver->dob, 'street' => $driver->street,
                'city' => $driver->city, 'state' => $driver->state, 'postal_code' => $driver->postal_code, 'country' => $driver->country,
                'country_id' => $driver->country_id, 'mobile_number' => $driver->mobile_number, 'photo' => $driver->photo,
                'vehicle_profile' => $driver->vehicle_profile
            );
            $json = array("status" => 1, "message" => "success", "data" => $result);

            return response()->json($json, 200);
        } else {
            $message = array("Message" => "No driver found");
            return response()->json($message, 400);
        }
    }

    public function updateDriverPhoto(Request $request)
    {
        $driver_id = $request->input('driver_id');
        $driver_exists = DriverModel::where("id", $driver_id)->first();

        if (count($driver_exists) > 0) {

            $str = rand();
            $random = md5($str);
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

                $file = $request->file('photo');
                $file_name = $random .  '_' . $file->getClientOriginalExtension();
                $file->move('uploads/driver_images', $file_name);
                $driver_image = 'uploads/driver_images/' . $file_name;
            } else {
                $driver_image = DriverDetails::where('driver_id', $driver_id)->first();
                $driver_image = $driver_image->photo;
            }

            $update_image = DriverDetails::where("driver_id", $driver_id)->update([
                'photo' => $driver_image
            ]);

            $data['result'] = $update_image;
            $result[] = array('driver_id' => $driver_id, 'photo' => $driver_image);
            $json = array("status" => 1, "message" => "success", "data" => $result);
            return response()->json($json);
        } else {
            $message = array("Message" => "No driver found");
            return response()->json($message, 400);
        }
    }

    public function updateVehicleProfile(Request $request)
    {
        $driver_id = $request->input('driver_id');
        $driver_exists = DriverModel::where("id", $driver_id)->first();

        if (count($driver_exists) > 0) {
            $str = rand();
            $random = md5($str);
            if ($request->hasFile('vehicle_profile') && $request->file('vehicle_profile')->isValid()) {

                $file = $request->file('vehicle_profile');
                $file_name = $random .  '_' . $file->getClientOriginalExtension();
                $file->move('uploads/vehicle_images', $file_name);
                $vehicle_profile = 'uploads/vehicle_images/' . $file_name;
            } else {
                $vehicle_profile = DriverDetails::where('driver_id', $driver_id)->first();
                $vehicle_profile = $vehicle_profile->vehicle_profile;
                $vehicle_profile = 'uploads/driver_images/700000000_jpg';
            }

            $update_image = DriverDetails::where("driver_id", $driver_id)->update([
                'vehicle_profile' => $vehicle_profile
            ]);
            $data['result'] = $update_image;
            $result[] = array('driver_id' => $driver_id, 'vehicle_profile' => $vehicle_profile);
            $json = array("status" => 1, "message" => "success", "data" => $result);
            return response()->json($json);
        } else {
            $message = array("Message" => "No driver found");
            return response()->json($message, 400);
        }
    }

    public function updateDriverPassword(Request $request)
    {
        $driver_id = $request->input('driver_id');
        $old_password = $request->input('old_password');
        $password = $request->input('password');

        $driver = DriverModel::driverData()->where('id', $driver_id)->first();

        if (count($driver) > 0) {

            $current_password = $driver->password;

            if ($current_password != md5($old_password)) {
                $message = array("Message" => "Current passsword incorrect");
                return response()->json($message, 400);
            } else {
                $change_password = DriverModel::where("id", $driver_id)->update([
                    'password' => md5($password)
                ]);

                $message = array("Message" => "Password changed successfully");
                return response()->json($message, 400);
            }
        } else {
            $message = array("Message" => "No driver found");
            return response()->json($message, 400);
        }
    }

    public function checkSentCode(Request $request)
    {
        $email = $request->input('email');
        $sentcode = $request->input('sentcode');

        $driver = DriverModel::driverData()->where('email', $email)->first();

        if (count($driver) > 0) {

            $current_code = $driver->sentcode;
            if ($sentcode == $current_code) {
                // $message = array("Message" => "verification successful");
                // return response()->json($message, 400);

                $result[] = array('driver_id' => $driver->id, 'email' => $email, 'sentcode' => $sentcode);
                $json = array("status" => 1, "message" => "success", "data" => $result);
                return response()->json($json, 200);
            } else {
                $message = array("Message" => "Incorrect code, verification failed");
                return response()->json($message, 400);
            }
        } else {
            $message = array("Message" => "No driver found");
            return response()->json($message, 400);
        }
    }

    public function addVehicle(Request $request)
    {
        $str = rand();
        $random = md5($str);
        $vehicle = new VehicleModel();
        $vehicle->company_id = $request->input('company_id');
        $vehicle->driver_id = $request->input('driver_id');
        $vehicle->vehicle_name = $request->input('vehicle_name');
        $vehicle->type = $request->input('type_id');
        $vehicle->vehicle_number = $request->input('vehicle_number');
        $vehicle->seats = $request->input('seats');
        if ($request->hasFile('vehicle_picture') && $request->file('vehicle_picture')->isValid()) {
            $file = $request->file('vehicle_picture');
            $file_name = $random .  '_' . $file->getClientOriginalExtension();
            $file->move('uploads/vehicle_images', $file_name);
            $vehicle_image = 'uploads/vehicle_images/' . $file_name;
        } else {
            $vehicle_image = 'uploads/vehicle_images/no_user.png';
        }
        $vehicle->vehicle_picture = $vehicle_image;

        if ($request->hasFile('vehicle_document') && $request->file('vehicle_document')->isValid()) {
            $file = $request->file('vehicle_document');
            $file_name = $random .  '_' . $file->getClientOriginalExtension();
            $file->move('uploads/vehicle_documents', $file_name);
            $vehicle_document = 'uploads/vehicle_documents/' . $file_name;
        } else {
            $vehicle_document = 'uploads/vehicle_documents/no_user.png';
        }
        $vehicle->vehicle_document = $vehicle_document;

        $driver_id = $request->input('driver_id');
        $driver_exists = DriverModel::where("id", $driver_id)->first();

        if (count($driver_exists) > 0) {

            $vehicle->save();

            $result[] = array(
                'vehicle_id' => $vehicle->id, 'vehicle_name' => $vehicle->vehicle_name, 'vehicle_number' => $vehicle->vehicle_number, 'type_id' => $vehicle->type,
                'seats' => $vehicle->seats, 'vehicle_image' => $vehicle->vehicle_picture, 'vehicle_document' => $vehicle->vehicle_document
            );
            $json = array("status" => 1, "message" => "success", "data" => $result);
            return response()->json($json, 200);
        } else {
            $message = array("Message" => "No driver found");
            return response()->json($message, 400);
        }
    }

    public function getVehicle(Request $request)
    {
        $driver_id = $request->input('driver_id');
        $vehicle = VehicleModel::getVehicle()->where('driver_id', $driver_id)->first();

        $data['result'] = $vehicle;

        if (count($vehicle) > 0) {
            $result[] = array(
                'driver_id' => $driver_id,  'vehicle_name' => $vehicle->vehicle_name, 'vehicle_number' => $vehicle->vehicle_number, 'vehicle_type' => $vehicle->vehicle_type,
                'seats' => $vehicle->seats, 'vehicle_picture' => $vehicle->vehicle_picture, 'vehicle_document' => $vehicle->vehicle_document
            );
            $json = array("status" => 1, "message" => "success", "data" => $result);
            return response()->json($json);
        } else {
            $message = array("Message" => "Record not found");
            return response()->json($message, 400);
        }
    }

    public function updateVehicle(Request $request)
    {
        $driver_id = $request->input('driver_id');
        $driver_exists = DriverModel::where("id", $driver_id)->first();

        if (count($driver_exists) > 0) {
            $str = rand();
            $random = md5($str);
            if ($request->hasFile('vehicle_picture') && $request->file('vehicle_picture')->isValid()) {
                $file = $request->file('vehicle_picture');
                $file_name = $random .  '_' . $file->getClientOriginalExtension();
                $file->move('uploads/vehicle_images', $file_name);
                $vehicle_image = 'uploads/vehicle_images/' . $file_name;
            } else {
                $vehicle_image = DriverModel::getDriverVehicle()->where('driver_id', $driver_id)->first();
                $vehicle_image = $vehicle_image->vehicle_picture;
            }

            if ($request->hasFile('vehicle_document') && $request->file('vehicle_document')->isValid()) {
                $file = $request->file('vehicle_document');
                $file_name = $random .  '_' . $file->getClientOriginalExtension();
                $file->move('uploads/vehicle_documents', $file_name);
                $vehicle_document = 'uploads/vehicle_documents/' . $file_name;
            } else {
                $vehicle_document = DriverModel::getDriverVehicle()->where('driver_id', $driver_id)->first();
                $vehicle_document = $vehicle_document->vehicle_document;
            }

            $vehicle = DriverModel::getDriverVehicle()->where('driver_id', $driver_id)->first();

            $vehicle_name = !empty($request->input('vehicle_name')) ? $request->input('vehicle_name') : $vehicle->vehicle_name;
            $type_id = !empty($request->input('type_id')) ? $request->input('type_id') : $vehicle->type;
            $vehicle_number = !empty($request->input('vehicle_number')) ? $request->input('vehicle_number') : $vehicle->vehicle_number;
            $seats = !empty($request->input('seats')) ? $request->input('seats') : $vehicle->seats;

            $update_vehicle = VehicleModel::where("driver_id", $driver_id)->update([
                'vehicle_name' => $vehicle_name, 'vehicle_number' => $vehicle_number, 'type' => $type_id, 'seats' => $seats,
                'vehicle_picture' => $vehicle_image, 'vehicle_document' => $vehicle_document
            ]);
            $data['result'] = $update_vehicle;
            $result[] = array(
                'driver_id' => $driver_id,  'vehicle_name' => $vehicle_name, 'vehicle_number' => $vehicle_number, 'type' => $type_id, 'seats' => $seats,
                'vehicle_picture' => $vehicle_image, 'vehicle_document' => $vehicle_document
            );
            $json = array("status" => 1, "message" => "success", "data" => $result);
            return response()->json($json);
        } else {
            $message = array("Message" => "Record not found");
            return response()->json($message, 400);
        }
    }

    public function deleteVehicle(Request $request)
    {
        $vehicle_id = $request->input('vehicle_id');
        $vehicle_exists = VehicleModel::where('id', $vehicle_id)->first();

        if (count($vehicle_exists)) {

            $vehicle = VehicleModel::where('id', $vehicle_id)->delete();

            $message = array("Message" => "Vehicle deleted successfully");
            return response()->json($message, 400);
        } else {
            $message = array("Message" => "Record not found");
            return response()->json($message, 400);
        }
    }

    public function addBankDetails(Request $request)
    {
        $driver_id = $request->input('driver_id');
        $bank_id = $request->input('bank_id');
        $bank_payee = $request->input('bank_payee');
        $bank_account = $request->input('bank_account');
        $bank_ifsc = $request->input('bank_ifsc');

        $bank_details = new BankDetailModel();
        $bank_details->driver_id = $driver_id;
        $bank_details->bank_id = $bank_id;
        $bank_details->bank_account = $bank_account;
        $bank_details->bank_payee = $bank_payee;
        $bank_details->bank_ifsc = $bank_ifsc;

        $existing_details = BankDetailModel::getBanksDetails()->where('driver_id', $driver_id)->first();

        if (count($existing_details) == 0) {

            $driver_exists = DriverModel::where("id", $driver_id)->first();

            if (count($driver_exists) > 0) {

                $bank_details->save();
                $result[] = array(
                    'driver_id' => $bank_details->driver_id, 'bank_id' => $bank_details->bank_id, 'bank_account' => $bank_details->bank_account,
                    'bank_payee' => $bank_details->bank_payee, 'bank_ifsc' => $bank_details->bank_ifsc,
                );
                $json = array("status" => 1, "message" => "success", "data" => $result);
                return response()->json($json, 200);
            } else {
                $message = array("Message" => "Record not found");
                return response()->json($message, 400);
            }
        } else {
            $message = array("Message" => "Driver bank details already exists");
            return response()->json($message, 400);
        }
    }

    public function getBankDetails(Request $request)
    {
        $driver_id = $request->input('driver_id');

        $driver_exists = DriverModel::where("id", $driver_id)->first();

        if (count($driver_exists) > 0) {

            $bank_details = BankDetailModel::getBanksDetails()->where('driver_id', $driver_id)->first();

            if (count($bank_details) > 0) {

                $result[] = array(
                    'driver_id' => $bank_details->driver_id, 'bank_id' => $bank_details->bank_id, 'bank_account' => $bank_details->bank_account,
                    'bank_payee' => $bank_details->bank_payee, 'bank_ifsc' => $bank_details->bank_ifsc,
                );
                $json = array("status" => 1, "message" => "success", "data" => $result);
                return response()->json($json, 200);
            } else {
                $message = array("Message" => "Record not found");
                return response()->json($message, 400);
            }
        } else {
            $message = array("Message" => "Record not found");
            return response()->json($message, 400);
        }
    }

    public function updateBankDetails(Request $request)
    {
        $driver_id = $request->input('driver_id');

        $driver_exists = DriverModel::where("id", $driver_id)->first();

        if (count($driver_exists) > 0) {

            $bank_details = BankDetailModel::getBanksDetails()->where('driver_id', $driver_id)->first();
            $bank_id = !empty($request->input('bank_id')) ? $request->input('bank_id') : $bank_details->bank_id;
            $bank_account = !empty($request->input('bank_account')) ? $request->input('bank_account') : $bank_details->bank_account;
            $bank_payee = !empty($request->input('bank_payee')) ? $request->input('bank_payee') : $bank_details->bank_payee;
            $bank_ifsc = !empty($request->input('bank_ifsc')) ? $request->input('bank_ifsc') : $bank_details->bank_ifsc;

            $update_driver_bank = BankDetailModel::where("driver_id", $driver_id)->update([
                'bank_id' => $bank_id, 'bank_account' => $bank_account, 'bank_payee' => $bank_payee, 'bank_ifsc' => $bank_ifsc
            ]);
            $data['result'] = $update_driver_bank;
            $result[] = array(
                'bank_id' => $bank_id, 'bank_account' => $bank_account, 'bank_payee' => $bank_payee, 'bank_ifsc' => $bank_ifsc
            );
            $json = array("status" => 1, "message" => "success", "data" => $result);
            return response()->json($json);
        } else {
            $message = array("Message" => "Record not found");
            return response()->json($message, 400);
        }
    }

    // Pending to be continued............................
    public function addTrip(Request $request)
    {
        $trip = new TripModel();
        $trip->driver_id = $request->input('driver_id');
        $trip->from_title = $request->input('from_title');
        $trip->from_lat = $request->input('from_lat');
        $trip->from_lng = $request->input('from_lng');
        $trip->from_address = $request->input('from_address');
        $trip->to_title = $request->input('to_title');
        $trip->to_lat = $request->input('to_lat');
        $trip->to_lng = $request->input('to_lng');
        $trip->to_address = $request->input('to_address');
        $trip->datetime = $request->input('datetime');
        $trip->last_lat = $request->input('last_lat');
        $trip->last_lng = $request->input('last_lng');
        $trip->trip_map_screenshot = $request->input('trip_map_screenshot');
        $trip->cancel_reason = $request->input('cancel_reason');
        $trip->end_datetime = $request->input('end_datetime');
        $trip->notify_datetime = $request->input('notify_datetime');
        $trip->notify_count = $request->input('notify_count');
        $trip->last_lng = $request->input('last_lng');
        $trip->trip_map_screenshot = $request->input('trip_map_screenshot');

        if ($request->input('from_title') == $request->input('to_title')) {
            $message = array("Message" => "Destination cannot be the same as ");
            return response()->json($message, 400);
        } else {

            $driver_id = $request->input('driver_id');
            $driver_exists = DriverModel::where("id", $driver_id)->first();

            if (count($driver_exists) > 0) {
                $trip->save();
                $result[] = array(
                    'driver_id' => $trip->driver_id, 'from_title' => $trip->from_title, 'from_lat' => $trip->from_lat,
                    'from_lng' => $trip->from_lng, 'from_address' => $trip->from_address, 'to_title' => $trip->to_title, 'to_lat' => $trip->to_lat,
                    'to_lng' => $trip->to_lng, 'to_address' => $trip->to_address, 'datetime' => $trip->datetime
                );
                $json = array("status" => 1, "message" => "success", "data" => $result);
                return response()->json($json, 200);
            } else {
                $message = array("Message" => "Driver not found");
                return response()->json($message, 400);
            }
        }
    }

    public function getTrip(Request $request)
    {
        $trip_id = $request->input('trip_id');
        $trip = TripModel::getTrips()->where('id', $trip_id)->first();

        if (count($trip) > 0) {

            $result[] = array(
                'driver_id' => $trip->driver_id, 'from_title' => $trip->from_title, 'from_lat' => $trip->from_lat,
                'from_lng' => $trip->from_lng, 'from_address' => $trip->from_address, 'to_title' => $trip->to_title, 'to_lat' => $trip->to_lat,
                'to_lng' => $trip->to_lng, 'to_address' => $trip->to_address, 'datetime' => $trip->datetime
            );
            $json = array("status" => 1, "message" => "success", "data" => $result);
            return response()->json($json, 200);
        } else {
            $message = array("Message" => "Record not found");
            return response()->json($message, 400);
        }
    }

    public function deleteTrip(Request $request)
    {
        $trip_id = $request->input('trip_id');
        $trip_exist = TripModel::where('id', $trip_id)->first();

        if (count($trip_exist)) {

            $trip = TripModel::where('id', $trip_id)->delete();

            $message = array("Message" => "Trip deleted successfully");
            return response()->json($message, 400);
        } else {
            $message = array("Message" => "Trip not found");
            return response()->json($message, 400);
        }
    }

    public function updateDriverLocation(Request $request)
    {
        $trip_id = $request->input('trip_id');
        $trip = TripModel::getTrips()->where('id', $trip_id)->first();

        if (count($trip) > 0) {

            $last_lat = !empty($request->input('last_lat')) ? $request->input('last_lat') : $trip->last_lat;
            $last_lng = !empty($request->input('last_lng')) ? $request->input('last_lng') : $trip->last_lng;

            $update_driver_location = TripModel::where("id", $trip_id)->update([
                'last_lat' => $last_lat, 'last_lng' => $last_lng
            ]);
            $data['result'] = $update_driver_location;
            $result[] = array(
                'trip_id' => $trip_id,  'last_lat' => $last_lat, 'last_long' => $last_lng
            );
            $json = array("status" => 1, "message" => "success", "data" => $result);
            return response()->json($json);
        } else {
            $message = array("Message" => "Trip not found");
            return response()->json($message, 400);
        }
    }

    public function getCountries()
    {
        $countries = DriverModel::getAllCountries();

        if (count($countries) > 0) {
            return response()->json($countries, 200);
        } else {
            $message = array("Message" => "Records not found");
            return response()->json($message, 400);
        }
    }

    public function getCities(Request $request)
    {
        $country_id = $request->input('country_id');
        $cities = DriverModel::getaAllCities()->where('country_id', $country_id);

        if (count($cities) > 0) {
            return response()->json($cities, 200);
        } else {
            $message = array("Message" => "Records not found");
            return response()->json($message, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}