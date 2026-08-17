<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('case_model');
        $this->load->model('setting_model');
    }
    public function index()
    {
        $this->load->view("adminpanel/setting/profile");
    }

    public function getInsurer()
    {
        $data = $this->setting_model->getAllinsurer();
        echo json_encode($data);
    }


    /*
    * Connect new vendor(KAJAL)
    */
    public function connectNewVendor()
    {
        $this->output->set_content_type('application/json');

        if ($this->session->userdata('id') !== null) {
            $vendorData = $this->input->post();

            // Check for empty fields
            if (empty($vendorData['vendor']) || empty($vendorData['branch']) || empty($vendorData['user'])) {
                $response = array("status" => 400, 'message' => "All fields are required.");
                $this->output->set_output(json_encode($response));
                return;
            }

            // Load model
            $this->load->model('setting_model');

            // Prepare data for insertion
            $data = [
                'vendor_uid' => $vendorData['user'],
                'bid' => $vendorData['branch'],
                'cid'=> $vendorData['cid'],
                'uid' => $this->session->userdata('id'),  // Login ID
                'status' => 1,
                'createdat' => date('Y-m-d H:i:s'),
                'updatedat' => date('Y-m-d H:i:s')
            ];

            // Check if the record already exists
            if ($this->setting_model->recordExists($data)) {
                $response = array("status" => 409, 'message' => "Record already exists.");
                $this->output->set_output(json_encode($response));
                return;
            }

            // Insert data
            $is_saved = $this->setting_model->insertNewVendor($data);

            if ($is_saved) {
                $response = array("status" => 200, 'message' => "Vendor connected successfully.");
            } else {
                $response = array("status" => 500, 'message' => "Internal server error.");
            }

            $this->output->set_output(json_encode($response));
        } else {
            $response = array("status" => 401, 'message' => "Unauthorized access. Please log in.");
            $this->output->set_output(json_encode($response));
        }
    }


    // public function move_files()
    // {
    //     // // Load the model
    //     // $this->load->model('setting_model');

    //     // // Load the spreadsheet
    //     // $inputFileName = FCPATH . './xlsheet/Book1.xlsx';

    //     // // Initialize response array
    //     // $response = [
    //     //     'success' => false,
    //     //     'data' => [],
    //     //     'message' => ''
    //     // ];

    //     // // Check if the file exists
    //     // if (!file_exists($inputFileName)) {
    //     //     log_message('error', "Excel file not found: $inputFileName");
    //     //     $response['message'] = "Excel file not found.";
    //     //     echo json_encode($response);
    //     //     return;
    //     // }

    //     // // Load the spreadsheet
    //     // $spreadsheet = IOFactory::load($inputFileName);
    //     // $sheetData = $spreadsheet->getActiveSheet()->toArray();

    //     // // Initialize an array to hold extracted case references and tag numbers
    //     // $extractedData = [];

    //     // // Populate the extracted data array
    //     // foreach ($sheetData as $row) {
    //     //     if (isset($row[0]) && strpos($row[0], 'Case Reference') !== false) {
    //     //         $extractedData['case_reference'] = trim(str_replace('Case Reference', '', $row[0]));
    //     //     } elseif (isset($row[0]) && strpos($row[0], 'Tag Number') !== false) {
    //     //         $extractedData['tagNumber'] = trim(str_replace('Tag Number', '', $row[0]));
    //     //     }
    //     // }

    //     // // Log the extracted data for debugging
    //     // log_message('info', 'Extracted data: ' . print_r($extractedData, true));

    //     // // Check if both case_reference and tagNumber are present
    //     // if (isset($extractedData['case_reference']) && isset($extractedData['tagNumber'])) {
    //     //     $case_reference = $extractedData['case_reference'];
    //     //     $tagNumber = $extractedData['tagNumber'];
    //     //     print_r($case_reference);
    //     //     print_r($tagNumber);
    //     //     exit();
    //     //     // Get case data using the loaded model
    //     //     $case_data = $this->setting_model->get_case_by_reference_and_tag($case_reference, $tagNumber);

    //     //     if ($case_data) {
    //     //         // Store and display the data
    //     //         $response['data'][] = [
    //     //             'case_reference' => $case_reference,
    //     //             'tagNumber' => $tagNumber,
    //     //             'aid' => $case_data->aid,
    //     //             'raw_data' => $extractedData // Include the raw data
    //     //         ];
    //     //     } else {
    //     //         $response['data'][] = [
    //     //             'case_reference' => $case_reference,
    //     //             'tagNumber' => $tagNumber,
    //     //             'aid' => null, // No match found
    //     //             'raw_data' => $extractedData // Include the raw data
    //     //         ];
    //     //     }
    //     // } else {
    //     //     $response['data'][] = [
    //     //         'case_reference' => null, // No extracted case reference
    //     //         'tagNumber' => null, // No extracted tag number
    //     //         'aid' => null, // No match found
    //     //         'raw_data' => $extractedData // Include raw data
    //     //     ];
    //     // }

    //     // // Set success message
    //     // $response['success'] = true;
    //     // $response['message'] = "Data loaded successfully.";

    //     // // Log the final response
    //     // log_message('info', 'Response: ' . json_encode($response));






    //     // Load the model
    //     $this->load->model('setting_model');

    //     // Load the spreadsheet
    //     $inputFileName = FCPATH . './xlsheet/Book1.xlsx';

    //     // Initialize response array
    //     $response = [
    //         'success' => false,
    //         'data' => [],
    //         'message' => ''
    //     ];

    //     // Check if the file exists
    //     if (!file_exists($inputFileName)) {
    //         log_message('error', "Excel file not found: $inputFileName");
    //         $response['message'] = "Excel file not found.";
    //         echo json_encode($response);
    //         return;
    //     }

    //     // Load the spreadsheet
    //     $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
    //     $sheetData = $spreadsheet->getActiveSheet()->toArray();

    //     // Initialize an array to hold extracted case references and tag numbers
    //     $extractedData = [];

    //     // Populate the extracted data array
    //     foreach ($sheetData as $row) {
    //         if (isset($row[1]) && strpos($row[1], 'Case Reference') !== false) {
    //             $extractedData['case_reference'] = trim(str_replace('Case Reference', '', $row[1]));
    //         } elseif (isset($row[1]) && strpos($row[1], 'Tag Number') !== false) {
    //             $extractedData['tag_number'] = trim(str_replace('Tag Number', '', $row[1]));
    //         }
    //     }

    //     // Check if data was extracted
    //     if (!empty($extractedData)) {
    //         $response['success'] = true;
    //         $response['data'] = $extractedData;
    //         $response['message'] = 'Data extracted successfully.';
    //     } else {
    //         $response['message'] = 'No relevant data found.';
    //     }

    //     echo json_encode($response);

    // }

    public function move_files()
    {
        // Load the model
        $this->load->model('setting_model');

        // Load the spreadsheet
        $sourceFolder = 'C:/Users/USER/Downloads/';  // Set the correct path to the folder
        $inputFileName = FCPATH . 'xlsheet/Book1.xlsx';

        // Initialize response array
        $response = [
            'success' => false,
            'data' => [],
            'message' => ''
        ];

        // Check if the file exists
        if (!file_exists($inputFileName)) {
            log_message('error', "Excel file not found: $inputFileName");
            $response['message'] = "Excel file not found.";
            echo json_encode($response);
            return;
        }

        // Load the spreadsheet
        $spreadsheet = IOFactory::load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        // Populate the data array and search for case references
        foreach ($sheetData as $row) {
            $row = array_map('trim', $row); // Trim each cell value

            // Skip the header row
            if ($row[0] === 'Case Reference') {
                continue;
            }
            // Extract case reference
            $case_reference = $row[0] ?? null;
            $tag_number = $row[1] ?? null;
            $fileName = $row[2] ?? null;
            // Search for the case in the database
            if ($case_reference) {
                $caseData = $this->setting_model->get_case_by_reference_and_tag($case_reference, $tag_number);
                if ($caseData) {
                    foreach ($caseData as $value) {
                        $data = array("aid" => $value->aid);
                    }
                    // $aid = $caseData->aid;
                    $reportFolder = FCPATH . 'uploads/' . $data['aid'] . '/reports/';

                    $searchPattern = $sourceFolder . $fileName . '.pdf';

                    // Check if the source folder exists
                    if (is_dir($sourceFolder)) {

                        // Search for the file in the source folder using glob()
                        $files = glob($searchPattern); // You can also use * for wildcards, e.g. *.xlsx

                        if (!empty($files)) {
                            // File found
                            $fileToCopy = $files[0];  // In case multiple files match, select the first one
                            // Check if the destination folder exists, if not, create it
                            if (!is_dir($reportFolder)) {
                                if (!mkdir($reportFolder, 0755, true)) {
                                    log_message('error', "Failed to create destination folder: $reportFolder");
                                    exit;
                                }
                            }

                            // Construct the destination path
                            $destinationPath = $reportFolder . basename($fileToCopy);

                            // Copy the file to the destination folder
                            if (copy($fileToCopy, $destinationPath)) {
                                log_message('info', "File successfully copied to: $destinationPath");
                            } else {
                                log_message('error', "Failed to copy file to: $destinationPath");
                            }
                        } else {
                            log_message('error', "File not found in the source directory.");
                        }
                    }
                } else {
                    $response['data'][] = [
                        'case_reference' => $case_reference,
                        'message' => 'No matching case found.'
                    ];
                }
            }
        }

        // Set success message if data was found
        $response['success'] = true;
        $response['message'] = "Data loaded successfully.";

        // Return the response as JSON
        echo json_encode($response);
    }

    /*
    * Get all Vendors(KAJAL)
    */
    public function getVendors()
    {
        $this->load->model('setting_model');

        $data = $this->setting_model->getAllVendors();

        if ($data !== false) {
            $response = array(
                "status" => 200,
                "data" => $data
            );
        } else {
            $response = array(
                "status" => 500,
                "message" => "Error fetching vendors"
            );
        }
        echo json_encode($response);
    }


    public function getVendortype()
    {
        $data = $this->setting_model->getAllvendortype();
        echo json_encode($data);
    }

    /*
    * Get all Branches connected with vendor(KAJAL)
    */
    public function getBranch()
    {
        $vendorid = $this->input->post('vendor');
        $data = $this->setting_model->getAllbranch($vendorid);
        echo json_encode($data);
    }

    // public function getUsers() {
    //     $branchid = $this->input->post('branch');
    //     $data = $this->setting_model->getAllUsers($branchid); 
    //     echo json_encode($data);
    // }


    /*
    * Get all users connected with branch(KAJAL)
    */
