<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class Company_model extends CI_Model{

  public function __construct(){
    parent::__construct();

  }

  public function getCompaniesByUserId($user_id) {
    $this->db->select('c.cid,c.usertype, cc.companyName');
    $this->db->from('claims_connect_with_department c');
    $this->db->join('claims_company cc', 'cc.id = c.cid', 'LEFT');
    $this->db->where('c.uid', $user_id);
    return $this->db->get()->result(); // return multiple companies
  }

  public function get_user_departments_with_names($cid,$uid) {
    $query = $this->db->get_where('claims_connect_with_department', [
        'uid' => $uid,
        'cid' => $cid
    ]);

    $row = $query->row();

    if ($row) {
        $dept_ids = explode(',', $row->departmentid);

        // Fetch department names using WHERE IN
        $this->db->where_in('id', $dept_ids);
        $dept_query = $this->db->get('claims_department');

        $departments = [];
        foreach ($dept_query->result() as $dept) {
            $departments[] = [
                'id' => $dept->id,
                'department' => $dept->department
            ];
        }
        return [
            'usertype' => $row->usertype,
            'departments' => $departments
        ];
        // // $result['usertype'] = $row->usertype;
        // return $result;
    }

    return [];
  }
  // public function get_company_profile($uid) {
  //   return $this->db->get_where('claims_connect_with_department', [
  //       'uid' => $uid
  //   ])->row(); // Return first connected company data
  // }
  public function fetchDepartmentNamesByCorporateId($user_id) {
    // Step 1: Fetch department IDs and usertype
    $this->db->select('departmentid, usertype');
    $this->db->from('claims_connect_with_department as ccd'); // Added alias
    $this->db->where('ccd.uid', $user_id); // Where condition for user ID

    $query = $this->db->get();
    $departmentIds = null;
    $usertype = null;

    if ($query->num_rows() > 0) {
        $result = $query->row(); // Get the first row
        $departmentIds = $result->departmentid; // Access the departmentid column
        $usertype = $result->usertype;
    }

    if (empty($departmentIds)) {
        // Fallback if no department IDs are found
        return [
            [
                'usertype' => 'default_usertype', // Replace with a valid default usertype
                'id' => 0, // Default ID
                'department' => 'Default Department', // Default department name
            ],
        ];
    }

    // Step 2: Convert department IDs to an array
    $departmentIdsArray = explode(',', $departmentIds); // Convert to array

    // Step 3: Fetch department details based on IDs
    $query = $this->db->select('id, department')
                      ->from('claims_department')
                      ->where_in('id', $departmentIdsArray)
                      ->get();

    $departments = [];
    foreach ($query->result_array() as $row) {
        $departments[] = [
            'usertype' => $usertype ?? 'default_usertype', // Provide default if null
            'id' => $row['id'],
            'department' => $row['department'] ?? 'Default Department', // Provide default if null
        ];
    }

    // Step 4: Return the departments array
    return !empty($departments) ? $departments : [
        [
            'usertype' => 'default_usertype', // Replace with a valid default usertype
            'id' => 0, // Default ID
            'department' => 'Default Department', // Default department name
        ],
    ];
  }

  public function fetchCompanyNameByUserID($user_id) {
    $this->db->select('ccd.usertype, ccd.cid');
    $this->db->from('claims_connect_with_department as ccd'); 
    $this->db->where('ccd.uid', $user_id);
    $this->db->order_by('ccd.usertype', 'asc');
    $query = $this->db->get();

    if($query->num_rows() > 0) {
        $results = $query->result();
        foreach ($results as $result) {
            if ($result->cid == 0) {
                $result->companyName = "INDIVIDUAL";
            }else{
                $result->companyName = $this->getCompanyName($result->cid);
            }
        }
        return $results; 
    } else {
        return false;
    }
  }

  public function getCompanyName($cid){
    $this->db->select('companyName');
    $this->db->from('claims_company');
    $this->db->where('id', $cid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->row()->companyName;
    } else {
        return null;
    }
  }

  public function getDepartmentName($departmentid){
    $this->db->select('department');
    $this->db->from('claims_department');
    $this->db->where('id', $departmentid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->row()->department;
    } else {
        return null;
    }
  }

  public function fetchprofession(){
      $query = $this->db->get('claims_corporate');
      return $query->result_array();
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
    $this->db->from('claims_company');
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
    // $this->column_search = array('CC.id','CC.cid','CC.companyName','CC.panNo','CC.cinNo','CC.website','CC.status','CU.id','CU.firstname','CU.lastname','CU.mobile');
    // $this->db->select("CC.*,CU.id as userId, CU.firstname, CU.lastname, CU.mobile");
    // $this->order = array('status'=> 0);
    // // Set default order
    // $this->db->from('claims_company as CC');
    // $this->db->join('claims_users as CU',' CC.createdBy = CU.id','LEFT');

    $this->column_search = array('CC.cid','CC.companyName');
    $this->db->select("CC.*");
    $this->order = array('status'=> 0);
    // Set default order
    $this->db->from('claims_company as CC');
    // $this->db->join('claims_users as CU',' CC.createdBy = CU.id','LEFT');
    
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
  public function searchpancard($data = null){
    $data = array('panNo'=> $data);
    $this->db->where($data);
    $query = $this->db->get('claims_company');
    if($query->num_rows() == 1)
    {
      return true;
    }else{
      return false;
    }
  }
  // public function  ($data = null){
  //   $query = $this->db->insert('claims_company',$data);
  //   if($query){
  //     return true;
  //   }else{
  //     return $this->db->_error_message();
  //   } 
  // }
  public function addCompany($data = null) {
    $query = $this->db->insert('claims_company', $data);
    if ($query) {
        return true; // Return true if the insert was successful
    } else {
        // Get the error message using the error() method
        $error = $this->db->error(); // This will return an array with 'code' and 'message'
        return $error['message']; // Return the error message
    } 
}

  public function getcompanybyId($data = null){
    $this->db->select("CC.id,CC.cid, CC.licenceNo, CC.professionId,CC.companyName,CC.cinNo,CC.website,CC.status,GROUP_CONCAT(CP.profession ORDER BY CP.id) profession");
    $this->order = array('CC.id' => 'asc');
    $this->db->from('claims_company as CC');
    $this->db->join('claims_profession as CP','FIND_IN_SET(CP.id, CC.professionId) > 0','RIGHT');
    $this->db->where('CC.cid',$data);
    $query = $this->db->get();
    if($query->num_rows() > 0)
    {
      return $query->result_array();
    }else{
      return false;
    }
  }
  
  public function getcompanyByUserId($userId = null) {
    if ($userId === null) {
        return false; 
    }

    // Selecting necessary fields, including professionId and profession name
    $this->db->select("CC.id, CC.cid, CC.licenceNo, CC.professionId, CC.companyName, CC.cinNo, CC.licenceImage, GROUP_CONCAT(CP.profession ORDER BY CP.id SEPARATOR ', ') as professions");
    $this->db->from('claims_company as CC');
    
    // Join to get profession names based on professionId
    $this->db->join('claims_profession as CP', 'FIND_IN_SET(CP.id, CC.professionId)', 'LEFT');
    $this->db->where('CC.createdBy', $userId);
    $this->db->group_by('CC.id'); // Grouping by company ID to ensure single result per company
    $query = $this->db->get();

    if (!$query) {
        $error = $this->db->error(); 
        return "Query Error: " . $error['message'];
    }

    // Fetching results as an array
    if ($query->num_rows() > 0) {
        return $query->result_array(); 
    } else {
        return false;
    }
  }
 
  public function editCompanyDetailsById($companyId) {
    $this->db->select("CC.id, CC.cid, CC.licenceNo, CC.professionId, CC.companyName, CC.cinNo, CC.licenceImage, GROUP_CONCAT(CP.profession ORDER BY CP.id SEPARATOR ', ') as professions");
    $this->db->from('claims_company as CC');

    // Join to get profession names based on professionId
    $this->db->join('claims_profession as CP', 'FIND_IN_SET(CP.id, CC.professionId)', 'LEFT');
    $this->db->where('CC.id', $companyId);
    $this->db->group_by('CC.id'); // Grouping by company ID to ensure single result per company
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->result_array(); // Return the existing company data
    } else {
        return false; // No results found
    }
  }



public function updateCompany($data) {
  $this->db->where('cid', $data['cid']);
  unset($data['cid']); // Don't include cid in the update data
  return $this->db->update('claims_company', $data);
}
public function deleteCompanyById($id) {
  $this->db->where('id', $id);
  $query = $this->db->get('claims_company');
  
  if ($query->num_rows() === 0) {
      return false; 
  }
  $this->db->where('id', $id);
  $this->db->delete('claims_company');
  return $this->db->affected_rows() > 0;
}


  public function insertbranch($branchData) {
    $this->db->insert('claims_branch', $branchData);
    if ($this->db->affected_rows() > 0) {
        return true;
    } else {
        return $this->db->error(); 
    }
  }

  public function getRegulated(){
    $this->db->select("*");
    $this->db->from('claims_profession');
    $this->db->where('type',0);
    $query = $this->db->get();
    if($query->num_rows() > 0)
    {
      return $query->result_array();
    }else{
      return false;
    }
  }

  public function getUnregulated(){
    $this->db->select("*");
    $this->db->from('claims_profession');
    $this->db->where('type',1);
    $query = $this->db->get();
    if($query->num_rows() > 0)
    {
      return $query->result_array();
    }else{
      return false;
    }
  }


  /*
  * Fetch members data from the database
  * @param $_POST filter data based on the posted parameters
  */
  public function getBranchRows($postData){
    $this->_get_branch_datatables_query($postData);
    if($postData['length'] != -1){
      $this->db->limit($postData['length'], $postData['start']);
    }
    
    $query = $this->db->get();

    return $query->result();
  }

/*
 * Count all records
 */
public function countAllbranch(){
  $this->db->from('claims_branch');
  return $this->db->count_all_results();
}

/*
 * Count records based on the filter params
 * @param $_POST filter data based on the posted parameters
 */
public function countFilteredbranch($postData){
  $this->_get_branch_datatables_query($postData);
  $query = $this->db->get();
  return $query->num_rows();
}

/*
 * Perform the SQL queries needed for an server-side processing requested
 * @param $_POST filter data based on the posted parameters
 */
private function _get_branch_datatables_query($postData){
  $this->column_search = array('CB.bid','CB.cid','CB.address','CB.gst','CB.pincode','CB.state','CB.city','CB.status','CC.cid','CC.companyName');
  $this->db->select("CB.bid,CB.cid,CB.address,CB.pincode,CB.gst,CB.state,CB.city,CB.status,CC.cid as companyId, CC.companyName");
  $this->order = array('CB.status'=> 0);
  // Set default order
  $this->db->from('claims_branch as CB');
  $this->db->join('claims_company as CC',' CC.cid = CB.cid','RIGHT');
  $this->db->where('CB.cid',$postData['select_company']);

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