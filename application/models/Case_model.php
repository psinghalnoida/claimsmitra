<?php defined('BASEPATH') or exit('No direct script access allowed');
class Case_model extends CI_Model
{

  public $formattedDateTime;
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('array');
    $this->load->helper('date');
    date_default_timezone_set('Asia/Kolkata');
    $currentDateTime = now();
    $this->formattedDateTime = date('d-m-Y H:i:s', $currentDateTime);
  }

  function update_job_data($aid, $jobdata)
  {
    $data = array('jobdata' => $jobdata);
    $this->db->where('aid', $aid);
    if ($this->db->update('claims_livelocationjob', $data)) {
      return true;
    } else {
      return false;
    }
  }

  function updateImages($images, $aid, $title)
  {
    $data = array($title => $images);
    $this->db->where('aid', $aid);
    if ($this->db->update('claims_livelocationjob', $data)) {
      return true;
    } else {
      return false;
    }
  }

 public function getCompanyId($companyid)
{
    $this->db->select('cid, companyName');
    $this->db->from('claims_connect_with_department');
    $this->db->where('cid', $companyid); // Filter by company ID
    $this->db->limit(1);
    
    $query = $this->db->get();

    // Check if the query execution failed
    if (!$query) {
        log_message('error', 'Database query failed: ' . $this->db->last_query());
        return null;
    }

    if ($query->num_rows() > 0) {
        return $query->row(); // Return the full row
    }
    return null;
}



 public function getUsersWithBankDepartmentAndCompany($userid = null, $companyid = null)
{
    $this->db->distinct();
    
    $this->db->select('
        cu.id AS user_id,  
        cb.id AS bank_id, 
        cb.bankId, 
        cb.accountno, 
        cb.ifsccode, 
        cb.micrcode, 
        cc.companyName,
        cb.cid AS company_id
    ');

    $this->db->from('claims_users cu');
    $this->db->join('claims_bank cb', 'cu.id = cb.userid', 'left');
    $this->db->join('claims_company cc', 'cb.cid = cc.id', 'left'); // Fixed Join Condition

    if ($userid !== null) {
        $this->db->where('cu.id', $userid);
    }
    if ($companyid !== null) {
        $this->db->where('cb.cid', $companyid);
    }
    
    $query = $this->db->get();
    return $query->result_array();
}

public function getLetterheadPathByCompanyId($companyid)
{
    $this->db->select('letterheadimg');
    $this->db->from('claims_company_letterheads');
    $this->db->where('cid', $companyid);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row()->letterheadimg;
    }
    // Fallback letterhead
}








  function update_case_reference($aid, $case_reference)
  {
    $data = array('case_reference' => $case_reference);
    $this->db->where('aid', $aid);
    if ($this->db->update('claims_livelocationjob', $data)) {
      return true;
    } else {
      return false;
    }
  }
  public function getAllCaseform()
  {
    $this->db->select('id,investigator_type');
    $this->db->from('claims_task_list');
    $query = $this->db->get();
    return $query->result();
  }


   public function insert_quick_survey($data)
    {
        $this->db->insert('claims_quicksurvey', $data);

        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }



  public function updateEssentialData($data, $aid)
  {
    $dataArray = array('essentialdata' => $data);
    $this->db->where('aid', $aid);
    return $this->db->update('claims_livelocationjob', $dataArray);
  }

  public function updatePaymentData($aid, $paymentDataJson)
  {
      // Prepare data for update
      $dataArray = [
          'paymentreceipt' => $paymentDataJson  // Store the entire array as JSON in the 'paymentreceipt' column
      ];
  
      // Update the payment data in the database
      $this->db->where('aid', $aid);
      return $this->db->update('claims_billing', $dataArray);
  }
  public function insertPaymentEssentialData($data, $aid)
  {
    $dataArray = array(
      'bill_to' => $data
    );

    $this->db->where('aid', $aid);
    $query = $this->db->get('claims_billing');

    if ($query->num_rows() > 0) {
      $this->db->where('aid', $aid);
      return $this->db->update('claims_billing', $dataArray);
    } else {
      $dataArray['aid'] = $aid;
      return $this->db->insert('claims_billing', $dataArray);
    }
  }

  public function insertshippingEssentialData($data, $aid)
  {
    $dataArray = array(
      'ship_to' => $data
    );

    $this->db->where('aid', $aid);
    $query = $this->db->get('claims_billing');

    if ($query->num_rows() > 0) {
      $this->db->where('aid', $aid);
      return $this->db->update('claims_billing', $dataArray);
    } else {
      $dataArray['aid'] = $aid;
      return $this->db->insert('claims_billing', $dataArray);
    }
  }

  public function getbillingdatabyAid($aid)
  {
    $this->db->select('bill_to');
    $this->db->from('claims_billing');
    $this->db->where('aid', $aid);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return json_decode($query->row()->bill_to);  // Decode the JSON directly here
    } else {
      return false;
    }
  }

  public function getalltaxdata($aid)
  {
    $this->db->select('tax');
    $this->db->from('claims_billing');
    $this->db->where('aid', $aid);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return json_decode($query->row()->tax);  // Decode the JSON directly here
    } else {
      return false;
    }
  }
  public function conversiondata($aid)
  {
    $this->db->select('currency');
    $this->db->from('claims_billing');
    $this->db->where('aid', $aid);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return json_decode($query->row()->currency);  // Decode the JSON directly here
    } else {
      return false;
    }
  }
  public function getinvoicetaxdata($aid)
  {
    $this->db->select('invoice');
    $this->db->from('claims_billing');
    $this->db->where('aid', $aid);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return json_decode($query->row()->invoice);  // Decode the JSON directly here
    } else {
      return false;
    }
  }

  public function getadditionaldata($aid)
  {
    $this->db->select('additional_expenses');
    $this->db->from('claims_billing');
    $this->db->where('aid', $aid);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return json_decode($query->row()->additional_expenses);  // Decode the JSON directly here
    } else {
      return false;
    }
  }




  public function gettotalamount($aid)
  {
    $this->db->select('*');  // Select all fields
    $this->db->from('claims_billing');
    $this->db->where('aid', $aid);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->row();  // Return as an object
    } else {
      return false; // No data found
    }
  }


  public function getshippingdatabyAid($aid)
  {
    $this->db->select('ship_to');
    $this->db->from('claims_billing');
    $this->db->where('aid', $aid);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return json_decode($query->row()->ship_to);  // Decode the JSON directly here
    } else {
      return false;
    }
  }




  public function cattleJob($data)
  {
    $data = array('jobdata' => $data);

    if ($this->db->insert('claims_livelocationjob', $data)) {
      return true;
    } else {
      return false;
    }
  }

