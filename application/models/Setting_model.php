<?php defined('BASEPATH') or exit('No direct script access allowed');
class Setting_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('array');
    }

    public function insertfield($data = null)
    {
        if ($this->db->insert('claims_form_fields', $data)) {
            return true;
        } else {
            log_message('error', 'Insert field failed: ' . print_r($this->db->error(), true));
            return false;
        }
    }

    public function get_case_by_reference_and_tag($case_reference, $tag_number)
    {
        $this->db->select('aid,essentialdata,case_reference');
        $this->db->from('claims_livelocationjob');  // Replace with your table name
        $this->db->where('case_reference', $case_reference);
        // $this->db->where('FIND_IN_SET("' . $tag_number . '", essentialdata) <> 0');
        $this->db->where('JSON_UNQUOTE(JSON_EXTRACT(essentialdata, "$.tagNumber")) =', $tag_number);

        $query = $this->db->get();
        // Log the executed query for debugging
        log_message('debug', 'Executed Query: ' . $this->db->last_query());

        if (!$query) {
            log_message('error', 'Database query failed: ' . $this->db->last_query());
            return false; // Return false if the query fails
        }

        if ($query->num_rows() > 0) {
            return $query->result(); // Return the first matching row
        } else {
            return false; // Return false if no match is found
        }
    }

    public function getAllDepartments()
    {
        $query = $this->db->get('claims_department');
        return $query->result_array();
    }

    public function getAllinsurer()
    {
        $this->db->select('insurer,id');
        $this->db->from('claims_insurer_temp');
        $query = $this->db->get();
        return $query->result();
    }

    /*
    * Get all vendors(KAJAL)
    */
    // public function getAllvendors()
    // {
    //     $this->db->select('vendor, id, vendortype');
    //     $this->db->from('claims_vendor');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    public function getAllVendors()
    {
        $this->db->select('id,companyName');
        $this->db->from('claims_company');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array(); // Return the result as an array
        } else {
            return false; // No vendors found
        }
    }


    public function getAllvendortype()
    {
        $this->db->select('id, profession');
        $this->db->from('claims_profession');
        $query = $this->db->get();
        return $query->result_array();
    }


    /*
    * Get user by branch(KAJAL)
    */
    public function getUsersByBranch($branchId, $userId)
    {
        $this->db->select('cu.id, cu.firstname, cu.lastname, cu.mobile');
        $this->db->from('claims_connect_with_company as ccc');
        $this->db->join('claims_branch as cb', 'cb.id = ccc.bid', 'LEFT');
        $this->db->join('claims_users as cu', 'cu.id = ccc.vendor_uid', 'LEFT');
        $this->db->where('cb.id', $branchId);
        $this->db->where('ccc.uid', $userId);
        $query = $this->db->get();
        if ($query === FALSE) {
            log_message('error', 'Database query failed: ' . $this->db->last_query());
            return [];
        }
        return $query->result_array();
    }


    /*
    * Check if vendor already exist(KAJAL)
    */
    public function vendorExists($vendorName)
    {
        $this->db->where('companyName', $vendorName);
        $query = $this->db->get('claims_company');
        return $query->num_rows() > 0;
    }

    /*
    * Save new vendor(KAJAL)
    */
    public function getProfessionById($id)
    {
        return $this->db->get_where('claims_profession', ['id' => $id])->row();
    }

    public function insertCompany($companyData)
    {
        return $this->db->insert('claims_company', $companyData);
    }






    // public function getVendorsWithProfession()
    // {
    //     // Perform a join between claims_company and claims_profession using professionId
    //     $this->db->select('cc.companyName, cc.cid, cp.profession, cp.type, cp.individual, cp.company');
    //     $this->db->from('claims_company cc');
    //     $this->db->join('claims_profession cp', 'cc.professionId = cp.id', 'inner'); // Inner join
    //     $query = $this->db->get();

    //     if ($query->num_rows() > 0) {
    //         return $query->result_array(); // Return result as array
    //     } else {
    //         return false; // Return false if no records found
    //     }
    // }

    public function cidExists($cid)
    {
        $this->db->where('cid', $cid);
        $query = $this->db->get('claims_company');
        return $query->num_rows() > 0;
    }


    public function getUsersByBranchAndMobile($branchId, $mobile)
    {
        $this->db->where('branch_id', $branchId);
        $this->db->like('mobile', $mobile); // Perform search based on the mobile number
        $query = $this->db->get('users'); // Replace 'users' with your actual users table
        return $query->result();
    }


    /*
    * Save new branch(KAJAL)
    */
    public function saveBranch($data)
    {
        // Prepare the branch data excluding the AUTO_INCREMENT field (id)
        $branchData = array(
            'address' => $data['address'],
            'pincode' => $data['pincode'],
            'state' => $data['state'],
            'city' => $data['city'],
            'gst' => $data['gst'],
            'cid' => $data['cid'] // Ensure this matches the database schema
        );

        $this->db->trans_start();

        // Perform the insert operation
        $this->db->insert('claims_branch', $branchData);

        // Check if the insert was successful
        $is_successful = $this->db->affected_rows() > 0;
        $last_id = $is_successful ? $this->db->insert_id() : null;

        $this->db->trans_complete();

        // Log transaction status and queries for debugging
        if ($this->db->trans_status() === FALSE) {
            log_message('error', 'Database Transaction Failed: ' . $this->db->last_query());
        }

        if (!$is_successful) {
            log_message('error', 'Failed to insert branch data: ' . $this->db->last_query());
        } else {
            log_message('debug', 'Insert Successful, Last ID: ' . $last_id);
        }

        return array(
            'is_successful' => $is_successful,
            'last_id' => $last_id
        );
    }

    /*
    * Check if user already exist(KAJAL)
    */
    public function userExists($mobile)
    {
        $this->db->where('mobile', $mobile);
        $query = $this->db->get('claims_users');

        // Log the query for debugging
        log_message('debug', 'SQL Query: ' . $this->db->last_query());

        return $query->num_rows() > 0;
    }


    public function saveUser($userData)
    {
        return $this->db->insert('claims_users', $userData);
    }

    public function getUserByMobile($mobile)
    {
        $this->db->where('mobile', $mobile);
        $query = $this->db->get('claims_users');
        return $query->row_array(); // Return the user's details
    }

      public function deleteVendorById($vendorId)
  {
    // Perform the deletion query
    $this->db->where('id', $vendorId);  // Assuming vendor_uid is the identifier
    $deleted = $this->db->delete('claims_connect_with_company'); // Deleting from the correct table

    // Optionally, check for errors in deletion
    if (!$deleted) {
        log_message('error', 'Failed to delete vendor with ID: ' . $vendorId);
    }
    return $deleted;
  }




    /*
    * Check if record already exist(KAJAL)
    */
    public function recordExists($data)
    {
        $this->db->where('vendor_uid', $data['vendor_uid']);
        $this->db->where('bid', $data['bid']);
        $this->db->where('uid', $data['uid']);
        $query = $this->db->get('claims_connect_with_company');
        return $query->num_rows() > 0;
    }


    /*
    * Insert new vendor record(KAJAL)
    */
    public function insertNewVendor($data)
    {
        $this->db->insert('claims_connect_with_company', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            // Log the error
            log_message('error', 'Database Insert Error: ' . $this->db->error()['message']);
            return false;
        }
    }





    /*
    * Get all branch connected with vendor(KAJAL)
    */
    public function getAllbranch($vendorid)
    {
        $this->db->select('id, address, state, city, status');
        $this->db->from('claims_branch');
        $this->db->where('cid', (int) $vendorid);
        $query = $this->db->get();
        return $query->result();
    }



    /*
    * Get all user connected with branch(KAJAL)
    */
    public function getAllusers($branchid)
{
    $this->db->select('ccc.id, ccc.vendor_uid, cu.firstname, cu.lastname, cu.mobile');
    $this->db->from('claims_connect_with_company as ccc');
    $this->db->join('claims_users as cu', 'cu.id = ccc.vendor_uid', 'LEFT');
    $this->db->where('ccc.bid', $branchid); // Added table alias to the 'bid' column for clarity
    $query = $this->db->get();

    // Log the actual SQL query being executed for debugging purposes
    log_message('debug', 'SQL Query: ' . $this->db->last_query());

    return $query->result();
}


    public function getAllconnectedusers($mobile)
    {
        // Query to get user data based on the mobile number
        $this->db->select('id, salutation, firstname, lastname, mobile,email');
        $this->db->from('claims_users');  // Make sure the table name is correct (replace 'users' if needed)
        $this->db->where("mobile", $mobile);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();  // Return the user data as an associative array
        } else {
            return false;  // No user found
        }
    }




    /**
     * Get Location Based outgoing cases 
     */
    public function getConnectedVendorByCid($postData)
    {
        $this->_get_datatables_query($postData);
        if (isset($postData['length']) && $postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    /*
    * Count all records
    */
    public function countAll()
    {
        $this->db->from('claims_connect_with_company');
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
    // private function _get_datatables_query($postData)
    // {
    //     $userid = $this->session->userdata('id');
    //     $this->column_search = array('cv.vendor', 'cb.address', 'cb.state', 'cb.city', 'cu.firstname', 'cu.lastname', 'cu.mobile');
    //     $this->column_order = array('cv.vendor', 'cb.address', 'cb.state', 'cb.city', 'cu.firstname', 'cu.lastname', 'cu.mobile'); // Ensure this array matches your columns

    //     $this->db->select('ccc.*, cv.vendor, cb.address, cb.state, cb.city, cu.firstname, cu.lastname, cu.mobile');
    //     $this->db->from('claims_connect_with_company as ccc');
    //     $this->db->join('claims_branch as cb', 'cb.id = ccc.bid', 'LEFT');
    //     $this->db->join('claims_vendor as cv', 'cv.id = cb.cid', 'LEFT');
    //     $this->db->join('claims_users as cu', 'cu.id = ccc.vendor_uid', 'LEFT');
    //     $this->db->where("ccc.uid", $userid);

    //     // Search Filter
    //     if (isset($postData['search']['value']) && $postData['search']['value'] != '') {
    //         $this->db->group_start();
    //         foreach ($this->column_search as $i => $item) {
    //             if ($i === 0) {
    //                 $this->db->like($item, $postData['search']['value']);
    //             } else {
    //                 $this->db->or_like($item, $postData['search']['value']);
    //             }
    //         }
    //         $this->db->group_end();
    //     }

    //     // Ordering
    //     if (isset($postData['order'])) {
    //         $this->db->order_by(
    //             $this->column_order[$postData['order']['0']['column']],
    //             $postData['order']['0']['dir']
    //         );
    //     } elseif (isset($this->order)) {
    //         $order = $this->order;
    //         $this->db->order_by(key($order), $order[key($order)]);
    //     }
    // }

    private function _get_datatables_query($postData)
    {
        // Define searchable and orderable columns
        $this->column_search = array('cv.companyName', 'cb.address', 'cb.state', 'cb.city', 'cb.pincode' ,'cb.gst','cu.salutation', 'cu.firstname', 'cu.lastname', 'cu.mobile');
        $this->column_order = array('cv.companyName', 'cb.address', 'cb.state', 'cb.city','cb.pincode' ,'cb.gst','cu.salutation', 'cu.firstname', 'cu.lastname', 'cu.mobile');

        // Build the base query
        $this->db->select('ccc.*, cv.companyName,cb_id.billing_id, cb.address, cb.state,cb.pincode, cb.city, cb.gst, cu.salutation, cu.firstname, cu.lastname, cu.mobile');
        $this->db->from('claims_connect_with_company as ccc');
        $this->db->join('claims_branch as cb', 'cb.id = ccc.bid', 'LEFT');
        $this->db->join('claims_company as cv', 'cv.id = cb.cid', 'LEFT');
        $this->db->join('claims_users as cu', 'cu.id = ccc.vendor_uid', 'LEFT');
        $this->db->join('claims_billing_ids as cb_id', 
            '(cb_id.cid = ccc.cid AND cb_id.billing_id_to = cb.cid) 
            OR (cb_id.cid = 0 AND cb_id.uid = ccc.vendor_uid)', 
            'LEFT'
        );

        $this->db->where("ccc.cid", $postData['companyid']);

        if (isset($postData['search']['value']) && $postData['search']['value'] != '') {
            $this->db->group_start();
            foreach ($this->column_search as $i => $item) {
                if ($i === 0) {
                    $this->db->like($item, $postData['search']['value']);
                } else {
                    $this->db->or_like($item, $postData['search']['value']);
                }
            }
            $this->db->group_end();
        }

        if (isset($postData['order'])) {
            $orderColumn = $this->column_order[$postData['order']['0']['column']];
            $orderDirection = $postData['order']['0']['dir'];

            if (in_array($orderDirection, ['asc', 'desc']) && in_array($orderColumn, $this->column_order)) {
                $this->db->order_by($orderColumn, $orderDirection);
            } else {
                $this->db->order_by('ccc.id', 'desc'); // Change to descending order
            }
        } else {
            $this->db->order_by('ccc.id', 'desc');
        }
    }
    
    public function _get_company_profession_query($postData)
    {
        $userid = $this->session->userdata('id');
        $this->column_search = array('cc.companyName', 'cp.profession');
        $this->column_order = array('cc.companyName', 'cp.profession');
        $this->db->select('cc.id AS companyId, cc.companyName');
        $this->db->from('claims_company AS cc');
        $this->db->join('claims_profession AS cp', 'cc.professionId = cp.id', 'INNER');
        $this->db->where("cc.createdBy", $userid); // Filter by user ID, adjust as needed

        // Search Filter
        if (isset($postData['search']['value']) && $postData['search']['value'] != '') {
            $this->db->group_start();
            foreach ($this->column_search as $i => $item) {
                if ($i === 0) {
                    $this->db->like($item, $postData['search']['value']);
                } else {
                    $this->db->or_like($item, $postData['search']['value']);
                }
            }
            $this->db->group_end();
        }

        // Ordering
        if (isset($postData['order'])) {
            $this->db->order_by(
                $this->column_order[$postData['order']['0']['column']],
                $postData['order']['0']['dir']
            );
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    /*
    * Billing By NANDINI
    */

    public function getDetailedInfo()
    {
        // Decrypt the 'q' parameter from the URL
        $aid = $this->encryption->decrypt(base64_decode($this->input->get('q')));

        // Select required fields from multiple tables
        $this->db->select('
            claims_connect_with_company.id, 
            claims_connect_with_company.uid, 
            claims_connect_with_company.bid, 
            claims_connect_with_company.vendor_uid, 
            claims_branch.city, 
            claims_branch.address, 
            claims_branch.gst, 
            claims_users.salutation,
            claims_users.firstname,
            claims_users.lastname,
            claims_users.mobile,
            claims_users.email,
            claims_company.companyName,
            claims_livelocationjob.case_reference,
            claims_livelocationjob.aid,
            claims_billing.aid AS billing_aid,
            JSON_UNQUOTE(JSON_EXTRACT(claims_billing.bill_to,"$.payment_by")) AS payment_by,
            JSON_UNQUOTE(JSON_EXTRACT(claims_billing.bill_to,"$.payment_branch_name")) AS payment_branch_name,
            JSON_UNQUOTE(JSON_EXTRACT(claims_billing.bill_to, "$.payment_user_name")) AS payment_user_name,
            JSON_UNQUOTE(JSON_EXTRACT(claims_billing.bill_to, "$.payment_mobile_num")) AS payment_mobile_num,
            JSON_UNQUOTE(JSON_EXTRACT(claims_billing.bill_to, "$.payment_gst")) AS payment_gst,
            JSON_UNQUOTE(JSON_EXTRACT(claims_livelocationjob.jobdata, "$.insured_name")) AS insured_name,
            JSON_UNQUOTE(JSON_EXTRACT(claims_livelocationjob.jobdata, "$.policy_number")) AS policy_number,
            CONCAT(
                JSON_UNQUOTE(JSON_EXTRACT(claims_livelocationjob.essentialdata, "$.date_of_incident")),
                " ",
                JSON_UNQUOTE(JSON_EXTRACT(claims_livelocationjob.essentialdata, "$.time_of_incident"))
            ) AS time_of_incident,
            claims_vendor.vendor
        ');

        // Define the main table and joins
        $this->db->from('claims_connect_with_company');
        $this->db->join('claims_branch', 'claims_connect_with_company.bid = claims_branch.id', 'left');
        $this->db->join('claims_users', 'claims_connect_with_company.vendor_uid = claims_users.id', 'left');
        $this->db->join('claims_company', 'claims_branch.cid = claims_company.id', 'left');
        $this->db->join('claims_livelocationjob', 'claims_connect_with_company.uid = claims_livelocationjob.userId AND claims_livelocationjob.aid = ' . $this->db->escape($aid), 'left');
        $this->db->join('claims_vendor', 'claims_branch.cid = claims_vendor.id', 'left');
        $this->db->join('claims_billing', 'claims_billing.aid = claims_livelocationjob.aid', 'left');

        // Execute the query
        $query = $this->db->get();

        // Error handling for query failure
        if ($query === false) {
            log_message('error', 'Failed to retrieve detailed information for aid: ' . $aid);
            return null;
        }

        // Return the first row of the result
        return $query->row();
    }
}