//    public function getUsers()
// {
//     // $branchId = $this->input->post('branch');
//     // log_message('debug', 'Branch ID received: ' . $branchId); // Log the received branch ID

//     // $data = [];
//     // if ($branchId) {
//       $mobile = $this->input->post('mobile');
//         $data = $this->setting_model->getAllconnectedusers($mobile);
//     //     log_message('debug', 'Users fetched: ' . print_r($data, true)); // Log the fetched data

//     //     if (empty($data)) {
//     //         log_message('debug', 'No users found for Branch ID: ' . $branchId);
//     //     }
//     // } else {
//     //     log_message('error', 'Branch ID is missing in the request.');
//     // }

//     // Return the data as JSON
//     echo json_encode($data);
// }
   public function getUsers() {
    // Get the mobile number from the AJAX request
    $mobileNumber = $this->input->post('mobile');

    // Check if mobile number is provided
    if ($mobileNumber) {
        // Use the model method to fetch user data based on the mobile number
        $data = $this->setting_model->getAllconnectedusers($mobileNumber);
    } else {
        $data = []; // Return an empty array if mobile number is missing
    }

    // Return the data as JSON
    echo json_encode($data);
}

    




    public function checkMobileExists()
    {
        $mobile = $this->input->post('mobile');
        $user = $this->setting_model->getAllconnectedusers($mobile);
        if ($user) {
            // If the user exists, return user data along with exists flag
            echo json_encode([
                'exists' => true,
                'data' => [
                    'salutation' => $user['salutation'],
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'mobile' => $user['mobile'],
                    'email' => $user['email']
                ]
            ]);
        } else {
            // If the user does not exist, only return the exists flag as false
            echo json_encode(['exists' => false]);
        }
    }



    /*
    * Add new Vendor(KAJAL)
    */
     public function addNewVendor()
   {
        $this->load->model('setting_model');
        $vendorData = $this->input->post();

        // Check session
        if ($this->session->userdata('id') === null) {
            $this->output->set_output(json_encode(["status" => 401, 'message' => "Unauthorized access. Please log in."]));
            return;
        }

        // Validate input
        if (empty($vendorData['usertype'])) {
            $this->output->set_output(json_encode(["status" => 400, 'message' => "User type is required."]));
            return;
        }

        $this->db->trans_start(); // Start transaction

        // Prepare company data
        $cid = $this->generateUniqueCID();
        $companyData = [
            'companyName' => $vendorData['vendor'],
            'professionId' => '3,' . $vendorData['vendortype'],
            'cinNo' => $vendorData['cinmum'],
            'licenceNo' => $vendorData['licencenum'],
            'website' => $vendorData['website'],
            'cid' => $cid,
            'status' => 1,
            'createdBy' => $this->session->userdata('id'),
            'createdAt' => date('Y-m-d H:i:s')
        ];

        // Insert company data
        if (!$this->setting_model->insertCompany($companyData)) {
            $this->db->trans_rollback();
            $this->output->set_output(json_encode(["status" => 500, 'message' => "Failed to insert company data."]));
            return;
        }
        $vendorId = $this->db->insert_id();

        // Prepare branch data
        $branchData = [
            'address' => $vendorData['address'],
            'pincode' => $vendorData['pincode'],
            'state' => $vendorData['state'],
            'city' => $vendorData['city'],
            'gst' => $vendorData['gst'],
            'cid' => $vendorId
        ];

        if (!$this->setting_model->saveBranch($branchData)) {
            $this->db->trans_rollback();
            $this->output->set_output(json_encode(["status" => 500, 'message' => "Failed to save branch data."]));
            return;
        }
        $branchId = $this->db->insert_id() ?: 0; // Default to 0 if branch ID is not set

        // Check or save user data
        $existingUser = $this->setting_model->getAllconnectedusers($vendorData['mobile']);
        $userId = $existingUser['id'] ?? $this->saveNewUser($vendorData);

        if (!$userId) {
            $this->db->trans_rollback();
            $this->output->set_output(json_encode(["status" => 500, 'message' => "User Already Exist"]));
            return;
        }

        // Prepare connection data
        $connectionData = [
            'vendor_uid' => $userId,
            'bid' => $branchId,
            'uid' => $this->session->userdata('id'),
            'cid' => $vendorData['companyid'],
            'status' => 1,
            'createdat' => date('Y-m-d H:i:s'),
            'updatedat' => date('Y-m-d H:i:s')
        ];

        if ($this->setting_model->recordExists($connectionData)) {
            $this->db->trans_rollback();
            $this->output->set_output(json_encode(["status" => 409, 'message' => "Record already exists."]));
            return;
        }

        if (!$this->setting_model->insertNewVendor($connectionData)) {
            $this->db->trans_rollback();
            $this->output->set_output(json_encode(["status" => 500, 'message' => "Failed to connect vendor."]));
            return;
        }

        $this->db->trans_complete(); // Commit transaction

        if ($this->db->trans_status() === FALSE) {
            $this->output->set_output(json_encode(["status" => 500, 'message' => "Transaction failed."]));
        } else {
            $this->output->set_output(json_encode([
                "status" => 200,
                'message' => "Vendor added and connected successfully!",
                'cid' => $vendorId,
                'data' => [
                    'companyName' => $companyData['companyName'],
                    'cid' => $vendorId
                ]
            ]));
        }
}

    private function saveNewUser($vendorData)
    {
    $userData = [
        'salutation' => $vendorData['salutation'],
        'firstname' => $vendorData['firstname'],
        'lastname' => $vendorData['lastname'],
        'mobile' => $vendorData['mobile'],
        'usertype' => $vendorData['usertype']
    ];

     // Add email only if it is provided and not empty
    if (!empty($vendorData['email'])) {
        $userData['email'] = $vendorData['email'];
    }

    if ($this->setting_model->saveUser($userData)) {
        return $this->db->insert_id();
    }

    return false;
    }


    // Generate unique CID method
    private function generateUniqueCID()
    {
        // Generate a 6-digit random number
        $cid = sprintf('%06d', mt_rand(0, 999999));

        // Check if the CID already exists in the database
        $this->db->where('cid', $cid);
        $query = $this->db->get('claims_company');

        // If exists, generate a new CID
        if ($query->num_rows() > 0) {
            return $this->generateUniqueCID();
        }

        return $cid;
    }







    /*
    * Add new Branch(KAJAL)
    */
    public function addNewBranch()
    {
        if ($this->session->userdata('id') != null) {
            // Retrieve posted data including vendor_id
            $data = array(
                'address' => $this->input->post('address'),
                'pincode' => $this->input->post('pincode'),
                'state' => $this->input->post('state'),
                'gst' => $this->input->post('gst'),
                'city' => $this->input->post('city'),
                'cid' => $this->input->post('vendor_id') // Save vendor_id as cid
            );

            // Load the model
            $this->load->model('setting_model');

            // Call the model to save the data
            $result = $this->setting_model->saveBranch($data);
            $is_saved = $result['is_successful'];
            $last_id = $result['last_id'];

            if ($is_saved) {
                $response = array(
                    "status" => 200,
                    'message' => "Branch added successfully",
                    'data' => array(
                        'id' => $last_id,
                        'address' => $data['address'],
                        'state' => $data['state'],
                        'city' => $data['city']
                    )
                );
            } else {
                $response = array("status" => 500, 'message' => "Internal server error");
            }
            echo json_encode($response);
        } else {
            redirect('user_logout');
        }
    }
      
      public function addNewUser() {
        // Load the model
        $this->load->model('setting_model');

        // Get input data for user
        $userData = $this->input->post();

        // Check if session exists (ensure the user is logged in)
        if ($this->session->userdata('id') !== null) {
            
            // Validate required fields (user info)
            if (empty($userData['salutation']) || empty($userData['firstname'])) {
                return;
            }

            // Prepare user data
            $salutation = $userData['salutation'];
            $firstname = $userData['firstname'];
            $lastname = $userData['lastname'];
            $mobile = $userData['mobile'];
            $mobile = $userData['mobile'];

            // Check if the user already exists by mobile number
            $existingUser = $this->setting_model->getAllconnectedusers($mobile);
            
            if ($existingUser) {
                // User already exists
                $response = array("status" => 409, 'message' => "User with this mobile number already exists.");
                $this->output->set_output(json_encode($response));
                return;
            }

            // Prepare data to insert a new user
            $userData = [
                'salutation' => $salutation,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'mobile' => $mobile,
            ];

            // Save the new user and get the generated ID
            $insertUserResult = $this->setting_model->saveUser($userData);
            if (!$insertUserResult) {
                // Error in inserting user
                log_message('error', 'Failed to save user data: ' . json_encode($userData));
                $response = array("status" => 500, 'message' => "Failed to save user data.");
                $this->output->set_output(json_encode($response));
                return;
            }

            // Capture the last inserted user ID
            $userId = $this->db->insert_id();

            // Return success response
            $response = array(
                "status" => 200,
                'message' => "User added successfully!",
                'userId' => $userId,  // Return the user ID
                'data' => [
                     'id' => $userId,
                    'salutation' => $salutation,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'mobile' => $mobile
                ]
            );
            $this->output->set_output(json_encode($response));

        } else {
            // Unauthorized access response
            $response = array("status" => 401, 'message' => "Unauthorized access. Please log in.");
            $this->output->set_output(json_encode($response));
        }
    }


      

    public function getdept() {}


    /*
    * Fetch Department (KAJAL)
    */
     public function fetchDepartments(){
        if ($this->session->userdata('id') != null) {
            $encrypted_json = $this->input->get('data');
            if ($encrypted_json) {
                // Decrypt the JSON string
                $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
                if ($decrypted_json) {
                    // Decode the JSON string back into an array
                    $data_array = json_decode($decrypted_json, true);
          
                    // Access the individual values
                    $defaultcompany = $data_array['defaultcompany'] ?? null;
                    $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                    $usertype = $data_array['usertype'] ?? null;
                    $data = [
                        'defaultcompany' => $defaultcompany,
                        'defaultdepartment' => $defaultdepartment,
                        'usertype' => $usertype,
                        'fields' => $this->case_model->get_field_names(),
                        'surveyors' => $this->case_model->get_survey_names(),
                        'view' => "Add Department",
                    ];
                }
            } 
            $this->load->model('setting_model');
            $departments = $this->setting_model->getAllDepartments();
            $data['departments'] = $departments;
            $this->load->view('adminpanel/jobs/locationbasedjob/adddepartment', $data);
        }
        else{
            redirect('user_logout');
        }
    }
    




    public function addUser()
    {
        $this->load->view("adminpanel/jobs/locationbasedjob/addnewuser");
    }


    // public function fetchBranchUser()
    // {
    //     $essentialdata = $this->your_model->get_essential_data();

    //     $vendorId = $essentialdata->policy_by_vendor_id; // Assuming this is the correct vendor ID field
    //     $vendor = $this->your_model->get_vendor_by_id($vendorId);

    //     $data['essentialdata'] = $essentialdata;
    //     $data['branch'] = $branch;
    //     $data['user'] = $user;

    // }


    /*
    * Get vendor record
    */
      public function getConnectedVendor()
      {
        if ($this->session->userdata('id') != null) {
            if ($this->input->is_ajax_request()) {
                $postData = $this->input->post();

                // Initialize data array
                $data = array();
                try {
                    // Get the connected vendors based on the posted data
                    $vendorlist = $this->setting_model->getConnectedVendorByCid($postData);
                    // Check if the vendor list is empty
                    if (empty($vendorlist)) {
                        // Return an empty response with the correct structure
                        $output = array(
                            "draw" => intval($postData['draw']),
                            "recordsTotal" => 0,
                            "recordsFiltered" => 0,
                            "data" => []
                        );
                        echo json_encode($output);
                        return; // End execution if no vendors are found
                    }

                    // Loop through the vendor list and prepare the data array
                    $i = $postData['start']; // Use the start parameter from DataTables for pagination
                      foreach ($vendorlist as $vendor) {
                        $i++;

                        // Check if company name and address are empty, if so, set to 'Individual'
                        $companyName = !empty($vendor->companyName) ? $vendor->companyName : 'Individual';
                        $address = !empty($vendor->address) ? $vendor->address : 'Individual';
                        $city = !empty($vendor->city) ? $vendor->city : '';
                        $state = !empty($vendor->state) ? $vendor->state : '';
                        $pincode = !empty($vendor->pincode) ? $vendor->pincode : '';

                        $billingid = !empty($vendor->billing_id) ? $vendor->billing_id : '';

                        // Combine the address details
                        $addressDetails = $address . ($city ? ', ' . $city : '') . ($state ? ' ,' . $state  : '') . ($pincode ? ' - ' . $pincode : '');
                        $addressDetails = $addressDetails ?: 'Individual'; // Ensure it's 'Individual' if the address is empty

                        // Prepare the delete button with a data attribute for the vendor ID
                        // $deleteButton = '<button type="button" class="btn btn-outline-info  delete-vendor" 
                        //                     data-vendor-id="' . htmlspecialchars(($vendor->id ?? ''), ENT_QUOTES, 'UTF-8') . '">
                        //                     Delete
                        //                  </button> ' ;

                        $data[] = array(
                            '<input type="radio" name="vendor_select" 
                                value="' . htmlspecialchars(($vendor->id ?? ''), ENT_QUOTES, 'UTF-8') . '" 
                                data-vendor-name="' . htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8') . '" 
                                data-branch-name="' . htmlspecialchars($addressDetails, ENT_QUOTES, 'UTF-8') . '"
                                data-gst="' . htmlspecialchars(($vendor->gst ?? ''), ENT_QUOTES, 'UTF-8') . '"
                                data-billing-id="' . htmlspecialchars(($billingid ?? ''), ENT_QUOTES, 'UTF-8') . '"
                                data-user-name="' . htmlspecialchars(($vendor->salutation ?? '') . ' ' . ($vendor->firstname ?? '') . ' ' . ($vendor->lastname ?? ''), ENT_QUOTES, 'UTF-8') . '"
                                data-mobile-number="' . htmlspecialchars(($vendor->mobile ?? ''), ENT_QUOTES, 'UTF-8') . '">',

                            // Company name column
                             htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8') .
                                ($billingid ? ' <span style="color:  #E16123;">' . htmlspecialchars($billingid, ENT_QUOTES, 'UTF-8') . '</span>' : ''),

                            // Address, City, State, and Pincode column
                            htmlspecialchars($addressDetails, ENT_QUOTES, 'UTF-8'),

                            // User information column with salutation included
                            htmlspecialchars(($vendor->salutation ?? '') . ' ' . ($vendor->firstname ?? '') . ' ' . ($vendor->lastname ?? '') . ' ' . ($vendor->mobile ?? ''), ENT_QUOTES, 'UTF-8'),

                            // Action column with Delete button
                            // $deleteButton
                        );
                    }


                    // Prepare the output array
                    $output = array(
                        "draw" => intval($postData['draw']),
                        "recordsTotal" => $this->setting_model->countAll(),
                        "recordsFiltered" => $this->setting_model->countFiltered($postData),
                        "data" => $data,
                    );

                    // Send JSON response
                    echo json_encode($output);
                } catch (Exception $e) {
                    // Log the error and send a generic error message
                    echo json_encode(array(
                        'error' => 'An error occurred while processing your request.',
                        'errorMessage' => $e->getMessage() // Use this line only in development for debugging.
                    ));
                }
            } else {
                $data['view'] = "Outgoing case";
                $this->load->view("adminpanel/jobs/locationbasedjob/outgoingcase", $data);
            }
        } else {
            redirect('user_logout');
        }
      }

        public function deletevendor()
        {
            if ($this->input->is_ajax_request()) {
                
                $vendorId = $this->input->post('vendor_id');
                
                if (empty($vendorId)) {
                    echo json_encode(['status' => 400, 'message' => 'Vendor ID is required']);
                    return;
                }

                $deleted = $this->setting_model->deleteVendorById($vendorId);

                if ($deleted) {
                    echo json_encode(['status' => 200, 'message' => 'Vendor deleted successfully']);
                } else {
                    echo json_encode(['status' => 500, 'message' => 'Failed to delete vendor or vendor not found']);
                }

            } else {
                echo json_encode(['status' => 400, 'message' => 'Invalid request']);
            }
        }






    public function checkRecordExists()
    {
        if ($this->session->userdata('id') != null) {
            if ($this->input->is_ajax_request()) {
                $postData = $this->input->post();

                // Call the model function
                $exists = $this->setting_model->recordExists($postData);

                // Return JSON response
                echo json_encode(array('exists' => $exists));
            } else {
                show_404();
            }
        } else {
            redirect('user_logout');
        }
    }

    public function surveyors()
    {
        $this->load->view("adminpanel/setting/globalsetting/surveyorlist");
    }
    public function createnewfield()
    {
        if ($this->session->userdata('id') != null) {
            if ($this->input->method() === 'post') {
                $this->form_validation->set_rules('field_name', 'Field Name', 'required');
                $this->form_validation->set_rules('key_name', 'Key Name', 'required');
                if ($this->form_validation->run() != FALSE) {
                    $fieldata = array(
                        "nature_of_job" => $this->input->post('nature_of_job'),
                        "fields_name" => $this->input->post('field_name'),
                        "key_name" => $this->input->post('key_name'),
                        "mandatory" => $this->input->post('mandatory'),
                        "status" => 1
                    );
                    $fieldcreated = $this->setting_model->insertfield($fieldata);
                    if (!empty($fieldcreated)) {
                        $response = array("status" => 200, 'message' => "New field created successfully", 'data' => null);
                        echo json_encode($response);
                    } else {
                        $response = array("status" => 500, 'message' => "Internal Server error");
                        echo json_encode($response);
                    }
                }
            } else {
                $locationjob['listofjobs'] = $this->case_model->getLocationJob();
                $this->load->view('adminpanel/setting/formfield/createform', $locationjob);
            }
        }
    }

    public function formfields()
    {
        if ($this->session->userdata('id') != null) {
            if ($this->input->method() === 'post') {
            } else {
                // $locationjob['listofjobs'] = $this->case_model->getLocationJob();
                $this->load->view('adminpanel/setting/formfield/formfieldlist');
            }
        }
    }
}
