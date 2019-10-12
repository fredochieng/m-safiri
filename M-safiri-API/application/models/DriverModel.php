<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DriverModel extends CI_Model
{

    var $client_service = "frontend-client";
    var $auth_key       = "simplerestapi";

    public function register_driver_data($data)
    {
        $this->db->insert('tbl_driverdata', $data);
        return array("status" => 201, "message" => "Data has been created");
    }

    public function add_driverdetails($datadetails)
    {
        $this->db->insert('tbl_driverdetails', $datadetails);
        return array("status" => 201, "message" => "Data has been created");
    }

    // check register data already exist or not
    public function checkDriverdata($email)
    {
        $query = $this->db->get_where('tbl_driverdata', array('email' => $email));
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    public function checkcompanyDriverdata($email, $authentication_code)
    {
        $query = $this->db->get_where('tbl_driverdata', array('email' => $email, 'authentication_code' => $authentication_code));
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // check register data already exist or not
    public function checkDriverprofile($driver_id)
    {
        //$query = $this->db->get_where('tbl_driverdetails',array('driver_id'=>$driver_id));
        $this->db->select('t1.*,t2.id as country_id')
            ->from('tbl_driverdetails as t1')
            ->join('tbl_country as t2', 't1.country = t2.country', 'left')
            ->where('t1.driver_id', $driver_id);
        $query = $this->db->get();
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function checkDrivermaindata($driver_id)
    {
        $query = $this->db->get_where('tbl_driverdata', array('id' => $driver_id));
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }

    // check register data already exist or not
    public function checkDriverbankdetails($driver_id)
    {
        $query = $this->db->get_where('tbl_driver_bankdetails', array('driver_id' => $driver_id));
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // add bank data
    public function add_bankdetails($bankdetails)
    {
        $this->db->insert('tbl_driver_bankdetails', $bankdetails);
        return array("status" => 201, "message" => "Data has been created");
    }
    // update driver bank data
    public function update_driver_bankdata($driver_id, $data)
    {
        $this->db->where('driver_id', $driver_id);
        $this->db->update('tbl_driver_bankdetails', $data);
        return array("status" => 201, "message" => "Data has been updated");
    }
    // get bank detail
    public function getdriverBankdata($driver_id)
    {
        //$query = $this->db->get_where('tbl_driver_bankdetails',array('bank_id'=>$bank_id,'driver_id'=>$driver_id));

        $this->db->select('t1.*,t4.id as country_id')
            ->from('tbl_driver_bankdetails as t1')
            ->join('tbl_country as t4', 't1.country = t4.country', 'left')
            ->where('t1.driver_id', $driver_id);
        $query = $this->db->get();
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }

    // user login
    public function loginDriverdata($user_email, $password)
    {
        $this->db->select("*");
        $this->db->where('email', $user_email);
        $this->db->where('password', md5($password));
        $this->db->where('status', 'active');
        $query = $this->db->get('tbl_driverdata');
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }

    // update user profile data
    public function update_driver_data($driver_id, $data)
    {
        $this->db->where('driver_id', $driver_id);
        $this->db->update('tbl_driverdetails', $data);
        return array("status" => 201, "message" => "Data has been updated");
    }
    public function update_driver_fullname($driver_id, $fullnamedata)
    {
        $this->db->where('id', $driver_id);
        $this->db->update('tbl_driverdata', $fullnamedata);
        return array("status" => 201, "message" => "Data has been updated");
    }

    // update user profile photo
    public function update_driver_photo($driver_id, $data)
    {
        $this->db->where('driver_id', $driver_id);
        $this->db->update('tbl_driverdetails', $data);
        return array("status" => 201, "message" => "Data has been updated");
    }
    // driver vehicle data
    public function update_drivervechicledata($driver_id, $data)
    {
        $this->db->where('driver_id', $driver_id);
        $this->db->update('tbl_driver_vehicle', $data);
        return array("status" => 201, "message" => "Data has been updated");
    }
    // get driver data
    public function getDriverdata($id)
    {

        $this->db->select('t1.*,t2.*,t3.vehicle_name,t3.vehicle_number,t4.id as country_id')
            ->from('tbl_driverdata as t1')
            ->join('tbl_driverdetails as t2', 't1.id = t2.driver_id')
            ->join('tbl_driver_vehicle as t3', 't1.id = t3.driver_id')
            ->join('tbl_country as t4', 't2.country = t4.country', 'left')
            ->where('t1.id', $id);
        $query = $this->db->get();

        $res   = $query->result_array();
        //print_r($res);
        // $queryForseats = $this->db->query("");
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }

    // driver vehicle
    public function add_vehicledata($vehicledata)
    {
        $this->db->insert('tbl_driver_vehicle', $vehicledata);
        return array("status" => 201, "message" => "Data has been created");
    }

    public function get_driver_vehicle($driver_id)
    {
        $query = $this->db->get_where('tbl_driver_vehicle', array('driver_id' => $driver_id));
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get device data
    public function get_user_devicedata($user_id)
    {
        $query = $this->db->get_where('tbl_user_devicedata', array('user_id' => $user_id));
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get driver vehicle data
    public function get_driverVehicledata($driver_id)
    {
        $this->db->select('t1.*,t2.id as vehicle_image_id,t2.photo_type,t2.photo')
            ->from('tbl_driver_vehicle as t1')
            ->join('tbl_vehicledetails as t2', 't1.id=t2.vehicle_id')
            ->where('t1.driver_id', $driver_id);
        $query = $this->db->get();

        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }

    // get trip user list
    public function get_tripallusers($trip_id)
    {
        $query = $this->db->query("SELECT `t1`.*, `t2`.`fname`, `t2`.`lname`, `t2`.`photo` FROM `tbl_user_trips` as `t1` JOIN `tbl_userdata` as `t2` ON `t1`.`user_id`=`t2`.`id` WHERE (`t1`.`status` = 'confirm' OR `t1`.`status` = 'booked') AND `t1`.`trip_id` = '" . $trip_id . "'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function get_trippassanger($book_id)
    {
        $query = $this->db->query("SELECT * FROM tbl_trip_passanger WHERE status = 'booked' AND book_id = '" . $book_id . "'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function countbookedpassanger($trip_id)
    {
        $query = $this->db->query("SELECT * FROM tbl_trip_passanger WHERE status = 'booked' AND trip_id = '" . $trip_id . "'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function get_trippassanger_onboard($book_id)
    {
        $query = $this->db->query("SELECT * FROM tbl_trip_passanger WHERE status = 'onboard' AND book_id = '" . $book_id . "'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    public function get_trippassanger_cancel($trip_id)
    {
        $query = $this->db->query("SELECT * FROM tbl_trip_passanger WHERE status = 'cancel' AND trip_id = '" . $trip_id . "'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    public function get_trippassanger_complete($trip_id)
    {
        $query = $this->db->query("SELECT * FROM tbl_trip_passanger WHERE status = 'completed' AND trip_id = '" . $trip_id . "'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    public function get_tripallusersdata($trip_id)
    {
        $query = $this->db->query("SELECT t1.*, t2.fname, t2.lname, t2.photo ,t2.device_id,t2.device_token FROM tbl_user_trips as t1 JOIN tbl_userdata as t2 ON t1.user_id=t2.id WHERE t1.status = 'booked' AND `t1`.`trip_id` = '" . $trip_id . "'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    public function get_tripallusers_completed($trip_id)
    {
        $query = $this->db->query("SELECT t1.*, t2.fname, t2.lname, t2.photo ,t2.device_id,t2.device_token FROM tbl_user_trips as t1 JOIN tbl_userdata as t2 ON t1.user_id=t2.id WHERE t1.status = 'onboard'  AND t1.trip_id = '" . $trip_id . "'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }

    //add vehicle photo
    public function add_vehicle_photo($data_vehicle)
    {
        $this->db->insert('tbl_vehicledetails', $data_vehicle);
        return array("status" => 201, "message" => "Data has been created");
    }

    //add numberplate photo
    public function add_numberplate_photo($data_vehicleplate)
    {
        $this->db->insert('tbl_vehicle_platephoto', $data_vehicleplate);
        return array("status" => 201, "message" => "Data has been created");
    }
    //delete driver number plate
    public function delete_numberPlate($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_vehicledetails');
        return array("status" => 201, "message" => "Data has been deleted");
    }
    // check email data
    /*public function checkEmail($email)
    {
        $query = $this->db->get_where('tbl_userdata',array('auth_input'=>$email));
        $res   = $query->result_array();
        if ($query->num_rows() > 0){

            return $res;
        }
        else{
            return false;
        }
    }*/
    // check code data already exist or not - forgot password
    public function checkCodedata($email, $sentcode)
    {
        $query = $this->db->get_where('tbl_driverdata', array('email' => $email, 'sentcode' => $sentcode));
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // check old password
    public function checkDriverpassword($driver_id, $old_password)
    {
        $query = $this->db->get_where('tbl_driverdata', array('id' => $driver_id, 'old_password' => $old_password));
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // update password
    public function update_driverpassword($driver_id, $data)
    {
        $this->db->where('id', $driver_id);
        $this->db->update('tbl_driverdata', $data);
        return array("status" => 201, "message" => "Data has been updated");
    }

    //add driver trip
    public function set_drivertrip($data)
    {
        $this->db->insert('tbl_driver_setlocation', $data);
        return array("status" => 201, "message" => "Data has been created");
    }
    // exist address
    public function checkTripdata($driver_id, $datetime)
    {
        //$query = $this->db->get_where('tbl_driver_setlocation',array('driver_id'=>$driver_id , 'from_title'=>$from_title, 'to_title'=>$to_title));
        //$query = $this->db->query("SELECT * FROM `tbl_driver_setlocation` WHERE `driver_id` = '".$driver_id."' AND `from_title` = '".$from_title."' AND `to_title` = '".$to_title."' AND `datetime` LIKE '%".$datetime."%' AND (`status` = 'pending' OR `status` = 'active')" );
        $query = $this->db->query("SELECT * FROM `tbl_driver_setlocation` WHERE `driver_id` = '" . $driver_id . "' AND `datetime` <= '" . $datetime . "' AND `end_datetime` >= '" . $datetime . "'");

        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function checkTripdata_before($driver_id, $datetime)
    {
        $next_datetime = date('Y-m-d H:i:s', strtotime('-30 minutes', strtotime($datetime)));
        $query = $this->db->query("SELECT * FROM `tbl_driver_setlocation` WHERE `driver_id` = '" . $driver_id . "' AND `datetime` between '" . $next_datetime . "' and '" . $datetime . "'");

        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get trip address
    public function checkTrip_pricedata($from_title, $to_title)
    {
        $query = $this->db->get_where('tbl_new_trip_price', array('from_address' => $from_title, 'to_address' => $to_title, 'status' => 'active'));

        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get driver trip
    public function getdrivertripAddress($id)
    {
        $query = $this->db->get_where('tbl_driver_setlocation', array('id' => $id));
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // update driver trip
    public function update_drivertrip($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_driver_setlocation', $data);
        //return array("status" => 201,"message" => "Data has been updated");
    }
    //delete driver trip Address
    public function delete_tripAddress($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_driver_setlocation');
        return array("status" => 201, "message" => "Data has been deleted");
    }
    public function delete_drivervehicledata($driver_id)
    {
        $this->db->where('driver_id', $driver_id);
        $this->db->where('photo_type', '');
        $this->db->delete('tbl_vehicledetails');
        return array("status" => 201, "message" => "Data has been deleted");
    }
    // get current trips
    public function getcurrentTrips($driver_id, $sort_by)
    {
        if ($sort_by == 'sort_time') {
            $sub_query = " ORDER BY `datetime` ASC";
        } elseif ($sort_by == 'sort_location') {
            $sub_query = " ORDER BY `from_address` ASC";
        } else {
            $sub_query = "ORDER BY `id` DESC";
        }
        //$query = $this->db->get_where('tbl_driver_setlocation',array('driver_id'=>$driver_id,'status'=>'pending'));
        $query = $this->db->query("SELECT * FROM `tbl_driver_setlocation` WHERE `driver_id` = '" . $driver_id . "' AND `status` = 'pending' $sub_query");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }

    // get current trips
    public function getuserTrips($trip_id)
    {
        $query = $this->db->get_where('tbl_user_trips', array('trip_id' => $trip_id));
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get trip rating
    public function gettripRating($trip_id)
    {
        $query = $this->db->query("SELECT AVG(`rating`) as avg_rating FROM `tbl_user_trips` WHERE `trip_id` = '" . $trip_id . "' AND `status` = 'completed'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get past trips
    public function getpastTrips($driver_id)
    {
        $query = $this->db->get_where('tbl_driver_setlocation', array('driver_id' => $driver_id, 'status' => 'deactive'));
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // history
    public function getTriphistory($driver_id)
    {
        $query = $this->db->query("SELECT * FROM `tbl_driver_setlocation` WHERE `driver_id` = '" . $driver_id . "' AND (`status` = 'deactive' OR `status` = 'cancel')");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get upcoming trips
    public function getupcomingTrips($driver_id)
    {
        //$query = $this->db->query('',array('driver_id'=>$driver_id,'status'=>'active'), 1, 1);
        $query = $this->db->query("SELECT * FROM tbl_driver_setlocation WHERE (status = 'active' OR status = 'ongoing')  AND driver_id = '" . $driver_id . "' Limit 1");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get all active trips
    public function getallactiveTrips($driver_id)
    {
        $query = $this->db->get_where('tbl_driver_setlocation', array('driver_id' => $driver_id, 'status' => 'deactive'));
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // onboard user list
    public function getallOnboardlist($trip_id)
    {
        $this->db->select('t1.*,t1.id as book_id,t2.fname,t2.lname,t2.photo')
            ->from('tbl_user_trips as t1')
            ->join('tbl_userdata as t2', 't1.user_id=t2.id')
            ->where('t1.trip_id', $trip_id)
            ->where('t1.status', 'onboard');
        $query = $this->db->get();

        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get all four rated
    public function getfourratedTrips($driver_id)
    {
        $query = $this->db->get_where('tbl_user_trips', array('driver_id' => $driver_id, 'rating' => '4'));
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get all rated trips
    public function getallratedTrips($driver_id)
    {
        $query = $this->db->query("SELECT t1.*,t2.fname,t2.lname,t2.photo FROM tbl_user_trips as t1 INNER JOIN tbl_userdata as t2 ON t1.user_id=t2.id WHERE rating != '' AND driver_id ='" . $driver_id . "'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // driver avg rating
    public function getdriverRating($driver_id)
    {
        $query = $this->db->query("SELECT AVG(`rating`) as avg_rating FROM `tbl_user_trips` WHERE `driver_id` = '" . $driver_id . "'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function calculate_triptime($id)
    {
        $query = $this->db->query("SELECT SEC_TO_TIME(SUM(UNIX_TIMESTAMP(`end_datetime`) - UNIX_TIMESTAMP(`datetime`))) AS sumtime FROM tbl_driver_setlocation WHERE `id` = '" . $id . "'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    //add document photo
    public function add_document_photo($documents)
    {
        $this->db->insert('tbl_driverdocuments', $documents);
        return array("status" => 201, "message" => "Data has been created");
    }
    //delete driver documents
    public function delete_documents($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_driverdocuments');
        return array("status" => 201, "message" => "Data has been deleted");
    }
    // get driver documents
    public function get_driver_documents($driver_id)
    {
        //$query = $this->db->get_where('tbl_driverdocuments',array('driver_id'=>$driver_id));
        $query = $this->db->query("SELECT * FROM `tbl_driverdocuments` WHERE `driver_id`='" . $driver_id . "' AND `photo` != ''");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get country
    public function get_allcountry()
    {
        $query = $this->db->get('tbl_country');
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get state
    public function get_allstate($country_id)
    {
        $query = $this->db->get_where('tbl_state', array('country_id' => $country_id));
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get tbl_driverdetails
    public function get_tbl_driverdetails($driver_id)
    {
        $query = $this->db->query("SELECT * FROM `tbl_driverdetails` WHERE (`gender`='' OR `dob`='' OR `city`='' OR `postal_code`='' OR `country`='' OR `mobile_number`='') AND `driver_id`='" . $driver_id . "'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get tbl_driver_bankdetails
    public function get_tbl_driver_bankdetails($driver_id)
    {
        $query = $this->db->query("SELECT * FROM `tbl_driver_bankdetails` WHERE (`bank_name`='' OR `bank_payee`='' OR `bank_account`='' OR `bank_ifsc`='' OR `street1`='' OR `street2`='' OR `city`='' OR `state`='' OR `postal_code`='' OR `country`='' OR `birthday`='') AND `driver_id`='" . $driver_id . "'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }

    public function get_tbl_vehicledetails($driver_id)
    {
        //$query = $this->db->query("SELECT t1.*,t2.id as vehicle_image_id,t2.photo_type,t2.photo FROM tbl_driver_vehicle as t1 INNER JOIN tbl_vehicledetails as t2 ON t1.id=t2.vehicle_id WHERE (t1.vehicle_name='' OR t1.vehicle_type='' OR t1.vehicle_number='' OR t1.seats='' OR t2.photo='') AND t1.driver_id='".$driver_id."'");
        $query = $this->db->query("SELECT * FROM tbl_driver_vehicle WHERE (vehicle_name='' OR vehicle_type='' OR vehicle_number='' OR seats='') AND driver_id='" . $driver_id . "'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get tbl_driverdocuments
    public function get_tbl_driverdocuments($driver_id)
    {
        $query = $this->db->query("SELECT * FROM `tbl_driverdocuments` WHERE `photo`='' AND driver_id='" . $driver_id . "'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // get trip locations
    public function get_locations()
    {
        $query = $this->db->query("SELECT * FROM `tbl_location` WHERE `status`='active'");
        $res   = $query->result_array();
        if ($query->num_rows() > 0) {
            return $res;
        } else {
            return false;
        }
    }
    // delete driver data
    public function delete_driverdata($driver_id)
    {
        $this->db->where('id', $driver_id);
        $this->db->delete('tbl_driverdata');
        return array("status" => 201, "message" => "Data has been deleted");
    }
    public function delete_driverprofile($driver_id)
    {
        $this->db->where('driver_id', $driver_id);
        $this->db->delete('tbl_driverdetails');
        return array("status" => 201, "message" => "Data has been deleted");
    }
    public function delete_driverdocs($driver_id)
    {
        $this->db->where('driver_id', $driver_id);
        $this->db->delete('tbl_driverdocuments');
        return array("status" => 201, "message" => "Data has been deleted");
    }
    public function delete_driverbankdetails($driver_id)
    {
        $this->db->where('driver_id', $driver_id);
        $this->db->delete('tbl_driver_bankdetails');
        return array("status" => 201, "message" => "Data has been deleted");
    }
    public function delete_drivervehicle($driver_id)
    {
        $this->db->where('driver_id', $driver_id);
        $this->db->delete('tbl_driver_vehicle');
        return array("status" => 201, "message" => "Data has been deleted");
    }
}