<?php defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
require_once APPPATH . 'libraries/stripe-php/init.php';

use Dompdf\Dompdf;
use Dompdf\Options;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class Admin extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
     	$this->load->library('encryption');
        $this->load->model('assignment_model','assignment');
        $this->load->model('company_model','company');
        $this->load->model('home_model','home');
        $this->load->model('setting_model');
        $this->load->helper('upload_helper');
        $this->load->helper('custom_helper');  
    }

    public function index(){
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

                    $user_id = $this->session->userdata('id');
                    $userdata['departments'] = $this->company->fetchDepartmentNamesByCorporateId(0,$user_id);

                    if (!empty($userdata['departments'][0])) {
                        // Create the data array
                        $data_array = [
                            'defaultcompany' => "0",
                            'defaultdepartment' => $userdata['departments'][0]['id'],
                            'usertype' => $userdata['departments'][0]['usertype']
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
                    }
                }else{
                    redirect('home');
                    // $response = array("status"=>201,'message'=>"You have entered wrong password!");
                    // echo json_encode($response);
                }
            }   
            }else{
            $this->load->view('superadmin/index');
        }   
    }
}