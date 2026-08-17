<?php 
class Home extends CI_Controller{
public function __construct()
{ 
    parent::__construct();
    $this->data = array();
    $this->load->model("Home_model");
    $this->load->model("Company_model","company");
    $this->load->model('assignment_model','assignment');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->helper('custom_helper');
    $this->load->library('user_agent');

}
// Welcome to Claimsmitra kindly verify otp send to you on the next screen.
/**
 * @function
 * User Index Page bydefault
 * Post data through ajax.
 * Created by Arpit Singh Dated:25-06-2022
 */
public function index(){
    if($this->session->userdata('isLogin') == "loggedIn") {
        if($this->session->userdata('useragent') == "desktop"){
            redirect("dashboard");
        }else{
            redirect('quicksurveylist');
        }
        
    }else if($this->session->userdata('isLogin') == "screenlocked"){
        redirect("dashboardlock");
    }else{
        $this->load->view("adminpanel/login");
    }
}

// public function index() {
//     $userType = $this->session->userdata('usertype');
//     $isLogin = $this->session->userdata('isLogin');

//     if ($isLogin == "loggedIn") {
//         if ($userType == "COMPANY_ADMIN") {
//             // Check if the user has completed the department selection
//             if ($this->getdepartment()) {
//                 // If departments are selected, go to the dashboard
//                 redirect("dashboard");
//             } else {
//                 // If departments are not yet selected, go to the department modal or page
//                 redirect("dashboard"); // Change this if your modal logic is handled elsewhere
//             }
//         } else {
//             // For other user types, redirect to the dashboard
//             redirect("dashboard");
//         }
//     } else if ($isLogin == "screenlocked") {
//         // Redirect to the screen lock page if the session is screenlocked
//         redirect("dashboardlock");
//     } else {
//         // If not logged in, load the login view
//         $this->load->view("adminpanel/login");
//     }
// }


/**
 * @function
 * User Registration
 * Post data through ajax.
 * Created by Arpit Singh Dated:25-06-2022
 */
public function userRegistration(){
    if($_POST){
        $mobile = $this->input->post('mobile');
        $passcode = $this->input->post('passcode');
        $formdata = $this->input->post('formdata');
        parse_str($formdata, $parseData);
        $data = array("salutation"=>$parseData['salutation'],
                      "firstname"=>$parseData['firstname'],
                      "lastname"=>$parseData['lastname'],
                      "mobile"=>$mobile,
                      "passcode"=>md5($passcode),
                      "termsandconditions"=>true,
                      "is_active"=>true);
        $result = $this->Home_model->updateUser($data);
        if($result){
            $response = array('status'=>200, 'message'=>'You have successfully registered','data'=>null);
            echo json_encode($response);
        }else{
            $response = array('status'=>500, 'message'=>'Internal Server Error!','data'=>$result);
            echo json_encode($response);
        }
    }
}

public function encrypturlvalue(){
    $company = $this->input->post('defaultcompany');
    $department = $this->input->post('defaultdepartment');
    $user_role = $this->input->post('usertype');
    
    if (!empty($company || !empty($department || !empty($user_role)))) {
        $encrypted_json = encryptUrl($company,$department,$user_role);
    }

    $response = array("status"=>200,'message'=>"Encrypted Value",'data'=>$encrypted_json);
    echo json_encode($response);
}

