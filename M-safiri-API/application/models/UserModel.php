    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class UserModel extends CI_Model {

        var $client_service = "frontend-client";
        var $auth_key       = "simplerestapi";

        public function register_user_data($data)
        {
            $this->db->insert('tbl_userdata',$data);
            return array("status" => 201,"message" => "Data has been created");
        }
        
        // check register data already exist or not
        public function checkUserdata($user_email)
        {
            $query = $this->db->get_where('tbl_userdata',array('user_email'=>$user_email));
            $res   = $query->result_array();
            if ($query->num_rows() > 0){

                return $res;
            }
            else{
                return false;
            }
        }

        // user login
        public function loginUserdata($user_email,$password)
        {
            /*$this->db->select("*");
            $this->db->where('user_email',$user_email);
            $this->db->where('password',md5($password));
            $this->db->or_where('username', $user_email);*/
            $query = $this->db->get_where('tbl_userdata',array('user_email'=>$user_email,'password'=>$password));
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }

        // update user profile
        public function update_user_data($user_id, $data) {
            $this->db->where('id', $user_id);
            $this->db->update('tbl_userdata', $data);
            return array("status" => 201,"message" => "Data has been updated");
        }

        public function user_checkCodedata($email,$sentcode)
        {
            $query = $this->db->get_where('tbl_userdata',array('user_email'=>$email , 'sentcode'=>$sentcode));
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
        
        public function update_passwordCode($user_id, $dataCode) {
            $this->db->where('id', $user_id);
            $this->db->update('tbl_userdata', $dataCode);
            return array("status" => 201,"message" => "Data has been updated");
        }
        
        // get user profile data
        public function getUserdata($user_id)
        {
            $query = $this->db->get_where('tbl_userdata',array('id'=>$user_id));
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
        // check email data
        public function checkEmail($email)
        {
            $query = $this->db->get_where('tbl_userdata',array('auth_input'=>$email));
            $res   = $query->result_array();
            if ($query->num_rows() > 0){

                return $res;
            }
            else{
                return false;
            }
        }
        
        // check old password
        public function checkUserpassword($user_id,$old_password)
        {
            $query = $this->db->get_where('tbl_userdata',array('id'=>$user_id , 'old_password'=>$old_password));
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
        // update user profile
        public function update_mypassword($user_id, $data) {
            $this->db->where('id', $user_id);
            $this->db->update('tbl_userdata', $data);
            return array("status" => 201,"message" => "Data has been updated");
        }

        // saved my address
        public function user_savedaddress($data)
        {
            $this->db->insert('tbl_my_address',$data);
            return array("status" => 201,"message" => "Data has been created");
        }
        // get my saved address
        public function getmyaddress($user_id)
        {
            $query = $this->db->get_where('tbl_my_address',array('user_id'=>$user_id));
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
        // delete my saved address
        public function delete_user_devicetoken($user_id,$device_token){
            $this->db->delete('tbl_user_devicedata', array('user_id' => $user_id,'device_token'=>$device_token)); 
            return array("status" => 201,"message" => "Data has been deleted");
        }
        // update user saved address
        public function user_update_savedaddress($id, $data) {
            $this->db->where('id', $id);
            $this->db->update('tbl_my_address', $data);
            return array("status" => 201,"message" => "Data has been updated");
        }
        // check saved address already exist or not
        public function check_myaddress($user_id,$title,$address)
        {
            $query = $this->db->query("SELECT * FROM `tbl_my_address` WHERE `user_id`='".$user_id."' AND `title` ='".$title."' OR `user_id`='".$user_id."' AND `address` = '".$address."'");
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
        
        // serch driver trips
        public function getdriverTrips($from_title,$to_title,$get_date,$seats,$rating,$price)
        {
            //$query = $this->db->query("SELECT t1.*,t2.fullname,t2.status as driver_status,t3.gender,t3.photo,t3.mobile_number,t4.vehicle_number,t4.vehicle_type,t4.vehicle_name,t4.seats FROM tbl_driver_setlocation as t1 INNER JOIN tbl_driverdata as t2 ON t1.driver_id=t2.id INNER JOIN tbl_driverdetails as t3 ON t1.driver_id=t3.driver_id INNER JOIN tbl_driver_vehicle as t4 ON t1.driver_id=t4.driver_id WHERE t1.from_title='".$from_title."' AND t1.to_title ='".$to_title."' AND t4.seats ='".$seats."' AND t1.datetime LIKE '%".$get_date."%'  AND t1.status = 'pending' AND t2.status='active'");
            if(isset($rating) && !empty($rating)){
                $subQueryRatting = " ORDER BY `t3`.`ratting` DESC";
                $subQueryPrice ="";
            }
            else{
                $subQueryRatting ="";   
            }
            if(isset($price) && !empty($price)){
                if($price == 'high'){
                    $subQueryPrice = " ORDER BY `t3`.`ratting` DESC";
                    $subQueryRatting =""; 
                }
                if($price == 'low'){
                    $subQueryPrice = " ORDER BY `t3`.`ratting` ASC";
                    $subQueryRatting =""; 
                }
            }
            else{
                $subQueryPrice ="";   
            }
            
            $query = $this->db->query("SELECT t1.*,t2.fullname,t2.status as driver_status,t3.gender,t3.photo,t3.mobile_number,t4.vehicle_number,t4.vehicle_type,t4.vehicle_name,t4.seats FROM tbl_driver_setlocation as t1 INNER JOIN tbl_driverdata as t2 ON t1.driver_id=t2.id INNER JOIN tbl_driverdetails as t3 ON t1.driver_id=t3.driver_id INNER JOIN tbl_driver_vehicle as t4 ON t1.driver_id=t4.driver_id WHERE t1.from_title='".$from_title."' AND t1.to_title ='".$to_title."' AND t1.datetime LIKE '%".$get_date."%'  AND t1.status = 'pending' AND t1.trip_price != '' AND t1.trip_price != '0' AND t2.status='active' AND t2.online_status='active' $subQueryRatting $subQueryPrice");
            $res   = $query->result_array();

            // count values
            $getTotalTrips = $query->num_rows();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }

        // get single trip
        public function getsingleTrip($id)
        {
            //SELECT t1.*,t2.fullname,t3.gender,t3.photo,t3.mobile_number,t4.vehicle_number,t4.vehicle_type,t5.status as user_trip_status FROM tbl_driver_setlocation as t1 INNER JOIN tbl_driverdata as t2 ON t1.driver_id=t2.id INNER JOIN tbl_driverdetails as t3 ON t1.driver_id=t3.driver_id INNER JOIN tbl_driver_vehicle as t4 ON t1.driver_id=t4.driver_id INNER JOIN tbl_user_trips as t5 ON t1.id=t5.trip_id WHERE t5.user_id='1'
            $this->db->select('t1.*,t2.fullname,t3.gender,t3.photo,t3.mobile_number,t4.vehicle_number,t4.vehicle_type,t4.vehicle_name,t5.status as user_trip_status,t5.rating as user_ratting')
             ->from('tbl_driver_setlocation as t1')
             ->join('tbl_driverdata as t2', 't1.driver_id=t2.id')
             ->join('tbl_driverdetails as t3', 't1.driver_id=t3.driver_id')
             ->join('tbl_driver_vehicle as t4', 't1.driver_id=t4.driver_id')
             ->join('tbl_user_trips as t5', 't1.id=t5.trip_id')
             ->where('t1.id', $id);
            $query = $this->db->get();

            // SELECT t1.*,t2.fname,t2.lname FROM tbl_status_comments as t1 INNER JOIN tbl_userdata as t2 on t1.user_id = t2.id WHERE t1.status=1

            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
        // get current trips
        public function getAllfromlist()
        {
            $this->db->select('*');
            $this->db->group_by('from_title');
            $query = $this->db->get_where('tbl_driver_setlocation',array('status'=>'pending'));
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
        
        // get current trips
        public function getAlltolist($from_title)
        {
            $query = $this->db->get_where('tbl_driver_setlocation',array('from_title'=>$from_title,'status'=>'pending'));
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }

        public function get_singletrip($trip_id)
        {
            $query = $this->db->query("SELECT t1.*,t2.fullname,t2.device_id,t2.device_token FROM tbl_driver_setlocation as t1 INNER JOIN tbl_driverdata as t2 ON t1.driver_id=t2.id WHERE t1.id = '".$trip_id."'");
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }

        // add user trips join
        public function user_jointrips($data)
        {
            $this->db->insert('tbl_user_trips',$data);
            return array("status" => 201,"message" => "Data has been created");
        }
        
        // get current trips
        public function check_jointrip($trip_id,$user_id)
        {
            $query = $this->db->query("SELECT * FROM `tbl_user_trips` WHERE `trip_id` = '".$trip_id."' AND `user_id` = '".$user_id."' AND `status` != 'cancel' AND `status` != '0'");

            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
        public function check_availabeltrips($trip_id)
        {
            $query = $this->db->get_where('tbl_user_trips',array('trip_id'=>$trip_id,'status ='=>'booked'));
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
        public function check_availabeltrips_passanger($trip_id)
        {
            $query = $this->db->get_where('tbl_trip_passanger',array('trip_id'=>$trip_id,'status ='=>'booked'));
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
        // get user review
        public function get_userReview($trip_id,$user_id)
        {
            $query = $this->db->select('t1.*,t2.fname,t2.lname,t2.photo')
                ->from('tbl_user_trips as t1')
                ->join('tbl_userdata as t2','t1.user_id=t2.id')
                ->where('t1.trip_id',$trip_id)
                ->where('t1.user_id',$user_id);
            $query = $this->db->get();
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
        // get cancel trip by user
        public function get_canceltrip($user_id,$trip_id) {
            $query = $this->db->get_where('tbl_user_trips',array('user_id'=>$user_id,'trip_id'=>$trip_id,'status' =>'booked'));
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
        // add review
        public function add_Tripreview($user_id,$trip_id, $data) {
            $this->db->where('trip_id', $trip_id);
            $this->db->where('user_id', $user_id);
            $this->db->where('status', 'completed');
            $this->db->update('tbl_user_trips', $data);
            return array("status" => 201,"message" => "Data has been updated");
        }
        public function add_Tripreview_confirm($id, $data) {
            $this->db->where('id', $id);
            $this->db->update('tbl_user_trips', $data);
            return array("status" => 201,"message" => "Data has been updated");
        }
        // add passnager
        public function add_Passanger($data)
        {
            $this->db->insert('tbl_trip_passanger',$data);
            return array("status" => 201,"message" => "Data has been created");
        }
        public function add_Passanger_update($id, $data) {
            $this->db->where('passanger_id', $id);
            $this->db->update('tbl_trip_passanger', $data);
            return array("status" => 201,"message" => "Data has been updated");
        }
        public function add_Passanger_update_trip($id, $data) {
            $this->db->where('trip_id', $id);
            $this->db->update('tbl_trip_passanger', $data);
            return array("status" => 201,"message" => "Data has been updated");
        }
        public function add_Passanger_update_trip_complete($id, $data) {
            $this->db->where('trip_id', $id);
            $this->db->where('status !=', 'cancel');
            $this->db->where('status !=', 'booked');
            $this->db->update('tbl_trip_passanger', $data);
            return array("status" => 201,"message" => "Data has been updated");
        }
        
        public function add_Passanger_update_bookid($id, $data) {
            $this->db->where('book_id', $id);
            $this->db->update('tbl_trip_passanger', $data);
            return array("status" => 201,"message" => "Data has been updated");
        }
        public function add_Passanger_onboard($id, $data) {
            $this->db->where('trip_id', $id);
            $this->db->where('status =', 'booked');
            $this->db->update('tbl_trip_passanger', $data);
            return array("status" => 201,"message" => "Data has been updated");
        }
        public function add_Tripreview_onboard($user_id,$trip_id, $data) {
            $this->db->where('trip_id', $trip_id);
            $this->db->where('user_id', $user_id);
            $this->db->where('status =', 'booked');
            $this->db->update('tbl_user_trips', $data);
            return array("status" => 201,"message" => "Data has been updated");
        }
        // get data by book id
        public function get_bookid($book_id)
        {
            $query = $this->db->get_where('tbl_trip_passanger',array('book_id'=>$book_id));
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
        
        public function add_Tripreview_complete($user_id,$trip_id, $data) {
            $this->db->where('trip_id', $trip_id);
            $this->db->where('user_id', $user_id);
            $this->db->where('status', 'onboard');
            $this->db->update('tbl_user_trips', $data);
            return array("status" => 201,"message" => "Data has been updated");
        }
        // get user trip history
        public function user_triphistory($user_id)
        {
            $this->db->select('t1.*,t1.status as user_trip_status,t1.id as book_id,t1.cancel_reason as user_cancel_reason,t2.*,t2.cancel_reason as driver_cancel_reason,t3.fullname ,t4.photo,t4.vehicle_profile,t5.vehicle_name')
             ->from('tbl_user_trips as t1')
             ->join('tbl_driver_setlocation as t2', 't1.trip_id=t2.id')
             ->join('tbl_driverdata as t3', 't1.driver_id=t3.id')
             ->join('tbl_driverdetails as t4', 't1.driver_id=t4.driver_id')
             ->join('tbl_driver_vehicle as t5', 't1.driver_id=t5.driver_id')
             ->where('t1.user_id', $user_id);
            $query = $this->db->get();
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
        // add Preferences
        public function add_Preferences($data)
        {
            $this->db->insert('tbl_preferences',$data);
            return array("status" => 201,"message" => "Data has been created");
        }
        
        public function get_user_trip_preferences($user_id,$trip_id)
        {
            $query = $this->db->get_where('tbl_preferences',array('user_id'=>$user_id,'trip_id'=>$trip_id));
            $res   = $query->result_array();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
        
        public function update_user_preference($user_id,$trip_id, $updatedata) {
            $this->db->where('user_id', $user_id);
            $this->db->where('trip_id', $trip_id);
            $this->db->update('tbl_preferences', $updatedata);
            return array("status" => 201,"message" => "Data has been updated");
        }
        // favorite trip list
        public function get_user_trip_favoritelist($user_id)
        {
            $query = $this->db->query("SELECT *,COUNT(*) FROM `tbl_user_trips` WHERE `user_id`='".$user_id."' GROUP BY `trip_id` HAVING COUNT(*) > 2");
            $res   = $query->result_array();

            // count values
            $getTotalTrips = $query->num_rows();
            if ($query->num_rows() > 0){
                return $res;
            }
            else{
                return false;
            }
        }
    }
