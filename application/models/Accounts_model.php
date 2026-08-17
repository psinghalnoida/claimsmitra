<?php defined('BASEPATH') or exit('No direct script access allowed');
class Accounts_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

    /**
     * Non Location Pending Cases
     * */
    public function getMisData($postData){
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
    public function countAllMisData(){
        $this->db->from('claims_livelocationjob');
        return $this->db->count_all_results();
    }

    /*
    * Count records based on the filter params
    * @param $_POST filter data based on the posted parameters
    */
    public function countFilteredMisData($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
    * Perform the SQL queries needed for an server-side processing requested
    * @param $_POST filter data based on the posted parameters
    */
    public function _get_datatables_query($postData){
    $this->column_search = array('id','investigator_type','unit','rate','time','based_on');
    
    $this->db->select('id,investigator_type,unit,rate,time,based_on');
    // Set default order
    $this->order = array('id' => 'asc');
    $this->db->from('claims_livelocationjob');
    $this->db->where('find_in_set('.$postData['jobs'].', based_on) <> 0');

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

    

}