<?php defined('BASEPATH') or exit('No direct script access allowed');
class Billing_model extends CI_Model
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

  public function getBillingByAid($aid)
  {
    $this->db->select('claims_billing.*, cb.gst as gst_number');
    $this->db->from('claims_billing');
    $this->db->join('claims_branch as cb', 'cb.id = claims_billing.branchid', 'left'); // Joining with branches table using branchid
    $this->db->where('claims_billing.aid', $aid);
    $query = $this->db->get();
    if($query->num_rows() > 0){
      return $query->row_array();
    }else{
      return false;
    }
  }

    public function get_payment_data($aid) {
        $this->db->select('paymentreceipt');
        $this->db->where('aid', $aid);
        $query = $this->db->get('claims_billing'); // Assuming 'users' table, change as needed
        return $query->row();
    }

    // public function update_payment_data($aid, $new_payment, $final_payment, $tds_deduct) {
    //     $payment_data = $this->get_payment_data($aid);
        
    //     if ($payment_data) {
    //         $existing_payments = json_decode($payment_data->paymentreceipt, true);

    //         if (!is_array($existing_payments)) {
    //             $existing_payments = []; // Initialize if null
    //         }

    //         // Append new payment data
    //         $existing_payments[] = $new_payment;

    //         // Convert to JSON
    //         $updated_json = json_encode($existing_payments);

    //         // Update the database
    //         $data = [
    //                 'paymentreceipt' => $updated_json,
    //                 'final_amount' => $final_payment, // Example: updating status
    //                 'tds_deduct' => $tds_deduct, // Updating timestamp
    //                 'remaining_amount' => '0.00'
    //                 ];
    //         $this->db->where('aid', $aid);
    //         $this->db->update('claims_billing', $data);

    //         return true;
    //     }
    //     return false;
    // }

    // public function update_payment_data($aid, $new_payment, $final_payment, $tds_deduct) {
    //     // Fetch existing payment data
    //     $payment_data = $this->get_payment_data($aid);
        
    //     // Initialize payments array
    //     $existing_payments = [];
    
    //     if ($payment_data && !empty($payment_data->paymentreceipt)) {
    //         $decoded_payments = json_decode($payment_data->paymentreceipt, true);
            
    //         // Ensure it's a valid array
    //         if (is_array($decoded_payments)) {
    //             $existing_payments = $decoded_payments;
    //         }
    //     }
    
    //     // Add new payment to the array
    //     $existing_payments[] = $new_payment;
    
    //     // Convert updated payments to JSON
    //     $updated_json = json_encode($existing_payments);
    
    //     // Prepare data for update
    //     $data = [
    //         'paymentreceipt' => $updated_json,
    //         'final_amount' => $final_payment,
    //         'tds_deduct' => $tds_deduct,
    //         'remaining_amount' => '0.00'
    //     ];
    
    //     // Update the database
    //     $this->db->where('aid', $aid);
    //     $this->db->update('claims_billing', $data);
    
    //     return ($this->db->affected_rows() > 0);
    // }



    // public function update_payment_data($aid, $new_payment, $final_payment, $tds_deduct) {
    //     // Fetch existing payment data
    //     $payment_data = $this->get_payment_data($aid);
        
    //     // Initialize payments array
    //     $existing_payments = [];
    
    //     if ($payment_data && !empty($payment_data->paymentreceipt)) {
    //         $decoded_payments = json_decode($payment_data->paymentreceipt, true);
            
    //         // Ensure it's a valid array
    //         if (is_array($decoded_payments)) {
    //             $existing_payments = $decoded_payments;
    //         }
    //     }
    
    //     // Add new payment to the array
    //     $existing_payments[] = $new_payment;
    
    //     // Convert updated payments to JSON
    //     $updated_json = json_encode($existing_payments);
    
    //     // Calculate remaining amount
    //     $remaining_amount = 0.00; // You can modify this logic based on your calculations
    
    //     // Check if remaining amount is 0.00, if yes, do not update
    //     if ($remaining_amount == 0.00) {
    //         return false; // Stop execution, row will not be updated
    //     }
    
    //     // Prepare data for update
    //     $data = [
    //         'paymentreceipt' => $updated_json,
    //         'final_amount' => $final_payment,
    //         'tds_deduct' => $tds_deduct,
    //         'remaining_amount' => $remaining_amount
    //     ];
    
    //     // Update the database
    //     $this->db->where('aid', $aid);
    //     $this->db->update('claims_billing', $data);
    
    //     return ($this->db->affected_rows() > 0);
    // }
    

    public function update_payment_data($aid, $new_payment, $final_payment, $tds_deduct) {
        // Prepare the new payment as a single array (replacing existing ones)
        $updated_json = json_encode([$new_payment]); // Keep only the latest payment
    
        // Prepare data for update
        $data = [
            'paymentreceipt' => NULL,  // Store only the latest payment
            'final_amount' => $final_payment,
            'tds_deduct' => $tds_deduct,
            'remaining_amount' => NULL
        ];

    
    
        // Update the database
        $this->db->where('aid', $aid);
        $this->db->update('claims_billing', $data);
    
        return ($this->db->affected_rows() > 0);
    }
    
    


    public function updateStatus($aid){
        $data = [
            'status' => 8
        ];
        $this->db->where('aid', $aid);
        $this->db->update('claims_livelocationjob', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }






  // public function updateBilling($aid, $billing_data)
  // {
  //   $this->db->where('aid', $aid);

  //   if ($this->db->update('claims_billing', $billing_data)) {
  //     return true;
  //   } else {
  //     // Log the error
  //     log_message('error', 'Update Query: ' . $this->db->last_query());
  //     log_message('error', 'Update Error: ' . json_encode($this->db->error()));
  //     return ['status' => 'error', 'message' => 'Database update failed.'];
  //   }
  // }
  public function updateBilling($aid, $billing_data){
      $this->db->trans_start();
      $this->db->where('aid', $aid);
      if (!$this->db->update('claims_billing', $billing_data)) {
          $this->db->trans_rollback();
          return ['status' => 'error', 'message' => 'Database update failed.'];
      }
      $this->db->where('aid', $aid);
      $query = $this->db->get('claims_livelocationjob');
      if ($query->num_rows() == 0) {
          $this->db->trans_complete();
          return false;
      }
      $data_livelocationjob = ['status' => '5'];
      $this->db->where('aid', $aid);
      if (!$this->db->update('claims_livelocationjob', $data_livelocationjob)) {
          $this->db->trans_rollback();
          return ['status' => 'error', 'message' => 'Failed to update job status.'];
      }
      $this->db->trans_complete();
      return $this->db->trans_status();
  }
  // public function insertBilling($billing_data)
  // {
  //   // Debugging: Check the billing data being inserted
  //   log_message('debug', 'Billing Data for Insertion: ' . print_r($billing_data, true));

  //   if ($this->db->insert('claims_billing', $billing_data)) {
  //     return true;
  //   } else {
  //     return ['status' => 'error', 'message' => 'Database insert failed.'];
  //   }
  // }
  public function insertBilling($billing_data)
  {
    if (!isset($billing_data['aid'])) {
        return ['status' => 'error', 'message' => 'Missing aid in billing data.'];
    }

    $aid = $billing_data['aid'];
    $this->db->trans_start();

    if (!$this->db->insert('claims_billing', $billing_data)) {
        $this->db->trans_rollback();
        return ['status' => 'error', 'message' => 'Database insert failed.'];
    }
    $this->db->where('aid', $aid);
    $query = $this->db->get('claims_livelocationjob');
    if ($query->num_rows() == 0) {
        $this->db->trans_complete();
        return false;
    }
    $data_livelocationjob = ['status' => '5'];
    $this->db->where('aid', $aid);
    if (!$this->db->update('claims_livelocationjob', $data_livelocationjob)) {
        $this->db->trans_rollback();
        return ['status' => 'error', 'message' => 'Failed to update job status.'];
    }
    $this->db->trans_complete();

    return $this->db->trans_status();
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
    // public function update_status($aid) {
    //   $this->db->where('aid', $aid);
    //   $query = $this->db->get('claims_livelocationjob');
    //   if ($query->num_rows() == 0) {
    //       return false; 
    //   }
    //   $data = array('status' => '6');
    //   $this->db->where('aid', $aid);
    //   $update_success = $this->db->update('claims_livelocationjob', $data);
    //   if (!$update_success) {
    //       log_message('error', 'Failed to update status for aid: ' . $aid);
    //       return false;
    //   }
  
    //   return true;  
    // }
    // public function update_status($aid) {
    //   // Start transaction
    //   $this->db->trans_start();
    //   $this->db->where('aid', $aid);
    //   $query = $this->db->get('claims_livelocationjob');
    //   if ($query->num_rows() == 0) {
    //       $this->db->trans_complete(); 
    //       return false; 
    //   }
    //   $data_livelocationjob = array('status' => '6');
    //   $this->db->where('aid', $aid);
    //   $this->db->update('claims_livelocationjob', $data_livelocationjob);
  
    //   // Update status in claims_billing
    //   $data_billing = array('status' => '1');
    //   $this->db->where('aid', $aid);
    //   $this->db->update('claims_billing', $data_billing);
    //   $this->db->trans_complete();
    //   if ($this->db->trans_status() === false) {
    //       log_message('error', 'Failed to update statuses for aid: ' . $aid);
    //       return false;
    //   }
  
    //   return true;  
    // }
    public function update_status($aid) {
      // Start transaction
      $this->db->trans_start();
      $this->db->where('aid', $aid);
      $query = $this->db->get('claims_livelocationjob');
      if ($query->num_rows() == 0) {
          $this->db->trans_complete(); 
          return false; 
      }
      $data_livelocationjob = array('status' => '6');
      $this->db->where('aid', $aid);
      $this->db->update('claims_livelocationjob', $data_livelocationjob);
  
      // Update status in claims_billing
      $data_billing = array('status' => '2');
      $this->db->where('aid', $aid);
      $this->db->update('claims_billing', $data_billing);
      $this->db->trans_complete();
      if ($this->db->trans_status() === false) {
          log_message('error', 'Failed to update statuses for aid: ' . $aid);
          return false;
      }
  
      return true;  
    }
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

            // Decode the JSON data into a PHP array
            $paymentReceiptData = json_decode($result->paymentreceipt, true);

            // Return the decoded data
            return $paymentReceiptData;
        } else {
            // Return null or an empty array if no data is found
            return null;
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

  /* ------------------------------------------------------------------------- *
  * FETCH INCOMING ASSIGNMENT FROM CLAIMS_ASSIGNMENT
  * ------------------------------------------------------------------------- */
  public function fetchRequest($postData)
  {
    $this->_get_ti_request_datatables_query($postData);
    if ($postData['length'] != -1) {
      $this->db->limit($postData['length'], $postData['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  /*
  * Count all records
  */
  public function countallti_request()
  {
    $this->db->from('claims_billing');
    return $this->db->count_all_results();
  }

  /*
  * Count records based on the filter params
  * @param $_POST filter data based on the posted parameters
  */
  public function countFilteredti_request($postData)
  {
    $this->_get_ti_request_datatables_query($postData);
    $query = $this->db->get();
    return $query->num_rows();
  }

  /*
  * Perform the SQL queries needed for an server-side processing requested
  * @param $_POST filter data based on the posted parameters
  */
 private function _get_ti_request_datatables_query($postData)
{ 
    $departmentid = $postData['department'];
    $companyid = $postData['company']; // Get company ID from postData

    $this->column_search = array('clb.id','clb.status','clb.sub_total','clb.total','clb.additional_expenses','clu.salutation','clu.firstname','clu.lastname','clc.companyName','cl_b.cid','cl_b.address','cl_b.pincode','cl_b.state','cl_b.city','cl_b.gst','clb.ti_number','clb.bill_to','clb.ship_to','clb.invoice','clb.ti_datetime','clb.grandtotal','clb.tax','clb.created_at','clj.case_reference','clj.aid','ctl.investigator_type');
    
    $this->db->select("clb.id,clb.sub_total,clb.status as billingstatus,clb.total,clb.additional_expenses,clu.salutation, clu.firstname, clu.lastname, cl_b.cid,clja.uid_from,clc.companyName,clb.branchid,cl_b.address,cl_b.pincode,cl_b.state,cl_b.city,cl_b.gst,clb.grandtotal,clb.ti_number,clb.ti_datetime,clb.bill_to,clb.ship_to,clb.invoice,clb.tax,clb.created_at,clj.case_reference,clj.aid,ctl.investigator_type");
    
    $this->order = array('clb.status' => 'asc');
    
    $this->db->from('claims_billing as clb');
    $this->db->join('claims_livelocationjob as clj', 'clb.aid = clj.aid', 'left');
    $this->db->join('claims_livelocationjob_assign as clja', 'clb.aid = clja.aid', 'left');
    $this->db->join('claims_task_list as ctl', 'ctl.id = clj.natureofjob', 'left');
    $this->db->join('claims_branch as cl_b', 'cl_b.id = clb.branchid', 'left');
    $this->db->join('claims_company as clc', 'clc.id = cl_b.cid', 'left');
    $this->db->join('claims_users as clu', 'clu.id = clja.uid_from', 'left');

    $this->db->where("clb.status != 0");

    // Apply filter for company ID if provided
    if (!empty($companyid)) {
        $this->db->where('cl_b.cid', $companyid);
    }

    $i = 0;
    foreach ($this->column_search as $item) {
        if (isset($postData['search']['value'])) {
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


  // public function updateTiNumber($data){
  //   $data['status'] = 2;
  //     // Update query
  //     $this->db->where('aid', $data['aid']);
  //     $update = $this->db->update('claims_billing', $data);
  //     // Check the result
  //     if ($update) {
  //         return true;
  //     } else {
  //         return false;
  //     }
  // }
  // public function updateTiNumber($data) {
  //   $data['status'] = 3;
  //   $this->db->where('aid', $data['aid']);
  //   $updateBilling = $this->db->update('claims_billing', $data);
  //   if ($updateBilling) {
  //       $data_livelocationjob = array('status' => '7');
  //       $this->db->where('aid', $data['aid']);
  //       $updateLivelocationjob = $this->db->update('claims_livelocationjob', $data_livelocationjob);
  //       if ($updateLivelocationjob) {
  //           return true;
  //       } else {
  //           return false;
  //       }
  //   } else {
  //       return false;
  //   }
  // }
  public function updateTiNumber($data)
  {
    // Ensure 'aid' is available in the incoming $data
    if (isset($data['aid'])) {
        $data['status'] = 3;
        $this->db->where('aid', $data['aid']); 
        $updateBilling = $this->db->update('claims_billing', $data);
        if ($updateBilling) {
            $data_livelocationjob = array('status' => '7');
            $this->db->where('aid', $data['aid']);
            $updateLivelocationjob = $this->db->update('claims_livelocationjob', $data_livelocationjob);
            if ($updateLivelocationjob) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
  }
  // Method to fetch GST numbers based on the company ID
   public function getGstNumbersByCompanyId($companyId)
   {
       $this->db->select('id, gst');
       $this->db->from('claims_branch');
       $this->db->where('cid', $companyId);
       $query = $this->db->get();
       if ($query->num_rows() > 0) {
           return $query->result_array();
       }
       
       return [];
   }
}