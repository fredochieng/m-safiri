<?php

namespace App\Http\Controllers;

use App\Models\Api\UserModel;
use App\Models\Api\DriverModel;
use App\Models\Api\User_Adress;
use App\Models\Api\UserReview;
use Illuminate\Http\Request;
use DB;

class UserModelController extends Controller
{

    public function register(Request $request)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {

            $message = array("status" => 400, "message" => "Bad request");
            return response()->json($message, 200);
        } else {

            $user_email = $request->input('user_email');
            $password = bcrypt($request->input('password'));
            $old_password = bcrypt($request->input('old_password'));
            $device_id = $request->input('device_id');
            $device_token = $request->input('device_token');

            // Get file attachments form the form
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $file = $request->file('photo');
                $file_name = $phone_no .  '_' . $file->getClientOriginalExtension();
                $file->move('uploads/driver_images', $file_name);
                $user_image = 'uploads/user_images/' . $file_name;
            } else {
                $user_image = 'no_profile';
            }

            $resultGetdata = UserModel::checkUserdata($user_email);
            if ($resultGetdata >= 1) {
                $json = array("status" => 0, "message" => "Data already exist");
                return response()->json($json, 200);
            } else {
                if ($user_email == "") {
                    $resp = array("status" => 400, "message" =>  "Email can not empty");
                    return response()->json($resp, 200);
                } else {
                    $userModel = new UserModel();

                    //Assign form elemnts to table columns
                    $userModel->user_email = $user_email;
                    $userModel->password = $password;
                    $userModel->old_password = $old_password;
                    $userModel->device_id = $device_id;
                    $userModel->device_token = $device_token;
                    $userModel->photo = $user_image;



                    $userModel->save();
                     $result[] = array(
                         'user_email' => $user_email);
                     $json = array("status" => 200, "message"=>"success", "data"=>$result);
                     return response()->json($json, 200);
                    }
				}


        }

    }

    //Login

        public function login(Request $request)
        {

                $user_email = $request->input('user_email');
                $password = md5($request->input('password'));

                $user_login = UserModel::loginUserdata()->where('user_email', $user_email)
                                ->where('password', '=', $password)
                                ->where('status', '=', 'active');

                if($user_login->count() >= 1){

                    $result['user'] = $user_login;

                    $json = array("status" =>200, "message" => "success", "data" => $result);
                    return response()->json($json, 200);

                }else{
                    $json = array("status" => 0, "message" => "Wrong Username or password");
                    return response()->json($json, 400);
                }

        }

    // public function SocialLogin(Request $request)
	// {
    //     $login_type = $request->input('login_type');
    //     $user_email = $request->input('user_email');
    //     $fname = $request->input('fname');
    //     $lname = $request->input('lname');
    //     $device_id = $request->input('device_id');
    //     $device_token = $request->input('device_token');
    //     $token =  $request->input('token');

    //     $resultGetdata = UserModel::checkUserdata($user_email);
    //     $result['data'] =  $resultGetdata;
    //     $user_id = $result->id;

    //     if ($resultGetdata >= 1) {

    //         $data = array(
    //             'login_type' => $login_type,
    //             'device_id' => $device_id,
    //             'device_token' => $device_token,
    //             'token' => $token
    //         );

    //         $updateUser = UserModel::find($user_id)->update($data);


    //         $json = array("status" => 0, "message" => "Data already exist");
    //         return response()->json($json, 200);
    //     } else {

    //     }
    // }


    // get user informations
    public function getuser($id)
    {
        $resultGetuser = UserModel::getUserdata($id);
        if ($resultGetuser >= 1) {
            $data['result'] = $resultGetuser;

            return response()->json($data['result'], 200);
        } else {
            $json = array("status" => 0, "message" => "user with that id does not exist");
            return response()->json($json, 200);
        }

    }

    // update user profile
    public function updateprofile(Request $request, $user_id)
    {

        $fname =  $request->input('fname');
        $lname =  $request->input('lname');
        $user_email =  $request->input('user_email');
        $mobile_number =  $request->input('mobile_number');
        $gender =  $request->input('gender');
        $country =  $request->input('country');
        $device_token =  $request->input('device_token');

        // Get file attachments form the form
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $file = $request->file('photo');
            $file_name = $phone_no .  '_' . $file->getClientOriginalExtension();
            $file->move('uploads/driver_images', $file_name);
            $photo = 'uploads/driver_images/' . $file_name;
        } else {
            $user_image = UserModel::where('id', $user_id)->first();
            $user_image = $user_image->photo;
        }

        $update_user_details = UserModel::where("id", $user_id)->update([
            'fname' =>  $fname,
            'lname' =>  $lname,
            'user_email' => $user_email,
            'mobile_number' => $mobile_number,
            'gender' => $gender,
            'country' => $country,
            'device_token' => $device_token,
            'photo' => $user_image

        ]);

        if ($update_user_details) {
            $json = array("status" => 201, "message" => "Data has been updated");
            return response()->json($json, 200);
        } else {
            $json = array("status" => 0, "message" => "Something went wrong");
            return response()->json($json, 200);
        }
    }

    // sendcode
    public function user_check_sentcode(Request $request)
    {
        $email = $request->input('user_email');
        $sentcode = $request->input('sentcode');

        // check password
        $resultGetCode = UserModel::user_checkCodedata($email, $sentcode);

        if ($resultGetCode >= 1) {
            $data['result'] = $resultGetCode;
            $json = array("status" => 0, "message" => "success", "data" => $data['result']);
            return response()->json($json, 200);
        } else {
            $json = array("status" => 0, "message" => "Verification failed.");
            return response()->json($json, 200);
        }
    }

    //change password
    public function user_changepassword(Request $request, $id)
    {
        $old_password = bcrypt($request->input('old_password'));
        $password = bcrypt($request->input('password'));

        $checkUser = UserModel::userChangePass($id, $old_password);

        if ($checkUser >= 1) {

            $update_user_password = UserModel::where("id", $id)->update([
                'password' =>  $password,
                'old_password' =>  $old_password,

            ]);

            $json = array("status" => 201, "message" => "success");
            return response()->json($json);
        } else {
            $json = array("status" => 0, "message" => "Please insert the correct old password to update.");
            return response()->json($json, 200);
        }
    }


    // add my saved address
    public function savedAddress(Request $request)
    {

        $user_id = $request->input('user_id');
        $title = $request->input('title');
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $address = $request->input('address');

        $user = User_Adress::checkAddress($title, $address);

        if ($user->count() >= 1) {

            $message = array("Message" => "Address already exist");
            return response()->json($message, 400);
        } else {

            $saveAddress = new User_Adress();

            $saveAddress->user_id = $user_id;
            $saveAddress->title = $title;
            $saveAddress->lat = $lat;
            $saveAddress->lng = $lng;
            $saveAddress->address = $address;

            $saveAddress->save();
            $result[] = array(
                'user_id' => $user_id,
                'title' => $title,
                'lat' => $lat,
                'lng' => $lng,
                'address' => $address);

            $message = array("Message" => "saved successfully", "data"=> $result);
            return response()->json($message, 201);
        }
    }

    // get my saved address
    public function getmyaddress($user_id)
    {
        $userAddress = User_Adress::getUserAddress($user_id);

        return response()->json($userAddress);
    }

    // update my saved address
    public function update_savedAddress(Request $request, $id)
    {

        $title = $request->input('title');
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $address = $request->input('address');

        $update_user_address = User_Adress::where("id", $id)->update([
            'title' =>  $title,
            'lat' =>  $lat,
            'lng' => $lng,
            'address' => $address,

        ]);

        if ($update_user_address) {
            $result[] = array(
                'id' => $id,
                'title' => $title,
                'lat' => $lat,
                'lng' => $lng,
                'address' => $address);
            $json = array("status" => 200, "message" => "Data has been updated", "data"=> $result);
            return response()->json($json, 200);
        } else {
            $json = array("status" => 400, "message" => "Something went wrong");
            return response()->json($json, 400);
        }
    }

    // delete my saved address
    public function delete_myaddress($id)
    {

        $delete_address = User_Adress::where("id", $id)->delete();

        if ($delete_address) {
            $result[] = array('id'=>$id);
            $json = array("status" => 200, "message" => "Data has been deleted", "data"=> $result);
            return response()->json($json, 200);
        } else {
            $json = array("status" => 400, "message" => "Something went wrong");
            return response()->json($json, 400);
        }
    }

        // get user driver trips
        public function get_driverTrips(Request $request)
        {
            $user_id = $request->input('user_id');
			$from_title = $request->input('from_title');
			$to_title = $request->input('to_title');
			$get_date = $request->input('get_date');
			$seats = $request->input('seats');
			$rating = $request->input('rating');
			$price = $request->input('price');
            $by_date = $request->input('by_date');

            $ResultAddress = UserModel::getdriverTrips($from_title,$to_title,$get_date,$seats,$rating,$price);
            if( $ResultAddress->count() >= 1){
                foreach ($ResultAddress as $getValue) {
                     $driver_id = $getValue->driver_id;
                     $trip_id = $getValue->trip_id;

                     $bookedSeats = UserModel::check_availabeltrips($trip_id);

                     $totalSeats =  DriverModel::get_driver_vehicle($driver_id );
                      $tSeats = $totalSeats->seats;

                      $finalSeats = $tseats - $bookedSeats;

                      if($finalSeats >= $seats){

                        $resultGetrating= DriverModel::getdriverRating($driver_id);
                     if($resultGetrating>=1){
                        $datarating['result'] = $resultGetrating;
                        $ratting = number_format((float)$resultGetrating->avg_rating, 2, '.', '');

                    }
                    else{
                        $ratting = "0";
                    }
                    $result[] = array(
                        'id'=>$getValue->id,
                        'user_id'=>$user_id,
                        'driver_id'=>$getValue->driver_id,
                        'from_title'=>$getValue->from_title,
                        'from_lat'=>$getValue->from_lat,
                        'from_lng'=>$getValue->from_lng,
                        'from_address'=>$getValue->from_address,
                        'to_title'=>$getValue->to_title,
                        'to_lat'=>$getValue->to_lat,
                        'to_lng'=>$getValue->to_lng,
                        'to_address'=>$getValue->to_address,
                        'datetime'=>$getValue->datetime,
                        'status'=>$getValue->status,
                        'fullname'=>$getValue->fullname,
                        'gender'=>$getValue->gender,
                        'photo'=>$photoPath,
                        'mobile_number'=>$getValue->mobile_number,
                        'vehicle_number'=>$getValue->vehicle_number,
                        'vehicle_name'=>$getValue->vehicle_name,
                        'vehicle_type'=>$getValue->vehicle_type,
                        'rating'=>$rating,
                        'trip_price'=>$getValue->trip_price,
                        'countBookedseats' =>$bookedSeats);

		                 $json = array("status" => 1,"message"=>"success", "data" => $result);
                         return response()->json($json, 200);

                     }else{

                        $json = array("status" => 0, "message" => "No data found");
                        return response()->json($json, 400);
                     }


                }
            }else{
                $json = array("status" => 0, "message" => "Something went wrong");
                return response()->json($json, 400);
                }

            // NOT COMPLETE
        }

       // get driver informations
        public function get_singleTrip($id)
        {
            $getValue = UserModel::getsingleTrip($id);

            $resultGettime= DriverModel::calculate_triptime($id);
            $datatime['resultime'] = $resultGettime;

            $calculate_time = $resultGettime;

            if(!empty($getValue)){
                $data['result'] = $getValue;

                dd($getValue);

                foreach ($data['result'] as $getValue) {
                    $resultGetrating= DriverModel::getdriverRating( $getValue->driver_id);
                    $diver_id = $getValue->driver_id;
                    if(!empty($resultGetrating)){
                        $datarating['result'] = $resultGetrating;
                        $ratting = '2.0';//number_format((float)$resultGetrating->avg_rating, 2, '.', '');

                    }
                    else{
                        $ratting = "0";
                    }

                    $result[] = array(
                        'id'=>$id,
                        'driver_id'=>$getValue->driver_id,
                        'from_title'=>$getValue->from_title,
                        'from_lat'=>$getValue->from_lat,
                        'from_lng'=>$getValue->from_lng,
                        'from_address'=>$getValue->from_address,
                        'to_title'=>$getValue->to_title,
                        'to_lat'=>$getValue->to_lat,
                        'to_lng'=>$getValue->to_lng,
                        'to_address'=>$getValue->to_address,
                        'last_lat'=>$getValue->last_lat,
                        'last_lng'=>$getValue->last_lng,
                        'datetime'=>$getValue->datetime,
                        'status'=>$getValue->status,
                        'fullname'=>$getValue->fullname,
                        'gender'=>$getValue->gender,
                        //'photo'=>$photoPath,
                        'mobile_number'=>$getValue->mobile_number,
                        'vehicle_number'=>$getValue->vehicle_number,
                        'vehicle_type'=>$getValue->vehicle_type,
                        'vehicle_name'=>$getValue->vehicle_name,
                        'calculate_time'=>$calculate_time,
                        'trip_price'=>$getValue->trip_price,
                        'ratting' =>$ratting,
                        'user_ratting' => $getValue->user_ratting,
                        'user_trip_status'=>$getValue->user_trip_status);

                        $json = array("status" => 1,"message"=>"success", "data" => $result);
                        return response()->json($json, 400);
                    }


            } else{
                $json = array("status" => 0, "message" => "Something went wrong");
                return response()->json($json, 400);
          }
        }

        // get all trips - Home screen
        public function get_allFromlist()
        {
            $resultGettrips= UserModel::getAllfromlist();
            if($resultGettrips->count() >= 1){
                $data['result'] = $resultGettrips;
	            	foreach ($data['result'] as $getValue) {

            		$result[] = array(

                        'id' => $getValue->id,
                        'driver_id' => $getValue->driver_id,
                        'from_title'=>$getValue->from_title ,
                        'from_lat'=>$getValue->from_lat ,
                        'from_lng'=>$getValue->from_lng ,
                        'from_address'=>$getValue->from_address ,
                        'to_title'=>$getValue->to_title ,
                        'to_lat'=>$getValue->to_lat ,
                        'to_lng'=>$getValue->to_lng ,
                        'to_address'=>$getValue->to_address ,
                        'datetime'=>$getValue->datetime ,
                        'end_datetime'=>$getValue->end_datetime ,
                        'status'=>$getValue->status
                        );


                }
                $json = array("status" => 1,"message"=>"success", "data" => $result);
                return response()->json($json, 200);
			}
			else{
                  $json = array("status" => 0, "message" => "Something went wrong");
                  return response()->json($json, 400);
			}
        }


        // get all trips - Home screen
	    public function get_allTolist(Request $request){

            $from_title = $request->input('from_title');
            $resultGettrips= UserModel::getAlltolist($from_title);
            if(!empty($resultGettrips)){
            	$data['result'] = $resultGettrips;
	            	foreach ($data['result'] as $getValue) {
                        $result[] = array(

                            'id' => $getValue->id,
                            'driver_id' => $getValue->driver_id,
                            'from_title'=>$getValue->from_title ,
                            'from_lat'=>$getValue->from_lat ,
                            'from_lng'=>$getValue->from_lng ,
                            'from_address'=>$getValue->from_address ,
                            'to_title'=>$getValue->to_title ,
                            'to_lat'=>$getValue->to_lat ,
                            'to_lng'=>$getValue->to_lng ,
                            'to_address'=>$getValue->to_address ,
                            'datetime'=>$getValue->datetime ,
                            'end_datetime'=>$getValue->end_datetime ,
                            'status'=>$getValue->status
                            );
                 }
                 $json = array("status" => 1,"message"=>"success", "data" => $result);
                 return response()->json($json, 200);
			}
			else{
			  	$json = array("status" => 0, "message" => "Something went wrong");
			}
        }

        // add user trips join
        public function user_joinTrip(Request $request)
        {
            $status = $request->input('status');
            $datetime = date("Y-m-d H:i:s");

            $trip_id =$request->input('trip_id');
            $user_id =$request->input('user_id');
            $driver_id =$request->input('driver_id');

            $data = array(
                'trip_id' =>$trip_id,
                'user_id' =>$user_id,
                'driver_id' =>$driver_id,
                'datetime' => $datetime,
                'status' => $status
            );
            $resultGetdata=UserModel::check_jointrip($trip_id ,$user_id);
            if(!empty($resultGetdata)){
                $json = array("status" =>0, "message" => "Data already exist");
                return response()->json($json, 401);
			}
			else{
                $insertTrip = new UserReview();

                UserReview::insert($data);

                $result[] = array('id'=>$id,
                'trip_id' => $trip_id,
                'user_id' => $user_id,
                'driver_id' => $driver_id,
                'datetime' => $datetime
                );
                 $json = array("status" => 1, "message"=>"success", "data" => $result);
                 return response()->json($json, 201);
			}

        }

        // NOT COMPLETE


    // get driver informations
    // public function get_singleTrip($id)
    // {
    //     $resultGetsingletrip = UserModel::check_availabeltrips($id);
    // }

    //add review
    public function user_addReview(Request $request)
    {
        $user_id = $request->input('user_id');
        $trip_id = $request->input('trip_id');
        $driver_id = $request->input('driver_id');
        $rating = $request->input('rating');
        $comments = $request->input('comment');

        $addReview = UserReview::where([['user_id', '=', $user_id], ['trip_id', '=', $trip_id], ['status', '=', 'completed']])->update([
            'rating' =>  $rating,
            'comments' =>  $comments,

        ]);

        $resultGetrating = DriverModel::getdriverRating($driver_id);
        $avg_rating =  $resultGetrating->avg_rating;

        if ($resultGetrating->count() >= 1) {

            $avgRating = number_format((float) $avg_rating, 2, '.', '');
        } else {
            $avgRating = 0;
        }
        // update ratting in driver data
        $addReview = DB::table('tbl_driverdata')->where('driver_id', '=', $driver_id)->update([
            'rating' =>  $avgRating,
        ]);

        return array("status" => 201, "message" => "Data has been updated");
    }

    public function user_confirmTrip()
    { }

    // cancel trip by user
    public function user_cancelTrip(Request $request, $id)
    {
        $user_id = $request->input('user_id');
        $trip_id = $request->input('trip_id');

        $resultGetcancelled = UserReview::get_canceltrip($user_id, $trip_id);
        if ($resultGetcancelled->count() >= 1) {

            $statusUpdate = DB::table('tbl_user_trips')->where('id', '=', $id)->update([
                'status' =>  'cancel',
            ]);

            $statusUpdate = DB::table('tbl_trip_passanger')->where('book_id', '=', $id)->update([
                'status' =>  'cancel',
            ]);

            $json = array("message" => "Trip cancelled.");
            return responce()->json($json, 200);
        } else {
            $json = array("message" => "Unable to cancel.");
            return responce()->json($json, 400);
        }
    }

    public function user_getReview()
    {
        $user_id = $request->input('user_id');
        $trip_id = $request->input('trip_id');

        $resultGetcancelled = UserReview::get_userReview($user_id, $trip_id);
        return responce()->json($resultGetcancelled, 200);
    }

    public function user_Preferences()
    {
        $driver_id = $request->input('driver_id');
        $user_id = $request->input('user_id');
        $trip_id = $request->input('trip_id');
        $music = $request->input('music');
        $medical = $request->input('medical');

        $resultGetPreference = Preference::get_user_trip_preferences($user_id, $trip_id);

        if ($resultGetPreference->count() >= 1) {
            $prefUpdate = DB::table('tbl_preferences')->where([['user_id', '=', $user_id], ['trip_id', '=', $trip_id]])->update([
                'music' => $music,
                'medical' => $medical
            ]);
            $json = array("message" => "Updated successfully");
            return responce()->json($json, 200);
        } else {

            $PrefInsert = new Preference();

            $PrefInsert->user_id = $user_id;
            $PrefInsert->trip_id = $trip_id;
            $PrefInsert->driver_id = $driver_id;
            $PrefInsert->music = $music;
            $PrefInsert->medical = $medical;

            $PrefInsert->save();

            $json = array("message" => "success");
            return responce()->json($json, 200);
        }
    }

    //get user trip preferences
    public function get_user_preferences()
    {
        $getprefResult = Preference::getPreferences($user_id);
        if ($getprefResult) {
            return responce()->json($getprefResult, 200);
        } else {
            $json = array("message" => "something went wrong");
            return responce()->json($json, 400);
        }
    }

    public function get_user_favoritelist($user_id)
    { }

    // get passanger from book_id
    public function get_user_passanger($book_id)
    {

        $passResult = UserModel::get_bookid($book_id);

        if ($passResult >= 1) {
            return responce()->json($passResult, 200);
        } else {
            $json = array("message" => "something went wrong");
            return responce()->json($json, 400);
        }
    }

    // passanger cancel trip
    public function passanger_canceltrip()
    { }

    // logout api
	// delete my saved address
	public function user_logout(Request $request) {

            $user_id = $request->input('user_id');
			$device_token = $request->input('device_token');

            $deviceToken = DB::table('tbl_user_devicedata')
                         ->where([['user_id', '=', $user_id], ['device_token', '=', $device_token]])
                         ->delete();

			$result[] = array('user_id'=>$user_id,'device_token'=>$device_token);
            $json = array("status" => 1, "message"=>"success delete.", "data" => $result);
            return response()->json($json, 200);
    }
}
