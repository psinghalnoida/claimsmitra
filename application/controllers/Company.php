<?php 
class Company extends CI_Controller{
    public function __construct()
   	{
       parent::__construct();
       $this->load->library('form_validation');
       $this->load->model('company_model','company');
       $this->load->model('home_model');
       $this->load->helper('upload_helper');
       $this->data = array();
   	}

    public function index(){
        $this->load->view('adminpanel/company/index');
    }

    public function newcompany(){
        $data['profession'] = $this->home_model->fetchprofession();
        $data['case'] = "All Company Data";
        $this->load->view('adminpanel/company/newcompany', $data);
    }

    /* ------------------------------------------------------------------------- *
    * GET COMPANY NAME BY USER ID
    * ------------------------------------------------------------------------- */
    public function getCompanyNameByUserID() {
        $user_id = $this->session->userdata('id');
        $companyid = $this->input->post('companyid');
        if ($user_id) {
            $companies = $this->company->fetchCompanyNameByUserID($user_id);
            $departments = $this->company->fetchDepartmentNamesByCorporateId($companyid,$user_id);
            $data['companies'] = $companies;
            $data['departments'] = $departments;

            if ($companies !== false) {
                if (!empty($companies)) {
                    echo json_encode(array(
                        'status' => 200,
                        'data' => $data
                    ));
                } else {
                    echo json_encode(array(
                        'status' => 404,
                        'message' => 'No companies found.'
                    ));
                }
            } else {
                echo json_encode(array(
                    'status' => 500,
                    'message' => 'Database query error. Please try again later.'
                ));
            }
        } else {
            echo json_encode(array(
                'status' => 400,
                'message' => 'Invalid user ID.'
            ));
        }
    }

    /* ------------------------------------------------------------------------- *
    * GET DEPARTMENT NAME BY COMPANY ID
    * ------------------------------------------------------------------------- */
    public function getDepartmentNameByCorporateId() {
        $corporate_id = $this->input->post('corporateId');
        $user_id = $this->session->userdata('id');
        if ($user_id != null && $corporate_id != null) {
            // Fetch department names from the model
            $departments = $this->company->get_user_departments_with_names($corporate_id,$user_id);
            // print_r(json_encode($departments));
            // exit;
            if ($departments !== false) {
                if (!empty($departments)) {
                    echo json_encode(array(
                        'status' => 200,
                        'data' => $departments
                    ));
                } else {
                    echo json_encode(array(
                        'status' => 404,
                        'message' => 'No departments found.'
                    ));
                }
            } else {
                echo json_encode(array(
                    'status' => 500,
                    'message' => 'Database query error. Please try again later.'
                ));
            }
        } else {
            echo json_encode(array(
                'status' => 400,
                'message' => 'Invalid user or corporate ID.'
            ));
        }
    }
    