   public function encrypturlvalueid()
    {
        $id = $this->input->post('id'); // ✅ include case/template ID
        $company = $this->input->post('defaultcompany');
        $department = $this->input->post('defaultdepartment');
        $user_role = $this->input->post('usertype');

        if (!empty($id) || !empty($company) || !empty($department) || !empty($user_role)) {
            $payload = json_encode([
                'id' => $id,
                'company' => $company,
                'department' => $department,
                'user_role' => $user_role
            ]);

            $encrypted_json = base64_encode($this->encryption->encrypt($payload));

            $response = array(
                "status" => 200,
                "message" => "Encrypted Value",
                "data" => $encrypted_json
            );
        } else {
            $response = array(
                "status" => 400,
                "message" => "Missing required input data.",
                "data" => null
            );
        }

        echo json_encode($response);
    }


/**
 * @function
 * User Login
 * Post data through ajax.
 * Created by Arpit Singh Dated:25-06-2022
 */
public function userLogin(){
    $session_data  = array();
    if($this->input->post()){
        $data = $this->input->post();
        // Add country code to the mobile number
        $country_code = '+91';
        $mobile_number = $country_code . $data['mobileoremail'];
        // Combine passcode fields into a single value
        $passcode = $data['passcode-1'] . $data['passcode-2'] . $data['passcode-3'] . $data['passcode-4'];

            if(!preg_match('/^\d{10}$/',$mobile_number)) {
                $error = "invalid phone number.";
            }
            $eptype = $mobile_number;
            if($eptype != null || $eptype != ""){
                $loginField = array("mobile"=>$eptype,"passcode"=>$passcode);
                $login =  $this->Home_model->loginUser($loginField);
                if($login != false){
                
                foreach ($login as $user) {
                    $user_agent = null;
                    if ($this->agent->is_mobile()) {
                        $user_agent = "mobile";
                    } elseif ($this->agent->is_browser()) {
                        $user_agent = "desktop";
                    }
                    // $user['companyname'] = $user['corporateId'] == 0 ? 'Individual' : $this->getCompanyName($user['corporateId']);
                    $session_data = array("id"=>$user['id'],
                                          "salutation"=>$user['salutation'],
                                          "firstname"=>$user['firstname'],
                                          "lastname"=>$user['lastname'],
                                          "mobile"=>$user['mobile'],
                                          "alt_mobile"=>$user['alt_mobile'],
                                          "email"=>$user['email'],
                                          "state"=>$user['state'],
                                          "city"=>$user['city'],
                                          "address"=>$user['address'],
                                          "pincode"=>$user['pincode'],
                                          "profilephoto"=>$user['profilephoto'],
                                          "email_verified"=>$user['email_verified'],
                                          "mobile_verified"=>$user['mobile_verified'],
                                          "is_active"=>$user['is_active'],
                                          "usertype"=>$user['usertype'],
                                          "useragent"=>$user_agent,
                                          "corporateId" => $user['corporateId'],
                                          "app_user"=>$user['app_user'],
                                          "isLogin"=>"loggedIn");
                }

                $this->session->set_userdata($session_data);
                $data_array = [
                        'defaultcompany' => "0",
                        'defaultdepartment' => "0",
                        'usertype' => "1"
                    ];
                
                    // Convert the array to JSON
                    $json_data = json_encode($data_array);

                    // Encrypt the JSON string
                    $encrypted_json = base64_encode($this->encryption->encrypt($json_data));
                    if($user_agent === "mobile"){
                        $url = base_url('quicksurveylist') . '?data=' . $encrypted_json;
                    }else{
                        $url = base_url('dashboard') . '?data=' . $encrypted_json;
                    }
                    
                    redirect($url);
                // redirect('dashboard');
                // $this->load->view('adminpanel/dashboard', $user_data);
                // print_r(json_encode($user_data));
                // exit;

                // if (!empty($userdata['departments'][0])) {
                //     // Create the data array
                //     $data_array = [
                //         'defaultcompany' => "0",
                //         'defaultdepartment' => $userdata['departments'][0]['id'],
                //         'usertype' => $userdata['departments'][0]['usertype']
                //     ];
                
                //     // Convert the array to JSON
                //     $json_data = json_encode($data_array);

                //     // Encrypt the JSON string
                //     $encrypted_json = base64_encode($this->encryption->encrypt($json_data));
                //     if($user_agent === "mobile"){
                //         $url = base_url('quicksurveylist') . '?data=' . $encrypted_json;
                //     }else{
                //         $url = base_url('dashboard') . '?data=' . $encrypted_json;
                //     }
                    
                //     redirect($url);
                // }
            }else{
                redirect('home');
            }
        }   
        }else{
        redirect('home');
    }
}

public function getCompanyName($corporateid){
    return $this->Home_model->getCompanyNameById($corporateid);
}

public function saveDepartments() {
    $user_id = $this->session->userdata('id');
    $corporate_id = $this->session->userdata('corporateId');
    $department_ids = $this->input->post('department_ids'); 
    if ($user_id && !empty($department_ids)) {
        $department_ids_array = explode(',', $department_ids);
        $result = $this->Home_model->saveUserDepartments($user_id, $department_ids_array);
        if ($result) {
            echo json_encode(array("status" => 200, "message" => "Departments saved successfully."));
        } else {
            echo json_encode(array("status" => 400, "message" => "Failed to save departments."));
        }
    } else {
        echo json_encode(array("status" => 400, "message" => "Invalid data."));
    }
}

public function fetchDepartments() {
    $user_id = $this->session->userdata('id');
    $corporate_id = $this->session->userdata('corporateId');

    if ($user_id && $corporate_id) {
        // Fetch department names from the model
        $departments = $this->Home_model->getDepartmentNamesByCorporateId($corporate_id);
        
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

public function fetchCompanyByUserId() {
    $user_id = $this->session->userdata('id');
    if ($user_id) {
        $companies = $this->Home_model->getCompaniesByUserId($user_id);
        if ($companies !== false) {
            if (!empty($companies)) {
                echo json_encode(array(
                    'status' => 200,
                    'data' => $companies
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

/*
 * @function
 * User Profile
 * Post data through ajax.
 * Created by Arpit Singh Dated:25-06-2022
 */

public function profileManagement()
    {
        // Check if user is logged in
        if ($this->session->userdata('id') != null) {
            $encrypted_json = $this->input->get('data');
            if ($encrypted_json) {
                $decrypted_json = $this->encryption->decrypt(base64_decode($encrypted_json));
                if ($decrypted_json) {
                    $data_array = json_decode($decrypted_json, true);
                    $defaultcompany = $data_array['defaultcompany'] ?? null;
                    $defaultdepartment = $data_array['defaultdepartment'] ?? null;
                    $usertype = $data_array['usertype'] ?? null;
                    $encrypted_tab = $this->input->get('tab') ?? 'personal_information';
                    $encrypted_option = $this->input->get('option') ?? 'addbanking';
                    $active_tab = $this->encryption->decrypt($encrypted_tab);
                    $action = $this->encryption->decrypt($encrypted_option);
                    $valid_tabs = ['personal_information', 'bank_information', 'kyc_documents', 'licence', 'corporate'];
                    $opration = ['addbanking', 'editbanking', 'fetchbanking'];
                    if (!in_array($active_tab, $valid_tabs)) {
                        $active_tab = 'personal_information'; 
                    }
                    $profile_data = array();
                    $profile_data['active_tab'] = $active_tab;
                    $profile_data['action'] = $action;
                    $profile_data['view'] = $active_tab;
                    $profile_data['defaultcompany'] = $defaultcompany;
                    $profile_data['defaultdepartment'] = $defaultdepartment;
                    $profile_data['usertype'] = $usertype;
                    $profile_data['companyName'] = $this->company->getCompanyName($defaultcompany);
                    $profile_data['departmentName'] = $this->company->getDepartmentName($defaultdepartment);
                    $userid = $this->session->userdata('id');
                    if ($active_tab == "personal_information") {
                        $userdata = $this->Home_model->getuserdatabyid($userid);
                        // print_r($userdata);
                        // exit();
                        if (!empty($userdata)) {
                            foreach ($userdata as $user) {
                                $user_data[] = array(
                                    "id" => $user['id'],
                                    "salutation" => $user['salutation'],
                                    "firstname" => $user['firstname'],
                                    "lastname" => $user['lastname'],
                                    "mobile" => $user['mobile'],
                                    "alt_mobile" => $user['alt_mobile'],
                                    "email" => $user['email'],
                                    "state" => $user['state'],
                                    "city" => $user['city'],
                                    "address" => $user['address'],
                                    "pincode" => $user['pincode'],
                                    "profilephoto" => $user['profilephoto'],
                                    "email_verified" => $user['email_verified'],
                                    "mobile_verified" => $user['mobile_verified'],
                                    "is_active" => $user['is_active'],
                                    "isLogin" => "loggedIn"
                                );
                            }
                            // print_r(json_encode($user_data));
                            // exit;
                            $profile_data['user_data'] = $user_data;
                        }
                    } else if ($active_tab == "bank_information") {
                        $profile_data['bank_data'] = $this->Home_model->getbankdetailbyuserid($userid);
                        if ($action == "addbanking") {
                            if ($_POST) {
                                $this->addNewBank($data);
                            }
                        } elseif ($action == "fetchbanking") {
                            $profile_data['bank_data'] = $this->Home_model->getbankdetailbyuserid($userid);
                            $this->load->view("adminpanel/setting/profile", $profile_data);
                        }
                    } else if ($active_tab == "kyc_documents") {
                        $profile_data['kycdocument_data'] = $this->Home_model->getkycdetailbyuserid($userid);
                    } else if ($active_tab == "licence") {
                        $profile_data['agent_data'] = $this->Home_model->getagentbyuserId($userid);
                        $profile_data['salvage_trader_data'] = $this->Home_model->getsalvagebuyerbyId($userid);
                        $profile_data['investigator_data'] = $this->Home_model->getInvestigatorbyId($userid);
                        $profile_data['profession'] = $this->Home_model->fetchprofession();
                        // $this->load->view("adminpanel/setting/profile", $profile_data);
                    } else if ($active_tab == "corporate") {
                    }
                    $data = [
                        'defaultcompany' => $defaultcompany,
                        'defaultdepartment' => $defaultdepartment,
                        'usertype' => $usertype,
                    ];
                    $this->load->view("adminpanel/setting/profile", $profile_data);
                }
            }
            // $encrypted_tab = $this->input->get('tab') ?? 'personal_information';
            // $encrypted_option = $this->input->get('option') ?? 'addbanking';
            // $active_tab = $this->encryption->decrypt($encrypted_tab);
            // $action = $this->encryption->decrypt($encrypted_option);
            // $valid_tabs = ['personal_information', 'bank_information', 'kyc_documents', 'licence', 'corporate'];
            // $opration = ['addbanking', 'editbanking', 'fetchbanking'];
            // if (!in_array($active_tab, $valid_tabs)) {
            //     $active_tab = 'personal_information'; 
            // }
            // $profile_data = array();
            // $profile_data['active_tab'] = $active_tab;
            // $profile_data['action'] = $action;
            // $userid = $this->session->userdata('id');
            // if ($active_tab == "personal_information") {
            //     $userdata = $this->Home_model->getuserdatabyid($userid);
            //     if (!empty($userdata)) {
            //         foreach ($userdata as $user) {
            //             $user_data[] = array(
            //                 "id" => $user['id'],
            //                 "salutation" => $user['salutation'],
            //                 "firstname" => $user['firstname'],
            //                 "lastname" => $user['lastname'],
            //                 "mobile" => $user['mobile'],
            //                 "alt_mobile" => $user['alt_mobile'],
            //                 "email" => $user['email'],
            //                 "state" => $user['state'],
            //                 "city" => $user['city'],
            //                 "address" => $user['address'],
            //                 "pincode" => $user['pincode'],
            //                 "profilephoto" => $user['profilephoto'],
            //                 "email_verified" => $user['email_verified'],
            //                 "mobile_verified" => $user['mobile_verified'],
            //                 "is_active" => $user['is_active'],
            //                 "isLogin" => "loggedIn"
            //             );
            //         }
            //         $profile_data['user_data'] = $user_data;
            //     }
            // } else if ($active_tab == "bank_information") {
            //     $profile_data['bank_data'] = $this->Home_model->getbankdetailbyuserid($userid);
            //     if ($action == "addbanking") {
            //         if ($_POST) {
            //             $this->addNewBank($data); // Logic to add new bank
            //         }
            //     } elseif ($action == "fetchbanking") {
            //         $profile_data['bank_data'] = $this->Home_model->getbankdetailbyuserid($userid);
            //         $this->load->view("adminpanel/setting/profile", $profile_data);
            //     }
            // } else if ($active_tab == "kyc_documents") {
            //     $profile_data['kycdocument_data'] = $this->Home_model->getkycdetailbyuserid($userid);
            // } else if ($active_tab == "licence") {
            //     $profile_data['agent_data'] = $this->Home_model->getagentbyuserId($userid);
            //     $profile_data['salvage_trader_data'] = $this->Home_model->getsalvagebuyerbyId($userid);
            //     $profile_data['investigator_data'] = $this->Home_model->getInvestigatorbyId($userid);
            //     $profile_data['profession'] = $this->Home_model->fetchprofession();
            //     // $this->load->view("adminpanel/setting/profile", $profile_data);
            // } else if ($active_tab == "corporate") {
            // }
            // $this->load->view("adminpanel/setting/profile", $profile_data);
        } else {
            redirect('user_logout');
        }
    }


public function fetchBankDetails() {
    // Check if user is logged in
    if ($this->session->userdata('id') != null) {
        $userid = $this->session->userdata('id');
        
        // Fetch bank details
        $bank_data = $this->Home_model->getbankdetailbyuserid($userid);
        // Prepare response
        if ($bank_data) {
            $response = [
                'status' => 200,
                'data' => $bank_data
            ];
        } else {
            $response = [
                'status' => 404,
                'message' => 'No bank information found.'
            ];
        }
        
        // Return response as JSON
        echo json_encode($response);
    } else {
        echo json_encode(['status' => 403, 'message' => 'Unauthorized']);
    }
}


public function getagentbyid(){
    if($this->session->userdata('id')!=null){
        $id = $this->input->post('agentid');
        $result = $this->Home_model->getagentbyId($id);
        if($result != null){
            foreach ($result as $value) {
                $agent_data = array("id"=>$value['id'],
                                    "companyId"=>$value['companyId'],
                                    "companyName" => $value['companyName'], 
                                    "userId"=>$value['userId'],
                                    "licenceno"=>$value['licenceno'],
                                    "licenceValidity"=>$value['licenceValidity'],
                                    "isActive"=>$value['isActive']);
            }
            $response = array("status"=>200,
                                "message"=>"Agent detail fetched!",
                                "data"=>$agent_data);
            echo json_encode($response);
        }else{
            redirect('user_logout');
        }
    }else{
        redirect('user_logout');
    }
}

// public function userProfileUpdate(){
//     if($this->session->userdata('id')!=null){
//         if($this->input->post()){
//             $data = $this->input->post();
//             $userdata = array(
//                 "salutation" => $data['salutation'] ?? null,
//                 "mobile" => $data['mobile'] ?? null, 
//                 "email" => $data['email'] ?? null,
//                 "firstname" => $data['firstname'] ?? null,
//                 "lastname" => $data['lastname'] ?? null,
//                 "alt_mobile" => $data['alt_mobile'] ?? null,
//                 "pincode" => $data['pincode'] ?? null,
//                 "city" => $data['city'] ?? null,
//                 "state" => $data['state'] ?? null,
//                 "address" => $data['address'] ?? null,
//                 "is_active" =>true
//             );
            
//             $result = $this->Home_model->updateUser($userdata);
//             if($result){
//                 $response = array("status"=>200, "message"=>"Profile update successfully!", "data"=>null);
//                 echo json_encode($response);
//             }else{
//                 $response = array("status"=>500, "message"=>"Internal server error!", "data"=>null);
//                 echo json_encode($response);
//             }
//         }else{
//             $response = array("status"=>404, "message"=>"404 page not found!", "data"=>null);
//             echo json_encode($response);
//         }
//     }else{
//         redirect(user_logout);
//     }
// }

public function userProfileUpdate(){
    if($this->session->userdata('id')!=null){
        if($this->input->post()){
            $data = $this->input->post();
            $userdata = array("salutation"=>$data['salutation'],
                                "mobile"=>$data['mobile'],
                                "email"=>$data['email'],
                                "firstname"=>$data['firstname'],
                                "lastname"=>$data['lastname'],
                                "pincode"=>$data['pincode'],
                                "city"=>$data['city'],
                                "state"=>$data['state'],
                                "address"=>$data['address'],
                                "is_active"=>$data['is_active']);

            $result = $this->Home_model->updateUser($userdata);
            if($result){
                $response = array("status"=>200, "message"=>"Profile update successfully!", "data"=>null);
                echo json_encode($response);
            }else{
                $response = array("status"=>500, "message"=>"Internal server error!", "data"=>null);
                echo json_encode($response);
            }
        }else{
            $response = array("status"=>404, "message"=>"404 page not found!", "data"=>null);
            echo json_encode($response);
        }
    }else{
        redirect(user_logout);
    }
}

 
/**
 * @function
 * User Logout
 * Post data through ajax.
 * Created by Arpit Singh Dated:25-06-2022
 */
public function userLogout(){
    $this->session->sess_destroy();
    redirect('home');
}



public function screenLock(){
    if($this->session->userdata('isLogin') == "loggedIn") {
        $this->session->set_userdata('isLogin', 'screenlocked');
        $this->load->view('adminpanel/lockscreen');
    }else{
        redirect("home");
    }
    
}

/**
 * Creatd by Arpit Singh Dated 01-07-2022
 * send mail on registration
 * @function send_email
 * @Home Controller
 */
function send_activationmail($email=null){
    $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'it.vpsac@gmail.com',
        'smtp_pass' => 'Admin@14827',
        'mailtype'  => 'text', 
        'charset'   => 'iso-8859-1'
    );
    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");

    $this->email->from('it.vpsac@gmail.com', 'Claims Mitra');
    $this->email->to($email); 

    $this->email->subject('Email Test');
    $this->email->message('Testing the email class.');  
    $result = $this->email->send();
}

/**
 * @Email Varification
 */
function emailVarification(){
    $email = $this->input->post();
    $this->data['result'] = $this->Home_model->emailVarify($email);
    if($this->data['result']!=false){
        foreach ($this->data['result'] as $row) {
            $this->data['emaildata'] = array("email"=>$row->email,
                                            "is_verified"=>$row->email_verified);
        }
        $response = array('status'=>true,'data'=>$this->data['emaildata']);
        echo json_encode($response);
    }else{
        $response = array('status'=>false,'data'=>$this->data['result']);
        echo json_encode($response);
    }
}

/**
 * @Mobile Varification
 */
function mobileVarification(){
    // $mobile = $this->input->post("mobile");
    if($_POST){
    $mobile = $this->input->post();
    $otprand=rand(1000,9999);
    if($this->is_mobileexist($mobile['mobile'])){
        if($this->is_mobileverified($mobile['mobile'])){
            $response = array("status"=>201,'message'=>"Mobile number already exist!");
            echo json_encode($response);
        }else{
            $sendotp = array('otp'=>$otprand,'mobile'=>$mobile['mobile']);
            if(sendotp($sendotp['otp'],$sendotp['mobile'])){
                if($this->Home_model->updateUser($sendotp)){
                    $response = array("status"=>200,'message'=>"OTP sent on your mobile number!");
                    echo json_encode($response);
                }
            }
        }    
    }else{
        $sendotp = array('otp'=>$otprand,'mobile'=>$mobile['mobile']);
        if(sendotp($sendotp['otp'],$sendotp['mobile'])){
            if($this->Home_model->createuser($sendotp)){
                $response = array("status"=>200,'message'=>"OTP sent on your mobile number!");
                echo json_encode($response);
            }else{
                $response = array("status"=>500,"message"=>"500 Internal server error!");
                echo json_encode($response);
            }
        }else{
            $response = array("status"=>301,"message"=>"We are unable to send otp on your mobile number. Please enter the correct mobile number or you can change your mobile number!");
            echo json_encode($response);
        }
    }
    }else{
        $response = array('status'=>404,'data'=>"404 Page not found");
        echo json_encode($response);
    }
}

 public function sendwhatsapp($otp,$mobile){
    if($mobile != null || $mobile != ""){
        $sendotp = array('otp'=>$otp,'mobile'=>$mobile);
        $message = "Your One-Time Password (OTP) is : ". $sendotp['otp'] ."  Please use this code to verify your identity. Do not share this code with anyone for security reasons.";
        if(sendwhatsapptextmessage($message,$sendotp['mobile'])){
            return true;
        }
    }
}

/**
 * OTP Verification
 *  
 * */
function otpverification (){
    if($_POST){
        $otp = $this->input->post('otp');
        $mobile = $this->input->post('mobile');
        $data = array('otp'=>$otp,'mobile'=>$mobile);
        $is_verified = $this->Home_model->otpverify($data);
        if($is_verified){
            $data['mobile_verified'] = 1;
            $is_update = $this->Home_model->updateUser($data);
            if($is_update){
                $response = array('status'=>200,'message'=>"Mobile number successfully verified!");
                echo json_encode($response);
            }else{
                $response = array('status'=>500,'message'=>"Internal Server Error!");
                echo json_encode($response);
            }
        }else{
            $response = array('status'=>403,'message'=>"You have enter wrong OTP!");
            echo json_encode($response);
        }
    }else{
        $response = array('status'=>404,'message'=>"404 Page not found");
        echo json_encode($response);
    }
}

function resetPasscode(){
    if($_POST){
        $email_phone = trim(stripslashes($this->input->post('mobileoremail')));
        $passcode = trim(stripslashes($this->input->post('passcode')));
        if(is_numeric($email_phone))
        {
            if(!preg_match('/^\d{10}$/',$email_phone)) {
                $error = "invalid phone number.";
            }
            $eptype = $email_phone;
            if($eptype != null || $eptype != ""){
               $passcodereset =  $this->Home_model->resetpasscode($email_phone,md5($passcode),"mobile");
               if($passcodereset){
                    $response = array("status"=>200,'message'=>"Password successfully reset!");
                    echo json_encode($response);
               }
            }
        }else 
        {  
            if (!filter_var($email_phone, FILTER_VALIDATE_EMAIL)) {
                $error = "invalid email address.";
            }
            $eptype = $email_phone;
            if($eptype != null || $eptype != ""){
                $mailsent = $this->sendmail($eptype);
                if($mailsent){
                    $response = array("status"=>200,'message'=>"OTP sent on your registered mail id!");
                    echo json_encode($response);
                }
            }
        }
    }else{

    }
}

function mobileexist(){
    if($_POST){
        $email_phone = trim(stripslashes($this->input->post('mobileoremail')));
        if(is_numeric($email_phone))
        {
            if(!preg_match('/^\d{10}$/',$email_phone)) {
                $error = "invalid phone number.";
            }
            $eptype = $email_phone;
            if($eptype != null || $eptype != ""){
                if($this->is_mobileexist($eptype)){
                    if($this->is_mobileverified($eptype)){
                        $response = array("status"=>200,'message'=>"Mobile number verified successfully!");
                        echo json_encode($response);
                    }else{
                        $response = array("status"=>201,'message'=>"Welcome to Claimsmitra kindly verify otp send to you on the next screen.");
                        echo json_encode($response);
                    }
                }else{
                    $response = array("status"=>201,'message'=>"Mobile number does not exist!");
                    echo json_encode($response);
                }
            }
        }else 
        {  
            if (!filter_var($email_phone, FILTER_VALIDATE_EMAIL)) {
                $error = "invalid email address.";
            }
            $eptype = $email_phone;
            if($eptype != null || $eptype != ""){
                if($this->is_emailexist($eptype)){
                    if($this->is_emailverified($eptype)){
                        $response = array("status"=>200,'message'=>"Email verified successfully!");
                        echo json_encode($response);
                    }else{
                        $response = array("status"=>201,'message'=>"Email not verified!");
                        echo json_encode($response);
                    }
                }else{
                    $response = array("status"=>201,'message'=>"Email does not exist!");
                    echo json_encode($response);
                }
            }
        }
    }else{

    }
}

function searchpincode(){
    if($_POST){
        $pincode = $this->input->post('pincode');
        $result = $this->Home_model->searchPincode($pincode);
        if($result){  
            $response = array('status'=>200,'message'=>"data fetched!", "data"=>$result[0]);
            echo json_encode($response);
        }
    }else{
        $response = array('status'=>404,'message'=>"404 Page not found");
        echo json_encode($response);
    }
}

function is_mobileexist($data){
    if($this->Home_model->mobile_exist($data)){
        return true;
    }else{
        return false;
    }
}
function is_mobileverified($data){
    if($this->Home_model->mobile_verify($data)){
        return true;
    }else{
        return false;
    }
}


function valid_phone_number_or_empty($value){
    $value = trim($value);
    if ($value == '') {
        return TRUE;
    }
    else
    {
        if (preg_match('/^\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}$/', $value))
        {
            return preg_replace('/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/', '($1) $2-$3', $value);
        }
        else
        {   
            $this->form_validation->set_message('valid_phone_number_or_empty', 'Mobile no is not valid.');
            return FALSE;
        }
    }
}

public function userForgotpassword(){
    if($_POST){
        $email_phone = trim($this->input->post('mobileoremail') ?? '');
        if(is_numeric($email_phone))
        {
            if(!preg_match('/^\d{10}$/',$email_phone)) {
                $error = "invalid phone number.";
            }
            $eptype = $email_phone;
            if($eptype != null || $eptype != ""){
                if($this->is_mobileexist($eptype)){
                    $otpsent =  $this->send_otp($eptype);
                    if($otpsent){
                        $response = array("status"=>200,'message'=>"OTP sent on your registered mobile number!");
                        echo json_encode($response);
                    }
                }else{
                    $response = array("status"=>201,'message'=>"Mobile number doesn't exist!");
                    echo json_encode($response);
                }
            }
        }else 
        {  
            if (!filter_var($email_phone, FILTER_VALIDATE_EMAIL)) {
                $error = "invalid email address.";
            }
            $eptype = $email_phone;
            if($eptype != null || $eptype != ""){
                $mailsent = $this->sendmail($eptype);
                if($mailsent){
                    $response = array("status"=>200,'message'=>"OTP sent on your registered mail id!");
                    echo json_encode($response);
                }
            }
        }
    }else{
        $this->load->view("adminpanel/forgotpassword");
    }
}

public function send_otp($mobile){
    $otprand=rand(1000,9999);
    if($mobile != null || $mobile != ""){
        $sendotp = array('otp'=>$otprand,'mobile'=>$mobile);
        // $message = "Your One-Time Password (OTP) is : ". $sendotp['otp'] ."  Please use this code to verify your identity. Do not share this code with anyone for security reasons.";
        if(sendotp($sendotp['otp'],$sendotp['mobile'])){
            if($this->Home_model->updateUser($sendotp)){
                return true;
            }
        }
    }
}

public function get_profession(){
    if($this->session->userdata('id')!=null){
    $result = $this->Home_model->fetchprofession();
    $response = array("status"=>200,
                      "message"=>"profession list successfully featched!",
                      "data"=>$result);
    echo json_encode($response);
    }else{
        redirect('user_logout');
    }
}

public function get_company(){
    if($this->session->userdata('id')!=null){
        $result = $this->Home_model->fetchcompany();
        $response = array("status"=>200,
                        "message"=>"Company list successfully featched!",
                        "data"=>$result);
        echo json_encode($response);
    }else{
        redirect('user_logout');
    }
}

public function uploadProfilePicture() {
    $config['upload_path'] = './assets/profile/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['file_name'] = 'profile_' . time() . '.jpeg';
    $config['upload']['detect_mime'] = false;
    $config['overwrite'] = true;

    if (!is_dir($config['upload_path'])) {
        mkdir($config['upload_path'], 0777, true);
    }

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('profile_photo')) {
        echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
        return;
    }

    $uploadData = $this->upload->data();
    $filePath = base_url('assets/profile/' . $uploadData['file_name']);

    $user_id = $this->session->userdata('id');
    $updateDatabase = $this->Home_model->updateProfilephoto($user_id, $filePath);

    if ($updateDatabase) {
        echo json_encode(['status' => 'success', 'image_url' => $filePath]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update database.']);
    }
}


/*public function getinsurancecompany(){
    if($this->session->userdata('id')!=null){
        if($_POST){
            $result = $this->Home_model->get_enterprisesBybusiness_type($data);
            if($result !=false){
                foreach ($result as  $value) {
                $list_company[] = array('<option value="'.$value['id'].'">'.$value['company_name'].'</option>');
                }
                $response = array("status"=>200,"message"=>"Insurace company list successfully featched!","data"=>$list_company);
                echo json_encode($response);
            }else{
                $response = array("status"=>400,"message"=>"Data not found!","data"=>null);
                echo json_encode($response);
            }
        }else{
                $response = array("status"=>500,"message"=>"Internal Server Error!","data"=>null);
                echo json_encode($response);
        }
    }else{
        redirect('user_logout');
    }
}*/


function getbanklist(){
    if($this->session->userdata('id')!=null){
        if($result !=false){
            foreach ($result as  $value) {
            $investigator[] = array('<option value="'.$value['id'].'">'.$value['bankname'].'</option>');
            }
            $response = array("status"=>200,"message"=>"Bank list successfully featched!","data"=>$investigator);
            echo json_encode($response);
        }else{
            $response = array("status"=>500,"message"=>"Internal Server Error!","data"=>null);
            echo json_encode($response);
        }
    }else{
        redirect('user_logout');
    }
}

function investigatorList(){
    if($this->session->userdata('id')!=null){
        $result = $this->Home_model->getinvestigator();
        if($result !=false){
            foreach ($result as  $value) {
            $investigator[] = array('<label class="form-check"><input type="checkbox" id="investigator'.$value['id'].'" onchange="checkinvestigator('.$value['id'].');" name="'.$value['id'].'" value="'.$value['investigator_type'].'" class="form-check-input">
                                            <span class="form-check-label">'.$value['investigator_type'].'</span></label>');
            }
            $response = array("status"=>200,"message"=>"Investigator list successfully featched!","data"=>$investigator);
            echo json_encode($response);
        }else{
            $response = array("status"=>500,"message"=>"Internal Server Error!","data"=>null);
            echo json_encode($response);
        }
    }else{
        redirect('user_logout');
    }
}

function salvagebuyercategoryList(){
    if($this->session->userdata('id')!=null){
        $result = $this->Home_model->getsalvagebuyercateogrylist();
        if($result !=false){
            foreach ($result as  $value) {
                $salvage_category[] = array('<option value="'.$value['id'].'">'.$value['category_name'].'</option>');
            }
                $response = array("status"=>200,"message"=>"Salvage Category list successfully fetched!","data"=>$salvage_category);
                echo json_encode($response);
        }else{
            $response = array("status"=>500,"message"=>"Internal Server Error!","data"=>null);
                echo json_encode($response);
        }
    }else{
        redirect('user_logout');
    }
}


function salvagesubcategoryList(){
    if($this->session->userdata('id')!=null){
        $category = $this->input->post('category');
        $result = $this->Home_model->getsalvagebuyersubcateogrylist($category);
        if($result !=false){
            foreach ($result as  $value) {
            $salvage_subcategory[] = array('<option value="'.$value['id'].'">'.$value['sub_category_name'].'</option>');
            }
            $response = array("status"=>200,"message"=>"Salvage Sub Category list successfully featched!","data"=>$salvage_subcategory);
            echo json_encode($response);
        }else{
            $response = array("status"=>500,"message"=>"Internal Server Error!","data"=>null);
            echo json_encode($response);
        }
    }else{
        redirect('user_logout');
    }
}


public function stateList(){
    if($this->session->userdata('id')!=null){
        $result = $this->Home_model->getstatelist();
        if($result !=false){
            foreach ($result as  $value) {
            $state[] = array('<option value="'.$value['id'].'">'.$value['name'].'</option>');
            }
            $response = array("status"=>200,"message"=>"State list successfully featched!","data"=>$state);
            echo json_encode($response);
        }else{
            $response = array("status"=>500,"message"=>"Internal Server Error!","data"=>null);
            echo json_encode($response);
        }
    }else{
        redirect('user_logout');
    }
}

public function cityList(){
    if($this->session->userdata('id')!=null){
        if($_POST){
            $stateId = $this->input->post('stateId');
            $cityList = $this->Home_model->getcityList($stateId);
            if($cityList !=false){
                foreach ($cityList as  $value) {
                    $city[] = array('<option value="'.$value['id'].'">'.$value['name'].'</option>');
                }
                $response = array("status"=>200,"message"=>"State list successfully featched!","data"=>$city);
                echo json_encode($response);
            }else{
                $response = array("status"=>500,"message"=>"Internal Server Error!","data"=>null);
                echo json_encode($response);
            }
        }else{
            $response = array("status"=>404,"message"=>"Page not found!","data"=>null);
            echo json_encode($response);
        }
    }else{
        redirect('user_logout');
    } 
}
/**
 * get bank detail by id
 * @function getbankbyid
 * 
 * */
public function getbankbyid(){
    if($this->session->userdata('id')!=null){
        if($_POST){
            $data = array('id'=>$this->input->post('bankid'));
            $result = $this->Home_model->getbank_detailbyid($data);
            if($result != null){
                foreach ($result as $value) {
                    $bank_data = array("id"=>$value['id'],
                                        "bankId"=>$value['bankId'],
                                        "accounttype"=>$value['accounttype'],
                                        "accountno"=>$value['accountno'],
                                        "ifsc_code"=>$value['ifsccode'],
                                        "chequecopy"=>$value['chequecopy'] == null ? null : base_url('/assets/upload/'.$value['chequecopy']),
                                        "micrcode"=>$value['micrcode'],
                                        "upi"=>$value['upi'],
                                        "status"=>$value['status'],
                                        "createdat"=>$value['createdat']);
                }
               
                
                $response = array("status"=>200,
                                "message"=>"Bank detail featched!",
                                "data"=>$bank_data);
                echo json_encode($response);
            }else{
                $response = array("status"=>400,
                                "message"=>"Record not found!",
                                "data"=>null);
                echo json_encode($response);
            }
        }else{
            $response = array("status"=>404,"message"=>"404 Page not found!","data"=>null);
            echo json_encode($response);
        }
    }else{
        redirect('user_logout');
    }
}


public function getdocumentByid(){
    if($this->session->userdata('id')!=null){
        if($_POST){
            $documnet_id = $this->input->post('documentid');
            $result = $this->Home_model->getdocument_detailbyid($documnet_id);
            if($result != null){
                foreach ($result as $value) {
                    $document_data = array("id"=>$value->id,
                                            "userid"=>$value->userid,
                                            "document_type"=>$value->document_type,
                                            "document_no"=>$value->document_no,
                                            "document_image"=>$value->document_image == null ? null : base_url('/assets/upload/'.$value->document_image),
                                            "status"=>$value->status,
                                            "created_at"=>$value->created_at);
                }
                $response = array("status"=>200,
                                  "message"=>"Kyc document detail featched!",
                                  "data"=>$document_data);
                echo json_encode($response);
            }else{
                $response = array("status"=>400,
                                  "message"=>"Record not found!",
                                  "data"=>$result);
                echo json_encode($response);
            }
        }else{
            $response = array("status"=>404,"message"=>"404 Page not found!");
            echo json_encode($response);
        }
    }else{
            redirect('user_logout');
    }
}

public function updateKycDocument() {
    if ($this->session->userdata('id') != null) {
        $documentId = $this->input->post('id');
        $documentType = $this->input->post('document_type');
        $thumbnail = null;
        $imagepath = basename($_FILES['kycdocument']["name"]);

        if ($imagepath != null) {
            preg_match('/(?<extension>\.\w+)$/im', $imagepath, $matches);
            $extension = $matches['extension'];
            $thumbnail = 'thumb_' . sha1($imagepath . time()) . $extension;
        }

        // Set upload configuration
        $config['upload_path'] = FCPATH . "assets/upload";
        $config['allowed_types'] = 'jpeg|jpg|png|pdf';
        $config['file_name'] = $thumbnail;
        $this->load->library('upload', $config);

        // Initialize the data array for updating the document
        $data = array(
            'document_type' => $documentType,
            'document_no' => ($documentType === "Aadhar Card") ? $this->input->post('aadhar_no') : $this->input->post('pan_no'),
            'userid' => $this->session->userdata('id')
        );

        // If a new document image is uploaded, add it to the data array
        if ($imagepath != null) {
            if ($this->upload->do_upload('kycdocument')) {
                $data['document_image'] = $thumbnail; // Set the new image path
            } else {
                log_message('error', 'File Upload Error: ' . $this->upload->display_errors());
            }
        }

        // Log the data being updated
        log_message('info', 'Data to be updated: ' . json_encode($data));

        // Call your model's update function with the document ID
        $result = $this->Home_model->updateDocument($data, $documentId);

        if ($result === true) {
            $response = array("status" => 200, "message" => "Document updated successfully!");
            echo json_encode($response);
        } else {
            log_message('error', 'Update error: ' . json_encode($result)); // Log the error message
            $response = array("status" => 502, "message" => "Failed to update KYC document due to an unknown error.");
            echo json_encode($response);
        }
    } else {
        redirect('user_logout');
    }
}






public function add_pan(){
    if($this->session->userdata('id')!=null){
        $thumb_pan = null;
        $config['upload_path']="./assets/upload";
        $config['allowed_types']='jpeg|jpg';
        if($_FILES['kyc_document']["name"]){
            $imagepath = basename($_FILES['kyc_document']["name"]);
            if($imagepath != null){
                    preg_match('/(?<extension>\.\w+)$/im', $imagepath, $matches);
                    $extension = $matches['extension'];
                    $thumbnail = 'thumb_'.sha1($imagepath.time()) . $extension;
            }
            $config['file_name'] = $thumbnail;
            $this->load->library('upload',$config);
            $pan_card = $this->upload->do_upload('kyc_document');
            if (!$pan_card){
                $response = array("status"=>400, "message"=>$this->upload->display_errors());
                echo json_encode($response);
            }else{
                $thumb_pan = $this->upload->data("file_name");
            }
        }
        if($thumb_pan!=null){
            $data = array('userid'=> $this->session->userdata('id'),
                    'document_no' => $this->input->post('pan_no'),
                    'document_image' => $thumb_pan,
                    'document_type' => "PAN Card",
                    'status'=> true);
            $check_existance = $this->Home_model->existance($data);
            if(!$check_existance){
                $result= $this->Home_model->add_documents($data);
                if ($result === true) {
                    $response = array("status"=>200, "message"=>"PAN card added successfully!");
                    echo json_encode($response);
                }else{
                    $response = array("status"=>500, "message"=>"500 Internal server error!");
                    echo json_encode($response);
                }
            }else{
                $response = array("status"=>403, "message"=>"You can not add multiple PAN card");
                echo json_encode($response);
            }
            
        }else{
                $response = array("status"=>500, "message"=>"500 Internal server error!");
                echo json_encode($response);
        }
    }else{
        redirect('user_logout');
    }
}

public function add_aadhar_Card(){
    if($this->session->userdata('id')!=null){
        $thumb_pan = null;
        $config['upload_path']="./assets/upload";
        $config['allowed_types']='jpeg|jpg';
        if($_FILES['kyc_document']["name"]){
            $imagepath = basename($_FILES['kyc_document']["name"]);
            if($imagepath != null){
                    preg_match('/(?<extension>\.\w+)$/im', $imagepath, $matches);
                    $extension = $matches['extension'];
                    $thumbnail = 'thumb_'.sha1($imagepath.time()) . $extension;
            }
            $config['file_name'] = $thumbnail;
            $this->load->library('upload',$config);
            $pan_card = $this->upload->do_upload('kyc_document');
            if (!$pan_card){
                $response = array("status"=>400, "message"=>$this->upload->display_errors());
                echo json_encode($response);
            }else{
                $thumb_pan = $this->upload->data("file_name");
            }
        }
        if($thumb_pan!=null){
            $data = array('userid'=> $this->session->userdata('id'),
                    'document_no' => $this->input->post('aadhar_no'),
                    'document_image' => $thumb_pan,
                    'document_type' => "Aadhar Card",
                    'status'=> true);
            $check_existance = $this->Home_model->existance($data);
            if(!$check_existance){
                $result= $this->Home_model->add_documents($data);
                if ($result === true) {
                    $response = array("status"=>200, "message"=>"Aadhar card added successfully!");
                    echo json_encode($response);
                }else{
                    $response = array("status"=>500, "message"=>"500 Internal server error!");
                    echo json_encode($response);
                }
            }else{
                $response = array("status"=>403, "message"=>"You can not add multiple Aadhar card");
                echo json_encode($response);
            }
        }else{
                $response = array("status"=>500, "message"=>"500 Internal server error!");
                echo json_encode($response);
        }
    }else{
        redirect('user_logout');
    }
}
    public function get_sla_data(){
        if($this->session->userdata('id')!=null){
            $query = '';
            if($this->input->post('query'))
            {
            $query = $this->input->post('query');
            }
            $data = $this->Home_model->getsla_data($query);
            echo json_encode($data);
        }else{
            redirect('user_logout');
        }
    }
    public function insert_new_document(){
        if ($this->session->userdata('id') != null) {
            $documentType = $this->input->post('document_type'); // Assuming you have a form field for document type
            $thumbnail = null;
            $imagepath = basename($_FILES['kycdocument']["name"]);
            if ($imagepath != null) {
                preg_match('/(?<extension>\.\w+)$/im', $imagepath, $matches);
                $extension = $matches['extension'];
                $thumbnail = 'thumb_' . sha1($imagepath . time()) . $extension;
            }
            $config['upload_path'] = FCPATH . "assets/upload"; // Absolute server path
            $config['allowed_types'] = 'jpeg|jpg|png|pdf'; // Adjust allowed types as needed
            $config['file_name'] = $thumbnail;
            $this->load->library('upload', $config);
        
            if ($this->upload->do_upload('kycdocument')) {
                $data = array(
                    'document_type' => $documentType, 
                    'document_no' =>$this->input->post('document_no'),
                    'document_image' => $thumbnail, 
                    'userid' => $this->session->userdata('id')
                );
                $result = $this->Home_model->addnewdocument($data);
                if ($result) {
                    // If the insertion is successful, you can respond with a success message.
                    $response = array("status" => 200, "message" => "KYC document added successfully!");

                    echo json_encode($response);
                } else {
                    $response = array("status" => 502, "message" => "Failed to add KYC document to the database: " . $this->db->error());
                    echo json_encode($response);
                }
            } else {
                $response = array("status" => 400, "message" => "File upload failed: " . $this->upload->display_errors());
                echo json_encode($response);
            }
        } else {
            redirect('user_logout');
        }
    }


    public function addNewBank(){

        $thumbnail = null;
        $imagepath = basename($_FILES['cancelCheque']["name"]);
        if($imagepath != null){
                preg_match('/(?<extension>\.\w+)$/im', $imagepath, $matches);
                $extension = $matches['extension'];
                $thumbnail = 'thumb_'.sha1($imagepath.time()) . $extension;
        }
        $config['upload_path']="./assets/upload";
        $config['allowed_types']='jpeg|jpg';
        $config['file_name'] = $thumbnail;
        $this->load->library('upload',$config);
        

        if($this->upload->do_upload('cancelCheque')){
            $imgupload = array('upload_data' => $this->upload->data());
            $data = array(
                'bankId' => $this->input->post('bank'),
                'accounttype' => $this->input->post('account_type'),
                'accountno' => $this->input->post('account_number'),
                'ifsccode' => $this->input->post('ifsc_code'),
                'micrcode' => $this->input->post('micr_code'),
                'upi' => $this->input->post('upi'),
                'chequecopy' => $thumbnail,
                'userid'=> $this->session->userdata('id'),
                'status'=> true
            );
            $result= $this->Home_model->addnewbank($data);
            if ($result === true) {
                $response = array("status"=>200, "message"=>"Bank added successfully!");
                echo json_encode($response);
            }else{
                $response = array("status"=>502, "message"=>$result['message']);
                echo json_encode($response);
            }
        }else{
            $response = array("status"=>400, "message"=>"File doesn't upload on server!");
            echo json_encode($response);
        }
    }

    public function updateBank() {
        if ($this->session->userdata('id') != null) {
            $thumbnail = null;
            if (isset($_FILES['cancelCheque']) && $_FILES['cancelCheque']['error'] === UPLOAD_ERR_OK) {
                $fileInfo = pathinfo($_FILES['cancelCheque']['name']);
                $extension = strtolower($fileInfo['extension']);
                $allowedExtensions = array("jpg", "jpeg", "png", "gif");

                if (in_array($extension, $allowedExtensions)) {
                    // Generate a unique filename
                    $thumbnail = uniqid() . '.' . $extension;

                    // Move the uploaded file to the destination directory
                    $uploadPath = './assets/upload/';
                    move_uploaded_file($_FILES['cancelCheque']['tmp_name'], $uploadPath . $thumbnail);
                } else {
                    // Handle invalid file format
                    $response = array("status" => 400, "message" => "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.");
                    echo json_encode($response);
                    return;
                }
            }

            $data = array(
                'bankId' => $this->input->post('bank'),
                'accounttype' => $this->input->post('account_type'),
                'accountno' => $this->input->post('account_number'),
                'ifsccode' => $this->input->post('ifsc_code'),
                'micrcode' => $this->input->post('micr_code'),
                'id' => $this->input->post('id'),
                'upi' => $this->input->post('upi'),
                'chequecopy' => $thumbnail,
                'userid' => $this->session->userdata('id'),
                'status' => true
            );
            print_r('Fetched id: ' . $this->input->post('id'));

            $result = $this->Home_model->updateBank($data);
            if ($result === true) {
                $response = array("status" => 200, "message" => "Bank account updated successfully!");
            } else {
                $response = array("status" => 502, "message" => "Failed to update bank account information.");
            }

            echo json_encode($response);
        } else {
            redirect('user_logout');
        }
    }
    
    public function deleteBankAccount() {
        if ($this->session->userdata('id') != null) {
            $id = $this->input->post('id');
            log_message('debug', 'ID to delete: ' . $id); // Log the ID for debugging
            $result = $this->Home_model->deletebank($id);
            if ($result) {
                $response = array("status" => 200, "message" => "Bank account successfully deleted", "data" => $result);
                echo json_encode($response);
            } else {
                $response = array("status" => 500, "message" => "500 Internal server error!");
                echo json_encode($response);
            }
        } else {
            redirect('user_logout');
        }
    }
    

    public function deleteKycAccount() {
        $documentId = $this->input->post('id');
        
        // Check if documentId is received
        if (!$documentId) {
            echo json_encode(['status' => 400, 'message' => 'Document ID is missing.']);
            return;
        }
    
        // Call the model method to delete the document
        if ($this->Home_model->deletedocument($documentId)) {
            echo json_encode(['status' => 200, 'message' => 'Document deleted successfully.']);
        } else {
            echo json_encode(['status' => 500, 'message' => 'Failed to delete the document.']);
        }
    }
    


    public function getcompanybyprofessionId(){
        if($this->session->userdata('id')!=null){
            $professionid = $this->input->post('profession');
            $result = $this->Home_model->getcompanybyprofession($professionid);
            if ($result != false) {
                $response = array("status"=>200,"message"=>"Company list successfully featched!","data"=>$result);
                echo json_encode($response);
            }else{
                $response = array("status"=>500, "message"=>"500 Internal server error!");
                echo json_encode($response);
            }
        }else{
            redirect('user_logout');
        }
    }



    public function insert_new_agent(){
        if($this->session->userdata('id')!=null){
            $licence_detail = array();
            $licence_detail['insurance_company'] = $this->input->post('insurance_company');
            $licence_detail['licence_number'] = $this->input->post('licence_number');
            $licence_detail['licence_validity'] = $this->input->post('licence_validity');

            $data = array(
                'companyId'=>$licence_detail['insurance_company'],
                'isActive' => true,
                'licenceno' => $licence_detail['licence_number'],
                'userId' => $this->session->userdata('id'),
                'licenceValidity' => $licence_detail['licence_validity'],
            );
            $result= $this->Home_model->addnewagent($data);
            if ($result === true) {
                $response = array("status"=>200, "message"=>"Licence added successfully!");
                echo json_encode($response);
            }else{
                $response = array("status"=>500, "message"=>"500 Internal server error!");
                echo json_encode($response);
            }
        }else{
            redirect('user_logout');
        }
    }

    public function insert_new_salvage_buyer(){
        if($this->session->userdata('id')!=null){
            $salvage_buyer_detail = array();
            $salvage_buyer_detail['category'] = $this->input->post('category');
            $salvage_buyer_detail['sub_category'] = $this->input->post('subcategory');
            $salvage_buyer_detail['buyer_range'] = $this->input->post('range_list');
            $salvage_buyer_detail['region'] = $this->input->post('state_list');
            $salvage_buyer_detail['others'] = $this->input->post('others');

            $data = array(
                'isActive' => true,
                'category' => $salvage_buyer_detail['category'],
                'subcategory' => serialize($salvage_buyer_detail['sub_category']),
                'buyer_range' => $salvage_buyer_detail['buyer_range'],
                'region' => serialize($salvage_buyer_detail['region']),
                'others' => $salvage_buyer_detail['others'],
                'userId' => $this->session->userdata('id')
            );

            $result= $this->Home_model->addnewsalvagebuyer($data);
            if ($result === true) {
                $response = array("status"=>200, "message"=>"Licence added successfully!");
                echo json_encode($response);
            }else{
                $response = array("status"=>500, "message"=>"500 Internal server error!");
                echo json_encode($response);
            }
        }else{
            redirect('user_logout');
        }
    }
   
    public function geteditsalvage() {
        if ($this->session->userdata('id') != null) {
            $salvageid = $this->input->post('salvageid');
            $salvage_data = $this->Home_model->geteditSalvageById($salvageid);
            if ($salvage_data) {
                $subcategory_ids = unserialize($salvage_data['subcategory']);
                $region_ids = unserialize($salvage_data['region']);
                if (is_array($subcategory_ids)) {
                    $this->db->select('sub_category_name');
                    $this->db->where_in('id', $subcategory_ids);
                    $subcategory_query = $this->db->get('claims_salvage_trader_subcategory');
                    $subcategory_names = ($subcategory_query !== false) ? $subcategory_query->result_array() : [];
                    $subcategory_names_array = array_column($subcategory_names, 'sub_category_name');
                } else {
                    $subcategory_names_array = [];
                }
                if (is_array($region_ids)) {
                    $this->db->select('name'); 
                    $this->db->where_in('id', $region_ids);
                    $region_query = $this->db->get('claims_states');
                    $region_names = ($region_query !== false) ? $region_query->result_array() : [];
                    $region_names_array = array_column($region_names, 'name');
                } else {
                    $region_names_array = [];
                }
                $response = array(
                    'status' => 200,
                    'sub_category' => $subcategory_names_array, 
                    'region' => $region_names_array,
                    'buyer_range' => $salvage_data['buyer_range']
                );
                
            } else {
                $response = array('status' => 404, 'message' => 'Data not found');
            }
    
            echo json_encode($response);
        } else {
            redirect('user_logout');
        }
    }
    
    
    
    
    public function insert_new_investigator(){
        if($this->session->userdata('id')!=null){
            $data = array();
            $investigator_detail = array();
            $investigator_detail['investigator'] = $this->input->post('investigator');
            $investigator_detail['language'] = $this->input->post('language');
            $investigator_detail['others'] = $this->input->post('others');   

            $is_exist = $this->Home_model->isInvestigatorExist($this->session->userdata('id'));
            if($is_exist == false){
                $data = array(
                            'investigator' => trim(implode(',',$investigator_detail['investigator'])),
                            'language' => trim(implode(',',$investigator_detail['language'])),
                            'others' => $investigator_detail['others'],
                            'userid' => $this->session->userdata('id'),
                            'isActive'=> true,
                ); 
                $result= $this->Home_model->addnewinvestigator($data);
            }else{
                $investigator_comp = array_intersect($is_exist['investigator'], $investigator_detail['investigator']);
                
                if($investigator_detail['language'] != ""){
                    $language_comp = array_intersect($is_exist['language'], $investigator_detail['language']);
                    $response = array("status"=>201, "message"=>implode(',', $language_comp));
                    echo json_encode($response);
                }
                if(empty($investigator_comp)){
                    $data['investigator'] = serialize(array_merge($is_exist['investigator'], $investigator_detail['investigator']));
                }else{
                    $response = array("status"=>201, "message"=>implode(',', $investigator_comp));
                    echo json_encode($response);
                }
                if($investigator_detail['language'] != "" && empty($language_comp)){
                    $data['language']  = serialize(array_merge($is_exist['language'], $investigator_detail['language']));   
                }else{
                    $response = array("status"=>201, "message"=>implode(',', $language_comp));
                    echo json_encode($response);
                }
                if($is_exist['others'] != ""){
                    $response = array("status"=>201, "message"=>"You can add only one other field");
                    echo json_encode($response);
                }else{
                    $data['others'] = $investigator_detail['others'];
                }
                if(!empty($data)){
                    $result = $this->Home_model->updateInvestigator($data,$this->session->userdata('id'));
                }                
            }
            if ($result === true) {
                $response = array("status"=>200, "message"=>"Licence added successfully!");
                echo json_encode($response);
            }else{
                $response = array("status"=>500, "message"=>"500 Internal server error!");
                echo json_encode($response);
            }
        }else{
            redirect('user_logout');
        }
    }
    public function deletetrader($trader_id) {
        $result = $this->Home_model->deletetraderbyid($trader_id);
        
        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
    public function deleteProfession(){
        if($this->session->userdata('id')!=null){
            $rowid = $this->input->post('id');
            $typeofprofession = $this->input->post('value');
            if($typeofprofession != "Document Translation"){
                $result = $this->Home_model->deleteprofessionById($rowid,$typeofprofession);
                print_r($result);
                exit;
            }
        }
    }
    
    public function deleteagent($id) {
        $result = $this->Home_model->deleteagentbyid($id);
        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
    

/*public function searchinvestigator(){
    $result  = $this->Home_model->searchInvestigator("investigator","Others");
    print_r($result);
    exit;
}*/

    public function add_gst(){
        if($this->session->userdata('id')!=null){
            $config['upload_path']="./assets/upload";
            $config['allowed_types']='jpeg|jpg';
            if($_FILES['upload_gst_certificate']["name"]){
                $imagepath = basename($_FILES['upload_gst_certificate']["name"]);
                if($imagepath != null){
                        preg_match('/(?<extension>\.\w+)$/im', $imagepath, $matches);
                        $extension = $matches['extension'];
                        $thumbnail = 'thumb_'.sha1($imagepath.time()) . $extension;
                }
                $config['file_name'] = $thumbnail;
                $this->load->library('upload',$config);
                $gst_certificate = $this->upload->do_upload('upload_gst_certificate');
                if (!$gst_certificate){
                    $response = array("status"=>400, "message"=>$this->upload->display_errors());
                    echo json_encode($response);
                }else{
                    $thumb_gst = $this->upload->data("file_name");
                    $data = array('userid'=> $this->session->userdata('id'),
                        'document_no' => $this->input->post('gst_no'),
                        'document_image' => $thumb_gst,
                        'document_type' => "GST",
                        'status'=> true);
                    $result= $this->Home_model->add_documents($data);
                    if ($result === true) {
                        $response = array("status"=>200, "message"=>"GST added successfully!");
                        echo json_encode($response);
                    }else{
                        $response = array("status"=>500, "message"=>"500 Internal server error!");
                        echo json_encode($response);
                    }
                }
            }  
        }else{
            redirect('user_logout'); 
        } 
    }

    public function getkycList(){
        if($this->session->userdata('id')!=null){
            $result = $this->Home_model->getkyc_list();
            if($result!=false){
                foreach ($result as  $value) {
                    if($value['kyc'] != "CIN Number" && $value['kyc'] != "GST Number" ){
                        $kycdocument_data[] = array('<option value="'.$value['kyc'].'">'.$value['kyc'].'</option>');
                    }
                }
                $response = array("status"=>200, "message"=>"KYC list fetched successfully!", "data"=>$kycdocument_data);
                echo json_encode($response);
            }else{
                $response = array("status"=>500, "message"=>"Internal server error!");
                echo json_encode($response);
            }
        }else{
            redirect('user_logout'); 
        }
    }


    public function getkycbyid() {
        if ($this->session->userdata('id') != null) {
            if ($_POST) {
                $id = $this->input->post('documentId');
                $result = $this->Home_model->getKycDetailById($id);

                if (is_array($result) && !empty($result)) {
                    $kycdocument_data = array();

                    foreach ($result as $value) {
                        if (is_object($value)) {
                            $kycdocument_data[] = array(
                                "document_type" => $value->document_type,
                                "id" => $value->id,
                                "userid" => $value->userid,
                                "document_no" => $value->document_no,
                                "document_image" => $value->document_image == null ? null : base_url('/assets/upload/' . $value->document_image),
                                "created_at" => $value->created_at
                            );
                        }
                    }

                    $response = array(
                        "status" => 200,
                        "message" => "Kyc document detail fetched!",
                        "data" => $kycdocument_data,
                        "document_type" => isset($kycdocument_data[0]['document_type']) ? $kycdocument_data[0]['document_type'] : null,
                        "document_no" => isset($kycdocument_data[0]['document_no']) ? $kycdocument_data[0]['document_no'] : null,
                        "document_image" => isset($kycdocument_data[0]['document_image']) ? $kycdocument_data[0]['document_image'] : null

                    );
                    echo json_encode($response);
                    $data['kycdocument_data'] = $kycdocument_data;
                } else {
                    $response = array(
                        "status" => 400,
                        "message" => "Record not found!",
                        "data" => $result
                    );

                    echo json_encode($response);
                }
            } else {
                $response = array("status" => 404, "message" => "404 Page not found!");
                echo json_encode($response);
                
            }
        } else {
            redirect('user_logout');
        }
    }
    public function getCompanydetail(){
        if($this->session->userdata('id')!= null){
            $companyid = $this->input->post('companyid');
            $result = $this->Home_model->checkcompanydetail($companyid);
            if($result){
                $response = array("status"=>200, "message"=>"Company data successfully fetched", "data"=>$result);
                echo json_encode($response); 
            }else{
                $response = array("status"=>400, "message"=>"No record found", "data"=>null);
                echo json_encode($response);
            }
        }else {
            redirect('user_logout');        
        }
    }
}
