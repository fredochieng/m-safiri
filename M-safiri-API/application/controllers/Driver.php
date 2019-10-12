<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('DriverModel');
		$this->load->model('UserModel');
		$this->load->library('Curl');
	}

	// user login data
	public function login_driver()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$data = array(
				'email' => $post_data['email'],
				'password' => md5($post_data['password'])
			);
			$resultDriverGetdata = $this->DriverModel->loginDriverdata($post_data['email'], $post_data['password']);
			if ($resultDriverGetdata >= 1) {
				$data['result'] = $resultDriverGetdata;
				$fullnamedata = array(
					'device_id' => $post_data['device_id'],
					'device_token' => $post_data['device_token']
				);
				$respfullnamedata = $this->DriverModel->update_driver_fullname($resultDriverGetdata[0]['id'], $fullnamedata);
				$result[] = array('driver_id' => $resultDriverGetdata[0]['id'], 'type' => $resultDriverGetdata[0]['type'], 'email' => $resultDriverGetdata[0]['email'], 'fullname' => $resultDriverGetdata[0]['fullname'], 'status' => $resultDriverGetdata[0]['status'], 'created_date' => $resultDriverGetdata[0]['created_date'], 'approvel' => $resultDriverGetdata[0]['approvel']);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Wrong Email or password");
			}
		}
		echo json_encode($json);
	}

	// driver registration
	public function register_driver()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$type = $post_data['type'];
			if ($type == 'individual') {
				$data = array(
					'type' => $post_data['type'],
					'fullname' => $post_data['fullname'],
					'email' => $post_data['email'],
					'password' => md5($post_data['password']),
					'old_password' => md5($post_data['password']),
					'authentication_code' => '',
					'device_id' => $post_data['device_id'],
					'device_token' => $post_data['device_token'],
					'online_status' => 'deactive',
					'approvel' => '0'
				);
				$resultGetdata = $this->DriverModel->checkDriverdata($post_data['email']);
				if ($resultGetdata >= 1) {
					$json = array("status" => 0, "message" => "Data already exist");
				} else {
					if ($post_data['email'] == "") {
						$resp = array("status" => 400, "message" =>  "Email can not empty");
					} else {
						$resp = $this->DriverModel->register_driver_data($data);
						$id = $this->db->insert_id();
						// insert into driver details
						$datadetails = array(
							'driver_id' => $id
						);
						$respdriver = $this->DriverModel->add_driverdetails($datadetails);
						// bank detals
						$bankdata = array(
							'driver_id' => $id
						);
						$respdriver = $this->DriverModel->add_bankdetails($bankdata);
						//document
						$docdata = array(
							'driver_id' => $id
						);
						$respdriver = $this->DriverModel->add_document_photo($docdata);
						// vehicle
						$vechiledata = array(
							'driver_id' => $id
						);
						$respdriver = $this->DriverModel->add_vehicledata($vechiledata);
						if (!file_exists('driver_uploads/' . $id)) {
							mkdir('driver_uploads/' . $id, 0777, true);
						}
						$result[] = array('driver_id' => $id, 'type' => $post_data['type'], 'fullname' => $post_data['fullname'], 'email' => $post_data['email']);
						$json = array("status" => 1, "message" => "success", "data" => $result);
					}
				}
			} else {
				$dataDriver = array(
					'fullname' => $post_data['fullname'],
					'email' => $post_data['email'],
					'password' => md5($post_data['password']),
					'old_password' => md5($post_data['password']),
					'authentication_code' => $post_data['authentication_code'],
					'device_id' => $post_data['device_id'],
					'device_token' => $post_data['device_token'],
					'status' => 'active',
					'approvel' => 'yes'
				);
				$resultGetdata = $this->DriverModel->checkcompanyDriverdata($post_data['email'], $post_data['authentication_code']);
				if ($resultGetdata >= 1) {
					$data['result'] = $resultGetdata;
					$resp = $this->DriverModel->update_driver_fullname($resultGetdata[0]['id'], $dataDriver);
					$result[] = array('driver_id' => $resultGetdata[0]['id'], 'type' => $post_data['type'], 'fullname' => $post_data['fullname'], 'email' => $post_data['email']);
					$json = array("status" => 1, "message" => "success", "data" => $result);
				} else {
					$json = array("status" => 0, "message" => "No data found.");
				}
			}
		}
		echo json_encode($json);
	}

	// add driver bank detail
	public function addDriver_bankdetails()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$bankdetails = array(
				'driver_id' => $post_data['driver_id'],
				'bank_name' => $post_data['bank_name'],
				'bank_payee' => $post_data['bank_payee'],
				'bank_account' => $post_data['bank_account'],
				'bank_ifsc' => $post_data['bank_ifsc'],
				'street1' => $post_data['street1'],
				'street2' => $post_data['street2'],
				'city' => $post_data['city'],
				'state' => $post_data['state'],
				'postal_code' => $post_data['postal_code'],
				'country' => $post_data['country'],
				'birthday' => $post_data['birthday']
			);
			$resultGetdata = $this->DriverModel->checkDriverbankdetails($post_data['driver_id']);
			if ($resultGetdata >= 1) {
				$json = array("status" => 0, "message" => "Data already exist");
			} else {
				$resp = $this->DriverModel->add_bankdetails($bankdetails);
				$id = $this->db->insert_id();
				$result[] = array('bank_id' => $id, 'driver_id' => $post_data['driver_id'], 'bank_name' => $post_data['bank_name'], 'bank_payee' => $post_data['bank_payee'], 'bank_account' => $post_data['bank_account'], 'bank_ifsc' => $post_data['bank_ifsc'], 'street1' => $post_data['street1'], 'street2' => $post_data['street2'], 'city' => $post_data['city'], 'state' => $post_data['state'], 'postal_code' => $post_data['postal_code'], 'country' => $post_data['country'], 'birthday' => $post_data['birthday']);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			}
		}
		echo json_encode($json);
	}

	// get driver status data
	public function getdriver_approvel()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			//$bank_id = $post_data['bank_id'];
			$email = $post_data['email'];
			$resultApprovel = $this->DriverModel->checkDriverdata($email);
			if ($resultApprovel >= 1) {
				$data['result'] = $resultApprovel;
				$result[] = array('driver_id' => $resultApprovel[0]['id'], 'type' => $resultApprovel[0]['type'], 'fullname' => $resultApprovel[0]['fullname'], 'email' => $resultApprovel[0]['email'], 'device_id' => $resultApprovel[0]['device_id'], 'device_token' => $resultApprovel[0]['device_token'], 'status' => $resultApprovel[0]['status'], 'created_date' => $resultApprovel[0]['created_date'], 'approvel' => $resultApprovel[0]['approvel']);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}

	// get driver status data
	public function getdriver_profile()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = $post_data['driver_id'];
			$resultProfile = $this->DriverModel->checkDriverprofile($driver_id);
			if ($resultProfile >= 1) {
				$data['result'] = $resultProfile;
				// profile photo
				if ($resultProfile[0]['photo'] == 'no_profile.png' || $resultProfile[0]['photo'] == '') {
					$photoPath = no_profile;
				} else {
					$photoPath = driver_profile . $resultProfile[0]['driver_id'] . "/" . $resultProfile[0]['photo'];
				}
				// profile photo
				if ($resultProfile[0]['vehicle_profile'] == '') {
					$vehiclePath = no_profile;
				} else {
					$vehiclePath = driver_profile . $resultProfile[0]['driver_id'] . "/" . $resultProfile[0]['vehicle_profile'];
				}
				$result[] = array('driver_id' => $resultProfile[0]['driver_id'], 'gender' => $resultProfile[0]['gender'], 'dob' => $resultProfile[0]['dob'], 'street' => $resultProfile[0]['street'], 'city' => $resultProfile[0]['city'], 'state' => $resultProfile[0]['state'], 'postal_code' => $resultProfile[0]['postal_code'], 'country' => $resultProfile[0]['country'], 'country_id' => $resultProfile[0]['country_id'], 'mobile_number' => $resultProfile[0]['mobile_number'], 'photo' => $photoPath, 'vehicle_profile' => $vehiclePath);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}

	// get driver bank data
	public function getdriver_bankdata()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			//$bank_id = $post_data['bank_id'];
			$driver_id = $post_data['driver_id'];
			$resultGetbankdata = $this->DriverModel->getdriverBankdata($driver_id);
			if ($resultGetbankdata >= 1) {
				$data['result'] = $resultGetbankdata;
				if ($resultGetbankdata[0]['country_id'] == "") {
					$country_id = "0";
				} else {
					$country_id = $resultGetbankdata[0]['country_id'];
				}
				$result[] = array('bank_id' => $resultGetbankdata[0]['bank_id'], 'driver_id' => $driver_id, 'bank_name' => $resultGetbankdata[0]['bank_name'], 'bank_payee' => $resultGetbankdata[0]['bank_payee'], 'bank_account' => $resultGetbankdata[0]['bank_account'], 'bank_ifsc' => $resultGetbankdata[0]['bank_ifsc'], 'street1' => $resultGetbankdata[0]['street1'], 'street2' => $resultGetbankdata[0]['street2'], 'city' => $resultGetbankdata[0]['city'], 'state' => $resultGetbankdata[0]['state'], 'postal_code' => $resultGetbankdata[0]['postal_code'], 'country' => $resultGetbankdata[0]['country'], 'country_id' => $country_id, 'birthday' => $resultGetbankdata[0]['birthday'], 'status' => $resultGetbankdata[0]['status']);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}

	// update driver bank details
	public function updateBankdetails()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = $post_data['driver_id'];
			//$bank_id = $post_data['bank_id'];
			// get driver data
			$resultGetbankdata = $this->DriverModel->getdriverBankdata($driver_id);
			$data['result'] = $resultGetbankdata;
			$bank_name = isset($post_data['bank_name']) ? $post_data['bank_name'] : $resultGetbankdata[0]['bank_name'];
			$bank_payee = isset($post_data['bank_payee']) ? $post_data['bank_payee'] : $resultGetbankdata[0]['bank_payee'];
			$bank_account = isset($post_data['bank_account']) ? $post_data['bank_account'] : $resultGetbankdata[0]['bank_account'];
			$bank_ifsc = isset($post_data['bank_ifsc']) ? $post_data['bank_ifsc'] : $resultGetbankdata[0]['bank_ifsc'];
			$city = isset($post_data['city']) ? $post_data['city'] : $resultGetbankdata[0]['city'];
			$state = isset($post_data['state']) ? $post_data['state'] : $resultGetbankdata[0]['state'];
			$postal_code = isset($post_data['postal_code']) ? $post_data['postal_code'] : $resultGetbankdata[0]['postal_code'];
			$country = isset($post_data['country']) ? $post_data['country'] : $resultGetbankdata[0]['country'];
			$street1 = isset($post_data['street1']) ? $post_data['street1'] : $resultGetbankdata[0]['street1'];
			$street2 = isset($post_data['street2']) ? $post_data['street2'] : $resultGetbankdata[0]['street2'];
			$birthday = isset($post_data['birthday']) ? $post_data['birthday'] : $resultGetbankdata[0]['birthday'];
			$status = isset($post_data['status']) ? $post_data['status'] : $resultGetbankdata[0]['status'];
			$data = array(
				'bank_name' => $bank_name,
				'bank_payee' => $bank_payee,
				'bank_account' => $bank_account,
				'bank_ifsc' => $bank_ifsc,
				'street1' => $street1,
				'street2' => $street2,
				'city' => $city,
				'state' => $state,
				'postal_code' => $postal_code,
				'country' => $country,
				'birthday' => $birthday,
				'status' => $status
			);
			$resp = $this->DriverModel->update_driver_bankdata($driver_id, $data);
			$result[] = array('bank_id' => $resultGetbankdata[0]['bank_id'], 'driver_id' => $driver_id, 'bank_name' => $bank_name, 'bank_payee' => $bank_payee, 'bank_account' => $bank_account, 'bank_ifsc' => $bank_ifsc, 'street1' => $street1, 'street2' => $street2, 'city' => $city, 'state' => $state, 'postal_code' => $postal_code, 'country' => $country, 'birthday' => $birthday, 'status' => $status);
			$json = array("status" => 1, "message" => "success", "data" => $result);
		}
		echo json_encode($json);
	}

	// get driver informations
	public function getdriver()
	{
		// echo "hgyfyfy";

		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'GET') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$id = $post_data['driver_id'];
			//$id = 8;
			// echo $id;
			// exit;
			$resultGetuser = $this->DriverModel->getDriverdata($id);
			if ($resultGetuser >= 1) {
				$data['result'] = $resultGetuser;
				// profile photo
				if ($resultGetuser[0]['photo'] == '' || $resultGetuser[0]['photo'] == 'no_profile.png') {
					$photoPath = no_profile;
				} else {
					$photoPath = driver_profile . $resultGetuser[0]['driver_id'] . "/" . $resultGetuser[0]['photo'];
				}
				// profile photo
				if ($resultGetuser[0]['vehicle_profile'] == '' || $resultGetuser[0]['vehicle_profile'] == 'no_profile.png') {
					$vehiclePath = no_profile;
				} else {
					$vehiclePath = driver_profile . $resultGetuser[0]['driver_id'] . "/" . $resultGetuser[0]['vehicle_profile'];
				}
				if ($resultGetuser[0]['country_id'] == "") {
					$country_id = "0";
				} else {
					$country_id = $resultGetuser[0]['country_id'];
				}
				$result[] = array('driver_id' => $id, 'device_id' => $resultGetuser[0]['device_id'], 'type' => $resultGetuser[0]['type'], 'fullname' => $resultGetuser[0]['fullname'], 'email' => $resultGetuser[0]['email'], 'device_id' => $resultGetuser[0]['device_id'], 'status' => $resultGetuser[0]['status'], 'created_date' => $resultGetuser[0]['created_date'], 'photo' => $photoPath, 'vehicle_profile' => $vehiclePath, 'vehicle_name' => $resultGetuser[0]['vehicle_name'], 'vehicle_number' => $resultGetuser[0]['vehicle_number'], 'gender' => $resultGetuser[0]['gender'], 'dob' => $resultGetuser[0]['dob'], 'street' => $resultGetuser[0]['street'], 'city' => $resultGetuser[0]['city'], 'state' => $resultGetuser[0]['state'], 'postal_code' => $resultGetuser[0]['postal_code'], 'country' => $resultGetuser[0]['country'], 'country_id' => $country_id, 'mobile_number' => $resultGetuser[0]['mobile_number'], 'device_id' => $resultGetuser[0]['device_id'], 'status' => $resultGetuser[0]['status'], 'approvel' => $resultGetuser[0]['approvel'], 'online_status' => $resultGetuser[0]['online_status']);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}

	// update driver profile
	public function updatedriver()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = $post_data['driver_id'];
			// get driver data
			$resultGetuser = $this->DriverModel->getDriverdata($driver_id);
			$data['result'] = $resultGetuser;
			// main table data
			$resultDrivemaintable = $this->DriverModel->checkDrivermaindata($driver_id);
			$dataresultDrivemaintable['result'] = $resultDrivemaintable;
			// profile data
			$resultDriverprofile = $this->DriverModel->checkDriverprofile($driver_id);
			$dataresultDriverprofile['result'] = $resultDriverprofile;

			$fullname = isset($post_data['fullname']) ? $post_data['fullname'] : $resultDrivemaintable[0]['fullname'];
			$gender = isset($post_data['gender']) ? $post_data['gender'] : $resultDriverprofile[0]['gender'];
			$dob = isset($post_data['dob']) ? $post_data['dob'] : $resultDriverprofile[0]['dob'];
			$street = isset($post_data['street']) ? $post_data['street'] : $resultDriverprofile[0]['street'];
			$city = isset($post_data['city']) ? $post_data['city'] : $resultDriverprofile[0]['city'];
			$state = isset($post_data['state']) ? $post_data['state'] : $resultDriverprofile[0]['state'];
			$postal_code = isset($post_data['postal_code']) ? $post_data['postal_code'] : $resultDriverprofile[0]['postal_code'];
			$country = isset($post_data['country']) ? $post_data['country'] : $resultDriverprofile[0]['country'];
			$mobile_number = isset($post_data['mobile_number']) ? $post_data['mobile_number'] : $resultDriverprofile[0]['mobile_number'];
			$status = isset($post_data['status']) ? $post_data['status'] : $resultDrivemaintable[0]['status'];
			$online_status = isset($post_data['online_status']) ? $post_data['online_status'] : $resultDrivemaintable[0]['online_status'];
			$approvel = isset($post_data['approvel']) ? $post_data['approvel'] : $resultDrivemaintable[0]['approvel'];

			$data = array(
				'gender' => $gender,
				'dob' => $dob,
				'street' => $street,
				'city' => $city,
				'state' => $state,
				'postal_code' => $postal_code,
				'country' => $country,
				'mobile_number' => $mobile_number
			);
			$fullnamedata = array(
				'fullname' => $fullname,
				'status' => $status,
				'online_status' => $online_status,
				'approvel' => $approvel
			);
			$resp = $this->DriverModel->update_driver_data($driver_id, $data);
			$respfullnamedata = $this->DriverModel->update_driver_fullname($driver_id, $fullnamedata);
			$result[] = array('driver_id' => $driver_id, 'fullname' => $fullname, 'gender' => $gender, 'dob' => $dob, 'street' => $street, 'city' => $city, 'state' => $state, 'postal_code' => $postal_code, 'country' => $country, 'mobile_number' => $mobile_number, 'status' => $status, 'approvel' => $approvel);
			$json = array("status" => 1, "message" => "success", "data" => $result);
		}
		echo json_encode($json);
	}

	// update user profile
	public function updatedriver_photo()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = $post_data['driver_id'];
			// profile photo
			$photoPath = driver_profile;
			if ($_FILES['photo']['name'] != "") {
				$imagePrefix = time();
				$imagename = $driver_id . $imagePrefix;
				$config['upload_path'] = './driver_uploads/' . $driver_id . '/';
				$config['allowed_types'] =     'gif|jpg|png|jpeg|jpe';
				$config['file_name'] = $imagename;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('photo')) {
					$error = array('error' => $this->upload->display_errors());
				} else {
					$upload_data = $this->upload->data();
					$photo_name = $imagename . $this->upload->data('file_ext');
					$photoNewpath = $photoPath . $driver_id . '/' . $photo_name;
				}
			} else {
				$photo_name = 'no_profile.png';
				$photoNewpath = user_profile . $photo_name;
			}
			// profile photo update
			$data = array(
				'photo' => $photo_name
			);
			$resp = $this->DriverModel->update_driver_photo($driver_id, $data);
			// get driver data
			//  		$resultGetdata=$this->DriverModel->getDriverdata($driver_id);
			// if($resultGetdata[0]['photo'] == 'no_profile.png' || $resultGetdata[0]['photo'] == ''){
			//      		$photoPath = no_profile;
			//      	}
			//      	else{
			//      		$photoPath = driver_profile.$resultGetdata[0]['id']."/".$resultGetdata[0]['photo'];
			//      	}
			$result[] = array('driver_id' => $driver_id, 'photo' => $photoNewpath);
			$json = array("status" => 1, "message" => "success", "data" => $result);
		}
		echo json_encode($json);
	}

	// update driver vehicle profile
	public function updatedriver_vehiclephoto()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = $post_data['driver_id'];
			// profile photo
			$photoPath = driver_profile . $driver_id . '/';
			if ($_FILES['vehicle_profile']['name'] != "") {
				$imagePrefix = time();
				$imagename = $driver_id . $imagePrefix;
				$config['upload_path'] = './driver_uploads/' . $driver_id . '/';
				$config['allowed_types'] =     'gif|jpg|png|jpeg|jpe';
				$config['file_name'] = $imagename;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('vehicle_profile')) {
					$error = array('error' => $this->upload->display_errors());
				} else {
					$upload_data = $this->upload->data();
					$photo_name = $imagename . $this->upload->data('file_ext');
					$photoNewpath = $photoPath . $photo_name;
				}
			} else {
				$photo_name = 'no_profile.png';
				$photoNewpath = $photoPath . $photo_name;
			}
			// profile photo update
			$data = array(
				'vehicle_profile' => $photo_name
			);
			$resp = $this->DriverModel->update_driver_photo($driver_id, $data);
			$result[] = array('driver_id' => $driver_id, 'vehicle_profile' => $photoNewpath);
			$json = array("status" => 1, "message" => "success", "data" => $result);
		}
		echo json_encode($json);
	}

	// sentcode email
	public function check_sentcode()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$email = $post_data['email'];
			$sentcode = $post_data['sentcode'];
			// check password
			$resultDriverGetoldpwd = $this->DriverModel->checkCodedata($email, $sentcode);
			if ($resultDriverGetoldpwd >= 1) {
				$data['result'] = $resultDriverGetoldpwd;
				/*$data = array(
                'id' => $driver_id,
                'password' => md5($newpassword),
                'old_password' => md5($newpassword)
	            );
	    		$resp = $this->DriverModel->update_driverpassword($driver_id,$data);*/
				$result[] = array('driver_id' => $resultDriverGetoldpwd[0]['id'], 'email' => $email, 'sentcode' => $sentcode);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Verification failed.");
			}
		}
		echo json_encode($json);
	}
	// change password
	public function driver_changepassword()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = isset($post_data['driver_id']) ? $post_data['driver_id'] : '';
			$newpassword = isset($post_data['password']) ? $post_data['password'] : '';
			if ($driver_id > 0) {
				$data = array(
					'password' => md5($newpassword),
					'old_password' => md5($newpassword)
				);
				$resp = $this->DriverModel->update_driverpassword($driver_id, $data);
				$result[] = array('driver_id' => $driver_id, 'password' => $newpassword);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Something goes wrong.");
			}
		}
		echo json_encode($json);
	}
	// update password
	public function update_driver_password()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = isset($post_data['driver_id']) ? $post_data['driver_id'] : '';
			$newpassword = isset($post_data['password']) ? $post_data['password'] : '';
			$old_password = isset($post_data['old_password']) ? $post_data['old_password'] : '';
			// check password
			$resultDriverGetoldpwd = $this->DriverModel->checkDriverpassword($post_data['driver_id'], md5($post_data['old_password']));
			if ($resultDriverGetoldpwd >= 1) {
				$data = array(
					'id' => $driver_id,
					'password' => md5($newpassword),
					'old_password' => md5($newpassword)
				);
				$resp = $this->DriverModel->update_driverpassword($driver_id, $data);
				$result[] = array('driver_id' => $driver_id, 'password' => $newpassword);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Password not match.");
			}
		}
		echo json_encode($json);
	}

	// driver vehicledata
	public function addVehicle()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = $post_data['driver_id'];
			$blank = $post_data['blank'];
			if ($blank == '1') {
				$vehicledata = array(
					'driver_id' => $post_data['driver_id'],
					'vehicle_name' => '',
					'vehicle_type' => '',
					'vehicle_number' => '',
					'seats' => ''
				);
				$respV = $this->DriverModel->add_vehicledata($vehicledata);
				$id = $this->db->insert_id();
				// vehicle data blank
				$data_vehicle = array(
					'vehicle_id' => $id,
					'driver_id'	=> $post_data['driver_id'],
					'photo_type'	=> '',
					'photo' => ''
				);
				//print_r($data_vehicle);
				$respVd = $this->DriverModel->add_vehicle_photo($data_vehicle);
			} else {
				$vehicledata = array(
					'driver_id' => $post_data['driver_id'],
					'vehicle_name' => $post_data['vehicle_name'],
					'vehicle_type' => $post_data['vehicle_type'],
					'vehicle_number' => $post_data['vehicle_number'],
					'seats' => $post_data['seats']
				);
				$respV = $this->DriverModel->add_vehicledata($vehicledata);
				$id = $this->db->insert_id();
				$this->db->where('driver_id', $driver_id);
				$this->db->where('vehicle_name', '');
				$this->db->delete('tbl_driver_vehicle');
				// upload photoes
				if ($_FILES['vehicle_photo']['name'] != "") {
					//echo $this->db->last_query();
					$countFile = count($_FILES['vehicle_photo']['name']);
					foreach ($_FILES['vehicle_photo']['tmp_name'] as $key => $tmp_name) {
						$temp = explode(".", $_FILES["vehicle_photo"]["name"][$key]);
						$file_name = round(microtime(true)) . $key . 'P' . '.' . end($temp);
						//$file_name = $_FILES['share_pic']['name'][$key];
						$file_size = $_FILES['vehicle_photo']['size'][$key];
						$file_tmp = $_FILES['vehicle_photo']['tmp_name'][$key];
						$file_type = $_FILES['vehicle_photo']['type'][$key];
						move_uploaded_file($file_tmp, "./driver_uploads/" . $post_data['driver_id'] . "/" . $file_name);

						$data_vehicle = array(
							'vehicle_id' => $id,
							'driver_id'	=> $post_data['driver_id'],
							'photo_type'	=> 'photo',
							'photo' => $file_name
						);
						//print_r($data_vehicle);
						$resp = $this->DriverModel->add_vehicle_photo($data_vehicle);
						$resultVehicle[] = array('vehicle_id' => $id, 'driver_id' => $post_data['driver_id'], 'photo_type'	=> 'photo', 'photo' => $file_name);
						//$jsonVehicle = array("status" => 1, "message"=>"success", "vehiclephoto" => $resultVehicle);
					}
				}

				// upload photoes
				if ($_FILES['numberplate_photo']['name'] != "") {
					$countFile = count($_FILES['numberplate_photo']['name']);
					foreach ($_FILES['numberplate_photo']['tmp_name'] as $key => $tmp_name) {
						$temp = explode(".", $_FILES["numberplate_photo"]["name"][$key]);
						$file_platname = round(microtime(true)) . $key . '.' . end($temp);
						//$file_platname = $_FILES['share_pic']['name'][$key];
						$file_size = $_FILES['numberplate_photo']['size'][$key];
						$file_tmp = $_FILES['numberplate_photo']['tmp_name'][$key];
						$file_type = $_FILES['numberplate_photo']['type'][$key];
						move_uploaded_file($file_tmp, "./driver_uploads/" . $post_data['driver_id'] . "/" . $file_platname);

						$data_vehicle = array(
							'vehicle_id' => $id,
							'driver_id'	=> $post_data['driver_id'],
							'photo_type'	=> 'plate',
							'photo' => $file_platname
						);
						//print_r($data_vehicle);
						$resp = $this->DriverModel->add_vehicle_photo($data_vehicle);
						$vehicleplate[] = array('vehicle_id' => $id, 'driver_id' => $post_data['driver_id'], 'photo_type'	=> 'plate', 'photo' => $file_platname);
						//$jsonVehicle = array("status" => 1, "message"=>"success", "vehiclephoto" => $vehicleplate);
					}
					//echo $this->db->last_query();
				}
			}
			/*$this->db->where('driver_id', $driver_id);
			$this->db->where('photo_type', '');
			$this->db->delete('tbl_vehicledetails');*/
			$result[] = array('driver_id' => $post_data['driver_id'], 'vehicle_id' => $id, 'vehicle_name' => $post_data['vehicle_name'], 'vehicle_type' => $post_data['vehicle_type'], 'vehicle_number' => $post_data['vehicle_number'], 'seats' => $post_data['seats'], "vehiclephoto" => $resultVehicle, "vehicleplate" => $vehicleplate);
			$json = array("status" => 1, "message" => "success", "data" => $result);
		}
		echo json_encode($json);
	}

	// delete number plate

	public function delete_vehiclePlate()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$id = $post_data['id'];
			$resp = $this->DriverModel->delete_numberPlate($id);
			$result[] = array('id' => $id);
			$json = array("status" => 1, "message" => "success delete.", "data" => $result);
		}
		echo json_encode($json);
	}
	// update driver Vehicle data
	public function update_vehicledata()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = $post_data['driver_id'];
			$resultGet_vehicle = $this->DriverModel->get_driver_vehicle($post_data['driver_id']);
			$data['result'] = $resultGet_vehicle;
			$vehicle_name = isset($post_data['vehicle_name']) ? $post_data['vehicle_name'] : $resultGet_vehicle[0]['vehicle_name'];
			$vehicle_type = isset($post_data['vehicle_type']) ? $post_data['vehicle_type'] : $resultGet_vehicle[0]['vehicle_type'];
			$vehicle_number = isset($post_data['vehicle_number']) ? $post_data['vehicle_number'] : $resultGet_vehicle[0]['vehicle_number'];
			$seats = isset($post_data['seats']) ? $post_data['seats'] : $resultGet_vehicle[0]['seats'];
			$data = array(
				'vehicle_name' => $vehicle_name,
				'vehicle_type' => $vehicle_type,
				'vehicle_number' => $vehicle_number,
				'seats' => $seats
			);
			$resp = $this->DriverModel->update_drivervechicledata($post_data['driver_id'], $data);
			// upload photoes
			if ($_FILES['vehicle_photo']['name'] != "") {
				$resdeletev = $this->DriverModel->delete_drivervehicledata($driver_id);
				$countFile = count($_FILES['vehicle_photo']['name']);
				foreach ($_FILES['vehicle_photo']['tmp_name'] as $key => $tmp_name) {
					$temp = explode(".", $_FILES["vehicle_photo"]["name"][$key]);
					$file_name = round(microtime(true)) . $key . 'P' . '.' . end($temp);
					//$file_name = $_FILES['share_pic']['name'][$key];
					$file_size = $_FILES['vehicle_photo']['size'][$key];
					$file_tmp = $_FILES['vehicle_photo']['tmp_name'][$key];
					$file_type = $_FILES['vehicle_photo']['type'][$key];
					move_uploaded_file($file_tmp, "./driver_uploads/" . $post_data['driver_id'] . "/" . $file_name);

					$data_vehicleplate = array(
						'vehicle_id' => $resultGet_vehicle[0]['id'],
						'driver_id'	=> $post_data['driver_id'],
						'photo_type'	=> 'photo',
						'photo' => $file_name
					);
					//print_r($data_vehicleplate);
					$resp = $this->DriverModel->add_vehicle_photo($data_vehicleplate);
					//echo $this->db->last_query();
					$resultVehicle[] = array('vehicle_id' => $resultGet_vehicle[0]['id'], 'driver_id' => $post_data['driver_id'], 'photo_type'	=> 'photo', 'photo' => $file_name);
					$jsonVehicle = array("status" => 1, "message" => "success", "vehiclephoto" => $resultVehicle);
				}
			} else {
				$jsonVehicle = array();
			}

			// upload photoes
			if ($_FILES['numberplate_photo']['name'] != "") {
				$resdeletev = $this->DriverModel->delete_drivervehicledata($driver_id);
				$countFile = count($_FILES['numberplate_photo']['name']);
				foreach ($_FILES['numberplate_photo']['tmp_name'] as $key => $tmp_name) {
					$temp = explode(".", $_FILES["numberplate_photo"]["name"][$key]);
					$file_platname = round(microtime(true)) . $key . '.' . end($temp);
					//$file_platname = $_FILES['share_pic']['name'][$key];
					$file_size = $_FILES['numberplate_photo']['size'][$key];
					$file_tmp = $_FILES['numberplate_photo']['tmp_name'][$key];
					$file_type = $_FILES['numberplate_photo']['type'][$key];
					move_uploaded_file($file_tmp, "./driver_uploads/" . $post_data['driver_id'] . "/" . $file_platname);

					$data_vehicle = array(
						'vehicle_id' => $resultGet_vehicle[0]['id'],
						'driver_id'	=> $post_data['driver_id'],
						'photo_type'	=> 'plate',
						'photo' => $file_platname
					);
					//print_r($data_vehicle);
					$resp = $this->DriverModel->add_vehicle_photo($data_vehicle);
					//echo $this->db->last_query();
					$vehicleplate[] = array('vehicle_id' => $resultGet_vehicle[0]['id'], 'driver_id' => $post_data['driver_id'], 'photo_type'	=> 'plate', 'photo' => $file_platname);
					$jsonVehicleplate = array("status" => 1, "message" => "success", "vehiclephoto" => $vehicleplate);
				}
			} else {
				$jsonVehicleplate = array();
			}
			$result[] = array('driver_id' => $post_data['driver_id'], 'vehicle_id' => $resultGet_vehicle[0]['id'], 'vehicle_name' => $vehicle_name, 'vehicle_type' => $vehicle_type, 'vehicle_number' => $vehicle_number, 'seats' => $seats, "vehiclephoto" => $jsonVehicle, "vehicleplate" => $jsonVehicleplate);
			$json = array("status" => 1, "message" => "success", "data" => $result);
		}
		echo json_encode($json);
	}

	// get all current driver trips
	public function get_Vehicledata()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = $post_data['driver_id'];
			$resultGetvehicle = $this->DriverModel->get_driverVehicledata($driver_id);
			if ($resultGetvehicle >= 1) {
				$data['result'] = $resultGetvehicle;
				//$photoPath = driver_profile.$driver_id.'/';
				foreach ($data['result'] as $getValue) {
					// profile photo
					if ($getValue['photo'] == 'no_profile.png' || $getValue['photo'] == '') {
						$photoPath = no_profile;
					} else {
						$photoPath = driver_profile . $getValue['driver_id'] . "/" . $getValue['photo'];
					}
					$result[] = array('id' => $getValue['id'], 'driver_id' => $driver_id, 'vehicle_image_id' => $getValue['vehicle_image_id'], 'vehicle_name' => $getValue['vehicle_name'], 'vehicle_type' => $getValue['vehicle_type'], 'vehicle_number' => $getValue['vehicle_number'], 'seats' => $getValue['seats'], 'created_date' => $getValue['created_date'], 'photo_type' => $getValue['photo_type'], 'photo' => $photoPath);
					$json = array("status" => 1, "message" => "success", "data" => $result);
				}
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	// add location for trip
	public function drivertripAddress()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			if ($post_data['from_title'] == $post_data['to_title']) {
				$json = array("status" => 0, "message" => "Pickup and Destination should not be same.");
			} else {
				$resultTripdata = $this->DriverModel->checkTrip_pricedata($post_data['from_title'], $post_data['to_title']);
				if ($resultTripdata >= 1) {
					$dataTrip_price['result'] = $resultTripdata;
					//$resultdata_next=$this->DriverModel->checkTripdata($post_data['driver_id'],$post_data['from_title'],$post_data['to_title'],$post_data['datetime']);
					$resultdata_next = $this->DriverModel->checkTripdata($post_data['driver_id'], $post_data['datetime']);
					//echo $this->db->last_query();
					if ($resultdata_next >= 1) {
						$json = array("status" => 0, "message" => "Data already exist.");
					} else {
						$resultdata = $this->DriverModel->checkTripdata_before($post_data['driver_id'], $post_data['datetime']);
						if ($resultdata >= 1) {
							$json = array("status" => 0, "message" => "Add trip after some time.");
						} else {
							$data = array(
								'driver_id' => $post_data['driver_id'],
								'from_title' => $post_data['from_title'],
								'from_lat' => $post_data['from_lat'],
								'from_lng' => $post_data['from_lng'],
								'from_address' => $post_data['from_address'],
								'to_title' => $post_data['to_title'],
								'to_lat' => $post_data['to_lat'],
								'to_lng' => $post_data['to_lng'],
								'to_address' => $post_data['to_address'],
								'datetime' => $post_data['datetime'],
								'notify_datetime' => $post_data['datetime'],
								'end_datetime' => $post_data['end_datetime'],
								'trip_price' => $resultTripdata[0]['price']
							);
							$resultGetdata = $this->DriverModel->set_drivertrip($data);
							$id = $this->db->insert_id();

							// calculate time
							$resultGettime = $this->DriverModel->calculate_triptime($id);
							$datatime['resultime'] = $resultGettime;
							$calculate_time = $resultGettime[0]['sumtime'];
							$result[] = array('id' => $id, 'driver_id' => $post_data['driver_id'], 'from_title' => $post_data['from_title'], 'from_lat' => $post_data['from_lat'], 'from_lng' => $post_data['from_lng'], 'from_address' => $post_data['from_address'], 'to_title' => $post_data['to_title'], 'to_lat' => $post_data['to_lat'], 'to_lng' => $post_data['to_lng'], 'to_address' => $post_data['to_address'], 'datetime' => $post_data['datetime'], 'end_datetime' => $post_data['end_datetime'], 'trip_price' => $resultTripdata[0]['price'], 'calculate_time' => $calculate_time);
							$json = array("status" => 1, "message" => "success", "data" => $result);
						}
					}
				} else {
					$json = array("status" => 0, "message" => "Price not defined.Please contact your Admin.");
				}
			}
		}
		echo json_encode($json);
	}
	// get driver single trip
	public function getdriver_singletrip()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$id = $post_data['id'];
			$resultGettrip = $this->DriverModel->getdrivertripAddress($id);
			if ($resultGettrip >= 1) {
				$data['result'] = $resultGettrip;
				$result[] = array('id' => $id, 'driver_id' => $resultGettrip[0]['driver_id'], 'from_title' => $resultGettrip[0]['from_title'], 'from_lat' => $resultGettrip[0]['from_lat'], 'from_lng' => $resultGettrip[0]['from_lng'], 'from_address' => $resultGettrip[0]['from_address'], 'to_title' => $resultGettrip[0]['to_title'], 'to_lat' => $resultGettrip[0]['to_lat'], 'to_lng' => $resultGettrip[0]['to_lng'], 'to_address' => $resultGettrip[0]['to_address'], 'datetime' => $resultGettrip[0]['datetime'], 'end_datetime' => $resultGettrip[0]['end_datetime'], 'status' => $resultGettrip[0]['status']);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}

	// Trip detail screen
	public function driver_tripdetails()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$trip_id = $post_data['trip_id'];
			$resultGettrip = $this->DriverModel->getdrivertripAddress($trip_id);
			if ($resultGettrip >= 1) {
				$data['result'] = $resultGettrip;
				// count passenget , rating
				if ($resultGettrip[0]['status'] == 'cancel') {
					$resultGetpassengerrating = $this->DriverModel->get_trippassanger_cancel($trip_id);
				} else {
					$resultGetpassengerrating = $this->DriverModel->get_trippassanger_complete($trip_id);
				}

				if ($resultGetpassengerrating >= 1) {
					$datapassenger['result'] = $resultGetpassengerrating;
					$countPassenger = count($datapassenger['result']);
					if ($countPassenger == "") {
						$countPassenger = 0;
					} else {
						$countPassenger = count($datapassenger['result']);
					}
					$resultGetrating = $this->DriverModel->gettripRating($trip_id);
					if ($resultGetrating >= 1) {
						$datarating['result'] = $resultGetrating;
						if ($resultGetrating[0]['avg_rating'] == "") {
							$ratting = "0";
						} else {
							$ratting = number_format((float) $resultGetrating[0]['avg_rating'], 2, '.', '');
						}
					} else {
						$ratting = "0";
					}
				} else {
					$ratting = "0";
					$countPassenger = 0;
				}
				if ($resultGettrip[0]['trip_map_screenshot'] == 'no_map.png' || $resultGettrip[0]['trip_map_screenshot'] == '') {
					$photoPath = no_map;
				} else {
					$photoPath = driver_profile . $resultGettrip[0]['driver_id'] . "/" . $resultGettrip[0]['trip_map_screenshot'];
				}
				$result[] = array('trip_id' => $trip_id, 'driver_id' => $resultGettrip[0]['driver_id'], 'from_title' => $resultGettrip[0]['from_title'], 'from_lat' => $resultGettrip[0]['from_lat'], 'from_lng' => $resultGettrip[0]['from_lng'], 'from_address' => $resultGettrip[0]['from_address'], 'to_title' => $resultGettrip[0]['to_title'], 'to_lat' => $resultGettrip[0]['to_lat'], 'to_lng' => $resultGettrip[0]['to_lng'], 'to_address' => $resultGettrip[0]['to_address'], 'datetime' => $resultGettrip[0]['datetime'], 'end_datetime' => $resultGettrip[0]['end_datetime'], 'trip_map_screenshot' => $photoPath, 'status' => $resultGettrip[0]['status'], 'total_passenger' => $countPassenger, 'ratting' => $ratting);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	// update location for trip
	public function update_drivertripAddress()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$id = $post_data['id'];
			// get driver data
			$resultGettrip = $this->DriverModel->getdrivertripAddress($id);
			$data['result'] = $resultGettrip;
			// datetime
			if (isset($post_data['delaytime']) && !empty($post_data['delaytime']) && $post_data['delaytime'] == "yes") {
				$datetime = date('Y-m-d H:i:s', strtotime('+30 minutes', strtotime($resultGettrip[0]['datetime'])));

				$end_datetime = date('Y-m-d H:i:s', strtotime('+30 minutes', strtotime($resultGettrip[0]['end_datetime'])));
				// send notification to all trip users
				$resultGettripUserlist = $this->DriverModel->get_tripallusers($id);
				if ($resultGettripUserlist >= 1) {
					$datalist['result'] = $resultGettripUserlist;

					foreach ($datalist['result'] as $getValue) {
						// get multiple device token
						$resultGetdevicedata = $this->DriverModel->get_user_devicedata($getValue['user_id']);
						if ($resultGetdevicedata >= 1) {
							$datadevice['result'] = $resultGetdevicedata;

							foreach ($datadevice['result'] as $getDevicevalue) {
								// notification code
								$device_token = $getDevicevalue['device_token'];
								if ($getDevicevalue['device_id'] == 'android') {
									$url = 'https://fcm.googleapis.com/fcm/send';
									$fields = array();
									$fields1 = array();
									$fields['to'] = $device_token;
									$json = array("message" => "Dear, User your upcoming trip has been delayed.", "type" => 'delay_trip', "trip_id" => $id);
									$fields1['message'] = json_encode($json);
									$fields1['title'] = 'TuRyde';
									//$fields['type'] = 'user_reminder';
									$fields['data'] = $fields1;

									$fields = json_encode($fields);
									$headers = array(
										'Authorization: key=' . "AAAAfadO3yo:APA91bGdQj7W4BuRZ2DZmwaBWoIcDbG4-6Ka8FgHEIbqCK6d5pJws8fE_ItZWH3OIALz7tJAQrqdl1xhr6ZROtluNK-ZeremEoabt11MIREru211InBApZ1_NeGofeAnW4p7W1ExZlzy",
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
									$apnsCert = 'Certificates.pem';
									$apnsPort = 2195;
									$apnsPass = '123456';
									$t_registration_id = str_replace('%20', '', $device_token);
									$ts_registration_id = str_replace(' ', '', $t_registration_id);
									$token = $ts_registration_id;

									$payload['aps'] = array('alert' => "Dear, User your upcoming trip has been delayed.", "data" => array("type" => 'delay_trip', "trip_id" => $id, "action-loc-key" => "View"), 'badge' => 1, 'sound' => 'default');
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
					}
				}
			} else {
				$datetime = isset($post_data['datetime']) ? $post_data['datetime'] : $resultGettrip[0]['datetime'];
				$end_datetime = isset($post_data['end_datetime']) ? $post_data['end_datetime'] : $resultGettrip[0]['end_datetime'];
			}

			$driver_id = isset($post_data['driver_id']) ? $post_data['driver_id'] : $resultGettrip[0]['driver_id'];
			$from_title = isset($post_data['from_title']) ? $post_data['from_title'] : $resultGettrip[0]['from_title'];
			$from_lat = isset($post_data['from_lat']) ? $post_data['from_lat'] : $resultGettrip[0]['from_lat'];
			$from_lng = isset($post_data['from_lng']) ? $post_data['from_lng'] : $resultGettrip[0]['from_lng'];
			$from_address = isset($post_data['from_address']) ? $post_data['from_address'] : $resultGettrip[0]['from_address'];
			$to_title = isset($post_data['to_title']) ? $post_data['to_title'] : $resultGettrip[0]['to_title'];
			$to_lat = isset($post_data['to_lat']) ? $post_data['to_lat'] : $resultGettrip[0]['to_lat'];
			$to_lng = isset($post_data['to_lng']) ? $post_data['to_lng'] : $resultGettrip[0]['to_lng'];
			$to_address = isset($post_data['to_address']) ? $post_data['to_address'] : $resultGettrip[0]['to_address'];
			$cancel_reason = isset($post_data['cancel_reason']) ? $post_data['cancel_reason'] : $resultGettrip[0]['cancel_reason'];
			$status = isset($post_data['status']) ? $post_data['status'] : $resultGettrip[0]['status'];
			// upload image- screenshot
			$photoPath = driver_profile . $driver_id . '/';
			if ($_FILES['trip_map_screenshot']['name'] != "") {
				$imagePrefix = time();
				$imagename = $driver_id . $imagePrefix;
				$config['upload_path'] = './driver_uploads/' . $driver_id . '/';
				$config['allowed_types'] =     'gif|jpg|png|jpeg|jpe';
				$config['file_name'] = $imagename;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('trip_map_screenshot')) {
					$error = array('error' => $this->upload->display_errors());
				} else {
					$upload_data = $this->upload->data();
					$photo_name = $imagename . $this->upload->data('file_ext');
					$photoNewpath = $photoPath . $photo_name;
				}
			} else {
				$photoNewpath = no_map;
				$photo_name = $resultGettrip[0]['trip_map_screenshot'];
			}
			$data = array(
				'driver_id' => $driver_id,
				'from_title' => $from_title,
				'from_lat' => $from_lat,
				'from_lng' => $from_lng,
				'from_address' => $from_address,
				'to_title' => $to_title,
				'to_lat' => $to_lat,
				'to_lng' => $to_lng,
				'trip_map_screenshot' => $photo_name,
				'cancel_reason' => $cancel_reason,
				'to_address' => $to_address,
				'datetime'	=> $datetime,
				'end_datetime'	=> $end_datetime,
				'status' => $status
			);
			if ($status == 'active') {
				if ($resultGettrip[0]['trip_price'] == "" && empty($resultGettrip[0]['trip_price']) || $resultGettrip[0]['trip_price'] == '0') {
					$json = array("status" => 0, "message" => "Admin have not added trip price.");
				} else {
					$resultGetdata = $this->DriverModel->update_drivertrip($id, $data);
					// calculate time
					$resultGettime = $this->DriverModel->calculate_triptime($id);
					$datatime['resultime'] = $resultGettime;
					$calculate_time = $resultGettime[0]['sumtime'];

					$resultData[] = array(
						'id' => $id, 'driver_id' => $driver_id, 'from_title' => $from_title, 'from_lat' => $from_lat, 'from_lng' => $from_lng,
						'from_address' => $from_address, 'to_title' => $to_title,
						'to_lat' => $to_lat, 'to_lng' => $to_lng, 'to_address' => $to_address, 'datetime' => $datetime, 'end_datetime'	=> $end_datetime, 'calculate_time' => $calculate_time, 'status' => $status, 'trip_map_screenshot' => $photoNewpath
					);
					$json = array("status" => 1, "message" => "success", "data" => $resultData);
				}
			} elseif ($status == 'cancel') {
				$datapassanger = array(
					'status' => 'cancel'
				);
				$resultGetdata = $this->UserModel->add_Passanger_update_trip($id, $datapassanger);
				$resultGetdata = $this->DriverModel->update_drivertrip($id, $data);
				// send notification to all trip users
				$resultGettripUserlistcancel = $this->DriverModel->get_tripallusersdata($id);
				if ($resultGettripUserlistcancel >= 1) {
					$datacancel['result'] = $resultGettripUserlistcancel;

					foreach ($datacancel['result'] as $getValue1) {
						// get user data
						$resultGetuser = $this->UserModel->getUserdata($getValue1['user_id']);
						// update user status
						$dataupdate = array(
							'status' => 'cancel'
						);
						$resultGetdata = $this->UserModel->add_Tripreview_onboard($getValue1['user_id'], $id, $dataupdate);
						// get multiple device token
						$resultGetdevicedata = $this->DriverModel->get_user_devicedata($getValue1['user_id']);
						if ($resultGetdevicedata >= 1) {
							$datadevice['result'] = $resultGetdevicedata;

							foreach ($datadevice['result'] as $getDevicevalue) {
								$device_token = $getDevicevalue['device_token'];
								$device_id = $getDevicevalue['device_id'];
								// notification code
								if ($device_id == "android") {
									$url = 'https://fcm.googleapis.com/fcm/send';
									$fields = array();
									$fields1 = array();
									$fields['to'] = $device_token;
									$json = array("message" => "Dear, User your upcoming trip has been cancelled.", "type" => 'cancel_trip', "trip_id" => $id);
									$fields1['message'] = json_encode($json);
									$fields1['title'] = 'TuRyde';
									//$fields['type'] = 'user_reminder';
									$fields['data'] = $fields1;
									$fields = json_encode($fields);
									$headers = array(
										'Authorization: key=' . "AAAAfadO3yo:APA91bGdQj7W4BuRZ2DZmwaBWoIcDbG4-6Ka8FgHEIbqCK6d5pJws8fE_ItZWH3OIALz7tJAQrqdl1xhr6ZROtluNK-ZeremEoabt11MIREru211InBApZ1_NeGofeAnW4p7W1ExZlzy",
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
									$apnsCert = 'Certificates.pem';
									$apnsPort = 2195;
									$apnsPass = '123456';
									$t_registration_id = str_replace('%20', '', $device_token);
									$ts_registration_id = str_replace(' ', '', $t_registration_id);
									$token = $ts_registration_id;

									$payload['aps'] = array('alert' => 'Dear, User your upcoming trip has been cancelled.', 'data' => array("type" => 'cancel_trip', "trip_id" => $id, "action-loc-key" => "View"), 'badge' => 1, 'sound' => 'default');
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
					}
				}
				// calculate time
				$resultGettime = $this->DriverModel->calculate_triptime($id);
				$datatime['resultime'] = $resultGettime;
				$calculate_time = $resultGettime[0]['sumtime'];

				$resultData[] = array(
					'id' => $id, 'driver_id' => $driver_id, 'from_title' => $from_title, 'from_lat' => $from_lat, 'from_lng' => $from_lng,
					'from_address' => $from_address, 'to_title' => $to_title,
					'to_lat' => $to_lat, 'to_lng' => $to_lng, 'to_address' => $to_address, 'datetime' => $datetime, 'end_datetime'	=> $end_datetime, 'calculate_time' => $calculate_time, 'status' => $status, 'trip_map_screenshot' => $photoNewpath
				);
				$json = array("status" => 1, "message" => "success", "data" => $resultData);
			} elseif ($status == 'deactive') {
				$resultGetdata = $this->DriverModel->update_drivertrip($id, $data);
				// send notification to all trip users
				$resultGettripUserlistcompleted = $this->DriverModel->get_tripallusers_completed($id);
				if ($resultGettripUserlistcompleted >= 1) {
					$datacomplete['result'] = $resultGettripUserlistcompleted;
					$datapassanger = array(
						'status' => 'completed'
					);
					$resultGetdata = $this->UserModel->add_Passanger_update_trip_complete($id, $datapassanger);
					foreach ($datacomplete['result'] as $getValuec) {
						// update user status
						$dataupdate = array(
							'status' => 'completed'
						);
						$resultGetdata = $this->UserModel->add_Tripreview_complete($getValuec['user_id'], $id, $dataupdate);
						// get multiple device token
						$resultGetdevicedata = $this->DriverModel->get_user_devicedata($getValuec['user_id']);
						if ($resultGetdevicedata >= 1) {
							$datadevice['result'] = $resultGetdevicedata;

							foreach ($datadevice['result'] as $getDevicevalue) {
								// notification code
								$device_token = $getDevicevalue['device_token'];
								if ($getDevicevalue['device_id'] == "android") {
									$url = 'https://fcm.googleapis.com/fcm/send';
									$fields = array();
									$fields1 = array();
									$fields['to'] = $device_token;
									$json = array("message" => "Dear, User your trip has been completed.", "type" => 'complete_trip', "trip_id" => $id);
									$fields1['message'] = json_encode($json);
									$fields1['title'] = 'TuRyde';
									//$fields['type'] = 'user_reminder';
									$fields['data'] = $fields1;
									$fields = json_encode($fields);
									$headers = array(
										'Authorization: key=' . "AAAAfadO3yo:APA91bGdQj7W4BuRZ2DZmwaBWoIcDbG4-6Ka8FgHEIbqCK6d5pJws8fE_ItZWH3OIALz7tJAQrqdl1xhr6ZROtluNK-ZeremEoabt11MIREru211InBApZ1_NeGofeAnW4p7W1ExZlzy",
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
									$apnsCert = 'Certificates.pem';
									$apnsPort = 2195;
									$apnsPass = '123456';
									$t_registration_id = str_replace('%20', '', $device_token);
									$ts_registration_id = str_replace(' ', '', $t_registration_id);
									$token = $ts_registration_id;

									$payload['aps'] = array('alert' => 'Dear, User your trip has been completed.', 'data' => array("type" => 'complete_trip', "trip_id" => $id, "action-loc-key" => "View"), 'badge' => 1, 'sound' => 'default');
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
					}
				}
				// calculate time
				$resultGettime = $this->DriverModel->calculate_triptime($id);
				$datatime['resultime'] = $resultGettime;
				$calculate_time = $resultGettime[0]['sumtime'];

				$resultData[] = array(
					'id' => $id, 'driver_id' => $driver_id, 'from_title' => $from_title, 'from_lat' => $from_lat, 'from_lng' => $from_lng,
					'from_address' => $from_address, 'to_title' => $to_title,
					'to_lat' => $to_lat, 'to_lng' => $to_lng, 'to_address' => $to_address, 'datetime' => $datetime, 'end_datetime'	=> $end_datetime, 'calculate_time' => $calculate_time, 'status' => $status, 'trip_map_screenshot' => $photoNewpath
				);
				$json = array("status" => 1, "message" => "success", "data" => $resultData);
			} elseif ($status == 'ongoing') {
				// onboard
				// if($status == "ongoing"){
				// 	$datapassanger = array(
				//            'status' => 'onboard'
				//        );
				// 	$resultGetdatatrip=$this->UserModel->add_Passanger_onboard($id,$datapassanger);
				// }
				$resultGetdata = $this->DriverModel->update_drivertrip($id, $data);
				// send notification to all trip users
				$resultGettripUserlistonbooked = $this->DriverModel->get_tripallusersdata($id);
				if ($resultGettripUserlistonbooked >= 1) {
					$databooked['result'] = $resultGettripUserlistonbooked;

					foreach ($databooked['result'] as $getValue1) {
						// get user data
						$resultGetuser = $this->UserModel->getUserdata($getValue1['user_id']);
						// update user status
						$dataupdate = array(
							'status' => 'onboard'
						);
						$resultGetdata = $this->UserModel->add_Tripreview_onboard($getValue1['user_id'], $id, $dataupdate);
						// notification code
						// get multiple device token
						$resultGetdevicedata = $this->DriverModel->get_user_devicedata($getValue1['user_id']);
						if ($resultGetdevicedata >= 1) {
							$datadevice['result'] = $resultGetdevicedata;

							foreach ($datadevice['result'] as $getDevicevalue) {
								$device_token = $getDevicevalue['device_token'];
								$device_id = $getDevicevalue['device_id'];
								if ($device_id == "android") {
									// notification code
									$url = 'https://fcm.googleapis.com/fcm/send';
									$fields = array();
									$fields1 = array();
									$fields['to'] = $device_token;
									$json = array("message" => "Dear, User you have onboarded the Trip.", "type" => 'onboard_trip', "trip_id" => $id);
									$fields1['message'] = json_encode($json);
									$fields1['title'] = 'TuRyde';
									//$fields['type'] = 'user_reminder';
									$fields['data'] = $fields1;
									$fields = json_encode($fields);
									$headers = array(
										'Authorization: key=' . "AAAAfadO3yo:APA91bGdQj7W4BuRZ2DZmwaBWoIcDbG4-6Ka8FgHEIbqCK6d5pJws8fE_ItZWH3OIALz7tJAQrqdl1xhr6ZROtluNK-ZeremEoabt11MIREru211InBApZ1_NeGofeAnW4p7W1ExZlzy",
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
									$apnsCert = 'Certificates.pem';
									$apnsPort = 2195;
									$apnsPass = '123456';
									$t_registration_id = str_replace('%20', '', $device_token);
									$ts_registration_id = str_replace(' ', '', $t_registration_id);
									$token = $ts_registration_id;

									$payload['aps'] = array('alert' => 'Dear, User your trip is onboard.', 'data' => array("type" => 'onboard_trip', "trip_id" => $id, "action-loc-key" => "View"), 'badge' => 1, 'sound' => 'default');
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
					}
				}
				// calculate time
				$resultGettime = $this->DriverModel->calculate_triptime($id);
				$datatime['resultime'] = $resultGettime;
				$calculate_time = $resultGettime[0]['sumtime'];

				$resultData[] = array(
					'id' => $id, 'driver_id' => $driver_id, 'from_title' => $from_title, 'from_lat' => $from_lat, 'from_lng' => $from_lng,
					'from_address' => $from_address, 'to_title' => $to_title,
					'to_lat' => $to_lat, 'to_lng' => $to_lng, 'to_address' => $to_address, 'datetime' => $datetime, 'end_datetime'	=> $end_datetime, 'calculate_time' => $calculate_time, 'status' => $status, 'trip_map_screenshot' => $photoNewpath
				);
				$json = array("status" => 1, "message" => "success", "data" => $resultData);
			} else {
				$resultGetdata = $this->DriverModel->update_drivertrip($id, $data);
				// calculate time
				$resultGettime = $this->DriverModel->calculate_triptime($id);
				$datatime['resultime'] = $resultGettime;
				$calculate_time = $resultGettime[0]['sumtime'];

				$resultData[] = array(
					'id' => $id, 'driver_id' => $driver_id, 'from_title' => $from_title, 'from_lat' => $from_lat, 'from_lng' => $from_lng,
					'from_address' => $from_address, 'to_title' => $to_title,
					'to_lat' => $to_lat, 'to_lng' => $to_lng, 'to_address' => $to_address, 'datetime' => $datetime, 'end_datetime'	=> $end_datetime, 'calculate_time' => $calculate_time, 'status' => $status, 'trip_map_screenshot' => $photoNewpath
				);
				$json = array("status" => 1, "message" => "success", "data" => $resultData);
			}
		}
		echo json_encode($json);
	}
	// delete driver trip Address
	public function delete_drivertripAddress()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$id = $post_data['id'];
			$resp = $this->DriverModel->delete_tripAddress($id);
			$result[] = array('id' => $id);
			$json = array("status" => 1, "message" => "success delete.", "data" => $result);
		}
		echo json_encode($json);
	}
	// get all current driver trips
	public function current_driverTrips()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = $post_data['driver_id'];
			$trip_type = $post_data['trip_type'];
			$sort_by = $post_data['sort_by'];
			if ($trip_type == 'current') {
				$resultGetmyaddress = $this->DriverModel->getcurrentTrips($driver_id, $sort_by);
			}
			if ($trip_type == 'past') {
				$resultGetmyaddress = $this->DriverModel->getpastTrips($driver_id);
			}
			if ($trip_type == 'upcoming') {
				$resultGetmyaddress = $this->DriverModel->getupcomingTrips($driver_id);
			}
			if ($trip_type == 'history') {
				$resultGetmyaddress = $this->DriverModel->getTriphistory($driver_id);
			}
			//$trip_price = substr(str_shuffle("0123456789"), 0, 3);

			if ($resultGetmyaddress >= 1) {
				$data['result'] = $resultGetmyaddress;
				$counttripresult = count($data['result']);
				foreach ($data['result'] as $getValue) {
					// count booked passanger
					$resultGetpassanger = $this->DriverModel->countbookedpassanger($getValue['id']);
					if ($resultGetpassanger >= 1) {
						$datapassanger['result'] = $resultGetpassanger;
						$countpassanger = count($datapassanger['result']);
					} else {
						$countpassanger = 0;
					}
					$result[] = array('id' => $getValue['id'], 'trip_type' => $post_data['trip_type'], 'driver_id' => $driver_id, 'from_title' => $getValue['from_title'], 'from_lat' => $getValue['from_lat'], 'from_lng' => $getValue['from_lng'], 'from_address' => $getValue['from_address'], 'to_title' => $getValue['to_title'], 'to_lat' => $getValue['to_lat'], 'to_lng' => $getValue['to_lng'], 'to_address' => $getValue['to_address'], 'datetime' => $getValue['datetime'], 'end_datetime' => $getValue['end_datetime'], 'status' => $getValue['status'], 'trip_price' => $getValue['trip_price'], 'count_trip' => $counttripresult, 'countpassanger' => $countpassanger);
					$json = array("status" => 1, "message" => "success", "data" => $result);
				}
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	// get trip userlist
	public function get_Tripuserlist()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$trip_id = $post_data['trip_id'];
			$resultGettripUserlist = $this->DriverModel->get_tripallusers($trip_id);

			if ($resultGettripUserlist >= 1) {
				$data['result'] = $resultGettripUserlist;
				//$countBookedseats = count($data['result']);
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
				//$countBookedseats = $countBookedseats1 + $countBookedseats2;
				// get driver vehicle seats
				$resultGetdriverseats = $this->DriverModel->get_driver_vehicle($resultGettripUserlist[0]['driver_id']);
				$dataseats['result'] = $resultGetdriverseats;
				$vehicleseats = $resultGetdriverseats[0]['seats'];
				$countRemainingseats = $vehicleseats - $countBookedseats2;
				foreach ($data['result'] as $getValue) {
					//$photoPath = user_profile.$getValue['user_id'].'/';
					// profile photo
					if ($getValue['photo'] == 'no_profile.png' || $getValue['photo'] == '') {
						$photoPath = no_profile;
					} else {
						$photoPath = user_profile . $getValue['user_id'] . "/" . $getValue['photo'];
					}
					// get passanger name
					$resultGettrippassanger = $this->DriverModel->get_trippassanger($getValue['id']);
					if ($resultGettrippassanger >= 1) {
						$datapassanger['result'] = $resultGettrippassanger;
						foreach ($datapassanger['result'] as $getPassanger) {
							$resultPassanger[] = array('passanger_id' => $getPassanger['passanger_id'], 'passanger_name' => $getPassanger['passanger_name'], 'book_id' => $getPassanger['book_id']);
							$jsonPassanger = array("status" => 1, "message" => "success", "data" => $resultPassanger);
						}
						$resultPassanger = array();
					} else {
						$jsonPassanger = array();
					}

					$result[] = array('id' => $getValue['id'], 'user_id' => $getValue['user_id'], 'driver_id' => $getValue['driver_id'], 'rating' => $getValue['rating'], 'status' => $getValue['status'], 'datetime' => $getValue['datetime'], 'fname' => $getValue['fname'], 'lname' => $getValue['lname'], 'photo' => $photoPath, "passanger" => $jsonPassanger);
					$json = array("status" => 1, "message" => "success", "countBookedseats" => $countBookedseats2, 'countRemainingseats' => $countRemainingseats, "data" => $result);
				}
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}

	// Ratting screen
	public function driver_rattingscreen()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = $post_data['driver_id'];
			$resultGettrip = $this->DriverModel->getallactiveTrips($driver_id);
			if ($resultGettrip >= 1) {
				$data['result'] = $resultGettrip;
				$lifitimeTrip = count($data['result']);
				if ($lifitimeTrip == "") {
					$lifitimeTrip = 0;
				} else {
					$lifitimeTrip = count($data['result']);
				}
				$resultGetrating = $this->DriverModel->getdriverRating($driver_id);
				if ($resultGetrating >= 1) {
					$datarating['result'] = $resultGetrating;
					$avg_rating = number_format((float) $resultGetrating[0]['avg_rating'], 2, '.', '');
				} else {
					$avg_rating = "0";
				}
				// count 4 rated
				$resultFourrated = $this->DriverModel->getfourratedTrips($driver_id);
				$datafourrate['fourrate'] = $resultFourrated;
				$fourstar = count($datafourrate['fourrate']);
				if ($fourstar == "") {
					$fourstar = 0;
				} else {
					$fourstar = count($datafourrate['fourrate']);
				}
				// count rated
				$resultGetrated = $this->DriverModel->getallratedTrips($driver_id);
				$datarate['resultrate'] = $resultGetrated;
				$ratedtrip = count($datarate['resultrate']);
				if ($ratedtrip == "") {
					$ratedtrip = 0;
				} else {
					$ratedtrip = count($datarate['resultrate']);
				}
				foreach ($datarate['resultrate'] as $getValue) {
					//$photoPath = user_profile.$getValue['user_id'].'/';
					if ($getValue['photo'] == 'no_profile.png' || $getValue['photo'] == '') {
						$photoPath = no_profile;
					} else {
						$photoPath = user_profile . $getValue['user_id'] . "/" . $getValue['photo'];
					}
					$resultrated[] = array('trip_id' => $getValue['trip_id'], 'user_id' => $getValue['user_id'], 'driver_id' => $getValue['driver_id'], 'rating' => $getValue['rating'], 'comments' => $getValue['comments'], 'status' => $getValue['status'], 'datetime' => $getValue['datetime'], 'fname' => $getValue['fname'], 'lname' => $getValue['lname'], 'photo' => $photoPath);
					$jsonRateduser = array("status" => 1, "message" => "success", "datauser" => $resultrated);
				}
				$result[] = array('avg_rating' => $avg_rating, 'lifitimeTrip' => $lifitimeTrip, 'ratedtrip' => $ratedtrip, 'fourstar' => $fourstar, 'ratedusers' => $jsonRateduser);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	// driver documents
	public function addDocuments()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = $post_data['driver_id'];
			$photo_type = $post_data['photo_type'];
			$blank = $post_data['blank'];
			// upload photoes
			if ($_FILES['driving_livence']['name'] != "") {
				$countFile = count($_FILES['driving_livence']['name']);
				foreach ($_FILES['driving_livence']['tmp_name'] as $key => $tmp_name) {
					$temp = explode(".", $_FILES["driving_livence"]["name"][$key]);
					$file_name = round(microtime(true)) . $key . 'L' . '.' . end($temp);
					//$file_name = $_FILES['share_pic']['name'][$key];
					$file_size = $_FILES['driving_livence']['size'][$key];
					$file_tmp = $_FILES['driving_livence']['tmp_name'][$key];
					$file_type = $_FILES['driving_livence']['type'][$key];
					move_uploaded_file($file_tmp, "./driver_uploads/" . $post_data['driver_id'] . "/" . $file_name);

					$documents = array(
						'driver_id'	=> $driver_id,
						'photo_type'	=> 'licence',
						'photo' => $file_name
					);
					//print_r($documents);
					$resp = $this->DriverModel->add_document_photo($documents);
					$this->db->where('driver_id', $driver_id);
					$this->db->where('photo_type', '');
					$this->db->delete('tbl_driverdocuments');
					//echo $this->db->last_query();
					$resultLicence[] = array('driver_id' => $post_data['driver_id'], 'photo_type'	=> 'licence', 'photo' => $file_name);
					$jsonLicence = array("status" => 1, "message" => "success", "result_livence" => $resultLicence);
				}
			}

			// upload photoes
			if ($_FILES['address_proof']['name'] != "") {
				$countFile = count($_FILES['address_proof']['name']);
				foreach ($_FILES['address_proof']['tmp_name'] as $key => $tmp_name) {
					$temp = explode(".", $_FILES["address_proof"]["name"][$key]);
					$file_platname = round(microtime(true)) . $key . '.' . end($temp);
					//$file_platname = $_FILES['share_pic']['name'][$key];
					$file_size = $_FILES['address_proof']['size'][$key];
					$file_tmp = $_FILES['address_proof']['tmp_name'][$key];
					$file_type = $_FILES['address_proof']['type'][$key];
					move_uploaded_file($file_tmp, "./driver_uploads/" . $post_data['driver_id'] . "/" . $file_platname);

					$documents_proof = array(
						'driver_id'	=> $post_data['driver_id'],
						'photo_type'	=> $photo_type,
						'photo' => $file_platname
					);
					//print_r($data_vehicle);
					$resp = $this->DriverModel->add_document_photo($documents_proof);
					$this->db->where('driver_id', $driver_id);
					$this->db->where('photo_type', '');
					$this->db->delete('tbl_driverdocuments');
					//echo $this->db->last_query();
					$result_proof[] = array('driver_id' => $post_data['driver_id'], 'photo_type'	=> $photo_type, 'photo' => $file_platname);
					$jsonAddress_proof = array("status" => 1, "message" => "success", "result_proof" => $result_proof);
				}
			}
			if ($blank == '1') {
				$documents_proof = array(
					'driver_id'	=> $post_data['driver_id'],
					'photo_type'	=> '',
					'photo' => ''
				);
				//print_r($data_vehicle);
				$resp = $this->DriverModel->add_document_photo($documents_proof);
			}
			$result[] = array('driver_id' => $post_data['driver_id'], 'vehicle_id' => $id, 'vehicle_name' => $post_data['vehicle_name'], 'vehicle_type' => $post_data['vehicle_type'], 'vehicle_number' => $post_data['vehicle_number'], 'seats' => $post_data['seats'], "driving_livence" => $jsonLicence, "address_proof" => $jsonAddress_proof);
			$json = array("status" => 1, "message" => "success", "data" => $result);
		}
		echo json_encode($json);
	}

	// delete driver document
	public function delete_Driverdocuments()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$id = $post_data['id'];
			$resp = $this->DriverModel->delete_documents($id);
			$result[] = array('id' => $id);
			$json = array("status" => 1, "message" => "success delete.", "data" => $result);
		}
		echo json_encode($json);
	}
	// get all driver documents
	public function get_driverDocuments()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = $post_data['driver_id'];
			$resultGetdocuments = $this->DriverModel->get_driver_documents($driver_id);
			if ($resultGetdocuments >= 1) {
				$data['result'] = $resultGetdocuments;
				//$photoPath = driver_profile.$driver_id.'/';
				foreach ($data['result'] as $getValue) {
					// profile photo
					if ($getValue['photo'] == 'no_profile.png' || $getValue['photo'] == '') {
						$photoPath = no_profile;
					} else {
						$photoPath = driver_profile . $driver_id . "/" . $getValue['photo'];
					}
					$result[] = array('id' => $getValue['id'], 'driver_id' => $driver_id, 'photo_type' => $getValue['photo_type'], 'photo' => $photoPath, 'created_date' => $getValue['created_date']);
					$json = array("status" => 1, "message" => "success", "data" => $result);
				}
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	// update location for trip
	public function update_driverLocation()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$id = $post_data['trip_id'];
			$last_lat = $post_data['last_lat'];
			$last_lng = $post_data['last_lng'];
			//$driver_id = $post_data['driver_id'];
			$data = array(
				'last_lat'	=> $last_lat,
				'last_lng'	=> $last_lng
			);
			$resultGetdata = $this->DriverModel->update_drivertrip($id, $data);
			$result[] = array('trip_id' => $id, 'last_lat' => $last_lat, 'last_lng' => $last_lng);
			$json = array("status" => 1, "message" => "success", "data" => $result);
		}
		echo json_encode($json);
	}
	// get all country
	public function get_Country()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$resultGetvehicle = $this->DriverModel->get_allcountry();
			if ($resultGetvehicle >= 1) {
				$data['result'] = $resultGetvehicle;
				foreach ($data['result'] as $getValue) {
					$result[] = array('country_id' => $getValue['id'], 'country' => $getValue['country']);
					$json = array("status" => 1, "message" => "success", "data" => $result);
				}
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}

	// get all state
	public function get_State()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$country_id = $post_data['country_id'];
			$resultGetvehicle = $this->DriverModel->get_allstate($country_id);
			if ($resultGetvehicle >= 1) {
				$data['result'] = $resultGetvehicle;
				foreach ($data['result'] as $getValue) {
					$result[] = array('state_id' => $getValue['state_id'], 'country_id' => $getValue['country_id'], 'state' => $getValue['state']);
					$json = array("status" => 1, "message" => "success", "data" => $result);
				}
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	// onboard userlist
	public function onboardUserlist()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$trip_id = $post_data['trip_id'];
			$status = $post_data['status'];
			//$user_id = "7, 4, 29";
			// $peoples = explode(",",$post_data['user_id']);
			//    foreach ($peoples as $user_id) 
			//    {
			//    	$data = array(
			//    		'status' =>'onboard'
			// 	);
			// 	$resultGetdata=$this->UserModel->add_Tripreview_onboard($user_id,$trip_id,$data);
			//    }
			// update passanger
			$passanger_id = explode(",", $post_data['user_id']);
			foreach ($passanger_id as $peoples) {
				$datapassanger = array(
					'status' => $status
				);
				$resultAdddata = $this->UserModel->add_Passanger_update($peoples, $datapassanger);
			}

			$result[] = array('trip_id' => $trip_id, 'user_id' => $post_data['user_id'], 'status' => $status);
			$json = array("status" => 1, "message" => "success", "data" => $result);
		}
		echo json_encode($json);
	}
	// all approvel status
	public function getdriver_allapprovel()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$id = $post_data['driver_id'];
			// default data
			$resultdriverdetails = $this->DriverModel->get_tbl_driverdetails($id);
			$resultdriverbank = $this->DriverModel->get_tbl_driver_bankdetails($id);
			$resultdrivervehicle = $this->DriverModel->get_tbl_vehicledetails($id);
			$resultdriverdocs = $this->DriverModel->get_tbl_driverdocuments($id);
			// profile
			if ($resultdriverdetails >= 1) {
				$profile_status = '0';
				//   	$datadriverdetails['result1']= $resultdriverdetails;
				// $countdriverdetails = count($datadriverdetails['result1']);
				// if($countdriverdetails>0){
				// 	$profile_status = '0';
				//    }
				//    else{
				//    	$profile_status = '1';
				//    }
			} else {
				$profile_status = '1';
			}

			// bank
			if ($resultdriverbank >= 1) {
				$bank_status = '0';
				// $dataresultdriverbank['result']= $resultdriverbank;
				// $countresultdriverbank = count($dataresultdriverbank['result']);
				// if($countresultdriverbank>0){
				// 	$bank_status = '0';
				// }
				// else{
				// 	$bank_status = '1';
				// }
			} else {
				$bank_status = '1';
			}

			// vehicle
			if ($resultdrivervehicle >= 1) {
				$vechicle_status = '0';
				// $dataresultdrivervehicle['result']= $resultdrivervehicle;
				// $countresultdrivervehicle = count($dataresultdrivervehicle['result']);
				// if($countresultdrivervehicle>0){
				// 	$vechicle_status = '0';
				// }
				// else{
				// 	$vechicle_status = '1';
				// }
			} else {
				$vechicle_status = '1';
			}

			// documents
			if ($resultdriverdocs >= 1) {
				$docs_status = '0';
				// $dataresultdriverdocs['result']= $resultdriverdocs;
				// $countresultdriverdocs = count($dataresultdriverdocs['result']);
				// if($countresultdriverdocs>0){
				// 	$docs_status = '0';
				// }
				// else{
				// 	$docs_status = '1';
				// }
			} else {
				$docs_status = '1';
			}

			$result[] = array('driver_id' => $id, 'profile_status' => $profile_status, 'bank_status' => $bank_status, 'vechicle_status' => $vechicle_status, 'docs_status' => $docs_status);
			$json = array("status" => 1, "message" => "success", "data" => $result);
		}
		echo json_encode($json);
	}
	// get trip locations
	public function get_Triplocations()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$resultGetlocation = $this->DriverModel->get_locations();
			if ($resultGetlocation >= 1) {
				$data['result'] = $resultGetlocation;
				foreach ($data['result'] as $getValue) {
					$result[] = array('id' => $getValue['id'], 'address' => $getValue['address'], 'latitude' => $getValue['latitude'], 'longitude' => $getValue['longitude']);
					$json = array("status" => 1, "message" => "success", "data" => $result);
				}
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	// get all onboard user list
	public function get_allonboard_userlist()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$trip_id = $post_data['trip_id'];
			$resultGetonboardlist = $this->DriverModel->getallOnboardlist($trip_id);
			if ($resultGetonboardlist >= 1) {
				$data['result'] = $resultGetonboardlist;
				foreach ($data['result'] as $getValue) {
					//$photoPath = user_profile.$getValue['user_id'].'/';
					// profile photo
					if ($getValue['photo'] == 'no_profile.png' || $getValue['photo'] == '') {
						$photoPath = no_profile;
					} else {
						$photoPath = user_profile . $getValue['user_id'] . "/" . $getValue['photo'];
					}
					$resultGettrippassanger = $this->DriverModel->get_trippassanger_onboard($getValue['book_id']);
					if ($resultGettrippassanger >= 1) {
						$datapassanger['result'] = $resultGettrippassanger;
						foreach ($datapassanger['result'] as $getPassanger) {
							$resultPassanger[] = array('passanger_id' => $getPassanger['passanger_id'], 'passanger_name' => $getPassanger['passanger_name'], 'book_id' => $getPassanger['book_id']);
							$jsonPassanger = array("status" => 1, "message" => "success", "data" => $resultPassanger);
						}
						$resultPassanger = array();
					} else {
						$jsonPassanger = array();
					}
					$result[] = array('id' => $getValue['book_id'], 'user_id' => $getValue['user_id'], 'driver_id' => $getValue['driver_id'], 'rating' => $getValue['rating'], 'status' => $getValue['status'], 'datetime' => $getValue['datetime'], 'fname' => $getValue['fname'], 'lname' => $getValue['lname'], 'photo' => $photoPath, "passanger" => $jsonPassanger);
					$json = array("status" => 1, "message" => "success", "data" => $result);
				}
			} else {
				$json = array("status" => 0, "message" => "Something went wrong");
			}
		}
		echo json_encode($json);
	}
	// remove driver data
	// update password
	public function remove_driverAccount()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			$json = array("status" => 400, "message" => "Bad request");
		} else {
			$post_data = $this->input->post();
			$driver_id = $post_data['driver_id'];
			if (isset($driver_id) && !empty($driver_id)) {
				// remove vehicle details
				$respprofile = $this->DriverModel->delete_drivervehicle($driver_id);
				// remove bank details
				$respprofile = $this->DriverModel->delete_driverbankdetails($driver_id);
				// remove from documents
				$respprofile = $this->DriverModel->delete_driverdocs($driver_id);
				// remove from profile table
				$respprofile = $this->DriverModel->delete_driverprofile($driver_id);
				// remove from main table
				$resp = $this->DriverModel->delete_driverdata($driver_id);
				$result[] = array('driver_id' => $driver_id);
				$json = array("status" => 1, "message" => "success", "data" => $result);
			} else {
				$json = array("status" => 0, "message" => "Data not found.");
			}
		}
		echo json_encode($json);
	}
}