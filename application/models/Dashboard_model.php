<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_model extends CI_Model{

  public function __construct(){
    parent::__construct();

  }

  /* ------------------------------------------------------------------------- *
  * FETCH ASSIGNMENT BY DATE
  * ------------------------------------------------------------------------- */
  public function get_cases_by_date($postData)
  {
    $this->_get_assignment_datatables_query($postData);
    if ($postData['length'] != -1) {
      $this->db->limit($postData['length'], $postData['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  /*
  * Count all records
  */
  public function countallAssignement()
  {
    $this->db->from('claims_livelocationjob');
    return $this->db->count_all_results();
  }

  /*
  * Count records based on the filter params
  * @param $_POST filter data based on the posted parameters
  */
  public function countFilteredAssignment($postData)
  {
    $this->_get_assignment_datatables_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

  /*
  * Perform the SQL queries needed for an server-side processing requested
  * @param $_POST filter data based on the posted parameters
  */
  private function _get_assignment_datatables_query($postData)
  { 
    $departmentid = $postData['department'];
    $companyid = $postData['company'];
    $userid = $this->session->userdata('id');

    // Define column names for searching
    $this->column_search = array('CJ.case_reference','CJ.aid','CTL.investigator_type');

    // Status mapping for search
    $status_map = [
        'Under Survey' => 1,
        'Photo Uploaded' => 2,
        'LOR Sent' => 3, 
        'FSR' => 4, 
        'Billing' => 5,
        'Waiting for TI' => 6,
        'Pending for Dispatch' => 7,
        'Dispatched' => 8,
        'Partially Payment Received' => 9,
        'Case Completed' => 10,
        'Cancelled' => 11,

    ];

    // Select required fields
    $this->db->select("CJ.id, CJ.case_reference, CJA.uid_from, CJA.departmentid, CJ.status, 
                       CJA.uid_to, CJA.cid_from, CJA.cid_to, CJ.aid, CTL.investigator_type, 
                       CJ.jobdata,CJ.essentialdata, JSON_UNQUOTE(JSON_EXTRACT(CJ.essentialdata, '$.insured_name')) AS insured_name, CJ.status, CJ.createdAt, CJ.latitude, CJ.longitude");
    $this->order = array('CJ.id' => 'desc');
    $this->db->from('claims_livelocationjob as CJ');
    $this->db->join('claims_livelocationjob_assign as CJA', 'CJA.aid = CJ.aid', 'left');
    $this->db->join('claims_task_list as CTL', 'CTL.id = CJ.natureofjob', 'left');
    $this->db->where("CJA.departmentid", $departmentid);
    $this->db->where("CJA.cid_to", $companyid);
    // print_r(json_encode($this->db->get()->result_array()));
    // exit;
    // Check if there is a search value
    if (isset($postData['search']['value']) && !empty($postData['search']['value'])) {
        $search_value = strtolower(trim($postData['search']['value']));
        
        // Check if the search term matches a status
        if (isset($status_map[$search_value])) {
            // If searching by status, filter by numeric value
            $this->db->where("CJ.status", $status_map[$search_value]);
        } else {
            // General search across defined columns
            $i = 0;
            foreach ($this->column_search as $item) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $search_value);
                } else {
                    $this->db->or_like($item, $search_value);
                }

                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
                $i++;
            }
        }
    }

    // Order by column if provided
    if (isset($postData['order'])) {
        $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    } else if (isset($this->order)) {
        $order = $this->order;
        $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function getAssignmentByDate(){
    $userid = $this->session->userdata('id');
    $this->db->select("DATE(createdAt) as createdat, COUNT(*) as total_cases");
    $this->db->from('claims_livelocationjob');
    $this->db->where('userId', $userid);
    $this->db->group_by("DATE(createdAt)");
    $query = $this->db->get();
    return $query->result();
  }

public function getTotalamounttopay($data){
  $this->db->select('balanceamount');
  $this->db->from('claims_nonlocationjob_assign');
  $this->db->where('uid_from',$data);
  $query = $this->db->get();
  return $query->result_array();
}

public function getOutgoinglivelocationjobs() {
  $userid = $this->session->userdata('id');
  $this->db->select("COUNT(*) as outgoing_livelocation_cases");
  $this->db->from('claims_livelocationjob'); 
  $this->db->where('userId', $userid); // Replace 'user_id' with the actual column name
  $result = $this->db->get()->row();
  return $result->outgoing_livelocation_cases;
}

// TOTAL INCOMING CASES
public function getTotalIncomingCases($companyid, $deartmentid) {
  $this->db->where('cid_to', $companyid);
  $this->db->where('departmentid', $deartmentid);
  return $this->db->count_all_results('claims_livelocationjob_assign');
}

// TOTAL UNDERSURVEY CASES
public function getTotalUnderSurveyCases($companyid, $departmentid) {
  $this->db->select('clj.aid, clj.case_reference, clja.uid_to');
  $this->db->from('claims_livelocationjob_assign as clja');
  $this->db->join('claims_livelocationjob as clj', 'clj.aid = clja.aid', 'LEFT');
  $this->db->where('clja.cid_to', $companyid);
  $this->db->where('clja.departmentid', $departmentid);
  $this->db->where('clj.status', 1);
  return $this->db->count_all_results();
}

// TOTAL BILLING DONE
public function getTotalBillingDone($companyid, $departmentid) {
  $this->db->select('clj.aid, clj.case_reference, clja.uid_to');
  $this->db->from('claims_livelocationjob_assign as clja');
  $this->db->join('claims_livelocationjob as clj', 'clj.aid = clja.aid', 'LEFT');
  $this->db->where('clja.cid_to', $companyid);
  $this->db->where('clja.departmentid', $departmentid);
  $this->db->where('clj.status', 5);
  return $this->db->count_all_results();
}

// TOTAL BILLING DONE
public function getTotalDispatchCases($companyid, $departmentid) {
  $this->db->select('clj.aid, clj.case_reference, clja.uid_to');
  $this->db->from('claims_livelocationjob_assign as clja');
  $this->db->join('claims_livelocationjob as clj', 'clj.aid = clja.aid', 'LEFT');
  $this->db->where('clja.cid_to', $companyid);
  $this->db->where('clja.departmentid', $departmentid);
  $this->db->where('clj.status', 8);
  return $this->db->count_all_results();
}
// NonLocation Incoming Cases
public function getIncomingnonlocationjobs() {
  $userid = $this->session->userdata('id');
  $this->db->select("COUNT(*) as incoming_nonlocation_cases");
  $this->db->from('claims_nonlocationjob_assign'); 
  $this->db->where('uid_to', $userid); // Replace 'user_id' with the actual column name
  $result = $this->db->get()->row();
  return $result->incoming_nonlocation_cases;
}
// LiveLocation Incoming Cases
public function getIncominglivelocationjobs() {
  $userid = $this->session->userdata('id');
  $this->db->select("COUNT(*) as incoming_livelocation_cases");
  $this->db->from('claims_pincodejob_assign'); 
  $this->db->where('uid_to', $userid); // Replace 'user_id' with the actual column name
  $result = $this->db->get()->row();
  return $result->incoming_livelocation_cases;
}
//  Table of outgoing fetch data
   public function getOutgoingData() {
      // Select specific fields from a table
      $this->db->select('aid, natureofjob,status');
      $query = $this->db->get('claims_nonlocationjob');

      return $query->result();
   }
// end  
  
  public function getallJobs(){
    $query = $this->db->get('claims_job');
    if($query->num_rows() > 0){
    return $query->result_array();
    }else{
        return false;
    }
  }

  /*public function getcompany(){
    $query = $this->db->get('claims_company');
    if($query->num_rows() > 0){
    return $query->result_array();
    }else{
        return false;
    }
  }

  public function updatecin($data){
    $this->db->where('companyName',$data['companyName']);
    $query = $this->db->update('claims_company',$data);
      if($query){
        return true;
      }else{
        $eee= $this->db->_error_message();

   
      } 
  }*/

    /*public function getTranslator($data = null, $userId){
      $this->db->select('CI.userId,CU.firstname,CU.lastname');
      $this->db->from('claims_users as CU');
      $this->db->join('claims_investigator as CI', 'CU.id = CI.userId','right');
      $this->db->where('find_in_set("'.$data.'", CI.language) <> 0');
      $this->db->where('CI.userId !=', $userId);
      $result = $this->db->get();
      if($result->num_rows() > 0){
          return $result->result_array();
      }else{
          return false;
      }
    }*/

    

   


//////////////Saurabh Sharma

///get live location working data
function get_translation_live_location(){

$qqq="SELECT *,claims_job.id as claimsid,claims_job.aid as claims_aid,claims_job.status as case_status,claims_investigator_list.investigator_type as assignment_name,(select firstname from claims_users where id=claims_job.userId) as assigned_by,(select mobile from claims_users where id=claims_job.userId) as assigned_by_mob,(select firstname from claims_users where id=uid_to) as assigned_to,(select mobile from claims_users where id=uid_to) as assigned_to_mob  FROM claims_job left join claims_investigator_list on claims_job.natureofjob=claims_investigator_list.id left join claims_job_assign on claims_job.aid=claims_job_assign.aid where  claims_job.job_type='live_location_based' and  claims_job.status!='7' and claims_job.status!='6' order by claims_job.id desc ";
        $query = $this->db->query($qqq);



        if($query->num_rows() > 0){
        return $query->result_array();
        }else{
            return false;
        }
    }



 ///get live location deleted data
   function deletedd_live_case(){

        $query = $this->db->query("SELECT *,claims_job.id as claimsid,claims_job.aid as claims_aid,claims_job.status as case_status,claims_investigator_list.investigator_type as assignment_name,(select firstname from claims_users where id=claims_job.userId) as assigned_by,(select mobile from claims_users where id=claims_job.userId) as assigned_by_mob,(select firstname from claims_users where id=uid_to) as assigned_to,(select mobile from claims_users where id=uid_to) as assigned_to_mob  FROM claims_job left join claims_investigator_list on claims_job.natureofjob=claims_investigator_list.id left join claims_job_assign on claims_job.aid=claims_job_assign.aid where  claims_job.job_type='live_location_based' and  claims_job.status='7' order by claims_job.id desc ");



        if($query->num_rows() > 0){
        return $query->result_array();
        }else{
            return false;
        }
    }

 ///get live location complete record data
       function completed_live_case(){

        $query = $this->db->query("SELECT *,claims_job.id as claimsid,claims_job.aid as claims_aid,claims_job.status as case_status,claims_investigator_list.investigator_type as assignment_name,(select firstname from claims_users where id=claims_job.userId) as assigned_by,(select mobile from claims_users where id=claims_job.userId) as assigned_by_mob,(select firstname from claims_users where id=uid_to) as assigned_to,(select mobile from claims_users where id=uid_to) as assigned_to_mob  FROM claims_job left join claims_investigator_list on claims_job.natureofjob=claims_investigator_list.id left join claims_job_assign on claims_job.aid=claims_job_assign.aid where  claims_job.job_type='live_location_based' and  claims_job.status='6' order by claims_job.id desc ");



      
        return $query->result_array();
        
    }

 ///Job assign to inspector and get  last recorded id
  public function claims_job_assignment($data){

// json_encode($data); 
    $query = $this->db->insert('claims_job',$data);

     $insert_id = $this->db->insert_id();
      if($query){
        return $insert_id;
      }else{
        $eee= $this->db->_error_message();

   
      } 
    }

 ///get case details by ID
     public function get_Case_details($aid){

       $query = $this->db->query("SELECT *,claims_job.id as claimsid,claims_job.aid as claims_aid,claims_job.status as case_status,claims_investigator_list.investigator_type as assignment_name,claims_job.inspector_report as inspector_report,claims_users.firstname as inspector_f_name,claims_users.lastname as inspector_l_name,claims_job_assign.uid_to as inspector_idd FROM claims_job left join claims_investigator_list on claims_job.natureofjob=claims_investigator_list.id  left join claims_job_assign on claims_job.aid=claims_job_assign.aid left join claims_users on claims_job_assign.uid_to=claims_users.id where claims_job.aid='".$aid."'");
       
            if($this->db->affected_rows() > 0)
                {
                     
              $array = [];
                $key=0;        

           
          return  $query->result_array();
                   }
                else
                {
                   return false;
                }
            
        }

///get job edit
     public function claims_job_edit($data,$aid){

 $this->db->where('aid',$aid);
    $query = $this->db->update('claims_job',$data);
      if($query){
        return true;
      }else{
        $eee= $this->db->_error_message();

   
      } 
    }
    /// Add Comment on case 
       public function comment_on_case($data){
    $query = $this->db->insert('claims_chat_real',$data);
      if($query){
        return true;
      }else{

      return false;   
      } 
    }

 
    ///get Inspector Those working in APk
    function getinspector(){

       $this->db->where('app_user','1');
        $query = $this->db->get('claims_users');
        if($query->num_rows() > 0){
        return $query->result_array();
        }else{
            return false;
        }
    }

//check valid assigned Case
     public function check_valid_asign($idd){

       $this->db->where('aid',$idd);
        $query = $this->db->get('claims_job_assign');
        if($query->num_rows() > 0){
        return $query->num_rows();
        }else{
            return 0;
        }
    }

//check Update Assign Case
  public function update_asign_case($aid,$data){

 $this->db->where('aid',$aid);
    $query = $this->db->update('claims_job_assign',$data);
      if($query){
        return true;
      }else{
        $eee= $this->db->_error_message();

   
      } 
    }
    // ----- CHATTING SYSTEM BY VIDHI SHARMA ---------
    public function allUser()
    {
      if (isset($_SESSION['id'])) {
          $mysession = $_SESSION['id'];
          $this->db->select('*');
          $this->db->where('id !=', $mysession);
          $data = $this->db->get('claims_users');
          if ($data->num_rows() > 0) {
              return $data->result_array();
          } else {
              return false;
          }
      } 
    }

    public function saveMessage($senderId, $receiverId, $message)
    {
        $data = array(
            'sender_message_id' => $senderId,
            'receiver_message_id' => $receiverId,
            'message' => $message,
            'time' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('user_messages', $data);
    }

    public function getMessages($receiverId, $senderId) {
        $this->db->select('message, time');
        $this->db->from('user_messages');
        $this->db->where('receiver_message_id', $receiverId);
        $this->db->where('sender_message_id', $senderId);
        $this->db->order_by('time', 'asc'); 
        $query = $this->db->get();
        return $query->result_array();
    }
  //------  END CHATTING SYSTEM ----------

}

?>