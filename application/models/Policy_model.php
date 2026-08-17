<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Policy_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->data = array();
    // Set table name
    $this->table = 'claims_policy';
    // Set orderable column fields
    $this->column_order = array(null, 'claims_users.salutation','claims_users.firstname','claims_users.lastname','claims_policy.id','claims_policy.typeofpolicy','claims_policy.policyno','claims_policy.policystartdate','claims_policy.policyenddate','claims_policy.premiun','claims_policy.status','claims_policy.createdAt');
    // Set searchable column fields
    $this->column_search = array('claims_users.salutation','claims_users.firstname','claims_users.lastname','claims_policy.id','claims_policy.typeofpolicy','claims_policy.policyno','claims_policy.policystartdate','claims_policy.policyenddate','claims_policy.premiun','claims_policy.status','claims_policy.createdAt');
    // Set default order
    $this->order = array('claims_users.firstname' => 'asc');
  }

  /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */
    public function getRows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    /*
     * Count all records
     */
    public function countAll(){
        $this->db->from($this->table);
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
        $this->db->select($this->column_order);  
        $this->db->from($this->table);
        $this->db->join('claims_users','claims_policy.customerId = claims_users.id', 'left');
 
        $i = 0;
        // loop searchable columns 
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
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

    public function getpolicydatabyid($data){
        $this->db->select('*');
        $this->db->from('claims_policy');
        //$this->db->join('claims_users','claims_policy.customerId = claims_users.id', 'left');
        $this->db->where('claims_policy.id',$data);
        $response = $this->db->get();
        if($response->result()!=null){
            return $response->result();
        }else{
            return false;
        }
    }

}