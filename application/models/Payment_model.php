<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Payment_model extends CI_Model{

  public function __construct(){
      parent::__construct();
  }

  /*
  * Fetch members data from the database
  * @param $_POST filter data based on the posted parameters
  */
  public function getRows($postData){
    $this->_get_datatables_query($postData);
      if($postData['length'] != -1) {
        $this->db->limit($postData['length'], $postData['start']);
      }
      $query = $this->db->get();
      if ($query) {
        // Check if there are rows in the result
        if ($query->num_rows() > 0) {
          return $query->result_array();
        } else {
          // Return an empty array or a message indicating no rows found
          return array();
        }
      } else {
        // Return the database error message
        return $this->db->error()['message'];
      }
  }
  
  /*
  * Count all records
  */
  public function countAll(){
    $this->db->from('claims_payout');
    return $this->db->count_all_results();
  }
  
  /*
  * Count records based on the filter params
  * @param $_POST filter data based on the posted parameters
  */
  public function countFiltered($postData){
    $this->_get_datatables_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }
  
  /*
  * Perform the SQL queries needed for an server-side processing requested
  * @param $_POST filter data based on the posted parameters
  */
  private function _get_datatables_query($postData){
    $userid = $this->session->userdata('id');
    $this->column_search = array('cp.aid','cp.totalamount','cp.pavablepeg','cp.balanceamount','cp.totaltds','cp.paymentat','ctl.investigator_type');
    $this->db->select('cp.aid,cp.totalamount,cp.pavablepeg,cp.balanceamount,cp.totaltds,cp.paymentat,ctl.investigator_type');
    $this->order = array('cp.id' => 'asc');
    $this->db->from('claims_payout as cp');
    $this->db->join('claims_nonlocationjob as cnj','cp.aid  = cnj.aid','RIGHT');
    $this->db->join('claims_task_list as ctl','cnj.natureofjob  = ctl.id','RIGHT');
    $this->db->where('cp.userId',$userid);

    $i = 0;
    // loop searchable columns 
    foreach($this->column_search as $item){
      // if datatable send POST for search
      if(isset($postData['search']['value'])){
        // first loop
        if($i===0){
          // open bracket
          $this->db->group_start();
          $this->db->like($item, $postData['search']['value']);
        }else{
          $this->db->or_like($item, $postData['search']['value']);
        }
        // last loop
        if(count($this->column_search) - 1 == $i){
        // close bracket
          $this->db->group_end();
        }
      }
      $i++;
    }

    if(isset($postData['order'])){
      $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    }else if(isset($this->order)){
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }


  public function getpayin($data){
      $this->db->select('cp.*, cu.salutation, cu.firstname, cu.lastname');
      $this->db->from('claims_payment as cp');
      $this->db->join('claims_users as cu', 'cp.paymentBy = cu.id', 'LEFT');
      $this->db->where('cp.aid', $data);
      $query = $this->db->get();
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
  }

  public function getpayout($data){
      $this->db->select('cpo.*, cu.salutation, cu.firstname, cu.lastname');
      $this->db->from('claims_payout as cpo');
      $this->db->join('claims_users as cu', 'cpo.userId = cu.id', 'LEFT');
      $this->db->where('cpo.aid', $data);
      $query = $this->db->get();
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
  }

  public function getBalanceRows($balanceData){
    $this->_get_datatables_balance_query($balanceData);
    if($balanceData['length'] != -1) {
        $this->db->limit($balanceData['length'], $balanceData['start']);
    }

    $query = $this->db->get();
    

    if ($query) {
        // Check if there are rows in the result
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            // Return an empty array or a message indicating no rows found
            return array();
        }
    } else {
        // Return the database error message
        return $this->db->error()['message'];
    }
  }
  public function countBalanceAll(){
    $this->db->from('claims_nonlocationjob');
    return $this->db->count_all_results();
  }
  public function countBalanceFiltered($balanceData){
    $this->_get_datatables_balance_query($balanceData);
    $query = $this->db->get();
    return $query->num_rows();
  }
  public function _get_datatables_balance_query($balanceData){
    $userid = $this->session->userdata('id');
    $this->column_search = array('cpj.id',
                                  'cpj.aid',
                                  'cpj.userId',
                                  'ctl.investigator_type', 
                                  'cpja.totalamount',
                                  'cpja.receivedamount',
                                  'cpja.balanceamount',
                                  'cpja.uid_to');
    $this->db->select("cpj.id,
                      cpj.aid,
                      cpj.userId, 
                      ctl.investigator_type, 
                      cpja.totalamount,
                      cpja.receivedamount,
                      cpja.balanceamount,
                      cpja.uid_to");

    $this->order = array('cpj.id' => 'asc');
    $this->db->from('claims_nonlocationjob as cpj');
    $this->db->join('claims_nonlocationjob_assign as cpja','cpj.aid  = cpja.aid','INNER');
    $this->db->join('claims_task_list as ctl','cpj.natureofjob  = ctl.id','RIGHT');
    $this->db->where('cpj.userId',$userid);

    $i = 0;
    // loop searchable columns 
    foreach($this->column_search as $item){
      // if datatable send POST for search
      if(isset($balanceData['search']['value'])){
        // first loop
        if($i===0){
          // open bracket
          $this->db->group_start();
          $this->db->like($item, $balanceData['search']['value']);
        }else{
          $this->db->or_like($item, $balanceData['search']['value']);
        }
        // last loop
        if(count($this->column_search) - 1 == $i){
        // close bracket
          $this->db->group_end();
        }
      }
      $i++;
    }

    if(isset($balanceData['order'])){
      $this->db->order_by($this->column_order[$balanceData['order']['0']['column']], $balanceData['order']['0']['dir']);
    }else if(isset($this->order)){
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }
}