function updateCaseData($data, $aid)
  {
    $data = array('casedata' => $data);
    $this->db->where('aid', $aid);
    if ($this->db->update('claims_livelocationjob', $data)) {
      return true;
    } else {
      return false;
    }
  }

  function updateCaseData_outgoing($data, $aid)
  {
    $data = array('casedata' => $data);
    $this->db->where('aid', $aid);
    if ($this->db->update('claims_outgoingjobs', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function getessentialdatabyAid($aid)
  {
    $this->db->select('cl.essentialdata,cl.aid,clj.uid_to,cu.salutation as salutation, cu.firstname as firstname, cu.lastname as lastname');
    $this->db->from('claims_livelocationjob as cl');
    $this->db->join('claims_livelocationjob_assign as clj','clj.aid = cl.aid', 'left');
    $this->db->join('claims_users as cu','cu.id = clj.uid_to', 'left');
    $this->db->where('cl.aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row();
    } else {
      return false;
    }
  }

   public function getoutgoingessentialdatabyAid($aid)
  {
    $this->db->select('cl.essentialdata,cl.aid,clj.uid_to,cu.salutation as salutation, cu.firstname as firstname, cu.lastname as lastname');
    $this->db->from('claims_outgoingjobs as cl');
    $this->db->join('claims_outgoingjobs_assign as clj','clj.aid = cl.aid', 'left');
    $this->db->join('claims_users as cu','cu.id = clj.uid_to', 'left');
    $this->db->where('cl.aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row();
    } else {
      return false;
    }
  }

   public function getjobdatabyAid($aid)
  {
    $this->db->select('jobdata');
    $this->db->from('claims_livelocationjob');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->jobdata;
    } else {
      return false;
    }
  }

  public function getadditionalbyAid($aid)
  {
    $this->db->select('additional_expenses');
    $this->db->from('claims_livelocationjob');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->essentialdata;
    } else {
      return false;
    }
  }

  public function getnatureofjobbyAid($aid)
  {
    $this->db->select('natureofjob');
    $this->db->from('claims_livelocationjob');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->natureofjob;
    } else {
      return false;
    }
  }

  public function getIlaImagesByAid($aid)
  {
    $this->db->select('ilaImages');
    $this->db->from('claims_livelocationjob');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->ilaImages;
    } else {
      return false;
    }
  }


  public function getReportImagesByAid($aid)
  {
    $this->db->select('reportImages');
    $this->db->from('claims_livelocationjob');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->reportImages;
    } else {
      return false;
    }
  }

  public function getReferenceByAid($aid)
  {
    $this->db->select('case_reference');
    $this->db->from('claims_livelocationjob');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->case_reference;
    } else {
      return false;
    }
  }

  public function getcasedatabyAid($aid)
  {
    $this->db->select('casedata');
    $this->db->from('claims_livelocationjob');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->casedata;
    } else {
      return false;
    }
  }

   public function getoutgoingcasedatabyAid($aid)
  {
    $this->db->select('casedata');
    $this->db->from('claims_outgoingjobs');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->casedata;
    } else {
      return false;
    }
  }

  function get_jobdata_case($aid)
  {
    $this->db->select('jobdata');
    $this->db->from('claims_livelocationjob');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->jobdata;
    } else {
      return false;
    }
  }

  public function getReportData($aid)
  {
    $this->db->select('essentialdata,casedata');
    $this->db->where('aid', $aid);
    $this->db->from('claims_livelocationjob');
    $query = $this->db->get();
    return $query->result();
  }

 public function search($search) {
    $this->db->distinct();
    $this->db->select('cu.id, cu.firstname, cu.lastname, cu.mobile'); // Ensure `id` is selected
    $this->db->from('claims_connect_with_department cwd');
    $this->db->join('claims_users cu', 'cwd.uid = cu.id', 'LEFT'); 

    // Apply search filter only if input exists
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like('cu.firstname', $search);
        $this->db->or_like('cu.lastname', $search);
        $this->db->or_like('cu.mobile', $search);
        $this->db->group_end();
    }

    $query = $this->db->get();
    return $query->result_array();
}

public function searchInspectorIndividual($searchItem, $sessionUser)
{
    $this->db->select('id, firstname, lastname, mobile');
    $this->db->from('claims_users');
    $this->db->where('id', (int)$sessionUser); // Ensure ID is integer

    // Only apply LIKE filter if search input is provided
    if (!empty($searchItem)) {
        $this->db->group_start();
        $this->db->like('firstname', trim($searchItem));
        $this->db->or_like('lastname', trim($searchItem));
        $this->db->group_end();
    }

    $query = $this->db->get();

    // Debug SQL Query
    log_message('error', 'SQL Query: ' . $this->db->last_query());

    return $query->result_array();
}

public function getLetterheadByCompanyId($companyid)
{
    $this->db->select('letterheadimg');
    $this->db->from('claims_company_letterheads');
    $this->db->where('cid', $companyid);
    $query = $this->db->get();
    
    return $query->row(); // Returns the row object if found, otherwise NULL
}

