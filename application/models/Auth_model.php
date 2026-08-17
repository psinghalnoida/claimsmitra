<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth_model extends CI_Model{
    public function __construct(){
      parent::__construct();
      $this->data = array();
    }

    

    function applyforclaim($data){
     if($this->db->insert('claims_claim',$data)){
        return true;
      }else{
        return false;
      }
    }

    function getallcasesbymobile($data){
      $this->db->where('inspector',$data);
      $query = $this->db->get('claims_claim');
      if($query->num_rows()>0){
        return $query->result_array();
      }else{
        return false;
      }
    }

    public function getUserbyphone($data){
      $this->db->where('mobile',$data);
      $query = $this->db->get('claims_users');
      if($query->num_rows()>0){
        return true;
      }else{
        return false;
      }
    }

    public function getclaimlistbymobile($data){
      $this->db->where($data);
      $this->db->from('claims_claim');
      $query = $this->db->get();
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
    }

    public function check_relation($familymemberid, $userId){
      $where = "familymemberId=$familymemberid AND userId=$userId";
      $this->db->where($where);
      $query = $this->db->get('claims_relative');
      if($query->num_rows()>0){
        return true;
      }else{
        return false;
      }
    }

    public function uploadImage($policyid,$customerId,$image){
      $where = "id=$policyid AND customerId=$customerId";
      $this->db->where($where);
      if($this->db->update('claims_policy', $image)){
        return true;
      }else{
        return false;
      }
    }
    public function checkExists($caseid, $casereference)
    {
        $this->db->where('caseid', $caseid);
        $this->db->where('casereference', $casereference);
        $query = $this->db->get('claims_media');

        return $query->num_rows() > 0;
    }

    

    public function getimagesfromclaim($claimid,$customerId){
      $where = "id=$claimid AND customerId=$customerId";
      $this->db->select('images');
      $this->db->where($where);
      $this->db->from('claims_claim');
      $query = $this->db->get()->row('images');
      return $query;
    }

    public function uploadclaimdata($policyid,$customerId,$image){
      $where = "id=$policyid AND customerId=$customerId";
      $this->db->where($where);
      if($this->db->update('claims_claim', $image)){
        return true;
      }else{
        return false;
      }
    }


    public function updateprofile($userid,$data = array()){
      $where = "id=$userid";
      $this->db->where($where);
      if($this->db->update('claims_users', $data)){
        return true;
      }else{
        return false;
      }
    }


    public function getpolicylist($customerId){
      $where = "customerId=$customerId";
      $this->db->where($where);
      $this->db->from('claims_policy');
      $query = $this->db->get();
      if($query->num_rows()>0){
        return $query->result_array();
      }else{
        return null;
      } 
    }

    public function getpolicybyid($policyid){
      $this->db->where($policyid);
      $this->db->from('claims_policy');
      $query = $this->db->get();
      return $query->row();
    }

    public function getimagesfrompolicy($policyid,$customerId){
      $where = "id=$policyid AND customerId=$customerId";
      $this->db->select('images');
      $this->db->where($where);
      $this->db->from('claims_policy');
      $query = $this->db->get()->row('images');
      return $query;
    }

    public function getfamilymembers($data){
      $this->db->select('*');
      $this->db->from('claims_relative relative'); 
      $this->db->join('claims_users users', 'relative.familymemberId=users.id', 'left');
      $this->db->where('relative.userId',$data);
      $query = $this->db->get(); 
      if($query->num_rows() != 0)
      {
          return $query->result_array();
      }
      else
      {
          return false;
      }
    }

    public function getuserdata($data){
      $this->db->where('mobile',$data);
      $this->db->from('claims_users');
      $query = $this->db->get()->row('id');
      return $query;
    }

    public function fetchrelationlist(){
      $query = $this->db->get('claims_relation');
      return $query->result_array();
    }

    public function fetchtypeofpolicylist(){
      $query = $this->db->get('claims_typesofpolicy');
      return $query->result_array();
    }

    public function verifyotp($data=null){
      $this->db->where($data);
      $query = $this->db->get('claims_users');
      if($query->num_rows()>0){
        return true;
      }else{
        return false;
      }
    }

    public function verifytoken($data=null){
      $this->db->where($data);
      $query = $this->db->get('claims_users');
      if($query->num_rows()>0){
        return true;
      }else{
        return false;
      }
    }
    public function createuser($data){  
      if($this->db->insert('claims_users',$data)){
        return true;
      }else{
        return $this->db->error();
      }
    }
    /*public function linkagent($data = array()){
      $where = "id=$data['id'] AND customerId=$data['customerId']";
      $this->db->where($where);
      if($this->db->update('claims_policy', $data)){
        return true;
      }else{
        return false;
      }
    }*/

    public function sharedwithfamilymember(){
      if($_POST){
        
      }
    }

    public function removefamilymember(){
      $policyid  = $this->input->post('policyid');
      $familymemberid  = $this->input->post('familymemberid');
      $data = array("");
      $result = $this->Auth_model->remove_familymember($data);
    }
    public function createrelation($data){
      if($this->db->insert('claims_relative',$data)){
        return true;
      }else{
        return $this->db->error();
      }
    }

    public function updateUser($data=null){
      $this->db->where('mobile', $data['mobile']);
      if($this->db->update('claims_users', $data)){
        return true;
      }else{
        return false;
      }
    }

    public function userlogin($params = array()){ 
      $query=$this->db->where($params);
      $login=$this->db->get('claims_users');
      if($login->num_rows()>0){
      return $login->result_array();
      } 
    }

    public function insertpolicy($data=null){
      $this->db->insert('claims_policy',$data);
      $insert_id = $this->db->insert_id();
      return $insert_id;
    }

    public function gettypeofpolicy($params = array()){
      $data = array();
      $query=$this->db->where($params);
      $query=$this->db->get('claims_typesofpolicy');
      $query = $query->result_array();
      if($query!=null){
        foreach ($query as $policydata) {
          $data[] = array("id"=>$policydata['id'],
                        "policyname"=>$policydata['policyname'],
                        "policyicon"=>base_url('/assets/upload/'.$policydata['policyicon']));
        }
        return $data;
      }
    }

    public function getuserprofession($data){
      $this->db->where('profession',$data);
      $this->db->from('claims_profession');
      $query = $this->db->get()->row('id');
      return $query;
    }

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


    public function getuserbymobile($data){
      $this->db->where('mobile',$data);
      $this->db->from('claims_users');
      $query = $this->db->get()->row();
      return $query;
    }

    public function getuserbyid($data){
      $this->db->where('id',$data);
      $this->db->from('claims_users');
      $query = $this->db->get();
      return $query->result_array();
    }
    /*public function applyforclaim($data = array()){
      $this->db->insert('claims_claim',$data)
      $insert_id = $this->db->insert_id();
      return $insert_id;
    }*/

    /**
     * Insert live location of Inspector
     * 
     * **/

    public function updatelivelocation($data = null){
      $this->db->where('userid', $data['userid']);
      if($this->db->update('claims_location',$data)){
        return true;
      }else{
        return false;
      }
    }

    public function update_availablity($data = null){
      $this->db->where('userid', $data['userid']);
      if($this->db->update('claims_location', $data)){
        return true;
      }else{
        return false;
      }
    }

    public function fetchbanner(){
      $query = $this->db->get('claims_banner');
      return $query->result_array();
    }
    
    public function acceptclaimbyuser($data = null){
      if($this->db->insert('claims_acceptclaim',$data)){
        return true;
      }else{
        return false;
      }
    }


    
}