    /**
     * Action View,Reject,Archive
     * Form Field-> Name of contact person, Mobile of Contact Person, Location for verification (Text Box *)
     */
    public function getcompanylist(){
        $data = array();
        // Fetch member's records
        $companyData = $this->company->getRows($_POST);
        
        $i = $_POST['start'];
        foreach($companyData as $companyValue){
            $i++;
            $case_status = null;
            if($companyValue->status == 0){
                $case_status = '<span class="label label-warning">Inactive</span>';
            }else{
                $case_status = '<span class="label label-success">Active</span>';
            }
            $action = '<div class="dropleft">
                            <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu">
                                <a href="'.base_url().'company/view/'.$companyValue->id.'" class="dropdown-item">View</a>
                                <a href="'.base_url().'company/view/'.$companyValue->id.'" class="dropdown-item">Reject</a>
                                <a href="'.base_url().'company/view/'.$companyValue->id.'" class="dropdown-item">Archive</a>
                            </div>
                        </div>';
            $data[] = array($i,
                            $companyValue->cid,
                            $companyValue->companyName,
                            $companyValue->createdBy, 
                            $companyValue->website,
                            $case_status,
                            $action);
        }
        $output = array(    
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->company->countAll(),
            "recordsFiltered" => $this->company->countFiltered($_POST),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function getbranches(){
        $data = array();

        $branchData = $this->company->getBranchRows($_POST);

        $i = $_POST['start'];
        foreach($branchData as $branchValue){
            $i++;
            $action = '<a href=""><span class="label label-success">Send Request</span></a>';
            $data[] = array($branchValue->bid,
                            $branchValue->gst,
                            $branchValue->address, 
                            $branchValue->pincode, 
                            $branchValue->state, 
                            $branchValue->city, 
                            $action);
        }
        $output = array(    
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->company->countAllbranch(),
            "recordsFiltered" => $this->company->countFilteredbranch($_POST),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function getcompanybyId(){
        if($this->session->userdata('id')!=null){
            $companyid = $this->input->post('company');
            $result = $this->company->getcompanybyId($companyid);
            if ($result != false) {
                $response = array("status"=>200,"message"=>"Company successfully fetched.","data"=>$result);
                echo json_encode($response);
            }else{
                $response = array("status"=>500, "message"=>"500 Internal server error.");
                echo json_encode($response);
            }
        }else{
            redirect('user_logout');
        }
    }

    public function getcompanybyuserId() {
        if ($this->session->userdata('id')) {
            $userId = $this->session->userdata('id'); 
            $companies = $this->company->getcompanyByUserId($userId);
            if ($companies) {
                $response = array(
                    'status' => 200,
                    'message' => 'Companies fetched successfully',
                    'data' => $companies
                );
            } else {
                $response = array(
                    'status' => 404,
                    'message' => 'No companies found',
                    'data' => null
                );
            }
            echo json_encode($response);
        } else {
            redirect('user_logout');
        }
    }
    
    public function editcompanydetailsbyid(){
        if($this->session->userdata('id')!=null){
            $companyId = $this->input->post('companyId');
            $result =  $this->company->editCompanyDetailsById($companyId);
            if ($result != false){
                $response = array("status" => 200, "message" => "Company successfully fetched.", "data" => $result);
                echo json_encode($response);
            }else{
                $response = array("status" => 404, "message" => "Error");
                echo json_encode($response);
            }
        }
        else{
            redirect('user_logout');
        }
    }

    public function addnewbranch() {
        if ($this->session->userdata('id') != null) {
            $branchData = array(
                "bid" => $this->input->post('cid') . random_int(1000, 9999),
                "cid" => $this->input->post('cid'),
                "uid" => $this->session->userdata('id'),
                "address" => $this->input->post('address'),
                "pincode" => $this->input->post('pincode'),
                "state" => $this->input->post('state'),
                "city" => $this->input->post('city'),
                "gst" => $this->input->post('gst'),
                "status" => 0
            );
            
            // Insert the branch data
            $result = $this->company->insertbranch($branchData);
            
            // Check if insert was successful
            if ($result !== true) {
                $response = array("status" => 500, "message" => "500 Internal server error.");
            } else {
                // Successfully inserted, include the new branch data in the response
                $response = array(
                    "status" => 200,
                    "message" => "Branch successfully created.",
                    "data" => array(
                        "bid" => $branchData["bid"],    // Include the new bid
                        "gst" => $branchData["gst"],    // Include the new gst
                        "address" => $branchData["address"],
                        "pincode" => $branchData["pincode"],
                        "state" => $branchData["state"],
                        "city" => $branchData["city"]
                    )
                );
            }
            echo json_encode($response);
        } else {
            redirect('user_logout');
        }
    }
    
    
    public function view($id = null){
        $data = array();
        if($id!=null){
            $info = $this->company->getcompanybyId($id);
            if($info != false){
                $data['companydata'] = $info[0];
                $data['professionlist'] = $this->home_model->fetchprofession();
                $this->load->view('adminpanel/company/view',$data);
            }
        }
    }

    public function validatepancard(){
        $query = '';
        if($this->input->post('query'))
        {
            $query = $this->input->post('query');
        }
        $data = $this->company->searchpancard($query);
        echo json_encode($data);
    }

    public function createCompany(){
        if($this->session->userdata('id')){
            if($this->input->method() == 'post'){
                $profession = array($this->input->post('select_profession'),3);
                $info = array('cid'=>random_int(100000, 999999),
                            'professionId'=>implode(',',$profession),
                            'companyName'=>$this->input->post('companyName'),
                            'cinNo'=>$this->input->post('cinNumber'),
                            'licenceNo'=>$this->input->post('licenceNumber'),
                            'createdBy'=> $this->session->userdata('id'));
                $this->form_validation->set_rules('companyName', 'Company Name', 'required');
                $this->form_validation->set_rules('cinNumber', 'CIN Number', 'required');
                $this->form_validation->set_rules('licenceNumber', 'Licence Number', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $errors = validation_errors();
                    $response = array('status'=>403, 'message'=>'Internal server error!','data'=>$errors);
                    echo json_encode($response);
                }else{
                    $add = $this->company->addCompany($info);
                    if ($add){
                    $response = array('status'=>200, 'message'=>'Company successfully added','data'=>null);
                    } else{
                    $response = array('status'=>500, 'message'=>'Internal server error!','data'=>$add);
                    }
                    echo json_encode($response);
                }
            }else{
                $info['regulated'] = $this->company->getRegulated();
                $info['unregulated'] = $this->company->getUnregulated();
                $this->load->view('adminpanel/company/createnewcompany',$info);
            }
        }else{
            redirect('user_logout');
        }
    }

    public function createcompanybyUser(){
        if($this->session->userdata('id')) {
            $upload = new UPLOAD();
            if($this->input->method() === 'post') {
                
                // Get the file details
                $imagepath = basename($_FILES['licenceimage']["name"]);
                $filename = null;
    
                // Check if the file exists
                if ($imagepath != null) {
                    // Extract file extension
                    preg_match('/(?<extension>\.\w+)$/im', $imagepath, $matches);
                    $extension = $matches['extension'];
                    $filename = 'company_' . sha1($imagepath . time()) . $extension;
                }
    
                // Set upload configuration
                $config['upload_path'] = FCPATH . "assets/upload/";
                $config['allowed_types'] = 'jpeg|jpg|png|pdf';
                $config['file_name'] = $filename;
                $this->load->library('upload', $config);
    
                // Create the company data array
                $info = array(
                    'cid' => random_int(100000, 999999),
                    'professionId' => implode(',', array($this->input->post('select_profession'), "3")),
                    'companyName' => $this->input->post('companyName'),
                    'cinNo' => $this->input->post('cinNumber'),
                    'licenceNo' => $this->input->post('licenceNumber'),
                    'licenceImage' => $filename,
                    'status' => true,
                    'createdBy' => $this->session->userdata('id')
                );
    
                // Validate form data
                $this->form_validation->set_rules('companyName', 'Company Name', 'required');
                $this->form_validation->set_rules('cinNumber', 'CIN Number', 'required');
                $this->form_validation->set_rules('licenceNumber', 'Licence Number', 'required');
    
                if ($this->form_validation->run() == FALSE) {
                    $errors = validation_errors();
                    $response = array('status' => 403, 'message' => 'Validation failed', 'data' => $errors);
                    echo json_encode($response);
                } else {
                    // Handle file upload if a file is selected
                    if ($imagepath != null && $this->upload->do_upload('licenceimage')) {
                        $info['licenceImage'] = $filename;  // Save the uploaded filename
                    } else if ($imagepath != null) {
                        log_message('error', 'File Upload Error: ' . $this->upload->display_errors());
                        $response = array('status' => 500, 'message' => 'Failed to upload image');
                        echo json_encode($response);
                        return;
                    }
    
                    // Insert the company data
                    $add = $this->company->addCompany($info);
                    if($add) {
                        $response = array('status' => 200, 'message' => 'Company successfully added', 'cid' => $info['cid']);
                    } else {
                        $response = array('status' => 500, 'message' => 'Internal server error', 'data' => null);
                    }
                    echo json_encode($response);
                }
    
            }
        } else {
            redirect('user_logout');
        }
    }
    
   
    public function updatecompanybyuser() {
        if ($this->session->userdata('id') != null) {
            $licenceImage = null;
    
            if (isset($_FILES['licenceimage']) && $_FILES['licenceimage']['error'] === UPLOAD_ERR_OK) {
                $fileInfo = pathinfo($_FILES['licenceimage']['name']);
                $extension = strtolower($fileInfo['extension']);
                $allowedExtensions = array("jpg", "jpeg", "png", "pdf");
    
                if (in_array($extension, $allowedExtensions)) {
                    $licenceImage = 'company_' . uniqid() . '.' . $extension;
                    $uploadPath = './assets/upload/';
                    move_uploaded_file($_FILES['licenceimage']['tmp_name'], $uploadPath . $licenceImage);
                } else {
                    echo json_encode(array("status" => 400, "message" => "Invalid file format. Only JPG, JPEG, PNG, and PDF are allowed."));
                    return;
                }
            }
    
            $data = array(
                'professionId' => implode(',', array($this->input->post('select_profession'), "3")),
                'companyName' => $this->input->post('companyName'),
                'cinNo' => $this->input->post('cinNumber'),
                'licenceNo' => $this->input->post('licenceNumber'),
                'cid' => $this->input->post('cid'),
            );
    
            if ($licenceImage) {
                $data['licenceImage'] = $licenceImage;
            }
            $result = $this->company->updateCompany($data);
    
            if ($result) {
                $response = array("status" => 200, "message" => "Company updated successfully!");
            } else {
                $response = array("status" => 502, "message" => "Failed to update company information.");
            }
    
            echo json_encode($response);
        } else {
            redirect('user_logout');
        }
    }
    
    public function deleteCompany() {
        $companyId = $this->input->post('companyId');

        // Validate the ID
        if (empty($companyId)) {
            echo json_encode(array("status" => 400, "message" => "Company ID is required."));
            return;
        }
        $result = $this->company->deleteCompanyById($companyId);

        // Check if deletion was successful
        if ($result) {
            echo json_encode(array("status" => 200, "message" => "Company deleted successfully!"));
        } else {
            echo json_encode(array("status" => 500, "message" => "Failed to delete the company or no record found."));
        }
    } 
}