public function getcompanynamebycid($companyid)
{
    $this->db->select('companyName');
    $this->db->from('claims_company');
    $this->db->where('id', $companyid);
    $query = $this->db->get();
    
    return $query->row_array(); // Returns the row object if found, otherwise NULL
}

  public function mobileExists($mobile)
  {
    $mobile_no = "+91" . $mobile;
    $this->db->select('id');
    $this->db->where('mobile', $mobile_no);
    $query = $this->db->get('claims_users');
    if ($query->num_rows() > 0) {
      // Mobile number exists, return its ID
      $row = $query->row();
      return $row->id;
    } else {
      // Mobile number doesn't exist
      return false;
    }
  }

  function sharedById($aid, $id)
  {
    $this->db->where('aid', $aid);
    $this->db->update('claims_livelocationjob_assign', array("sharedwith" => $id));
    return $this->db->affected_rows(); // Return the number of affected rows
  }

  


  public function countFiles($aid, $filetype,$foldername)
  {
    $directory = 'uploads/' . $aid . '/' . $filetype;
    // Count files with specific extensions
    $totalitem = $this->countFilesWithExtension($directory);
    return $totalitem;
  }

  public function countQuickFiles($aid, $filetype,$foldername)
  {
    $directory = 'quicksurvey/' . $aid . '/' . $filetype;
    // Count files with specific extensions
    $totalitem = $this->countFilesWithExtension($directory);
    return $totalitem;
  }
  // Function to count files with specific extensions
  private function countFilesWithExtension($directory)
  {
    $count = 0;
    if ($handle = opendir($directory)) {
      while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
          $ext = pathinfo($file, PATHINFO_EXTENSION);
          $count++;
        }
      }
      closedir($handle);
    }
    return $count;
  }

 

  /*
    * Fetch members data from the database
    * @param $_POST filter data based on the posted parameters
    */
  public function getRows($postData)
  {
    $query =  $this->_get_datatables_query($postData);
    if ($postData['length'] != -1) {
      $this->db->limit($postData['length'], $postData['start']);
    }
    $query = $this->db->get();

    return $query->result();
  }

  /*
    * Count all records
    */
  public function countAll()
  {
    $this->db->from('claims_nonlocationjob');
    return $this->db->count_all_results();
  }

  /*
    * Count records based on the filter params
    * @param $_POST filter data based on the posted parameters
    */
  public function countFiltered($postData)
  {
    $this->_get_datatables_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

  /*
    * Perform the SQL queries needed for an server-side processing requested
    * @param $_POST filter data based on the posted parameters
    */
  private function _get_datatables_query($postData)
  {
    $userid = $this->session->userdata('id');
    $key = "language_from:";
    $this->column_search = array('ci.investigator', 'ctl.investigator_type', 'cu.salutation', 'cu.mobile', 'cu.firstname', 'cu.lastname', 'cnj.id', 'cnj.aid', 'cnj.natureofjob', 'cnj.jobdata', 'cnj.docs', 'cnj.status', 'cnj.createdat');
    $this->db->select('ci.investigator,cu.salutation, cu.mobile, cu.firstname,cu.lastname, ci.language, cnj.*, ctl.investigator_type, cnja.uid_to');
    $this->db->select("SUBSTRING_INDEX(SUBSTRING_INDEX(cnj.jobdata, '$." . $key . "', -1),',',1) AS extracted_value");
    $this->db->from('claims_nonlocationjob as cnj');
    $this->db->join('claims_task_list as ctl', 'cnj.natureofjob = ctl.id');
    $this->db->join('claims_nonlocationjob_assign as cnja', 'cnja.aid = cnj.aid');
    $this->db->join('claims_investigator as ci', 'ci.userId = ' . $userid . '', 'inner');
    $this->db->join('claims_users as cu', 'cu.id = cnj.userId', 'inner');
    $this->db->where('FIND_IN_SET(ctl.investigator_type, ci.investigator) >', 0);
    $this->db->where('(cnja.uid_to = ' . $userid . ' OR cnja.uid_to = 0)');
    $this->db->where('cnj.userId !=', $userid);
    // $this->db->where("(CASE WHEN cnj.natureofjob = 8 THEN FIND_IN_SET(JSON_UNQUOTE(JSON_EXTRACT(cnj.jobdata, '$." . $key . "')), ci.language) > 0 ELSE JSON_UNQUOTE(JSON_EXTRACT(cnj.jobdata, '$." . $key . "')) IS NULL END)", NULL, FALSE);

    $i = 0;
    // loop searchable columns 
    foreach ($this->column_search as $item) {
      // if DataTables send POST for search
      if (isset($postData['search']['value'])) {
        // first loop
        if ($i === 0) {
          // open bracket
          $this->db->group_start();
          $this->db->like($item, $postData['search']['value']);
        } else {
          $this->db->or_like($item, $postData['search']['value']);
        }
        // last loop
        if (count($this->column_search) - 1 == $i) {
          // close bracket
          $this->db->group_end();
        }
      }
      $i++;
    }

    if (isset($postData['order'])) {
      $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    } elseif (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function paymentIn($data)
  {
    $query = $this->db->insert('claims_payment', $data);
    if ($query) {
      return true;
    } else {
      return $this->db->error();
    }
  }

  public function updatePayment($data, $casetype)
  {
    $this->db->select('receivedamount,totalamount');
    if ($casetype == 1) {
      $this->db->from('claims_nonlocationjob_assign');
    } else if ($casetype == 0) {
      $this->db->from('claims_pincodejob_assign');
    } else if ($casetype == 2) {
      $this->db->from('claims_livelocationjob_assign');
    }

    $this->db->where('aid', $data['aid']);
    $row = $this->db->get()->row();
    if (isset($row)) {
      $received_amount = floatval(str_replace(',', '', $row->receivedamount));
      $total_amount = floatval(str_replace(',', '', $row->totalamount));
      if ($received_amount == '0.00') {
        $amount = $data['receivedamount'];
        $balanceamount = $total_amount - $amount;
      } else {
        $amount = $received_amount + $data['receivedamount'];
        $balanceamount = $total_amount - $amount;
      }
      $updateamount = array(
        'receivedamount' => number_format($amount, 2),
        'balanceamount' => number_format($balanceamount, 2)
      );
      $amountupdate = $this->update_amount($updateamount, $data['aid'], $casetype);
      if ($amountupdate) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function update_amount($updateamount, $aid, $casetype)
  {
    $this->db->where('aid', $aid);
    if ($casetype == 1) {
      if ($this->db->update('claims_nonlocationjob_assign', $updateamount)) {
        return true;
      } else {
        return false;
      }
    } else if ($casetype == 0) {
      if ($this->db->update('claims_pincodejob_assign', $updateamount)) {
        return true;
      } else {
        return false;
      }
    } else if ($casetype == 2) {
      if ($this->db->update('claims_livelocationjob_assign', $updateamount)) {
        return true;
      } else {
        return false;
      }
    }
  }

  public function updateRecord($updaterecord, $aid, $casetype)
  {
    $this->db->where('aid', $aid);
    if ($casetype == 1) {
      if ($this->db->update('claims_nonlocationjob', $updaterecord)) {
        return true;
      } else {
        return false;
      }
    } else if ($casetype == 0) {
      if ($this->db->update('claims_pincodejob', $updaterecord)) {
        return true;
      } else {
        return false;
      }
    } else if ($casetype == 2) {
      if ($this->db->update('claims_livelocationjob', $updaterecord)) {
        return true;
      } else {
        return false;
      }
    }
  }
  public function jobscanbedoneByUser($userid)
  {
    $this->db->select("investigator");
    $this->db->from('claims_investigator');
    $this->db->where('userId', $userid);
    $query = $this->db->get()->row();
    if (isset($query)) {
      return $query->investigator;
    } else {
      return false;
    }
  }

   public function getInvestigatorTypeByNatureOfJob($natureofjob)
  {
    $this->db->select('ctl.investigator_type');
    $this->db->from('claims_task_list ctl');
    $this->db->join('claims_livelocationjob clj', 'ctl.id = clj.natureofjob', 'inner');
    $this->db->where('clj.natureofjob', $natureofjob);
    $query = $this->db->get();
    return $query->row() ? $query->row()->investigator_type : null;
  }

  public function getlanguagelist($userid)
  {
    $this->db->select("language");
    $this->db->from('claims_investigator');
    $this->db->where('userId', $userid);
    $query = $this->db->get()->row();
    if (isset($query)) {
      return $query->language;
    } else {
      return false;
    }
  }

 




  public function getCosting($natureofjob)
  {
    // Ensure the natureofjob is an integer to prevent SQL injection
    $natureofjob = intval($natureofjob);

    // Start a query
    $this->db->select('investigator_type, unit, rate, time, based_on');
    $this->db->from('claims_task_list');
    $this->db->where('id', $natureofjob);

    // Execute the query
    $query = $this->db->get();

    // Check if query execution was successful and rows were returned
    if ($query->num_rows() > 0) {
      return $query->row_array();
    } else {
      // Return an associative array indicating no results found
      return array(
        'status' => false,
        'message' => 'No costing data found for the specified nature of job.'
      );
    }
  }


  

  public function acceptnonlocationcase($aid)
  {
    $data = array(
      'aid' => $aid,
      'uid_to' => $this->session->userdata('id')
    );
    $this->db->where('aid', $aid);
    if ($this->db->update('claims_nonlocationjob_assign', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function updatecasestatus($aid)
  {
    $modifiedDateTime = clone $this->formattedDateTime;  // Make a copy to avoid modifying the original object
    // $modifiedDateTime->modify('+2 days');
    $data = array(
      'aid' => $aid,
      'status' => "Accepted",
      'jobstartdate' => $this->formattedDateTime
    );
    $this->db->where('aid', $aid);
    if ($this->db->update('claims_nonlocationjob', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function getNonLocationJob()
  {
    $this->db->select('*');
    $this->db->from('claims_task_list');
    $this->db->where('find_in_set("0", based_on) <> 0');
    $result = $this->db->get();
    if ($result->num_rows() > 0) {
      return $result->result_array();
    } else {
      return false;
    }
  }

  

  public function getPincodeJob()
  {
    $this->db->select('*');
    $this->db->from('claims_task_list');
    $this->db->where('find_in_set("1", based_on) <> 0');
    $result = $this->db->get();
    if ($result->num_rows() > 0) {
      return $result->result_array();
    } else {
      return false;
    }
  }
  /*
    * Fetch members data from the database
    * @param $_POST filter data based on the posted parameters
    */
  public function getVendorRows($postData)
  {
    $this->_getdatatablesquery($postData);
    if ($postData['length'] != -1) {
      $this->db->limit($postData['length'], $postData['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  /*
    * Count all records
    */
  public function countAllVendor()
  {
    $this->db->from('claims_job');
    return $this->db->count_all_results();
  }

  /*
    * Count records based on the filter params
    * @param $_POST filter data based on the posted parameters
    */
  public function countVendorFiltered($postData)
  {
    $this->_getdatatablesquery($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

  /*
  * Perform the SQL queries needed for an server-side processing requested
  * @param $_POST filter data based on the posted parameters
  */
  private function _getdatatablesquery($postData)
  {
    $userId = $this->session->userdata('id');
    $this->column_search = array('CI.userId', 'CU.firstname', 'CU.lastname', 'CU.mobile', 'CU.state', 'CU.city', 'CU.address', 'CU.pincode');
    $this->db->select('CI.userId,CU.firstname,CU.lastname,CU.mobile,CU.state,CU.city,CU.address,CU.pincode');
    $this->db->from('claims_users as CU');
    $this->db->join('claims_investigator as CI', 'CU.id = CI.userId', 'right');
    $this->db->where('find_in_set("' . $postData['language'] . '", CI.language) <> 0');
    $this->db->where('CI.userId !=', $userId);

    $i = 0;
    // loop searchable columns 
    foreach ($this->column_search as $item) {
      // if datatable send POST for search
      if (isset($postData['search']['value'])) {
        // first loop
        if ($i === 0) {
          // open bracket
          $this->db->group_start();
          $this->db->like($item, $postData['search']['value']);
        } else {
          $this->db->or_like($item, $postData['search']['value']);
        }

        // last loop
        if (count($this->column_search) - 1 == $i) {
          // close bracket
          $this->db->group_end();
        }
      }
      $i++;
    }

    if (isset($postData['order'])) {
      $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function getnatureofjob($data)
  {
    $this->db->select('investigator_type');
    $this->db->from('claims_task_list');
    $this->db->where('id', $data);
    $row = $this->db->get()->row();
    if (isset($row)) {
      return $row->investigator_type;
    } else {
      return false;
    }
  }
  /*
  * Fetch members data from the database
  * @param $_POST filter data based on the posted parameters
  */
  public function getnonlocationoutgoingcases($postData)
  {
    $this->_get_non_outgoing_datatables_query($postData);
    if ($postData['length'] != -1) {
      $this->db->limit($postData['length'], $postData['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  /*
  * Count all records
  */
  public function countAllnonlocationoutgoing()
  {
    $this->db->from('claims_nonlocationjob');
    return $this->db->count_all_results();
  }

  /*
  * Count records based on the filter params
  * @param $_POST filter data based on the posted parameters
  */
  public function countFilterednonlocationoutgoing($postData)
  {
    $this->_get_non_outgoing_datatables_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

  /*
  * Perform the SQL queries needed for an server-side processing requested
  * @param $_POST filter data based on the posted parameters
  */
  private function _get_non_outgoing_datatables_query($postData)
  {
    $userid = $this->session->userdata('id');
    $this->column_search = array(
      'CTL.investigator_type',
      'CNLJ.id',
      'CJA.uid_from',
      'CJA.uid_to',
      'CJA.cid_from',
      'CJA.cid_to',
      'CNLJ.aid',
      'CNLJ.natureofjob',
      'CNLJ.jobdata',
      'CNLJ.docs',
      'CNLJ.status',
      'CNLJ.createdat'
    );

    $this->db->select("CTL.investigator_type,
                      CNLJ.id,
                      CJA.uid_from,
                      CJA.uid_to,
                      CJA.cid_from,
                      CJA.cid_to,
                      CNLJ.aid,
                      CNLJ.natureofjob,
                      CNLJ.jobdata,
                      CNLJ.docs,
                      CNLJ.status,
                      CNLJ.createdat");
    // Set default order
    $this->order = array('CNLJ.id' => 'asc');
    $this->db->from('claims_nonlocationjob as CNLJ');
    $this->db->join('claims_nonlocationjob_assign as CJA', 'CJA.aid = CNLJ.aid', 'INNER');
    $this->db->join('claims_task_list as CTL', 'CTL.id  = CNLJ.natureofjob', 'INNER');
    $this->db->where("CNLJ.userId", $userid);

    $i = 0;
    // loop searchable columns 
    foreach ($this->column_search as $item) {
      // if datatable send POST for search
      if (isset($postData['search']['value'])) {
        // first loop
        if ($i === 0) {
          // open bracket
          $this->db->group_start();
          $this->db->like($item, $postData['search']['value']);
        } else {
          $this->db->or_like($item, $postData['search']['value']);
        }

        // last loop
        if (count($this->column_search) - 1 == $i) {
          // close bracket
          $this->db->group_end();
        }
      }
      $i++;
    }

    if (isset($postData['order'])) {
      $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function getIncomingCasebyId($id = null)
  {
    $this->column_search = array('CTL.investigator_type', 'CTL.time', 'CNLJ.jobstartdate', 'CNLJ.id', 'CU.salutation', 'CU.firstname', 'CU.lastname', 'CU.mobile', 'CNLJ.aid', 'CNLJ.natureofjob', 'CNLJ.jobdata', 'CNLJ.docs', 'CNLJ.status', 'CNLJ.createdat');
    $this->db->select("CTL.investigator_type,CTL.time,CNLJ.jobstartdate,CNLJ.id,CU.salutation,CU.firstname,CU.lastname,CU.mobile,CNLJ.aid,CNLJ.natureofjob,CNLJ.jobdata,CNLJ.docs,CNLJ.status,CNLJ.createdat");
    $this->db->from('claims_nonlocationjob as CNLJ');
    $this->db->join('claims_users as CU', 'CU.id  = CNLJ.userId', 'LEFT');
    $this->db->join('claims_task_list as CTL', 'CTL.id  = CNLJ.natureofjob', 'LEFT');
    $this->db->where("CNLJ.id", $id);
    $result = $this->db->get();
    if ($result->num_rows() > 0) {
      return $result->row_array();
    } else {
      return false;
    }
  }

  public function getAllFiles($aid, $filetype)
  {
    $directory = 'uploads/' . $aid . '/' . $filetype;
    // Get all files in the directory
    $files = $this->getFiles($directory);
    return $files;
  }

  public function getAllReports($aid, $filetype)
  {
    $directory = 'uploads/' . $aid . '/' . $filetype;
    // Get all files in the directory
    $files = $this->getFiles($directory);
    return $files;
  }


  private function getFiles($directory)
  {
    $files = array();
    if ($handle = opendir($directory)) {
      while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
          $files[] = $file;
        }
      }
      closedir($handle);
    }
    return $files;
  }

  /**
   * Non Location Pending Cases
   */
  public function getPendingCases($postData)
  {
    $this->_get_datatables_pending_query($postData);
    if ($postData['length'] != -1) {
      $this->db->limit($postData['length'], $postData['start']);
    }
    $query = $this->db->get();

    return $query->result();
  }

  /*
  * Count all records
  */
  public function countAllPendingcase()
  {
    $this->db->from('claims_nonlocationjob');
    return $this->db->count_all_results();
  }

  /*
  * Count records based on the filter params
  * @param $_POST filter data based on the posted parameters
  */
  public function countFilteredPendingCase($postData)
  {
    $this->_get_datatables_pending_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

  /*
  * Perform the SQL queries needed for an server-side processing requested
  * @param $_POST filter data based on the posted parameters
  */
  public function _get_datatables_pending_query($postData)
  {
    $userid = $this->session->userdata('id');
    $this->column_search = array(
      'CTL.investigator_type',
      'CJ.id',
      'CUA.salutation as assigntosalutation',
      'CUA.firstname as assigntofirstname',
      'CUA.lastname as assigntolastname',
      'CUA.mobile as assigntomobile',
      'CU.salutation as creatorsalutation',
      'CU.firstname as creatorfirstname',
      'CU.lastname as creatorlastname',
      'CU.mobile as creatormobile',
      'CJ.aid',
      'CJ.natureofjob',
      'CJ.jobdata',
      'CJ.docs',
      'CJ.status',
      'CJ.createdat'
    );

    $this->db->select("CTL.investigator_type,
                      CJ.id,
                      CUA.salutation as assigntosalutation,
                      CUA.firstname as assigntofirstname,
                      CUA.lastname as assigntolastname,
                      CUA.mobile as assigntomobile,
                      CU.salutation as creatorsalutation,
                      CU.firstname as creatorfirstname,
                      CU.lastname as creatorlastname,
                      CU.mobile as creatormobile,
                      CJ.aid,
                      CJ.natureofjob,
                      CJ.jobdata,
                      CJ.docs,
                      CJ.status,
                      CJ.createdat");
    // Set default order
    $this->order = array('CJ.id' => 'asc');
    $this->db->from('claims_nonlocationjob_assign as CJA');
    $this->db->join('claims_nonlocationjob as CJ', 'CJ.aid  = CJA.aid', 'LEFT');
    $this->db->join('claims_users as CU', 'CJA.uid_from  = CU.id', 'LEFT');
    $this->db->join('claims_users as CUA', 'CJA.uid_to  = CUA.id', 'LEFT');
    $this->db->join('claims_task_list as CTL', 'CJ.natureofjob  = CTL.id', 'LEFT');
    $i = 0;
    // loop searchable columns 
    foreach ($this->column_search as $item) {
      // if datatable send POST for search
      if (isset($postData['search']['value'])) {
        // first loop
        if ($i === 0) {
          // open bracket
          $this->db->group_start();
          $this->db->like($item, $postData['search']['value']);
        } else {
          $this->db->or_like($item, $postData['search']['value']);
        }

        // last loop
        if (count($this->column_search) - 1 == $i) {
          // close bracket
          $this->db->group_end();
        }
      }
      $i++;
    }

    if (isset($postData['order'])) {
      $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  /**
   * Get Location Based outgoing cases 
   */
  public function getlocationoutgoingcases($postData)
  {
    $this->_get_outgoing_datatables_query($postData);
    if ($postData['length'] != -1) {
      $this->db->limit($postData['length'], $postData['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  /*
  * Count all records
  */
  public function countAlllocationoutgoing()
  {
    $this->db->from('claims_livelocationjob');
    return $this->db->count_all_results();
  }

  /*
  * Count records based on the filter params
  * @param $_POST filter data based on the posted parameters
  */
  public function countFilteredlocationoutgoing($postData)
  {
    $this->_get_outgoing_datatables_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

  /*
  * Perform the SQL queries needed for an server-side processing requested
  * @param $_POST filter data based on the posted parameters
  */
  private function _get_outgoing_datatables_query($postData)
  {
    $userid = $this->session->userdata('id');
    $this->column_search = array(
      'CJ.id',
      'CJ.case_reference',
      'CJ.status',
      'CJA.uid_from',
      'CJA.uid_to',
      'CJA.cid_from',
      'CJA.cid_to',
      'CJ.aid',
      'ctl.investigator_type',
      'CJ.jobdata',
      'CJ.status',
      'CJ.createdAt',
      'CJ.latitude',
      'CJ.longitude'
    );

    $this->db->select("CJ.id,
                      CJ.case_reference,
                      CJA.uid_from,
                      CJ.status,
                      CJA.uid_to,
                      CJA.cid_from,
                      CJA.cid_to,
                      CJ.aid,
                      ctl.investigator_type,
                      CJ.jobdata,
                      CJ.status,
                      CJ.createdAt,
                      CJ.latitude,
                      CJ.longitude");
    // Set default order
    $this->order = array('CJ.id' => 'desc');
    $this->db->from('claims_livelocationjob as CJ');
    $this->db->join('claims_livelocationjob_assign as CJA', 'CJA.aid = CJ.aid', 'left');
    $this->db->join('claims_task_list as ctl', 'ctl.id = CJ.natureofjob', 'left');
    $this->db->where("CJ.userId", $userid);
    $this->db->where("CJ.status != ", 1);
    $i = 0;
    // loop searchable columns 
    foreach ($this->column_search as $item) {
      // if datatable send POST for search
      if (isset($postData['search']['value'])) {
        // first loop
        if ($i === 0) {
          // open bracket
          $this->db->group_start();
          $this->db->like($item, $postData['search']['value']);
        } else {
          $this->db->or_like($item, $postData['search']['value']);
        }

        // last loop
        if (count($this->column_search) - 1 == $i) {
          // close bracket
          $this->db->group_end();
        }
      }
      $i++;
    }

    if (isset($postData['order'])) {
      $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }




  /**
   * Get Location Based outgoing cases 
   */
  public function getlocationcompletedcases($postData)
  {
    $this->_get_completed_datatables_query($postData);
    if ($postData['length'] != -1) {
      $this->db->limit($postData['length'], $postData['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  /*
  * Count all records
  */
  public function countAlllocationcompleted()
  {
    $this->db->from('claims_livelocationjob');
    return $this->db->count_all_results();
  }

  /*
  * Count records based on the filter params
  * @param $_POST filter data based on the posted parameters
  */
  public function countFilteredlocationcompleted($postData)
  {
    $this->_get_completed_datatables_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

  /*
  * Perform the SQL queries needed for an server-side processing requested
  * @param $_POST filter data based on the posted parameters
  */
  private function _get_completed_datatables_query($postData)
  {
    $userid = $this->session->userdata('id');
    $this->column_search = array(
      'CJ.id',
      'CJ.status',
      'CJA.uid_from',
      'CJA.uid_to',
      'CJA.cid_from',
      'CJA.cid_to',
      'CJ.aid',
      'ctl.investigator_type',
      'CJ.jobdata',
      'CJ.status',
      'CJ.createdAt',
      'CJ.latitude',
      'CJ.longitude'
    );

    $this->db->select("CJ.id,
                      CJA.uid_from,
                      CJ.status,
                      CJA.uid_to,
                      CJA.cid_from,
                      CJA.cid_to,
                      CJ.aid,
                      ctl.investigator_type,
                      CJ.jobdata,
                      CJ.status,
                      CJ.createdAt,
                      CJ.latitude,
                      CJ.longitude");
    // Set default order
    $this->order = array('CJ.id' => 'desc');
    $this->db->from('claims_livelocationjob as CJ');
    $this->db->join('claims_livelocationjob_assign as CJA', 'CJA.aid = CJ.aid', 'INNER');
    $this->db->join('claims_task_list as ctl', 'ctl.id = CJ.natureofjob', 'left');
    $this->db->where("CJ.userId", $userid);
    $this->db->where("CJ.status", "4");
    $i = 0;
    // loop searchable columns 
    foreach ($this->column_search as $item) {
      // if datatable send POST for search
      if (isset($postData['search']['value'])) {
        // first loop
        if ($i === 0) {
          // open bracket
          $this->db->group_start();
          $this->db->like($item, $postData['search']['value']);
        } else {
          $this->db->or_like($item, $postData['search']['value']);
        }

        // last loop
        if (count($this->column_search) - 1 == $i) {
          // close bracket
          $this->db->group_end();
        }
      }
      $i++;
    }

    if (isset($postData['order'])) {
      $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function updatestatus($aid, $casestatus)
  {
    $data = array(
      'aid' => $aid,
      'status' => $casestatus
    );
    $this->db->where('aid', $aid);
    if ($this->db->update('claims_nonlocationjob', $data)) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Get Pincode based jobs
   * */
  public function getpincodeoutgoingcases($postData)
  {
    $this->_get_pincode_outgoing_datatables_query($postData);
    if ($postData['length'] != -1) {
      $this->db->limit($postData['length'], $postData['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }



  /*
  * Count all records
  */
  public function countAllpincodeoutgoing()
  {
    $this->db->from('claims_pincodejob');
    return $this->db->count_all_results();
  }

  /*
  * Count records based on the filter params
  * @param $_POST filter data based on the posted parameters
  */
  public function countFilteredpincodeoutgoing($postData)
  {
    $this->_get_pincode_outgoing_datatables_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

  private function _get_pincode_outgoing_datatables_query($postData)
  {
    $userid = $this->session->userdata('id');
    $this->column_search = array(
      'CTL.investigator_type',
      'CPJ.id',
      'CJA.uid_from',
      'CJA.uid_to',
      'CJA.cid_from',
      'CJA.cid_to',
      'CPJ.aid',
      'CPJ.natureofjob',
      'CPJ.jobdata',
      'CPJ.docs',
      'CPJ.status',
      'CPJ.createdat'
    );

    $this->db->select("CTL.investigator_type,
                      CPJ.id,
                      CJA.uid_from,
                      CJA.uid_to,
                      CJA.cid_from,
                      CJA.cid_to,
                      CPJ.aid,
                      CPJ.natureofjob,
                      CPJ.jobdata,
                      CPJ.docs,
                      CPJ.status,
                      CPJ.createdat");
    // Set default order
    $this->order = array('CPJ.id' => 'asc');
    $this->db->from('claims_pincodejob as CPJ');
    $this->db->join('claims_pincodejob_assign as CJA', 'CJA.aid = CPJ.aid', 'INNER');
    $this->db->join('claims_task_list as CTL', 'CTL.id  = CPJ.natureofjob', 'INNER');
    $this->db->where("CPJ.userId", $userid);

    $i = 0;
    // loop searchable columns 
    foreach ($this->column_search as $item) {
      // if datatable send POST for search
      if (isset($postData['search']['value'])) {
        // first loop
        if ($i === 0) {
          // open bracket
          $this->db->group_start();
          $this->db->like($item, $postData['search']['value']);
        } else {
          $this->db->or_like($item, $postData['search']['value']);
        }

        // last loop
        if (count($this->column_search) - 1 == $i) {
          // close bracket
          $this->db->group_end();
        }
      }
      $i++;
    }
    if (isset($postData['order'])) {
      $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function insertPinCodeJob($data = null)
  {
    $query = $this->db->insert('claims_pincodejob', $data);
    if ($query) {
      $result = array(
        'aid' => $data['aid'],
        'status' => true
      );
      return $result;
    } else {
      $result = array(
        'aid' => null,
        'status' => $this->db->error()
      );
      return $result;
    }
  }

  public function jobpincodeassignTo($data = null)
  {
    $query = $this->db->insert('claims_pincodejob_assign', $data);
    if ($query) {
      return true;
    } else {
      return $this->db->error();
    }
  }

  public function getCaseDetails($aid)
  {

    $this->db->select('cnj.aid,cnj.natureofjob,ctl.payoutratebyassignment,cc.percentage as usercomission,cnj.userId,cnja.uid_to,cnja.totalamount,cnja.receivedamount, cp.receivedamount as payinamount, cp.servicecharge, cp.cgst,cp.sgst,cp.igst,cp.status');
    $this->db->from('claims_payment as cp');
    $this->db->join("claims_nonlocationjob_assign as cnja", "cp.aid = cnja.aid", 'INNER');
    $this->db->join("claims_nonlocationjob as cnj", "cp.aid = cnj.aid", 'INNER');
    $this->db->join("claims_task_list as ctl", "cnj.natureofjob = ctl.id", 'INNER');
    $this->db->join("claims_comission as cc", "cnj.userId = cc.userId", 'INNER');
    $this->db->where('cp.aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return false;
    }
  }

  public function getTaxation()
  {
    $this->db->select('*');
    $this->db->from('claims_taxation');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getlive_location_Rows($postData)
  {
    $query =  $this->_get_datatables_live_query($postData);
    if ($postData['length'] != -1) {
      $this->db->limit($postData['length'], $postData['start']);
    }
    $query = $this->db->get();

    return $query->result();
  }

  /*
    * Count all records
    */
  public function countAll_live()
  {
    $this->db->from('claims_livelocationjob');
    return $this->db->count_all_results();
  }

  /*
    * Count records based on the filter params
    * @param $_POST filter data based on the posted parameters
    */
  public function countFiltered_live($postData)
  {
    $this->_get_datatables_live_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

  /*
    * Perform the SQL queries needed for an server-side processing requested
    * @param $_POST filter data based on the posted parameters
    */
  private function _get_datatables_live_query($postData)
  {
    $this->column_search = array('ctl.investigator_type', 'cu_from.salutation', 'cu_from.mobile', 'cu_from.firstname', 'cu_from.lastname', 'cu_to.salutation', 'cu_to.mobile', 'cu_to.firstname', 'cu_to.lastname', 'cu_share.salutation', 'cu_share.mobile', 'cu_share.firstname', 'cu_share.lastname', 'clj.id', 'clj.aid', 'clj.natureofjob', 'clj.jobdata', 'clj.latitude', 'clj.longitude', 'clj.status', 'clj.createdAt');
    $this->db->select('ctl.investigator_type,cu_share.mobile as mobile_share,cu_share.firstname as firstname_share,cu_share.lastname as lastname_share,cu_from.salutation as salutatio_from,cu_from.mobile as mobile_from,cu_from.firstname as firstname_from,cu_from.lastname as lastname_from,cu_to.salutation as salutatio_to,cu_to.mobile as mobile_to,cu_to.firstname as firstname_to,cu_to.lastname as lastname_to,clj.id,clj.aid,clj.natureofjob,clj.jobdata,clj.latitude,clj.longitude,clj.status,clj.createdAt');

    $this->db->from('claims_livelocationjob as clj');
    $this->db->join('claims_task_list as ctl', 'clj.natureofjob = ctl.id');
    $this->db->join('claims_livelocationjob_assign as clja', 'clja.aid = clj.aid');
    $this->db->join('claims_users as cu_from', 'cu_from.id = clja.uid_from', 'LEFT');
    $this->db->join('claims_users as cu_to', 'cu_to.id = clja.uid_to', 'LEFT');
    $this->db->join('claims_users as cu_share', 'cu_share.id = clja.sharedwith', 'LEFT');

    $i = 0;
    // loop searchable columns 
    foreach ($this->column_search as $item) {
      // if DataTables send POST for search
      if (isset($postData['search']['value'])) {
        // first loop
        if ($i === 0) {
          // open bracket
          $this->db->group_start();
          $this->db->like($item, $postData['search']['value']);
        } else {
          $this->db->or_like($item, $postData['search']['value']);
        }
        // last loop
        if (count($this->column_search) - 1 == $i) {
          // close bracket
          $this->db->group_end();
        }
      }
      $i++;
    }

    if (isset($postData['order'])) {
      $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    } elseif (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

public function getQuickSurveyCases($userId)
{
    $this->_get_quicksurvey_datatables_query($_POST);
    if ($_POST['length'] != -1) {
        $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
}


// public function getquicksurveyAllFiles($directoryname, $filetype)
// {
//     $directoryname = basename($directoryname);
//     $filetype = basename($filetype);
    
//     $directory = FCPATH . 'quicksurvey' . DIRECTORY_SEPARATOR . $directoryname . DIRECTORY_SEPARATOR . $filetype;

//     if (!is_dir($directory)) {
//         log_message('error', 'Directory does not exist: ' . $directory);
//         return 0; 
//     }

//     return count($this->getquicksurveyFiles($directory));
// }

public function getquicksurveyAllFiles($directoryname, $filetype, $returnFiles = false)
{
    $directoryname = basename($directoryname);
    $filetype = basename($filetype);
    
    $directory = FCPATH . 'quicksurvey' . DIRECTORY_SEPARATOR . $directoryname . DIRECTORY_SEPARATOR . $filetype;

    if (!is_dir($directory)) {
        log_message('error', 'Directory does not exist: ' . $directory);
        return ($returnFiles) ? [] : 0; // Return empty array for files, 0 for count
    }

    $files = $this->getquicksurveyFiles($directory);
    return ($returnFiles) ? $files : count($files);
}



private function getquicksurveyFiles($directory)
{
    $files = [];
    try {
        if ($handle = opendir($directory)) {
            while (false !== ($file = readdir($handle))) {
                // Exclude system entries
                if ($file != "." && $file != "..") {
                    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

                    // If you want to filter for specific file types (e.g., jpg, png, mp4)
                    $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'pdf', 'docx']; // Add necessary file types
                    if (in_array(strtolower($fileExtension), $validExtensions)) {
                        $files[] = $file;
                    }
                }
            }
            closedir($handle);
        }
    } catch (Exception $e) {
        log_message('error', 'Error reading directory: ' . $directory . ' - ' . $e->getMessage());
    }

    return $files;
}




  /*
  * Count all records
  */
  public function countAllquicksurvey()
  {
    $this->db->from('claims_quicksurvey');
    return $this->db->count_all_results();
  }

  /*
  * Count records based on the filter params
  * @param $_POST filter data based on the posted parameters
  */
  public function countFilteredquicksurvey($postData)
  {
    $this->_get_quicksurvey_datatables_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

 private function _get_quicksurvey_datatables_query($postData)
{
    $this->column_search = array(
        'CPJ.id',
        'CPJ.userid',
        'CPJ.beneficiaryname',
        'CPJ.itemnumber',
        'CPJ.directoryname',
        'CPJ.status',
        'CPJ.createdat',
        'CJA.salutation',
        'CJA.firstname',
        'CJA.lastname',
        'CTL.companyName'
    );

    $this->db->select("CPJ.id, CPJ.userid, CTL.companyName, CPJ.beneficiaryname, CPJ.itemnumber, CPJ.directoryname, CPJ.status, CPJ.createdat, CJA.salutation, CJA.firstname, CJA.lastname");
    
    // Set default order by 'createdat' descending to show most recent entries first
    $this->order = array('CPJ.createdat' => 'desc');
    $this->db->from('claims_quicksurvey as CPJ');
    $this->db->join('claims_users as CJA', 'CJA.id = CPJ.userid', 'INNER');
    $this->db->join('claims_company as CTL', 'CTL.id = CPJ.cid', 'INNER');

    $i = 0;
    foreach ($this->column_search as $item) {
        if (isset($postData['search']['value'])) {
            // First loop
            if ($i === 0) {
                $this->db->group_start();
                $this->db->like($item, $postData['search']['value']);
            } else {
                $this->db->or_like($item, $postData['search']['value']);
            }

            if (count($this->column_search) - 1 == $i) {
                $this->db->group_end();
            }
        }
        $i++;
    }

    if (isset($postData['order'])) {
        $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    } else if (isset($this->order)) {
        $order = $this->order;
        $this->db->order_by(key($order), $order[key($order)]);
    }
}


//   private function _get_quicksurvey_datatables_query()
// {
//     // Define searchable columns
//     $this->column_search = array(
//         'CPJ.id',
//         'CPJ.userid',
//         'CPJ.beneficiaryname',
//         'CPJ.itemnumber',
//         'CPJ.directoryname',
//         'CPJ.status',
//         'CPJ.createdat'
//     );

//     // Select specific columns from the database
//     $this->db->select("CPJ.id, CPJ.userid, CPJ.beneficiaryname, CPJ.itemnumber,CPJ.directoryname, CPJ.status, CPJ.createdat");
    
//     // Define the table to query from
//     $this->db->from('claims_quicksurvey as CPJ');
//     $i = 0;
//     foreach ($this->column_search as $item) {
//         if (isset($postData['search']['value']) && $postData['search']['value'] != '') {
//             if ($i === 0) {
//                 $this->db->group_start();  // Start grouping for "OR" condition
//                 $this->db->like($item, $postData['search']['value']);
//             } else {
//                 $this->db->or_like($item, $postData['search']['value']);
//             }

//             if (count($this->column_search) - 1 == $i) {
//                 $this->db->group_end();  // Close the group
//             }
//         }
//         $i++;
//     }

//     // Apply ordering if specified
//     if (isset($postData['order'])) {
//         $this->db->order_by($this->column_order[$postData['order'][0]['column']], $postData['order'][0]['dir']);
//     } elseif (isset($this->order)) {
//         $order = $this->order;
//         $this->db->order_by(key($order), $order[key($order)]);
//     }
// }


  public function saveDispatchData($data)
  {
    try {
      $this->db->insert('claims_dispatch', $data);
      return $this->db->affected_rows() > 0;
    } catch (Exception $e) {
      error_log('Database error: ' . $e->getMessage());
      return false;
    }
  }



  public function getLatestRecordByAid($aid)
  {
    $this->db->where('aid', $aid);
    $this->db->order_by('dispatchdate', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('claims_dispatch');
    return $query->row_array();
  }
  public function getUidToByAid($aid)
  { 
    $this->db->select('uid_to');
    $this->db->from('claims_livelocationjob_assign');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->row()->uid_to; 
    }
    
    return null;  
  }

  public function saveSurveyFeeData($data)
  {
    try {
      $this->db->insert('claims_expenses', $data);
      return $this->db->affected_rows() > 0;
    } catch (Exception $e) {
      error_log('Database error: ' . $e->getMessage());
      return false;
    }
  }


  public function getSurveyFeeRecordByAid($aid)
  {
    $this->db->where('aid', $aid);
    $query = $this->db->get('claims_expenses');

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }


  /*
  * Lor (Nandini)
  * 
  */

  public function getpreparelor($departments)
  {
      $this->db->select('id, description'); 
      $this->db->from('claims_lor'); 
      $this->db->where_in('department', $departments);
      $query = $this->db->get();
      return $query->result(); 
  }


  
  public function getLorByAidUid($aid, $uid) {
    $query = $this->db->get_where('claims_sendlor', ['aid' => $aid, 'uid' => $uid]);
    return $query->row_array(); 
  }
  public function getSendlorStatus($aid)
  {
      $this->db->select('status');
      $this->db->from('claims_sendlor');
      $this->db->where('aid', $aid);
      $query = $this->db->get();
      return $query->row() ? $query->row()->status : null;
  }

  public function updateQuestion($aid, $description) {
    $this->db->where('aid', $aid);
    $result = $this->db->update('claims_sendlor', ['lor' => json_encode($description)]);
    if ($result) {
        return true;
    } else {
        echo $this->db->last_query(); 
        return false;
    }
  }


  public function appendQuestion($aid, $newQuestion) {
    $this->db->select('lor');
    $this->db->where('aid', $aid);
    $query = $this->db->get('claims_sendlor');
    $result = $query->row();

    if ($result) {
        $existingQuestions = json_decode($result->lor, true);
        if (!is_array($existingQuestions)) {
            $existingQuestions = [];
        }
        $existingQuestions[] = $newQuestion;
        $updatedData = ['lor' => json_encode($existingQuestions)];

        // Update the database
        $this->db->where('aid', $aid);
        if ($this->db->update('claims_sendlor', $updatedData)) {
            return true;
        } else {
            log_message('error', 'Database update failed for aid ' . $aid);
        }
    } else {
        log_message('error', 'No record found for aid ' . $aid);
    }

    return false;
}


  public function insertNewQuestion($aid, $newQuestion) {
    $data = ['aid' => $aid, 'lor' => $newQuestion];
    $this->db->insert('claims_sendlor', $data); 
  }

  public function updateLorQuestions($aid, $data){
    $this->db->where('aid', $aid);
    $this->db->update('claims_sendlor', [
        'sent_to' => $data['sent_to'],  
        'special_note' => $data['special_note'], 
        'date_of_letter' => $data['date_of_letter'], 
        'automail_fix' => $data['automail_fix'],
        'sent_date' => $data['sent_date'] ,
        'mail_automation' => $data['mail_automation'],
        'status' => $data['status'],
    ]);
    return $this->db->affected_rows() > 0;
  }

  public function getInsertedQuestions($aid) {
    $this->db->select('lor');
    $this->db->from('claims_sendlor');  
    $this->db->where('aid', $aid);  
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        $questions = $query->result_array();
        foreach ($questions as &$question) {
            $question['description'] = json_decode($question['lor']);
        }

        return $questions;  
    } else {
        return false; 
    }
  }


  public function deleteQuestionByDescription($description) {
    $description = trim($description);
  
    // Fetch the current 'lor' value from the database
    $this->db->select('lor');
    $this->db->where('lor IS NOT NULL');
    $query = $this->db->get('claims_sendlor');

    if ($query->num_rows() > 0) {
        $row = $query->row();
        $lorArray = json_decode($row->lor, true);
        if (($key = array_search($description, $lorArray)) !== false) {
            unset($lorArray[$key]);
            $updatedLor = json_encode(array_values($lorArray));
            $this->db->set('lor', $updatedLor);
            $this->db->where('lor', $row->lor); 
            return $this->db->update('claims_sendlor');
        }
    }
    return false;
  }

  public function get_survey_names(){
    $this->db->select('*');
    $this->db->from('claims_task_list');
    $this->db->order_by('investigator_type','asc');
    $query = $this->db->get();
    return $query->result_array();
  }
  

  public function insertLorQuestions($data) {
    $this->db->insert('claims_sendlor', [
        'aid' => $data['aid'],
        'uid' => $data['uid'],
        'lor' => $data['lor'] 
    ]);
    return $this->db->affected_rows() > 0;
  }
  public function updateLor($aid, $uid, $updatedLorJson) {
    $this->db->where('aid', $aid);
    $this->db->where('uid', $uid);
    $this->db->update('claims_sendlor', ['lor' => $updatedLorJson]);
    return $this->db->affected_rows() > 0;
  }


   /*
  * Lor end (Nandini)
  * 
  */

  public function deletesurvey($id = null)
  {
    $this->db->where('id', $id);
    $this->db->delete('claims_expenses');
    return $this->db->affected_rows() > 1 ? true : false;
  }

  // 

  // get type of case
 public function gettypeofcase($departmentid)
  {
    // Initialize the query
    $this->db->select('*');
    $this->db->from('claims_task_list');
    $this->db->where('FIND_IN_SET(' . $this->db->escape($departmentid) . ', departmentid) <> 0');
    $this->db->where('status', 1);
    // Execute the query and return the result
    $query = $this->db->get();
    return $query->result();
  }


  
  
  public function getcasename($formid)
  {
    $this->db->select('investigator_type');
    $this->db->from('claims_task_list');
    $this->db->where('id', $formid);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->investigator_type;
    } else {
      return false;
    }
  }



  
  




  // public function getPaymentData($aid)
  // {
  //   $this->db->select('paymentreceipt'); // Ensure this returns multiple records if needed
  //   $this->db->from('claims_billing');
  //   $this->db->where('aid', $aid);
  //   $query = $this->db->get();

  //   if ($query->num_rows() > 0) {
  //     // Return the payment receipt as JSON
  //     return json_encode($query->result_array()); // Return as an array of records
  //   } else {
  //     return json_encode([]); // Return an empty JSON array if no data is found
  //   }
  // }

  public function getPaymentData($aid)
{
    // Fetch the paymentreceipt data from the claims_billing table
    $this->db->select('paymentreceipt');
    $this->db->from('claims_billing');
    $this->db->where('aid', $aid);
    $query = $this->db->get();
    
    // Check if a row is found
    if ($query->num_rows() > 0) {
        $result = $query->row();
        return $result;
    } else {
        // Return null or an empty array if no data is found
        return null;
    }
}








  // public function getPaymentData($aid)
  // {
  //     // Ensure the aid is valid and prevent SQL injection
  //     if (empty($aid)) {
  //         return []; // Return an empty array for consistency
  //     }

  //     $this->db->select("JSON_UNQUOTE(JSON_EXTRACT(paymentreceipt, '$.date')) AS date, 
  //                        JSON_UNQUOTE(JSON_EXTRACT(paymentreceipt, '$.payment_for')) AS payment_for, 
  //                        JSON_UNQUOTE(JSON_EXTRACT(paymentreceipt, '$.amount')) AS amount");
  //     $this->db->from('claims_billing');
  //     $this->db->where('aid', $aid);
  //     $query = $this->db->get();

  //     // Check if query was successful and return results
  //     if ($query && $query->num_rows() > 0) {
  //         return $query->result_array();
  //     } else {
  //         return []; // Return an empty array for consistency
  //     }
  // }

  public function updateBilling($aid, $billing_data)
{
    $this->db->where('aid', $aid);

    if ($this->db->update('claims_billing', $billing_data)) {
        return ['status' => 'success', 'message' => 'Billing data updated successfully.'];
    } else {
        // Log the error
        log_message('error', 'Update Query: ' . $this->db->last_query());
        log_message('error', 'Update Error: ' . json_encode($this->db->error()));
        return ['status' => 'error', 'message' => 'Database update failed.'];
    }
}



  public function getBillingByAid($aid)
{
    $this->db->select('*');
    $this->db->from('claims_billing');
    $this->db->where('aid', $aid);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $result = $query->result_array();
        log_message('debug', 'Raw Billing Data: ' . print_r($result, true)); // Debugging log

        // Process bill_to, ship_to, and other fields if they exist
        foreach ($result as &$row) {
            // Decode JSON fields if they exist
            $row['bill_to'] = isset($row['bill_to']) ? json_decode($row['bill_to'], true) : [];
            $row['ship_to'] = isset($row['ship_to']) ? json_decode($row['ship_to'], true) : [];
            $row['additional_expenses'] = isset($row['additional_expenses']) ? json_decode($row['additional_expenses'], true) : [];
            $row['paymentreceipt'] = isset($row['paymentreceipt']) ? json_decode($row['paymentreceipt'], true) : [];
            $row['invoice'] = isset($row['invoice']) && is_string($row['invoice']) ? json_decode($row['invoice'], true) : [];
            $row['subtotal'] = $row['sub_total'];
            $row['total'] = $row['total'];
            $row['grand_total'] = $row['grandtotal'];

            // Process tax data
            $taxData = isset($row['tax']) && is_string($row['tax']) ? json_decode($row['tax'], true) : [];
            $row['gst_number'] = $taxData['gst_number'] ?? '';
            $row['gst_percentage'] = $taxData['gst_percentage'] ?? '';
            $row['igst_percentage'] = $taxData['igst_percentage'] ?? '';
            $row['cgst_percentage'] = $taxData['cgst_percentage'] ?? '';
            $row['sgst_percentage'] = $taxData['sgst_percentage'] ?? '';

            // Set the currency field
            $row['currency'] = isset($row['currency']) && is_string($row['currency']) ? json_decode($row['currency'], true) : [];

            // You can optionally modify the row further if needed
        }

        return $result;
    } else {
        return [];
    }
}





  public function insertBilling($billing_data)
  {
    // Debugging: Check the billing data being inserted
    log_message('debug', 'Billing Data for Insertion: ' . print_r($billing_data, true));

    if ($this->db->insert('claims_billing', $billing_data)) {
      return true;
    } else {
      return ['status' => 'error', 'message' => 'Database insert failed.'];
    }
  }


  /*
    * Query by NANDINI
    */

  public function get_field_names()
  {
    $this->db->select('*');
    $this->db->from('claims_form_fields');
    $this->db->order_by('fields_name','asc');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function getattributedata($attributes) {
    $this->db->select('fields_name');
    $this->db->from('claims_form_fields');
    $query = $this->db->get();
    return $query->result_array(); 
  }

  /**    Email Settings (by nandini)   **/

  public function save_email_config($data){
    return $this->db->insert('claims_email_setting', $data);
  }
  public function get_email_config()
  {
      $query = $this->db->get('claims_email_setting');
      return $query->row_array(); 
  }

}
