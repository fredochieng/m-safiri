<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		/*
        $check_auth_client = $this->UserModel->check_auth_client();
		if($check_auth_client != true){
			die($this->output->get_output());
		}
		*/
		$this->load->model('UserModel');
		$this->load->model('DriverModel');
		$this->load->library('Curl');
	}
	public function notification()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			// ios
			$device_token = "C8AEFCE512BE8A7E9A57375E3B9D73A2A4EFD01DA48A4E277537F68B66ECAFC2";
			$apnsHost = 'gateway.sandbox.push.apple.com';
			$apnsCert = 'Certificates_Driver.pem';
			$apnsPort = 2195;
			$apnsPass = '123456';
			$t_registration_id = str_replace('%20', '', $device_token);
			$ts_registration_id = str_replace(' ', '', $t_registration_id);
			$token = $ts_registration_id;

			$payload['aps'] = array('alert' => "Dear, Driver user has Confirm your trip.", "data" => array("type" => 'user_confirm_trip', 'trip_id' => '13', "action-loc-key" => "View"), 'badge' => 1, 'sound' => 'default');
			$payload['extra_info'] = array('apns_msg' => "TuRyde Notification");
			$output = json_encode($payload);
			$token = pack('H*', str_replace(' ', '', $token));
			$apnsMessage = chr(0) . chr(0) . chr(32) . $token . chr(0) . chr(strlen($output)) . $output;

			$streamContext = stream_context_create();
			stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
			stream_context_set_option($streamContext, 'ssl', 'passphrase', $apnsPass);

			$apns = stream_socket_client('ssl://' . $apnsHost . ':' . $apnsPort, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);
			fwrite($apns, $apnsMessage);
			fclose($apns);
			$rtn["code"]	= "0001"; //means result OK
			$rtn["msg"]		= "OK";
		}
	}

	// user login data
	public function login()

	{

		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$resultGetdata = $this->UserModel->loginUserdata($post_data['user_email'], md5($post_data['password']));
			if ($resultGetdata >= 1) {
				$data['result'] = $resultGetdata;
				// profile photo
				if ($resultGetdata[0]['photo'] == 'no_profile.png' || $resultGetdata[0]['photo'] == '') {
					$photoPath = no_profile;
				} else {
					$photoPath = user_profile . $resultGetdata[0]['id'] . "/" . $resultGetdata[0]['photo'];
				}
				$fullnamedata = array(
					'device_id' => $post_data['device_id'],
					'device_token' => $post_data['device_token']
				);
				$respfullnamedata = $this->UserModel->update_user_data($resultGetdata[0]['id'], $fullnamedata);

				$result[] = array('user_id' => $resultGetdata[0]['id'], 'user_email' => $resultGetdata[0]['user_email'], 'username' => $resultGetdata[0]['username'], 'mobile_number' => $resultGetdata[0]['mobile_number'], 'gender' => $resultGetdata[0]['gender'], 'photo' => $photoPath, 'fname' => $resultGetdata[0]['fname'], 'lname' => $resultGetdata[0]['lname'], 'country' => $resultGetdata[0]['country'], 'device_id' => $resultGetdata[0]['device_id'], 'status' => $resultGetdata[0]['status']);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Wrong Username or password");
			}
		}
		echo json_encode($json);
	}

	// user registration
	public function register()
	{

		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$data = array(
				'user_email' => $post_data['user_email'],
				'password' => md5($post_data['password']),
				'old_password' => md5($post_data['password']),
				'device_id' => $post_data['device_id'],
				'device_token' => $post_data['device_token']
			);
			$resultGetdata = $this->UserModel->checkUserdata($post_data['user_email'], $post_data['username']);
			if ($resultGetdata >= 1) {
				$json = array("status" => 0, "message" => "Data already exist");
			} else {
				if ($post_data['user_email'] == "") {
					$resp = array("status" => 400, "message" =>  "Email can not empty");
				} else {
					$resp = $this->UserModel->register_user_data($data);
					$id = $this->db->insert_id();
					if (!file_exists('user_uploads/' . $id)) {
						mkdir('user_uploads/' . $id, 0777, true);
					}
					$result[] = array('user_id' => $id, 'user_email' => $post_data['user_email']);
					$json = array("status" => 1, "message" => "success", "data" => $result);
				}
			}
		}
		echo json_encode($json);
	}

	// fblogin
	public function SocialLogin()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$login_type = isset($post_data['login_type']) ? $post_data['login_type'] : '';
			$user_email = isset($post_data['user_email']) ? $post_data['user_email'] : '';
			$fname = isset($post_data['fname']) ? $post_data['fname'] : '';
			$lname = isset($post_data['lname']) ? $post_data['lname'] : '';
			$device_id = isset($post_data['device_id']) ? $post_data['device_id'] : '';
			$device_token = isset($post_data['device_token']) ? $post_data['device_token'] : '';
			$token = isset($post_data['token']) ? $post_data['token'] : '';

			$resultGetdata = $this->UserModel->checkUserdata($user_email);
			if ($resultGetdata >= 1) {
				$data['result'] = $resultGetdata;
				// update data
				$data = array(
					'login_type' => $login_type,
					'device_id' => $device_id,
					'device_token' => $device_token,
					'token' => $token
				);
				$resp = $this->UserModel->update_user_data($resultGetdata[0]['id'], $data);
				if ($resultGetdata[0]['photo'] == 'no_profile.png' || $resultGetdata[0]['photo'] == '') {
					$photoPath = no_profile;
				} else {
					$photoPath = user_profile . $resultGetdata[0]['id'] . "/" . $resultGetdata[0]['photo'];
				}

				$result[] = array('user_id' => $resultGetdata[0]['id'], 'user_email' => $resultGetdata[0]['user_email'], 'username' => $resultGetdata[0]['username'], 'mobile_number' => $resultGetdata[0]['mobile_number'], 'gender' => $resultGetdata[0]['gender'], 'photo' => $photoPath, 'fname' => $resultGetdata[0]['fname'], 'lname' => $resultGetdata[0]['lname'], 'country' => $resultGetdata[0]['country'], 'device_id' => $resultGetdata[0]['device_id'], 'status' => $resultGetdata[0]['status']);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$data = array(
					'user_email' => $post_data['user_email'],
					'fname' => $post_data['fname'],
					'lname' => $post_data['lname'],
					'login_type' => $login_type,
					'device_id' => $device_id,
					'device_token' => $device_token,
					'token' => $token
				);
				$resp = $this->UserModel->register_user_data($data);
				$id = $this->db->insert_id();
				if (!file_exists('user_uploads/' . $id)) {
					mkdir('user_uploads/' . $id, 0777, true);
				}
				$result[] = array('user_id' => $id, 'user_email' => $post_data['user_email']);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			}
		}
		echo json_encode($json);
	}
	// get user informations
	public function getuser()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$user_id = $post_data['user_id'];
			$resultGetuser = $this->UserModel->getUserdata($user_id);
			if ($resultGetuser >= 1) {
				$data['result'] = $resultGetuser;
				// profile photo
				if ($resultGetuser[0]['photo'] == 'no_profile.png' || $resultGetuser[0]['photo'] == '') {
					$photoPath = no_profile;
				} else {
					$photoPath = user_profile . $resultGetuser[0]['id'] . "/" . $resultGetuser[0]['photo'];
				}
				$user_id = isset($resultGetuser[0]['id']) ? $resultGetuser[0]['id'] : '';
				$fname = isset($resultGetuser[0]['fname']) ? $resultGetuser[0]['fname'] : '';
				$lname = isset($resultGetuser[0]['lname']) ? $resultGetuser[0]['lname'] : '';
				$user_email = isset($resultGetuser[0]['user_email']) ? $resultGetuser[0]['user_email'] : '';
				$username = isset($resultGetuser[0]['username']) ? $resultGetuser[0]['username'] : '';
				$mobile_number = isset($resultGetuser[0]['mobile_number']) ? $resultGetuser[0]['mobile_number'] : '';
				$gender = isset($resultGetuser[0]['gender']) ? $resultGetuser[0]['gender'] : '';
				$country = isset($resultGetuser[0]['country']) ? $resultGetuser[0]['country'] : '';
				$device_id = isset($resultGetuser[0]['device_id']) ? $resultGetuser[0]['device_id'] : '';
				$status = isset($resultGetuser[0]['status']) ? $resultGetuser[0]['status'] : '';

				$result[] = array('user_id' => $user_id, 'fname' => $fname, 'lname' => $lname, 'user_email' => $user_email, 'username' => $username, 'mobile_number' => $mobile_number, 'gender' => $gender, 'photo' => $photoPath, 'country' => $country, 'device_id' => $device_id, 'status' => $status);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}

	// update user profile
	public function updateprofile()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$user_id = $post_data['user_id'];
			// profile photo
			$photoPath = user_profile;

			$post_data = $this->input->post();
			$resultGetuser = $this->UserModel->getUserdata($user_id);

			$data['result'] = $resultGetuser;


			if ($_FILES['photo']['name'] != "") {
				$imagePrefix = time();
				$imagename =  $user_id . $imagePrefix;
				$config['upload_path'] = './user_uploads/' . $user_id . '/';
				$config['allowed_types'] =     'gif|jpg|png|jpeg|jpe';
				$config['file_name'] = $imagename;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('photo')) {
					$error = array('error' => $this->upload->display_errors());
				} else {
					$upload_data = $this->upload->data();
					$photo_name = $imagename . $this->upload->data('file_ext');
					$photoNewpath = $photoPath . $user_id . '/' . $photo_name;
				}
			} else {
				$photo_name = $resultGetuser[0]['photo'];
				$photoNewpath = user_profile . $user_id . '/' . $photo_name;
			}

			$mobile_number = isset($post_data['mobile_number']) ? $post_data['mobile_number'] : $resultGetuser[0]['mobile_number'];
			$gender = isset($post_data['gender']) ? $post_data['gender'] : $resultGetuser[0]['gender'];
			$fname = isset($post_data['fname']) ? $post_data['fname'] : $resultGetuser[0]['fname'];
			$lname = isset($post_data['lname']) ? $post_data['lname'] : $resultGetuser[0]['lname'];
			$country = isset($post_data['country']) ? $post_data['country'] : $resultGetuser[0]['country'];
			$user_email = isset($post_data['user_email']) ? $post_data['user_email'] : $resultGetuser[0]['user_email'];
			$device_token = isset($post_data['device_token']) ? $post_data['device_token'] : $resultGetuser[0]['device_token'];
			$data = array(
				'user_email' => $user_email,
				'photo' => $photo_name,
				'mobile_number' => $mobile_number,
				'gender' => $gender,
				'fname' => $fname,
				'lname' => $lname,
				'country' => $country,
				'device_token' => $device_token,
			);
			$resp = $this->UserModel->update_user_data($user_id, $data);
			$result[] = array('user_id' => $user_id, 'fname' => $fname, 'lname' => $lname, 'user_email' => $user_email, 'photo' => $photoNewpath, 'mobile_number' => $mobile_number, 'status' => $resultGetuser[0]['status']);
			$json = array("status" => 1, "message" => "success", "data" => $result);
		}
		echo json_encode($json);
	}
	// sendcode
	public function user_check_sentcode()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$email = $post_data['user_email'];
			$sentcode = $post_data['sentcode'];
			// check password
			$resultDriverGetoldpwd = $this->UserModel->user_checkCodedata($email, $sentcode);
			if ($resultDriverGetoldpwd >= 1) {
				$data['result'] = $resultDriverGetoldpwd;
				$result[] = array('user_id' => $resultDriverGetoldpwd[0]['id'], 'user_email' => $email, 'sentcode' => $sentcode);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Verification failed.");
			}
		}
		echo json_encode($json);
	}
	// change password
	public function user_changepassword()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$user_id = isset($post_data['user_id']) ? $post_data['user_id'] : '';
			$user_id = isset($post_data['password']) ? $post_data['password'] : '';
			if ($driver_id > 0) {
				$data = array(
					'password' => md5($newpassword),
					'old_password' => md5($newpassword)
				);
				$resp = $this->UserModel->update_passwordCode($user_id, $data);
				$result[] = array('user_id' => $user_id, 'password' => $newpassword);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Something goes wrong.");
			}
		}
		echo json_encode($json);
	}

	// forgot password
	public function forgotpassword()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			//$user_id = isset($post_data['user_id']) ? $post_data['user_id'] : '';
			$email = isset($post_data['user_email']) ? $post_data['user_email'] : '';
			$resultGetEmail = $this->UserModel->checkEmail($email);
			//echo $this->db->last_query();
			if ($resultGetEmail >= 1) {
				$data['result'] = $resultGetEmail;
				//print_r($data['result']);
				$code = date('si') . $resultGetEmail[0]['id'];
				//$resp = $this->UserModel->add_helpcenter($datarow);
				$this->load->library('email');
				$config['protocol']    = 'smtp';
				$config['smtp_host']    = 'ssl://smtp.gmail.com';
				$config['smtp_port']    = 587;
				$config['smtp_timeout'] = 7;
				$config['smtp_user']    = 'nishant.eleganzit@gmail.com';
				$config['smtp_pass']    = 'nishant2708';
				$config['charset']    = 'utf-8';
				$config['newline']    = "\r\n";
				$config['mailtype'] = 'text'; // or html
				$config['validation'] = TRUE; // bool whether to validate email or not      
				$this->email->initialize($config);
				$this->email->from('nishant.eleganzit@gmail.com', 'Nishant');
				$this->email->to('aryan.74344@gmail.com');
				//$this->email->cc('another@another-example.com');
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('Glamus | Please recover password');
				$this->email->message('Please use the following security code for the Glamus account :  -' . $email . ' 
						Security Code : ' . $code . '');

				//if($this->email->send()){
				//echo $this->email->print_debugger();
				$dataCode = array(
					'passwordcode' => $code
				);
				$resp = $this->UserModel->update_passwordCode($resultGetEmail[0]['id'], $dataCode);
				//$result[] = array("Email sent successfully.");
				$result[] = array('user_id' => $resultGetEmail[0]['id'], 'code' => $code);
				$json = array("status" => 1, "message" => "success", "data" => $result);
				/*}else{
						//echo $this->email->print_debugger();
						$result[] = array("Error in sending Email.");
						$json = array("status" => 0, "message"=>"Failed", "data" => $result);
					}*/
			} else {
				$json = array("status" => 0, "message" => "User Not found.");
			}
		}
		echo json_encode($json);
	}


	// update password
	public function newpassword()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$user_id = isset($post_data['user_id']) ? $post_data['user_id'] : '';
			$old_password = isset($post_data['old_password']) ? $post_data['old_password'] : '';
			// check password
			$resultUserGetoldpwd = $this->UserModel->checkUserpassword($post_data['user_id'], md5($post_data['old_password']));
			if ($resultUserGetoldpwd >= 1) {
				$newpassword = isset($post_data['password']) ? $post_data['password'] : '';
				$data = array(
					'id' => $user_id,
					'password' => md5($newpassword),
					'old_password' => md5($newpassword)
				);
				$resp = $this->UserModel->update_mypassword($user_id, $data);
				$result[] = array('user_id' => $user_id, 'password' => $newpassword);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else { }
		}
		echo json_encode($json);
	}

	// add my saved address
	public function savedAddress()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$data = array(
				'user_id' => $post_data['user_id'],
				'title' => $post_data['title'],
				'lat' => $post_data['lat'],
				'lng' => $post_data['lng'],
				'address' => $post_data['address']
			);
			$resultGetdata = $this->UserModel->check_myaddress($post_data['user_id'], $post_data['title'], $post_data['address']);
			if ($resultGetdata >= 1) {
				$json = array("status" => 0, "message" => "Data already exist");
			} else {
				$resp = $this->UserModel->user_savedaddress($data);
				$id = $this->db->insert_id();
				$result[] = array('id' => $id, 'user_id' => $post_data['user_id'], 'title' => $post_data['title'], 'lat' => $post_data['lat'], 'lng' => $post_data['lng'], 'address' => $post_data['address']);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			}
		}
		echo json_encode($json);
	}
	// update my saved address
	public function update_savedAddress()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$id = $post_data['id'];
			$data = array(
				'user_id' => $post_data['user_id'],
				'title' => $post_data['title'],
				'lat' => $post_data['lat'],
				'lng' => $post_data['lng'],
				'address' => $post_data['address']
			);
			if ($post_data['id'] == "") {
				$resp = array("status" => 400, "message" =>  "id can not empty");
			} else {
				$resp = $this->UserModel->user_update_savedaddress($id, $data);
				$result[] = array('id' => $id, 'user_id' => $post_data['user_id'], 'title' => $post_data['title'], 'lat' => $post_data['lat'], 'lng' => $post_data['lng'], 'address' => $post_data['address']);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			}
		}
		echo json_encode($json);
	}
	// get user saved address
	public function get_savedAddress()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$user_id = $post_data['user_id'];
			$resultGetmyaddress = $this->UserModel->getmyaddress($user_id);
			if ($resultGetmyaddress >= 1) {
				$data['result'] = $resultGetmyaddress;
				foreach ($data['result'] as $getValue) {
					$result[] = array('id' => $getValue['id'], 'user_id' => $getValue['user_id'], 'title' => stripslashes($getValue['title']), 'lat' => $getValue['lat'], 'lng' => $getValue['lng'], 'address' => stripslashes($getValue['address']));
					$json = array("status" => 1, "message" => "success", "data" => $result);
				}
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	// delete my saved address
	public function delete_myaddress()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$id = $post_data['id'];
			$resp = $this->UserModel->delete_my_address($id);
			$result[] = array('id' => $id);
			$json = array("status" => 1, "message" => "success delete.", "data" => $result);
		}
		echo json_encode($json);
	}
	// get user driver trips
	public function get_driverTrips()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$user_id = $post_data['user_id'];
			$from_title = $post_data['from_title'];
			$to_title = $post_data['to_title'];
			$get_date = $post_data['get_date'];
			$seats = $post_data['seats'];
			$rating = isset($post_data['rating']) ? $post_data['rating'] : '';
			$price = isset($post_data['price']) ? $post_data['price'] : '';
			$by_date = isset($post_data['by_date']) ? $post_data['by_date'] : '';
			$resultGetmyaddress = $this->UserModel->getdriverTrips($from_title, $to_title, $get_date, $seats, $rating, $price);
			// images, avg rating,
			if ($resultGetmyaddress >= 1) {
				$data['result'] = $resultGetmyaddress;
				foreach ($data['result'] as $getValue) {
					$driver_id = $getValue['driver_id'];
					$trip_id = $getValue['id'];
					// get booked seats
					$resultGetcountseats = $this->UserModel->check_availabeltrips($trip_id);
					if ($resultGetcountseats >= 1) {
						$datagetseats['result'] = $resultGetcountseats;
						$countBookedseats1 = count($datagetseats['result']);
					} else {
						$countBookedseats1 = 0;
					}
					$resultGetcountseats1 = $this->UserModel->check_availabeltrips_passanger($trip_id);
					if ($resultGetcountseats1 >= 1) {
						$datagetseats1['result'] = $resultGetcountseats1;
						$countBookedseats2 = count($datagetseats1['result']);
					} else {
						$countBookedseats2 = 0;
					}
					$countBookedseats = $countBookedseats1 + $countBookedseats2;
					// get driver vehicle seats
					$resultGetdriverseats = $this->DriverModel->get_driver_vehicle($driver_id);
					$datagetdriverseats['result'] = $resultGetdriverseats;
					$finalseats = $resultGetdriverseats[0]['seats'] - $countBookedseats2;

					if ($finalseats >= $seats) {
						if ($getValue['photo'] == 'no_profile.png' || $getValue['photo'] == '') {
							$photoPath = no_profile;
						} else {
							$photoPath = driver_profile . $getValue['driver_id'] . "/" . $getValue['photo'];
						}
						$resultGetrating = $this->DriverModel->getdriverRating($getValue['driver_id']);
						if ($resultGetrating >= 1) {
							$datarating['result'] = $resultGetrating;
							$ratting = number_format((float) $resultGetrating[0]['avg_rating'], 2, '.', '');
						} else {
							$ratting = "0";
						}
						/*$resultGetrating=$this->DriverModel->gettripRating($getValue['id']);
				            if($resultGetrating>=1){
				            	$datarating['result'] = $resultGetrating;
				            	if($resultGetrating[0]['avg_rating'] == ""){
				            		$ratting = "0";
				            	}
				            	else{
				            		$ratting = number_format((float)$resultGetrating[0]['avg_rating'], 2, '.', '');
				            	}
				            	
				            }
				            else{
				            	$ratting = "0";
				            }*/
						// trip price
						//$trip_price = substr(str_shuffle("0123456789"), 0, 3);
						// distance calculate
						//
						$result[] = array('id' => $getValue['id'], 'user_id' => $user_id, 'driver_id' => $getValue['driver_id'], 'from_title' => $getValue['from_title'], 'from_lat' => $getValue['from_lat'], 'from_lng' => $getValue['from_lng'], 'from_address' => $getValue['from_address'], 'to_title' => $getValue['to_title'], 'to_lat' => $getValue['to_lat'], 'to_lng' => $getValue['to_lng'], 'to_address' => $getValue['to_address'], 'datetime' => $getValue['datetime'], 'status' => $getValue['status'], 'fullname' => $getValue['fullname'], 'gender' => $getValue['gender'], 'photo' => $photoPath, 'mobile_number' => $getValue['mobile_number'], 'vehicle_number' => $getValue['vehicle_number'], 'vehicle_name' => $getValue['vehicle_name'], 'vehicle_type' => $getValue['vehicle_type'], 'ratting' => $ratting, 'trip_price' => $getValue['trip_price'], 'countBookedseats' => $countBookedseats2);
						$json = array("status" => 1, "message" => "success", "data" => $result);
					} else {
						//continue;
						$json = array("status" => 0, "message" => "No data found");
					}
				}
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	// get driver informations
	public function get_singleTrip()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$id = $post_data['id'];
			//$user_id = $post_data['user_id'];
			$resultGetsingletrip = $this->UserModel->getsingleTrip($id);
			//$trip_price = substr(str_shuffle("0123456789"), 0, 3);
			// calculate time
			$resultGettime = $this->DriverModel->calculate_triptime($id);
			$datatime['resultime'] = $resultGettime;
			$calculate_time = $resultGettime[0]['sumtime'];
			if ($resultGetsingletrip >= 1) {
				$data['result'] = $resultGetsingletrip;
				if ($resultGetsingletrip[0]['photo'] == 'no_profile.png' || $resultGetsingletrip[0]['photo'] == '') {
					$photoPath = no_profile;
				} else {
					$photoPath = driver_profile . $resultGetsingletrip[0]['driver_id'] . "/" . $resultGetsingletrip[0]['photo'];
				}
				$resultGetrating = $this->DriverModel->getdriverRating($resultGetsingletrip[0]['driver_id']);
				if ($resultGetrating >= 1) {
					$datarating['result'] = $resultGetrating;
					$ratting = number_format((float) $resultGetrating[0]['avg_rating'], 2, '.', '');
				} else {
					$ratting = "0";
				}
				/*$resultGetrating=$this->DriverModel->gettripRating($id);
	            if($resultGetrating>=1){
	            	$datarating['result'] = $resultGetrating;
	            	if($resultGetrating[0]['avg_rating'] == ""){
	            		$ratting = "0";
	            	}
	            	else{
	            		$ratting = number_format((float)$resultGetrating[0]['avg_rating'], 2, '.', '');
	            	}
	            	
	            }
	            else{
	            	$ratting = "0";
	            }*/
				$result[] = array('id' => $id, 'driver_id' => $resultGetsingletrip[0]['driver_id'], 'from_title' => $resultGetsingletrip[0]['from_title'], 'from_lat' => $resultGetsingletrip[0]['from_lat'], 'from_lng' => $resultGetsingletrip[0]['from_lng'], 'from_address' => $resultGetsingletrip[0]['from_address'], 'to_title' => $resultGetsingletrip[0]['to_title'], 'to_lat' => $resultGetsingletrip[0]['to_lat'], 'to_lng' => $resultGetsingletrip[0]['to_lng'], 'to_address' => $resultGetsingletrip[0]['to_address'], 'last_lat' => $resultGetsingletrip[0]['last_lat'], 'last_lng' => $resultGetsingletrip[0]['last_lng'], 'datetime' => $resultGetsingletrip[0]['datetime'], 'status' => $resultGetsingletrip[0]['status'], 'fullname' => $resultGetsingletrip[0]['fullname'], 'gender' => $resultGetsingletrip[0]['gender'], 'photo' => $photoPath, 'mobile_number' => $resultGetsingletrip[0]['mobile_number'], 'vehicle_number' => $resultGetsingletrip[0]['vehicle_number'], 'vehicle_type' => $resultGetsingletrip[0]['vehicle_type'], 'vehicle_name' => $resultGetsingletrip[0]['vehicle_name'], 'calculate_time' => $calculate_time, 'trip_price' => $resultGetsingletrip[0]['trip_price'], 'ratting' => $ratting, 'user_ratting' => $resultGetsingletrip[0]['user_ratting'], 'user_trip_status' => $resultGetsingletrip[0]['user_trip_status']);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	// get all trips - Home screen
	public function get_allFromlist()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$resultGettrips = $this->UserModel->getAllfromlist();
			if ($resultGettrips >= 1) {
				$data['result'] = $resultGettrips;
				foreach ($data['result'] as $getValue) {
					$result[] = array('id' => $getValue['id'], 'driver_id' => $getValue['driver_id'], 'from_title' => $getValue['from_title'], 'from_lat' => $getValue['from_lat'], 'from_lng' => $getValue['from_lng'], 'from_address' => $getValue['from_address'], 'to_title' => $getValue['to_title'], 'to_lat' => $getValue['to_lat'], 'to_lng' => $getValue['to_lng'], 'to_address' => $getValue['to_address'], 'datetime' => $getValue['datetime'], 'end_datetime' => $getValue['end_datetime'], 'status' => $getValue['status']);
					$json = array("status" => 1, "message" => "success", "data" => $result);
				}
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	// get all trips - Home screen
	public function get_allTolist()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$from_title = $post_data['from_title'];
			$resultGettrips = $this->UserModel->getAlltolist($from_title);
			if ($resultGettrips >= 1) {
				$data['result'] = $resultGettrips;
				foreach ($data['result'] as $getValue) {
					$result[] = array('id' => $getValue['id'], 'driver_id' => $getValue['driver_id'], 'from_title' => $getValue['from_title'], 'from_lat' => $getValue['from_lat'], 'from_lng' => $getValue['from_lng'], 'from_address' => $getValue['from_address'], 'to_title' => $getValue['to_title'], 'to_lat' => $getValue['to_lat'], 'to_lng' => $getValue['to_lng'], 'to_address' => $getValue['to_address'], 'datetime' => $getValue['datetime'], 'end_datetime' => $getValue['end_datetime'], 'status' => $getValue['status']);
					$json = array("status" => 1, "message" => "success", "data" => $result);
				}
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	// add user trips join
	public function user_joinTrip()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$status = $post_data['status'];
			$datetime = date("Y-m-d H:i:s");
			$data = array(
				'trip_id' => $post_data['trip_id'],
				'user_id' => $post_data['user_id'],
				'driver_id' => $post_data['driver_id'],
				'datetime' => $datetime,
				'status' => $status
			);
			$resultGetdata = $this->UserModel->check_jointrip($post_data['trip_id'], $post_data['user_id']);
			if ($resultGetdata >= 1) {
				$json = array("status" => 0, "message" => "Data already exist");
			} else {
				$resp = $this->UserModel->user_jointrips($data);
				$id = $this->db->insert_id();
				$result[] = array('id' => $id, 'trip_id' => $post_data['trip_id'], 'user_id' => $post_data['user_id'], 'driver_id' => $post_data['driver_id'], 'datetime' => $datetime);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			}
		}
		echo json_encode($json);
	}
	// add review trip
	public function user_addReview()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$user_id = $post_data['user_id'];
			$trip_id = $post_data['trip_id'];
			$driver_id = $post_data['driver_id'];
			$data = array(
				'rating' => $post_data['rating'],
				'comments' => $post_data['comments']
			);
			$resultGetdata = $this->UserModel->add_Tripreview($user_id, $trip_id, $data);
			$id = $this->db->insert_id();
			// get driver ratting
			$resultGetrating = $this->DriverModel->getdriverRating($driver_id);
			if ($resultGetrating >= 1) {
				$datarating['result'] = $resultGetrating;
				$avg_rating = number_format((float) $resultGetrating[0]['avg_rating'], 2, '.', '');
			} else {
				$avg_rating = "0";
			}
			// update ratting in driver data
			$dataratting = array(
				'ratting' => $avg_rating
			);
			$resp = $this->DriverModel->update_driver_data($driver_id, $dataratting);

			$result[] = array('trip_id' => $trip_id, 'user_id' => $user_id, 'rating' => $post_data['rating'], 'comments' => $post_data['comments']);
			$json = array("status" => 1, "message" => "success", "data" => $result);
		}
		echo json_encode($json);
	}
	// add review trip
	public function user_confirmTrip()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$id = $post_data['id'];
			$user_id = $post_data['user_id'];
			$trip_id = $post_data['trip_id'];
			$status = $post_data['status'];
			$cancel_reason = $post_data['cancel_reason'];

			// upload image- screenshot
			$photoPath = user_profile . $user_id . '/';
			if ($_FILES['trip_screenshot']['name'] != "") {
				$imagePrefix = time();
				$imagename = $user_id . $imagePrefix;
				$config['upload_path'] = './user_uploads/' . $user_id . '/';
				$config['allowed_types'] =     'gif|jpg|png|jpeg|jpe';
				$config['file_name'] = $imagename;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('trip_screenshot')) {
					$error = array('error' => $this->upload->display_errors());
				} else {
					$upload_data = $this->upload->data();
					$photo_name = $imagename . $this->upload->data('file_ext');
					$photoNewpath = $photoPath . $photo_name;
				}
			} else {
				$photoNewpath = no_map;
				$photo_name = 'no_map.png';
			}
			$data = array(
				'status' => $status,
				'cancel_reason' => $cancel_reason,
				'trip_screenshot' => $photo_name
			);
			//$resultGetdata=$this->UserModel->add_Tripreview($user_id,$trip_id,$data);
			$resultGetdata = $this->UserModel->add_Tripreview_confirm($id, $data);
			$lastid = $this->db->insert_id();
			if ($status == 'booked') {
				$peoples = explode(",", $post_data['passanger_name']);
				foreach ($peoples as $passanger) {
					$datapassanger = array(
						'trip_id' => $trip_id,
						'status' => 'booked',
						'book_id' => $id,
						'passanger_name' => $passanger
					);
					$resultAdddata = $this->UserModel->add_Passanger($datapassanger);
				}
				// send notificatio to user
				$resultGettrip = $this->UserModel->get_singletrip($trip_id);
				if ($resultGettrip >= 1) {
					$datarating['result'] = $resultGettrip;
					$device_token = $resultGettrip[0]['device_token'];
					$device_id = $resultGettrip[0]['device_id'];
					if ($device_id == "android") {
						$url = 'https://fcm.googleapis.com/fcm/send';
						$fields = array();
						$fields1 = array();
						$fields['to'] = $device_token;
						$json = array("message" => "Dear, Driver user has Confirm your trip.", "type" => 'user_confirm_trip', 'trip_id' => $trip_id);
						$fields1['message'] = json_encode($json);
						$fields1['title'] = 'TuRyde';
						$fields['data'] = $fields1;

						$fields = json_encode($fields);
						$headers = array(
							'Authorization: key=' . "AAAAtGOUWZk:APA91bHmcm1PA38CmzUX_9C9IadlDr9HYIt1KUTkgd6xIVurkK8mFSGkSYn-Q-JE1oL0Nv9TY075JFlPIhwEABDXTWCdRFC_ehKALXrBvNhj-KEqKowCAv8tXtdYKuR-tINwePMAczfk",
							'Content-Type: application/json'
						);
						$this->curl->create($url);
						$this->curl->post($fields);
						$this->curl->option(CURLOPT_HTTPHEADER, $headers);
						$result = $this->curl->execute();
						$rtn["code"]    = "000"; //means result OK
						$rtn["msg"]     = "OK";
						$rtn["result"]  = $result;
					} else {
						// ios
						$apnsHost = 'gateway.sandbox.push.apple.com';
						$apnsCert = 'Certificates_Driver.pem';
						$apnsPort = 2195;
						$apnsPass = '123456';
						$t_registration_id = str_replace('%20', '', $device_token);
						$ts_registration_id = str_replace(' ', '', $t_registration_id);
						$token = $ts_registration_id;

						$payload['aps'] = array('alert' => "Dear, Driver user has Confirm your trip.", "data" => array("type" => 'user_confirm_trip', 'trip_id' => $trip_id, "action-loc-key" => "View"), 'badge' => 1, 'sound' => 'default');
						$payload['extra_info'] = array('apns_msg' => "TuRyde Notification");
						$output = json_encode($payload);
						$token = pack('H*', str_replace(' ', '', $token));
						$apnsMessage = chr(0) . chr(0) . chr(32) . $token . chr(0) . chr(strlen($output)) . $output;

						$streamContext = stream_context_create();
						stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
						stream_context_set_option($streamContext, 'ssl', 'passphrase', $apnsPass);

						$apns = stream_socket_client('ssl://' . $apnsHost . ':' . $apnsPort, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);
						fwrite($apns, $apnsMessage);
						fclose($apns);
						$rtn["code"]	= "0001"; //means result OK
						$rtn["msg"]		= "OK";
					}
				}
			}
			if ($status == "cancel") {
				$datapassanger = array(
					'status' => 'cancel'
				);
				$resultGetdata = $this->UserModel->add_Passanger_update_bookid($id, $datapassanger);
			}
			$resultData[] = array('id' => $id, 'trip_id' => $trip_id, 'user_id' => $user_id, 'status' => $status, 'trip_screenshot' => $photoNewpath);
			$json = array("status" => 1, "message" => "success", "data" => $resultData);
		}
		echo json_encode($json);
	}
	// get user all trip history
	public function user_Tripshistory()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$user_id = $post_data['user_id'];
			$resultGetmyaddress = $this->UserModel->user_triphistory($user_id);
			if ($resultGetmyaddress >= 1) {
				$data['result'] = $resultGetmyaddress;
				// trip price
				//$trip_price = substr(str_shuffle("0123456789"), 0, 3);
				foreach ($data['result'] as $getValue) {
					// calculate time
					$resultGettime = $this->DriverModel->calculate_triptime($getValue['trip_id']);
					$datatime['resultime'] = $resultGettime;
					$calculate_time = $resultGettime[0]['sumtime'];
					// driver photo
					if ($getValue['photo'] == 'no_profile.png' || $getValue['photo'] == '') {
						$photoPath = no_profile;
					} else {
						$photoPath = driver_profile . $getValue['driver_id'] . "/" . $getValue['photo'];
					}
					// trip screenshot
					if ($getValue['trip_screenshot'] == 'no_map.png' || $getValue['trip_screenshot'] == '') {
						$trip_screenshot = no_map;
					} else {
						$trip_screenshot = user_profile . $getValue['user_id'] . "/" . $getValue['trip_screenshot'];
					}

					// profile photo
					if ($getValue['vehicle_profile'] == '') {
						$vehiclePath = no_profile;
					} else {
						$vehiclePath = driver_profile . $getValue['driver_id'] . "/" . $getValue['vehicle_profile'];
					}

					if (isset($getValue['driver_cancel_reason']) && !empty($getValue['driver_cancel_reason'])) {
						$cancel_by = 'driver';
						$cancel_reason = $getValue['driver_cancel_reason'];
					}
					if (isset($getValue['user_cancel_reason']) && !empty($getValue['user_cancel_reason'])) {
						$cancel_by = 'user';
						$cancel_reason = $getValue['user_cancel_reason'];
					}
					$resultApprovel = $this->UserModel->get_bookid($getValue['book_id']);
					if ($resultApprovel >= 1) {
						$datapassanger['result'] = $resultApprovel;
						foreach ($datapassanger['result'] as $getValue1) {
							$resultPassanger[] = array('passanger_id' => $getValue1['passanger_id'], 'trip_id' => $getValue1['trip_id'], 'passanger_name' => $getValue1['passanger_name'], 'status' => $getValue1['status']);
							$jsonPassanger = array("status" => 1, "message" => "success", "data" => $resultPassanger);
						}
						$resultPassanger = array();
					} else {
						$jsonPassanger = array();
					}
					$result[] = array('book_id' => $getValue['book_id'], 'trip_id' => $getValue['trip_id'], 'user_id' => $getValue['user_id'], 'driver_id' => $getValue['driver_id'], 'fullname' => $getValue['fullname'], 'photo' => $photoPath, 'vehicle_profile' => $vehiclePath, 'trip_screenshot' => $trip_screenshot, 'vehicle_name' => $getValue['vehicle_name'], 'rating' => $getValue['rating'], 'comments' => $getValue['comments'], 'user_trip_status' => $getValue['user_trip_status'], 'cancel_by' => $cancel_by, 'cancel_reason' => $cancel_reason, 'status' => $getValue['status'], 'datetime' => $getValue['datetime'], 'from_title' => $getValue['from_title'], 'from_lat' => $getValue['from_lat'], 'from_lng' => $getValue['from_lng'], 'from_address' => $getValue['from_address'], 'to_title' => $getValue['to_title'], 'to_lat' => $getValue['to_lat'], 'to_lng' => $getValue['to_lng'], 'to_address' => $getValue['to_address'], 'end_datetime' => $getValue['end_datetime'], 'last_lat' => $getValue['last_lat'], 'last_lng' => $getValue['last_lng'], 'calculate_time' => $calculate_time, 'trip_price' => $getValue['trip_price'], "passanger" => $jsonPassanger);
					$json = array("status" => 1, "message" => "success", "data" => $result);
				}
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}

	// cancel trip by user
	public function user_cancelTrip()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$id = $post_data['id'];
			$user_id = $post_data['user_id'];
			$trip_id = $post_data['trip_id'];
			$resultGetcanceltrip = $this->UserModel->get_canceltrip($user_id, $trip_id);
			if ($resultGetcanceltrip >= 1) {
				$data = array(
					'status' => 'cancel'
				);
				$resultGetdata = $this->UserModel->add_Tripreview_onboard($user_id, $trip_id, $data);
				$datapassanger = array(
					'status' => 'cancel'
				);
				$resultGetdata = $this->UserModel->add_Passanger_update_bookid($id, $datapassanger);
				$result[] = array('trip_id' => $trip_id, 'user_id' => $user_id, 'status' => 'cancel');
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Unable to cancel.");
			}
		}
		echo json_encode($json);
	}
	// add user trips join
	public function user_getReview()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$trip_id = $post_data['trip_id'];
			$user_id = $post_data['user_id'];
			$resultGetdata = $this->UserModel->get_userReview($trip_id, $user_id);
			if ($resultGetdata >= 1) {
				$data['result'] = $resultGetdata;
				// profile photo
				if ($resultGetdata[0]['photo'] == 'no_profile.png' || $resultGetdata[0]['photo'] == '') {
					$photoPath = no_profile;
				} else {
					$photoPath = user_profile . $resultGetdata[0]['user_id'] . "/" . $resultGetdata[0]['photo'];
				}
				$result[] = array('id' => $resultGetdata[0]['id'], 'trip_id' => $post_data['trip_id'], 'user_id' => $post_data['user_id'], 'photo' => $photoPath, 'driver_id' => $resultGetdata[0]['driver_id'], 'fname' => $resultGetdata[0]['fname'], 'lname' => $resultGetdata[0]['lname'], 'rating' => $resultGetdata[0]['rating'], 'comments' => $resultGetdata[0]['comments'], 'status' => $resultGetdata[0]['status'], 'datetime' => $resultGetdata[0]['datetime']);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}

	// add Preferences
	public function user_Preferences()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = $post_data['driver_id'];
			$user_id = $post_data['user_id'];
			$trip_id = $post_data['trip_id'];
			$music = $post_data['music'];
			$medical = $post_data['medical'];
			$data = array(
				'driver_id' => $driver_id,
				'user_id' => $user_id,
				'trip_id' => $trip_id,
				'music' => $music,
				'medical' => $medical
			);
			$resultApprovel = $this->UserModel->get_user_trip_preferences($user_id, $trip_id);
			if ($resultApprovel >= 1) {
				$data['result'] = $resultApprovel;
				$updatedata = array(
					'music' => $music,
					'medical' => $medical
				);
				$resp = $this->UserModel->update_user_preference($user_id, $trip_id, $updatedata);
				$result[] = array('driver_id' => $resultApprovel[0]['driver_id'], 'trip_id' => $trip_id, 'user_id' => $user_id, 'music' => $music, 'medical' => $medical);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$resultGetdata = $this->UserModel->add_Preferences($data);
				$id = $this->db->insert_id();
				$result[] = array('driver_id' => $driver_id, 'trip_id' => $trip_id, 'user_id' => $user_id, 'music' => $music, 'medical' => $medical);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			}
		}
		echo json_encode($json);
	}
	//get user trip preferences
	public function get_user_preferences()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$user_id = $post_data['user_id'];
			$trip_id = $post_data['trip_id'];
			$resultApprovel = $this->UserModel->get_user_trip_preferences($user_id, $trip_id);
			if ($resultApprovel >= 1) {
				$data['result'] = $resultApprovel;
				$result[] = array('user_id' => $user_id, 'trip_id' => $trip_id, 'music' => $resultApprovel[0]['music'], 'medical' => $resultApprovel[0]['medical'], 'driver_id' => $resultApprovel[0]['driver_id']);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	//get user favorite trips
	public function get_user_favoritelist()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$user_id = $post_data['user_id'];
			$resultFavorite = $this->UserModel->get_user_trip_favoritelist($user_id);
			if ($resultFavorite >= 1) {
				$data['result'] = $resultFavorite;
				foreach ($data['result'] as $getValue) {
					$resultFavoriteTrip = $this->DriverModel->getdrivertripAddress($getValue['trip_id']);
					if ($resultFavoriteTrip >= 1) {
						$dataFavorite['result'] = $resultFavoriteTrip;
						$result[] = array('user_id' => $user_id, 'trip_id' => $resultFavoriteTrip[0]['id'], 'from_title' => $resultFavoriteTrip[0]['from_title'], 'from_lat' => $resultFavoriteTrip[0]['from_lat'], 'from_lng' => $resultFavoriteTrip[0]['from_lng'], 'from_address' => $resultFavoriteTrip[0]['from_address'], 'to_title' => $resultFavoriteTrip[0]['to_title'], 'to_lat' => $resultFavoriteTrip[0]['to_lat'], 'to_lng' => $resultFavoriteTrip[0]['to_lng'], 'to_address' => $resultFavoriteTrip[0]['to_address'], 'datetime' => $resultFavoriteTrip[0]['datetime'], 'last_lat' => $resultFavoriteTrip[0]['last_lat'], 'last_lng' => $resultFavoriteTrip[0]['last_lng'], 'end_datetime' => $resultFavoriteTrip[0]['end_datetime']);
						$json = array("status" => 1, "message" => "success", "data" => $result);
					}
				}
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	// get passanger from book_id
	public function get_user_passanger()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$book_id = $post_data['book_id'];
			$resultApprovel = $this->UserModel->get_bookid($book_id);
			if ($resultApprovel >= 1) {
				$data['result'] = $resultApprovel;
				foreach ($data['result'] as $getValue) {
					$result[] = array('passanger_id' => $getValue['passanger_id'], 'trip_id' => $getValue['trip_id'], 'passanger_name' => $getValue['passanger_name'], 'status' => $getValue['status'], 'book_id' => $getValue['book_id']);
					$json = array("status" => 1, "message" => "success", "data" => $result);
				}
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	// passanger cancel trip
	public function passanger_canceltrip()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$passanger_id = explode(",", $post_data['passanger_id']);
			foreach ($passanger_id as $peoples) {
				$datapassanger = array(
					'status' => 'cancel'
				);
				$resultAdddata = $this->UserModel->add_Passanger_update($peoples, $datapassanger);
			}
			$resultData[] = array('passanger_id' => $post_data['passanger_id'], 'status' => 'cancel');
			$json = array("status" => 1, "message" => "success", "data" => $resultData);
		}
		echo json_encode($json);
	}
	// logout api
	// delete my saved address
	public function user_logout()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$user_id = $post_data['user_id'];
			$device_token = $post_data['device_token'];
			$resp = $this->UserModel->delete_user_devicetoken($user_id, $device_token);
			$result[] = array('user_id' => $user_id, 'device_token' => $device_token);
			$json = array("status" => 1, "message" => "success delete.", "data" => $result);
		}
		echo json_encode($json);
	}
}