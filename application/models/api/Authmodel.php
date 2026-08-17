<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authmodel extends CI_Model{

  public function __construct(){
    parent::__construct();
    $this->load->database();
  }
  
  function updateLocationById($data){
    $inspectorId = $data['inspectorId'];

    // Check if the user already exists
    $existingUser = $this->getUserById($inspectorId);

    if ($existingUser) {
        // User exists, update the user record
        $this->updateLocation($existingUser['id'], $data);
        return $existingUser['id'];
    } else {
        // User doesn't exist, create a new user
        $this->createLocation($data);
        return $this->db->insert_id(); // Return the newly created user ID
    }
  }

  public function getData($page, $limit, $search = ''){
      $this->column_search = array('CI.userId','CU.firstname','CU.lastname','CU.mobile','CU.state','CU.city','CU.address','CU.pincode');
      // Apply search if provided
      $i = 0;
      foreach($this->column_search as $item){
        // if datatable send POST for search
        if(isset($search)){
          // first loop
          if($i===0){
            // open bracket
            $this->db->group_start();
            $this->db->like($item, $search);
          }else{
            $this->db->or_like($item, $search);
          }
          // last loop
          if(count($this->column_search) - 1 == $i){
                    // close bracket
            $this->db->group_end();
          }
        }
        $i++;
      }

      // Calculate offset based on pagination
      $offset = ($page - 1) * $limit;

      // Get data with pagination
      $this->db->limit($limit, $offset);
      $query = $this->db->get('your_table_name');

      return $query->result_array();
  }

  function createcase($data){
    $this->db->insert('claims_livelocationjob',$data);
    // Get the ID of the inserted row
    $insert_id = $this->db->insert_id();
    // Fetch the entire row using the ID
    $query = $this->db->get_where('claims_livelocationjob', array('id' => $insert_id));
    return $query->row();
  }

  function accept_case($userid, $aid){
    $data = array('uid_to' => $userid);
    $this->db->where('aid', $aid);
    $this->db->update('claims_livelocationjob_assign', $data);
    if($this->db->affected_rows() > 0){
      return true;
    }else{
      return false;
    }
  }

  function updateaccepted_case($aid){
    $data = array('status' => '1');
    $this->db->where('aid', $aid);
    $this->db->update('claims_livelocationjob', $data);
    if($this->db->affected_rows() > 0){
      return true;
    }else{
      return false;
    }
  }

  public function getUserverification($userid){
    $this->db->select('id,salutation,firstname,lastname,mobile,alt_mobile,email,termsandconditions,state,city,address,pincode,profilephoto,email_verified,mobile_verified,usertype,corporateId, app_user,is_active');
    $query = $this->db->get_where('claims_users', array('id' => $userid));
    return $query->row_array();
  }

  private function getUserById($id) {
      // Query the database to check if the user exists
      $query = $this->db->get_where('claims_inspector_location', array('inspectorId' => $id));
      return $query->row_array();
  }

  private function updateLocation($userId, $userData) {
      // Update the user record in the database
      $this->db->where('id', $userId);
      $this->db->update('claims_inspector_location', $userData);
  }

  private function createLocation($userData) {
      // Insert a new user record into the database
      $this->db->insert('claims_inspector_location', $userData);
  }



  public function is_mobile_exists($mobile){
    $query = $this->db->get_where('claims_users', array('mobile' => $mobile));
    return $query->num_rows() > 0;
  }

  public function validate_user($data){
    $query = $this->db->get_where('claims_users', array(
      'mobile' => $data['mobile'],
      'passcode' => md5($data['passcode'])
    ));
    return $query->row();
  }

      /** 
     * @mobile exist
     * is mobile exist?
     * */
    function mobile_exist($data=null){
      $this->db->where('mobile',$data);
      $query = $this->db->get('claims_users');
      if($query->num_rows() == 1)
      {
        return true;
      }else{
        return false;
      }  
    }

    /**
     * @mobileVarify
     * is mobile verified?
     */
    function mobile_verify($value=null){
      $data = array('mobile'=> $value,
                    'mobile_verified'=>true);
      $this->db->where($data);
      $query = $this->db->get('claims_users');
      if($query->num_rows() == 1)
      {
        return true;
      }else{
        return false;
      }  
    }

    /**
     * Update User profile
     * */ 
    public function updateUser($data=null){
      $this->db->where('mobile', $data['mobile']);
      
      if($this->db->update('claims_users', $data)){
        return true;
      }else{
        return false;
      }
    }

    /**
     * Create new user profile
     * */ 
    public function createuser($data){  
      if($this->db->insert('claims_users',$data)){
        return true;
      }else{
        return false;
      }
    }

    /**
     * otpverify
     * */
    public function otpverify($data=null){
      $data = array('mobile'=> $data['mobile'],
                    'otp'=>$data['otp']);
      $this->db->where($data);
      $query = $this->db->get('claims_users');
      if($query->num_rows() == 1)
      {
        return true;
      }else{
        return false;
      }  
    }

    /**
     * User List
     * */
    public function getusers(){
      $this->db->select('cst.userId, cu.salutation, cu.firstname, cu.lastname, cu.city, cu.state,cu.address, cu.pincode,cu.profilephoto, cu.email_verified, cu.mobile_verified,cu.is_active, cu.createdat');
      $this->db->from('claims_users as cu');
      $this->db->join('claims_salvage_trader as cst', 'cst.userId = cu.id', 'right');
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
        return $query->result();
      }else {
        return 'No results found';
      }
    }

    public function getinspectorlocation($inspectorId){
      $this->db->select('latitude,longitude'); 
      $this->db->from('claims_inspector_location');
      $this->db->where('inspectorId', $inspectorId);
      $query = $this->db->get();
      return $query->row();
    }

    public function get_upcoming_cases($userid){
      $this->db->select('clj.id,clj.aid,clj.latitude,clj.jobdata,clj.longitude,clj.userId,ctl.investigator_type,clj.status,clj.createdAt, cu.salutation,cu.firstname,cu.lastname,clja.uid_to');
      $this->db->from('claims_livelocationjob as clj');
      $this->db->join('claims_livelocationjob_assign as clja', 'clja.aid = clj.aid', 'inner');
      $this->db->join('claims_users as cu', 'cu.id = clj.userId','left');
      $this->db->join('claims_task_list as ctl', 'ctl.id = clj.natureofjob','left');
      $this->db->where('clja.uid_to', $userid);
      $this->db->where('clj.status !=', '1');
      $this->db->limit(10);
      $query = $this->db->get();

      if ($query->num_rows() > 0) {
          return $query->result();
      }
      return FALSE;
    }

    public function get_accepted_cases(){
      $userid = $this->session->userdata('id');
      $this->db->select('clj.id,clj.aid,clj.userId,ctl.investigator_type,clj.status,clj.createdAt, cu.salutation,cu.firstname,cu.lastname,clja.uid_to');
      $this->db->from('claims_livelocationjob as clj');
      $this->db->join('claims_livelocationjob_assign as clja', 'clja.aid = clj.aid', 'inner');
      $this->db->join('claims_users as cu', 'cu.id = clj.userId','left');
      $this->db->join('claims_task_list as ctl', 'ctl.id = clj.natureofjob','left');
      // $this->db->order_by('createdAt', 'DESC');
      // $this->db->where('(clja.uid_to = '.$userid.' OR clja.uid_to = 0)');
      $this->db->where('clj.status', '1');
      
      $this->db->limit(10);
      $query = $this->db->get();

      if ($query->num_rows() > 0) {
          return $query->result();
      }
      return FALSE;
    }
}
?>
