<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_model extends CI_Model{
    public function __construct(){
      parent::__construct();
      $this->data = array();
    }
    /**
     * @Model
     * Insert User Registration data
     */
    /*function insertUser($data=""){
      $query = $this->db->insert('claims_users',$data);
      if($query){
        return true;
      }else{
        return $this->db->_error_message();
      } 
    }*/

    function getUserById($userid){
      return $this->db->get_where('claims_users', ['id' => $userid])->row_array();

    }

    function updateProfilephoto($user_id, $filePath){
      $this->db->where('id', $user_id);
      $this->db->update('claims_users', ['profilephoto' => $filePath]);

      if ($this->db->affected_rows() > 0) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * @Model
     * Account Verification
     */
    function verifyEmailandMobile($value=null){
      $this->db->select('email,email_verified');
      $this->db->from('claims_users');
      $this->db->where('email',$value);
      $response = $this->db->get();
      if($response->result()!=null){
        return $response->result();
      }else{
        return false;
      }
    }

    /**
     * user login model 
     * @function loginUser
     * @model Home 
     */
    
    function loginUser($value=""){
      $this->db->select('*');
      $data = array("mobile"=> $value['mobile'],
                    'passcode'=>md5($value['passcode']),  
                    'is_active'=> 1);
      $this->db->where($data);
      $result = $this->db->get('claims_users');
      if($result->num_rows()>0)
      {
        return $result->result_array();
      }else{
        return false;
      }
    }

    function getDepartments() {
      $query = $this->db->get('claims_department'); 
      return $query->result_array();
    }

    function saveUserDepartments($user_id, $department_ids) {
      $department_ids_string = implode(',', $department_ids); 
      $corporate_id = $this->session->userdata('corporateId');
      
      $data = array(
          'uid' => $user_id,               
          'departmentid' => $department_ids_string, 
          'cid' => $corporate_id,                                 
      );
      
      if ($this->db->insert('claims_connect_with_department', $data)) {
          return true; 
        } else {
          return false; 
      }

    }
    
  
  
    // function getBranchId($corporate_id) {
    //   $this->db->select('claims_branch.bid'); 
    //   $this->db->from('claims_users'); 
    //   $this->db->join('claims_company', 'claims_users.corporateId = claims_company.id'); 
    //   $this->db->join('claims_branch', 'claims_company.id = claims_branch.cid');
    //   $this->db->where('claims_users.corporateId', $corporate_id); 
      
    //   $query = $this->db->get();
  
    //   if ($query->num_rows() > 0) {
    //       return $query->row()->bid;
    //   } else {
    //       return null; 
    //   }
    // }
    public function getDepartmentNamesByCorporateId($corporate_id) {
      // Selecting department names based on corporate ID
      $this->db->select('cd.department'); // Select the department name
      $this->db->from('claims_connect_with_department as ccd'); // Main table
      $this->db->join('claims_department as cd', 'FIND_IN_SET(cd.id, ccd.departmentid) > 0'); // Join using FIND_IN_SET to handle multiple department IDs
      $this->db->where('ccd.cid', $corporate_id); // Where condition for corporate ID
  
      $query = $this->db->get();
  
      // Check for errors and return results
      if ($query === false) {
          log_message('error', 'Database query error: ' . $this->db->last_query());
          log_message('error', 'Database error message: ' . json_encode($this->db->error()));
          return false; // Return false to indicate failure
      }
  
      return $query->result(); // Returns an array of department objects with names
    }


  public function getCompaniesByUserId($user_id) {
    // Select company names
    $this->db->select('companyName');
    $this->db->from('claims_company'); 
    $this->db->where('createdBy', $user_id); 
    $query = $this->db->get();
    
    if ($query->num_rows() > 0) {
        return $query->result(); 
    } else {
        return false;
    }
  }
  
  
  
  
  
    function getCompanyNameById($corporateid){
      $this->db->select('companyName');
      $this->db->from('claims_company');
      $this->db->where('id',$corporateid);
      $row = $this->db->get()->row();
      if (isset($row)) {
          return $row->companyName;
      } else {
          return false;
      }
    }
    
  
    function searchPincode($pincode){
      $this->db->select("*");
      $this->db->from("claims_pincode");
      if($pincode != '')
      {
       $this->db->like('pincode', $pincode);
      }
      $this->db->order_by('pincode_id', 'DESC');
      return $this->db->get()->result_array();
    }

    function getuserdatabyid($value = null){
      $this->db->where('id',$value);
      $query = $this->db->get('claims_users');
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
    }
    
    public function isInvestigatorExist($userid = null){
      $data = array();
      $this->db->where('userId',$userid);
      $query = $this->db->get('claims_investigator');
      if($query->num_rows() > 0){
        foreach ($query->result_array() as $value) {
          $data = array("id"=>$value['id'],
                        "userid"=>$value['userId'],
                        "investigator"=>$value['investigator'],
                        "language"=>$value['language'],
                        "others"=>$value['others'],
                        "isActive"=>$value['isActive']);
        }
        return $data;
      }else{
        return false;
      }
    }
    public function getbank_detailbyid($data){
      $this->db->select("*");
      $this->db->from('claims_bank as cb');
      $this->db->where('cb.id', $data['id']);
      $query = $this->db->get();
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
    }
    
    public function updateBank($data) {
      if ($data !== null && isset($data['id'])) {
          $this->db->where('id', $data['id']);
          unset($data['id']);
  
          if ($this->db->update('claims_bank', $data)) {
              return true;
          } else {
              $db_error = $this->db->error();
              log_message('error', 'Database Error: ' . $db_error['message']);
              return false;
          }
      } else {
          return false;
      }
  }
    
  // public function updateDocument($data) {
  //   if ($data !== null && isset($data['id'])) {
  //       $this->db->where('id', $data['id']);
  //       unset($data['id']);
  
  //       if ($this->db->update('claims_kyc_document', $data)) {
  //           return array("status" => 200, "message" => "Kyc document updated successfully!");
  //       } else {
  //           $db_error = $this->db->error();
  //           log_message('error', 'Database Error: ' . $db_error['message']);
  //           return array("status" => 502, "message" => "Failed to update Kyc document");
  //       }
  //   } 
  // }
//   public function updateDocument($data, $documentId) {
//     if ($data !== null && $documentId) {
//         $this->db->where('id', $documentId);
//         // Update the record in the database
//         if ($this->db->update('claims_kyc_document', $data)) {
//             return true; // Update was successful
//         } else {
//             $db_error = $this->db->error();
//             log_message('error', 'Database Error: ' . $db_error['message']);
//             return array("status" => 502, "message" => "Failed to update KYC document");
//         }
//     } 
//     return false; // If no data or ID was provided
// }

public function updateDocument($data, $documentId) {
  if ($data !== null && $documentId) {
      $this->db->where('id', $documentId);
      // Update the record in the database
      if ($this->db->update('claims_kyc_document', $data)) {
          return true; // Update was successful
      } else {
          $db_error = $this->db->error();
          log_message('error', 'Database Error: ' . $db_error['message']);
          return array("status" => 502, "message" => "Failed to update KYC document: " . $db_error['message']);
      }
  } 
  return array("status" => 502, "message" => "No data or document ID provided.");
}





    public function getnatureofjobbyid($id = null){
      $this->db->from('claims_task_list');
      $this->db->where('id',$id);
      return $this->db->get()->row()->investigator_type;
    }

    public function getbankdetailbyuserid($value = null){
      $this->db->where('userid',$value);
      $query = $this->db->get('claims_bank');
      if($query->num_rows() > 0){
        foreach ($query->result_array() as $value) {
          $data[] = array("id"=>$value['id'],
                        "userid"=>$value['userid'],
                        "bankname"=>$this->getbankname($value['bankId']),
                        "accounttype"=>$value['accounttype'],
                        "accountno"=>$value['accountno'],
                        "ifsccode"=>$value['ifsccode'],
                        "chequecopy"=>$value['chequecopy'],
                        "micrcode"=>$value['micrcode'],
                        "upi"=>$value['upi'],
                        "status"=>$value['status']);
        }
        return $data;
      }else{
        return false;
      }
    }




  
  //   public function getbankdetailbyuserid($userid) {
  //     $this->db->where('userid', $userid);
  //     $query = $this->db->get('claims_bank');
  //     log_message('debug', "Query: " . $this->db->last_query()); 
  //     if ($query->num_rows() > 0) {
  //         $data = [];
  //         foreach ($query->result_array() as $value) {
  //             $data[] = [
  //                 "id" => $value['id'],
  //                 "userid" => $value['userid'],
  //                 "bankname" => $this->getbankname($value['bankId']),
  //                 "accounttype" => $value['accounttype'],
  //                 "accountno" => $value['accountno'],
  //                 "ifsccode" => $value['ifsccode'],
  //                 "chequecopy" => $value['chequecopy'],
  //                 "micrcode" => $value['micrcode'],
  //                 "upi" => $value['upi'],
  //                 "status" => $value['status']
  //             ];
  //         }
  //         log_message('debug', "Bank Data: " . print_r($data, true));
  //         return $data;
  //     } else {
  //         return false; // No records found
  //     }
  // }
  
  
  
  function getbankname($bankid) {
    $this->db->select('bankname');
    $this->db->from('claims_banklist');
    $this->db->where('id', $bankid);
    $query = $this->db->get();
    
    if ($query->num_rows() > 0) {
        return $query->row()->bankname;
    } else {
        return null;
    }
   }


    /**
     * user login model 
     * @function loginUser
     * @model Home 
     */
    function getprofession($value=null){
      $this->db->select('profession');
      $this->db->from('claims_profession');
      $this->db->where('id',$value);
      $row = $this->db->get()->row();
      if (isset($row)) {
          return $row->profession;
      } else {
          return false;
      }
    }

    /**
     * @emailVarify
     * Email field varification
     */
    /*function emailVarify($data=null){
      
      $this->db->select('email,email_verified');
      $this->db->from('claims_users');
      $this->db->where('email',$data['email']);
      $response = $this->db->get();
      if($response->result()!=null){
        return $response->result();
      }else{
        return false;
      }
    }*/

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

    public function getprofessionid($value){
      $this->db->select('id');
      $this->db->from('claims_profession');
      $this->db->where('profession',$value);
      $row = $this->db->get()->row();
      if (isset($row)) {
          return $row->id;
      } else {
          return false;
      }
    }

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

    public function resetpasscode($value = "", $passcode = "",$type = ""){
      $this->db->where($type, $value);
      $data = array($type=>$value,
                    "passcode"=>$passcode);
      if($this->db->update('claims_users', $data)){
        return true;
      }else{
        return false;
      }
    }


    public function fetchprofession(){
      $query = $this->db->get('claims_profession');
      return $query->result_array();
    }

    

    public function getgst_detail($data = null){
      $this->db->where($data);
      $query = $this->db->get('claims_gst');
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
    }

    public function getbank_list(){
      $query = $this->db->get('claims_banklist');
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
    }
    /*public function get_enterprisesBybusiness_type($data = null){
      $this->db->where($data);
      $query = $this->db->get('claims_company');
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
    }*/

    /*public function getkyc_documents($data = null){
      $this->db->where($data);
      $query = $this->db->get('claims_kyc');
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
    }*/

   
    public function getKycDetailById($id) {
      $this->db->select('*');
      $this->db->from('claims_kyc_document');
      $this->db->where('id', $id);
      $query = $this->db->get();
      $response['status'] = 404;
      if ($query->num_rows() > 0) {
          $response['status'] = 200;
          $response['data'] = $query->row();
      }
      return $response;
    }
    
    public function getsla_data($query){
       $search = $this
                ->db
                ->select('*')
                ->from('claims_individual_surveyor')
                ->where('ind_sla_no_bap_format',$query)
                ->or_where('ind_sla_no',$query)
                ->get();
     
        if($search->num_rows()>0)
        {
            return $search->result(); 
        }
        else
        {
            return null;
        }
    }

    public function addnewbank($data = null){
      if($this->db->insert('claims_bank',$data)){
        return true;
      }else{
        return $this->db->error();
      }
    }
    public function addnewagent($data = null){
      if($this->db->insert('claims_agent',$data)){
        return true;
      }else{
        return false;
      }
    }

    public function addnewsalvagebuyer($data = null){
      if($this->db->insert('claims_salvage_trader',$data)){
        return true;
      }else{
        return false;
      }
    }

    public function addnewinvestigator($data = null){
      if($this->db->insert('claims_investigator',$data)){
        return true;
      }else{
        return false;
      }
    }
    
    public function updateInvestigator($data = null, $userid = null){
      $this->db->where('userId', $userid);
      if($this->db->update('claims_investigator', $data)){
        return true;
      }else{
        return false;
      }
    }

    public function searchInvestigator($data = null, $value = null){
      $invetigator = null;
      $this->db->where('userId','114');
      $this->db->from('claims_investigator');
      $query = $this->db->get()->row()->investigator;
      if($query != "" && $query != null){
        /*print_r($query);
        exit;*/
        $this->db->select("FIND_IN_SET('$value','$query')");
        $invetigator = $this->db->get();
        if($invetigator->result() != 0){
          return $invetigator->result();
        }
      }else{
        return false;
      } 

      /*$this->db->select('*');
      $this->db->from('claims_investigator');
      $this->db->where("find_in_set($value, $data)");
      $query = $this->db->get();
      print_r($query->num_rows());
      exit;
      if($query->num_rows() > 0){
        return true;
      }else{
        return false;
      }*/
    }

    /**
     * Investigator list 
     * @function getinvestigator
    */
    function getinvestigator(){
      $query = $this->db->get('claims_task_list');
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
    }



    /**
     * Salvage buyer category list 
     * @function getsalvagebuyercateogrylist
    */
    function getsalvagebuyercateogrylist(){
      $query = $this->db->get('claims_salvage_trader_category');
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
    }


    /**
     * Salvage buyer sub category list 
     * @function getsalvagebuyersubcateogrylist
    */
    function getsalvagebuyersubcateogrylist($data){
      $this->db->where('categoryid',$data);
      $query = $this->db->get('claims_salvage_trader_subcategory');
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
    }
    

    function getstatelist(){
      $query = $this->db->get('claims_states');
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
    }

    function getcityList($stateId){
      $this->db->where('state_id',$stateId);
      $query = $this->db->get('claims_cities');
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
    }
    

    /**
     * Kyc document list 
     * @function getkyc_list
    */
    function getkyc_list(){
      $query = $this->db->get('claims_kyc');
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
    }

    /**
     * Add new kyc document 
     * @function add_documents
    */
    public function add_documents($data = null){
        if($this->db->insert('claims_kyc_document',$data)){
          return true;
        }else{
          return false;
        }
    }

    public function addnewdocument($data = null){
      if($this->db->insert('claims_kyc_document',$data)){
        return true;
      }else{
        return $this->db->error();
      }
    }
    public function existance($data){
      $this->db->where('userid',$data['userid']);
      $this->db->where('document_type',$data['document_type']);
      $query = $this->db->get('claims_kyc_document');
      if($query->num_rows() > 0){
        return true;
      }else{
        return false;
      }
    }

    /**
     * get kyc document by id 
     * @function getkyc_documnetbyid
    */
    public function getkycdetailbyuserid($value = null){
      $this->db->where('userid', $value);
      $query = $this->db->get('claims_kyc_document');
  
      if ($query->num_rows() > 0) {
          foreach ($query->result_array() as $value) {
              $data[] = array(
                  "id" => $value['id'],
                  "userid" => $value['userid'],
                  "document_type" => $value['document_type'],
                  "document_no" => $value['document_no'],
                  "document_image" => $value['document_image'],
                  "created_at" => $value['created_at'],
              ); 
          }
          return $data;
          echo json_encode($data);
      } else {
          return false;
      }
  }
  
    /**
     * get kyc document by id 
     * @function getlicencebyid
    */
    function getagentbyuserId($value = null){
      $this->db->select('ca.*, cc.companyName');
      $this->db->from('claims_agent as ca');
      $this->db->join('claims_company as cc', 'ca.companyId = cc.id', 'LEFT');
      $this->db->where('ca.userid', $value);
      $query = $this->db->get();
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
    }

    // function getagentbyId($value = null){
    //   $this->db->select('ca.*');
    //   $this->db->from('claims_agent as ca');
    //   $this->db->where('ca.id', $value);
    //   $query = $this->db->get();
    //   if($query->num_rows() > 0){
    //     return $query->result_array();
    //   }else{
    //     return false;
    //   }
    // }
    public function getagentbyId($id) {
      $this->db->select('claims_agent.id, 
                         claims_agent.companyId, 
                         claims_agent.userId, 
                         claims_agent.licenceno, 
                         claims_agent.licenceValidity, 
                         claims_agent.isActive, 
                         claims_company.companyName');
      $this->db->from('claims_agent');
      $this->db->join('claims_company', 'claims_company.id = claims_agent.companyId', 'left');
      $this->db->where('claims_agent.id', $id);
      $query = $this->db->get();
      
      if ($query->num_rows() > 0) {
          return $query->result_array(); // return result as an array
      }
      return null; // or return false
    }
    function deletetraderbyid($trader_id) {
      $this->db->where('id', $trader_id); 
      return $this->db->delete('claims_salvage_trader');
    }
    function deleteagentbyid($id) {
      $this->db->where('id', $id); 
      return $this->db->delete('claims_agent');
    }
  
    function geteditSalvageById($salvageid) {
      $this->db->select('
          claims_salvage_trader.subcategory,
          claims_salvage_trader.region,
          claims_salvage_trader.buyer_range
      ');
      $this->db->from('claims_salvage_trader');
      $this->db->join('claims_salvage_trader_subcategory', 'claims_salvage_trader_subcategory.id IN (claims_salvage_trader.subcategory)', 'left');
      $this->db->join('claims_states', 'claims_states.id IN (claims_salvage_trader.region)', 'left');
      $this->db->where('claims_salvage_trader.id', $salvageid);
      $query = $this->db->get();
  
      if ($query !== false && $query->num_rows() > 0) {
          return $query->row_array();
      } else {
          log_message('error', 'Database query failed for salvageid: ' . $salvageid);
          return false;
      }
    }
  
  
    function getsalvagebuyerbyId($value = null){
      $data = array();
      $this->db->select('csb.*, csbc.category_name as salvage_buyer_catergory');
      $this->db->from('claims_salvage_trader  as csb');
      $this->db->join('claims_salvage_trader_category as csbc', 'csb.category = csbc.id', 'LEFT');
      $this->db->where('csb.userid', $value);
      $query = $this->db->get();
      if($query->num_rows() > 0){
        foreach ($query->result_array() as $value) {
          $data[] = array("id"=>$value['id'],
                        "userid"=>$value['userId'],
                        "categoryid"=>$value['category'],
                        "subcategory"=>$this->getsubcategory($value['subcategory']),
                        "buyer_range"=>$value['buyer_range'],
                        "region"=>$this->getstate($value['region']),
                        "others"=>$value['others'],
                        "isActive"=>$value['isActive'],
                        "salvage_buyer_catergory"=>$value['salvage_buyer_catergory']);
        }
        return $data;
      }else{
        return false;
      }
    }
    
    function getInvestigatorbyId($value = null){
      $data = array();
      $this->db->select('*');
      $this->db->from('claims_investigator');
      $this->db->where('userId', $value);
      $query = $this->db->get();
      if($query->num_rows() > 0){
        foreach ($query->result_array() as $value) {
          $data[] = array("id"=>$value['id'],
                        "userid"=>$value['userId'],
                        "investigator"=>explode(',',$value['investigator']),
                        "language"=>$value['language'],
                        "other"=>$value['others'],
                        "isActive"=>$value['isActive']);
        }
        return $data;
      }else{
        return false;
      }
    }

    function getsubcategory($ids){
      $subcategory = array();
      $subcategory_list = unserialize($ids);
      $query = $this->db->where_in("id", $subcategory_list)->get("claims_salvage_trader_subcategory");
      return $query->result_array();
    }

    function getstate($ids){
      $subcategory = array();
      $subcategory_list = unserialize($ids);
      $query = $this->db->where_in("id", $subcategory_list)->get("claims_states");
      return $query->result_array();
    }

    function getdocument_detailbyid($value = null){
      $this->db->where('id',$value);
      $query = $this->db->get('claims_kyc_document');
      if($query->num_rows() > 0){
        return $query->result();
      }else{
        return false;
      }
    }

    function getcompanybyprofession($value = null){
      $this->db->where('find_in_set("'.$value.'", professionId) <> 0');
      $this->db->where('status',1);
      $query = $this->db->get('claims_company');
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
    }

    function deletebank($id = null) {
      $this->db->where('id', $id);
      $this->db->delete('claims_bank');
      return $this->db->affected_rows() > 0; 
    }
  
    function deletedocument($documentId = null) {
      if ($documentId) {
          $this->db->where('id', $documentId);
          $this->db->delete('claims_kyc_document');
          return $this->db->affected_rows() > 0; // Ensure it returns true if a row was deleted
      }
      return false; // Return false if no document ID is provided
    }
  


    function deleteprofessionById($id = null, $profession  = null){
      if($this->db->query("UPDATE claims_investigator SET investigator=replace(investigator, '$profession,',''),investigator=replace(investigator, ',$profession','') WHERE id=$id"))
      {
        return true;
      }else{
        return false;
      }
    }

    function checkcompanydetail($data = null){
      $this->db->where('id',$data);
      $query = $this->db->get('claims_company');
      if($query->num_rows() > 0){
        return $query->result();
      }else{
        return false;
      }
    }
}