<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Auth extends REST_Controller{

    private $authorizationKey ;
    public function __construct(){
      header('Access-Control-Allow-Origin: *');
      header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
      header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
      $method = $_SERVER['REQUEST_METHOD'];
      if($method == "OPTIONS") {
          die();
      }

      parent::__construct();
      $this->load->model(array("api/auth_model"));
      $this->load->library(array("form_validation"));
      $this->load->helper("security");
      $this->load->model('case_model');
      $this->load->model('home_model');
      $this->load->helper('jwt_helper');
      $this->load->helper('custom_helper');
      $this->authorizationKey = "eyJhbGciOiJIUzI1NiJ9.eyJSb2xlIjoiQWRtaW4iLCJJc3N1ZXIiOiJJc3N1ZXIiLCJVc2VybmFtZSI6IkphdmFJblVzZSIsImV4cCI6MTcwNDY5MDE0OSwiaWF0IjoxNzA0NjkwMTQ5fQ.fmSHFg5JYAoTKbj94Mu9gLrkQpy898m8xtSV_VCzOwg";
    }

    function calculateDistance($lat1, $lon1, $inspectorid, $unit = 'km') {
      $inspectorlocation = $this->auth_model->getinspectorlocation($inspectorid);
      if($lat1 != null && $lon1 =! null || $lat1 != "" && $lon1 != ""){
        $radlat1 = pi() * $lat1 / 180;
        $radlat2 = pi() * $inspectorlocation->latitude / 180;
        $theta = $lon1 - $inspectorlocation->longitude;
        $radtheta = pi() * $theta / 180;
        $distance = sin($radlat1) * sin($radlat2) + cos($radlat1) * cos($radlat2) * cos($radtheta);
        $distance = acos($distance);
        $distance = $distance * 180 / pi();
        $distance = $distance * 60 * 1.1515;

        if ($unit == 'km') {
            $distance = $distance * 1.609344; // Convert miles to kilometers
        }
        return (string)$distance;
      }else {
        return "Location no found!";
      }
    }

  public function updateFormData_post(){
    $casedata = get_object_vars(json_decode($this->input->raw_input_stream));
    $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
    if($authentication['status'] == 200){
      $aid = $casedata['aid'];
      $job_data = $this->auth_model->get_jobdata_case($aid);
      $data_array = json_decode($job_data, true);
      $data_array['surveyor_observation'] = $casedata['surveyor_observation'];

      $updated_json_data = json_encode($data_array);

      $is_update = $this->auth_model->update_job_data($aid, $updated_json_data);
      if($is_update){
          $this->response(array(
            "status" => 200,
            "message" => "Data Successfully Update"
          ), REST_Controller::HTTP_OK);
      }else{
          $this->response(array(
            "status" => 500,
            "message" => "Internal server error."
          ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }      
    }else{
      $this->response(array(
        "status" => $authentication['status'],
        "message" => $authentication['message']
      ), REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function userAuthorization($request){
    
    // Get the Authorization header
    $authorizationHeader = $request;

    // Check if the header is present
    if ($authorizationHeader) {
        // Extract the JWT token from the Authorization header
        $jwtToken = sscanf($authorizationHeader, 'Bearer %s')[0];
        try {
            // Decode and verify the JWT
            $decodedToken = JWT::decode($jwtToken, $this->authorizationKey);
            
            // Access the claims or user information from the decoded token
            $userId = $decodedToken->user_id;
            $result = $this->auth_model->getUserverification($userId);
            
            if(!empty($result)){
              $response = array("status"=>200,'message'=>"Authorized User",'data'=>$result);
              return $response;
            }
        } catch (Exception $e) {
          $response = array("status"=>401,'message'=>"Invalid token");
          return $response;
        }
    } else {
      $response = array("status"=>401,'message'=>"Authorization header missing");
      return $response;
    }
}

public function sharecase_post(){
    $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
    if($authentication['status'] == 200){
    $mobileno = $this->input->post('mobile_no');
    $aid = $this->input->post('aid');
    
    $id = $this->case_model->mobileExists($mobileno);
    
    if ($id !== false) {
        $affectedRows = $this->case_model->sharedById($aid,$id);
        if ($affectedRows > 0) {
            echo "Column  has been updated for AID ($aid).";
        } else {
            echo "Error updating column for AID ($aid).";
        }
    } else {
        $userdata = array('mobile'=>"+91".$mobileno,
                            'is_active'=>0);
        if($this->home_model->createuser($userdata)){
            $id = $this->case_model->mobileExists($mobileno);
            $affectedRows = $this->case_model->sharedById($aid,$id);
            if ($affectedRows > 0) {
                $this->response(array(
                    "status" => 200,
                    "message" => "Case shared successfully",
                    "data" => null
                ), REST_Controller::HTTP_OK); // Change HTTP_BAD_REQUEST to HTTP_OK
            } else {
                $this->response(array(
                    "status" => 500,
                    "message" => "Internal server error",
                    "data" => null
                ), REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->response(array(
                    "status" => 400,
                    "message" => "Page not found",
                    "data" => null
                ), REST_Controller::HTTP_BAD_REQUEST);
        }
    }
  }
}

public function uploadImage_post(){
    $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
    $filename = $_FILES['file']['name']; // Change 'file_name' to 'file'
    $filetype = $this->input->post('file_type');
    $aid = $this->input->post('aid');
    
    if($authentication['status'] == 200){
        if (!is_dir('uploads/'.$aid.'/'.$filetype)) {
            mkdir('./uploads/'.$aid.'/'.$filetype, 0777, TRUE);
        }

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $config['upload_path'] = './uploads/'.$aid.'/'.$filetype;
            $config['allowed_types'] = '*';
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            $upload = $this->upload->do_upload('file');
            
            if($upload === FALSE){
                $this->response(array(
                    "status" => 400,
                    "message" => $this->upload->display_errors(),
                    "data" => null
                ), REST_Controller::HTTP_BAD_REQUEST);
            } else {
                $this->response(array(
                    "status" => 200,
                    "message" => "File upload successfully",
                    "data" => null
                ), REST_Controller::HTTP_OK); // Change HTTP_BAD_REQUEST to HTTP_OK
            }
        }
    } else {
        $this->response(array(
            "status" => $authentication['status'],
            "message" => $authentication['message']
        ), REST_Controller::HTTP_BAD_REQUEST);
    }
}

public function caseData_get(){
  // Pagination parameters
  $page = $this->input->get('page') ? $this->input->get('page') : 1;
  $limit = $this->input->get('limit') ? $this->input->get('limit') : 10;

  // Search parameter
  $search = $this->input->get('search');

  $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
  if($authentication['status'] == 200){
    // Get data from the model with pagination and search
    $data = $this->auth_model->get_data($page, $limit, $search);
    if(!empty($data)){
      $this->response(array(
        "status" => 200,
        "message" => "Location update successfully.",
        "data" => $data
      ), REST_Controller::HTTP_OK);
    }else{
      $this->response(array(
        "status" => 200,
        "message" => "No Data Found.",
        "data" => $data
      ), REST_Controller::HTTP_OK);
    }
  }else{
    $this->response(array(
      "status" => $authentication['status'],
      "message" => $authentication['message']
    ), REST_Controller::HTTP_BAD_REQUEST);
  }
}

  /**
   * get inspector location
   */
  public function location_post(){

    // $latitude = $this->input->post('latitude');
    $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
    //$locationdata = get_object_vars(json_decode($this->input->raw_input_stream));
      $latitude = $this->input->post('latitude');
      $longitude = $this->input->post('longitude');
      if($authentication['status'] == 200){
      if ($latitude && $longitude) {
        $data = array("latitude"=>$latitude,
                      "longitude"=>$longitude,
                      "inspectorId"=>$authentication['data']['id']);
        $result = $this->auth_model->updateLocationById($data);
        if($result){
          $this->response(array(
            "status" => 200,
            "message" => "Location update successfully."
          ), REST_Controller::HTTP_OK);
        }
      }else {
        $this->response(['error' => 'Invalid location data'], REST_Controller::HTTP_BAD_REQUEST);
      }
    }else{
      $this->response(array(
        "status" => $authentication['status'],
        "message" => $authentication['message']
      ), REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function createCase_post(){
    $casedata = get_object_vars(json_decode($this->input->raw_input_stream));
    $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
    if($authentication['status'] == 200){
      $aid = date("dmyhis").rand(10,100);
      $data = array("aid"=>$aid,
                    "jobdata"=>json_encode($casedata['formData']),
                    "natureofjob"=>$casedata['formname'],
                    "latitude"=>$casedata['latitude'],
                    "longitude"=>$casedata['longitude'],
                    "status"=>"1",
                    "userId"=>$authentication['data']['id']);
        $result = $this->auth_model->createcase($data);
        $jobassigned = array("aid"=>$aid,
                              "uid_from"=>$authentication['data']['id'],
                              "uid_to"=>$authentication['data']['id']);
        $location = "location";
        $jobassign  = $this->auth_model->jobassignTo($jobassigned, $location);
        if(!empty($result)){
          if (!is_dir('./uploads/'.$aid.'/images')) {
              mkdir('./uploads/'.$aid.'/images', 0777, TRUE);
          }
          if(!is_dir('./uploads/'.$aid.'/videos')){
              mkdir('./uploads/'.$aid.'/videos', 0777, TRUE);
          }
          if(!is_dir('./uploads/'.$aid.'/documents')){
              mkdir('./uploads/'.$aid.'/documents', 0777, TRUE);
          }
          $this->response(array(
            "status" => 200,
            "message" => "You have successfully created case.",
            "data" => $result
          ), REST_Controller::HTTP_OK);
        }else{
          $this->response(array(
            "status" => 500,
            "message" => "Internal Server Error."
          ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }else{
      $this->response(array(
        "status" => $authentication['status'],
        "message" => $authentication['message']
      ), REST_Controller::HTTP_BAD_REQUEST);
    }
  }
  /**
   * @Mobile verification
   * if mobile number exist then redirect to otp screen.  
   * */
  public function mobile_verify_post(){
    $mobile = $this->security->xss_clean($this->input->post("mobile"));
    $this->form_validation->set_rules("mobile", "Mobile", "required");
    if($this->form_validation->run() === FALSE){
      $this->response(array(
        "status" => 400,
        "message" => "Mobile number required"
      ) , REST_Controller::HTTP_BAD_REQUEST);
    }else{
      if($this->auth_model->is_mobile_exists($mobile)){
        $this->response(array(
          "status" => 200,
          "message" => "Mobile number exist."
        ), REST_Controller::HTTP_OK);
      }else{
        $this->response(array(
          "status" => 404,
          "message" => "Mobile number does not exist."
        ), REST_Controller::HTTP_NOT_FOUND);
      }
    }
  }
  /**
   * @Login 
   * Enter mobile number and passcode (4 Digit passcode)
   * */
  public function login_post(){
    $profilephoto = null;
    $mobile = $this->security->xss_clean($this->input->post("mobile"));
    $passcode = $this->security->xss_clean($this->input->post("passcode"));
    $this->form_validation->set_rules("mobile", "Mobile", "required");
    $this->form_validation->set_rules("passcode", "Passcode", "required");
    if($this->form_validation->run() === FALSE){
    $this->response(array(
      "status" => 400,
      "message" => "All fields are required"
    ) , REST_Controller::HTTP_BAD_REQUEST);
    }else{
      $data = array("passcode"=>$passcode,
                    "mobile"=>$mobile);
      if($user = $this->auth_model->validate_user($data)){
        if($user->profilephoto){
          $profilephoto = "".base_url().'assets/profile/'.$user->profilephoto."";
        }
        $token_data = array(
          'user_id' => $user->id,
          'salutation' => $user->salutation,
          'firstname' => $user->firstname,
          'lastname' => $user->lastname,
          'state' => $user->state,
          'city' => $user->city,
          'mobile' => $user->mobile,
          'profilephoto' => $profilephoto,
          'timestamp' => date("Y-m-d H:i:s", time()),
        );
        $token = JWT::encode($token_data, $this->authorizationKey);
        $token_data['token'] = $token;
        $this->response(array(
          "status" => 200,
          "message" => "Successfully login.",
          'data' => $token_data
        ), REST_Controller::HTTP_OK);
      }else{
        $this->response(array(
          "status" => 401,
          "message" => "Invalid credentials."
        ), REST_Controller::HTTP_UNAUTHORIZED);
      }
    }
  }
  /**
   * @Register
   * Enter mobile number, passcode, salutation, firstname, lastname
   * */
  public function register_post(){
    $mobile = $this->input->post('mobile');
    $passcode = $this->input->post('passcode');
    $salutation = $this->input->post('salutation');
    $firstname = $this->input->post('firstname');
    $lastname = $this->input->post('lastname');
    if(!empty($mobile)){
        if($this->auth_model->is_mobile_exists($mobile)){
          $data = array("salutation"=>$salutation,
                  "firstname"=>$firstname,
                  "lastname"=>$lastname,
                  "mobile"=>$mobile,
                  "passcode"=>md5($passcode),
                  "termsandconditions"=>true,
                  "is_active"=>true);
          $result = $this->auth_model->updateUser($data);
          if($result){
              $this->response(array(
                "status" => 200,
                "message" => "You have successfully registered."
              ), REST_Controller::HTTP_OK);
          }else{
              $this->response(array(
                "status" => 500,
                "message" => "Internal server error."
              ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          }

        }else{
          $this->response(array(
            "status" => 404,
            "message" => "Mobile number does not exist."
          ), REST_Controller::HTTP_NOT_FOUND);
        }
      }else{
        $this->response(array(
          "status" => 400,
          "message" => "Mobile number required."
        ), REST_Controller::HTTP_BAD_REQUEST);
      }
  }

  /**
   * @forgot password 
   * Enter mobile number
   * */
  public function forgotpassword_post(){
    $mobile = $this->security->xss_clean($this->input->post("mobile"));
    $this->form_validation->set_rules("mobile", "Mobile", "required");
    $otprand=rand(1000,9999);
    if($this->form_validation->run() === FALSE){
      $this->response(array(
        "status" => 400,
        "message" => "Mobile number required"
      ) , REST_Controller::HTTP_OK);
    }else{
      if($this->is_mobileexist($mobile)){
        if($this->is_mobileverified($mobile)){
          $sendotp = array('otp'=>$otprand,'mobile'=>$mobile);
            if($this->sendwhatsapp($sendotp['otp'],$sendotp['mobile'])){
                if($this->auth_model->updateUser($sendotp)){
                  $this->response(array(
                    "status" => 200,
                    "message" => "OTP sent on your mobile number."
                  ), REST_Controller::HTTP_OK);
                }
            }
        }else{
          $this->response(array(
          "status" => 400,
          "message" => "Mobile number not verified."
          ), REST_Controller::HTTP_BAD_REQUEST);
        }
      }else{
        $this->response(array(
          "status" => 404,
          "message" => "Mobile number does not exist."
        ), REST_Controller::HTTP_NOT_FOUND);
      }
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
 * @OTP verification
 * POST mobile number and otp 
 * */
function otpverification_post(){
    if($_POST){
        $otp = $this->input->post('otp');
        $mobile = $this->input->post('mobile');
        $data = array('otp'=>$otp,'mobile'=>$mobile);
        $is_verified = $this->auth_model->otpverify($data);
        if($is_verified){
            $data['mobile_verified'] = 1;
            $is_update = $this->auth_model->updateUser($data);
            if($is_update){
                $this->response(array(
                  "status" => 200,
                  "message" => "Mobile number successfully verified."
                ), REST_Controller::HTTP_OK);
            }else{
                $this->response(array(
                  "status" => 500,
                  "message" => "Internal server error."
                ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }else{

            $this->response(array(
                  "status" => 400,
                  "message" => "You have enter wrong OTP."
            ), REST_Controller::HTTP_BAD_REQUEST);
        }
    }else{
        $this->response(array(
                  "status" => 404,
                  "message" => "Page not found."
        ), REST_Controller::HTTP_NOT_FOUND);
    }
}


function updateNewPasscode_post(){
    if($_POST){
        $passcode = $this->input->post('passcode');
        $mobile = $this->input->post('mobile');
        $data = array('passcode'=>$passcode,'mobile'=>$mobile);
        $result = $this->auth_model->updatePasscode($data);
        if($result){
          $this->response(array(
            "status" => 200,
            "message" => "Password update successfully."
          ), REST_Controller::HTTP_OK);
        }else{
            $this->response(array(
                  "status" => 400,
                  "message" => "You have enter wrong OTP."
            ), REST_Controller::HTTP_BAD_REQUEST);
        }
    }else{
        $this->response(array(
                  "status" => 404,
                  "message" => "Page not found."
        ), REST_Controller::HTTP_NOT_FOUND);
    }
}


function is_mobileexist($data){
    if($this->auth_model->mobile_exist($data)){
        return true;
    }else{
        return false;
    }
}

function is_mobileverified($data){
    if($this->auth_model->mobile_verify($data)){
        return true;
    }else{
        return false;
    }
}
  /**
 * @Mobile Varification
 */
function mobileverification_post(){
  if($_POST){
    $mobile = $this->input->post("mobile");
    $otprand=rand(1000,9999);
    $mobile = $this->input->post();
    if($this->is_mobileexist($mobile['mobile'])){
        if($this->is_mobileverified($mobile['mobile'])){
          $this->response(array(
            "status" => 200,
            "message" => "Mobile number already exist."
          ), REST_Controller::HTTP_OK);
        }else{
            $sendotp = array('otp'=>$otprand,'mobile'=>$mobile['mobile']);
            if(sendotp($sendotp['otp'],$sendotp['mobile'])){
                if($this->auth_model->updateUser($sendotp)){
                  $this->response(array(
                    "status" => 200,
                    "message" => "OTP sent on your mobile number."
                  ), REST_Controller::HTTP_OK);
                }
            }
        }    
    }else{
        $sendotp = array('otp'=>$otprand,'mobile'=>$mobile['mobile']);
        if(sendotp($sendotp['otp'],$sendotp['mobile'])){
            if($this->auth_model->createuser($sendotp)){
                $this->response(array(
                  "status" => 200,
                  "message" => "OTP sent on your mobile number."
                ), REST_Controller::HTTP_OK);
            }else{
                $this->response(array(
                  "status" => 500,
                  "message" => "Internal server error."
                ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }else{
            $this->response(array(
                  "status" => 404,
                  "message" => "We are unable to send otp on your mobile number. Please enter the correct mobile number or you can change your mobile number"
            ), REST_Controller::HTTP_NOT_FOUND);
        }
    }
    }else{
        $this->response(array(
              "status" => 404,
              "message" => "Page not found"
        ), REST_Controller::HTTP_NOT_FOUND);
    }
}


/**
 * User list
 * */
function users_get(){
  $users = $this->auth_model->getusers();
  $this->response(array(
                  "status" => 200,
                  "message" => "Users list",
                  "data"=>$users
  ), REST_Controller::HTTP_OK);
}

/**
 * Latest case
 * */

function upcomingcase_get(){
  $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
  if($authentication['status'] == 200){
    $latest_items = $this->auth_model->get_upcoming_cases($authentication['data']['id']);
    if($latest_items != false){
      foreach ($latest_items as $case) {
        $insured_data = $this->getJobdata(json_decode($case->jobdata));
        $inspector_location = $this->auth_model->getinspectorlocation($case->uid_to);
        $casedata[] = array("id"=>$case->id,
                          "aid"=> $case->aid,
                          "contact_person_name"=>$insured_data['contact_person_name'],
                          "contact_person_mobile"=>$insured_data['contact_person_mobile'],
                          "insured_name"=>$insured_data['insured_name'],
                          "tag_vehicle"=>$insured_data['tag_vehicle'],
                          "policy_number"=>$insured_data['policy_number'],
                          "location_survey"=>$insured_data['location_survey'],
                          "cause_loss"=>$insured_data['cause_loss'],
                          "workshop_name"=>$insured_data['workshop_name'],
                          "workshop_advisor_name"=>$insured_data['workshop_advisor_name'],
                          "instruction"=>$insured_data['instruction'],
                          "surveyor_observation"=>$insured_data['surveyor_observation'],
                          "latitude"=> $case->latitude,
                          "longitude"=> $case->longitude,
                          "userId"=> $case->userId,
                          "investigator_type"=> $case->investigator_type,
                          "status"=> $case->status,
                          "createdAt"=> $case->createdAt,
                          "salutation"=> $case->salutation,
                          "firstname"=> $case->firstname,
                          "lastname"=> $case->lastname,
                          "uid_to"=> $case->uid_to,
                          "inspector_latitude"=> $inspector_location->latitude,
                          "inspector_longitude"=>$inspector_location->longitude);
      }
    }
    if ($latest_items) {
        $this->response([
            'status' => 200,
            'message' => 'Upcoming Cases',
            'data' => $casedata
        ], REST_Controller::HTTP_OK);
    } else {
        $this->response([
            'status' => 404,
            'message' => 'No items found',
            'data'=>null
        ], REST_Controller::HTTP_NOT_FOUND);
    }
  }else{
    $this->response(array(
      "status" => $authentication['status'],
      "message" => $authentication['message'],
      "data"=>null
    ), REST_Controller::HTTP_BAD_REQUEST);
  }
}

function getJobdata($data){
  $insureddata = array('contact_person_name'=>$data->contact_person_name,
                      'contact_person_mobile'=>$data->contact_person_mobile,
                      'insured_name'=>$data->insured_name,
                      'tag_vehicle'=>$data->tag_vehicle,
                      'policy_number'=>$data->policy_number,
                      'location_survey'=>$data->location_survey,
                      'cause_loss'=>$data->cause_loss,
                      'workshop_name'=>$data->workshop_name,
                      'workshop_advisor_name'=>$data->workshop_advisor_name,
                      'instruction'=>$data->instruction,
                      'surveyor_observation'=>$data->surveyor_observation);
  return $insureddata;
}


function acceptedcase_get(){
  $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
  if($authentication['status'] == 200){
    $latest_items = $this->auth_model->get_accepted_cases($authentication['data']['id']);
    if($latest_items != false){
      foreach ($latest_items as $case) {
        $insured_data = $this->getJobdata(json_decode($case->jobdata));
        $inspector_location = $this->auth_model->getinspectorlocation($case->uid_to);
        $casedata[] = array("id"=>$case->id,
                          "aid"=> $case->aid,
                          "contact_person_name"=>$insured_data['contact_person_name'],
                          "contact_person_mobile"=>$insured_data['contact_person_mobile'],
                          "insured_name"=>$insured_data['insured_name'],
                          "tag_vehicle"=>$insured_data['tag_vehicle'],
                          "policy_number"=>$insured_data['policy_number'],
                          "location_survey"=>$insured_data['location_survey'],
                          "cause_loss"=>$insured_data['cause_loss'],
                          "workshop_name"=>$insured_data['workshop_name'],
                          "workshop_advisor_name"=>$insured_data['workshop_advisor_name'],
                          "instruction"=>$insured_data['instruction'],
                          "surveyor_observation"=>$insured_data['surveyor_observation'],
                          "latitude"=> $case->latitude,
                          "longitude"=> $case->longitude,
                          "userId"=> $case->userId,
                          "investigator_type"=> $case->investigator_type,
                          "status"=> $case->status,
                          "createdAt"=> $case->createdAt,
                          "salutation"=> $case->salutation,
                          "firstname"=> $case->firstname,
                          "lastname"=> $case->lastname,
                          "uid_to"=> $case->uid_to,
                          "inspector_latitude"=> $inspector_location->latitude,
                          "inspector_longitude"=>$inspector_location->longitude);
      }
    }
    if ($latest_items) {
        $this->response([
            'status' => 200,
            'message' => 'Accepted Cases',
            'data' => $casedata
        ], REST_Controller::HTTP_OK);
    } else {
        $this->response([
            'status' => 404,
            'message' => 'No items found',
            'data'=>null
        ], REST_Controller::HTTP_NOT_FOUND);
    }
  }else{
    $this->response(array(
      "status" => $authentication['status'],
      "message" => $authentication['message'],
      "data"=>null
    ), REST_Controller::HTTP_BAD_REQUEST);
  }
}


function runningcase_get(){
  $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
  if($authentication['status'] == 200){
    $latest_items = $this->auth_model->get_running_case($authentication['data']['id']);
    if($latest_items != false){
      foreach ($latest_items as $case) {
        $insured_data = $this->getJobdata(json_decode($case->jobdata));
        $inspector_location = $this->auth_model->getinspectorlocation($case->uid_to);
        $casedata[] = array("id"=>$case->id,
                          "aid"=> $case->aid,
                          "contact_person_name"=>$insured_data['contact_person_name'],
                          "contact_person_mobile"=>$insured_data['contact_person_mobile'],
                          "insured_name"=>$insured_data['insured_name'],
                          "tag_vehicle"=>$insured_data['tag_vehicle'],
                          "policy_number"=>$insured_data['policy_number'],
                          "location_survey"=>$insured_data['location_survey'],
                          "cause_loss"=>$insured_data['cause_loss'],
                          "workshop_name"=>$insured_data['workshop_name'],
                          "workshop_advisor_name"=>$insured_data['workshop_advisor_name'],
                          "instruction"=>$insured_data['instruction'],
                          "surveyor_observation"=>$insured_data['surveyor_observation'],
                          "latitude"=> $case->latitude,
                          "longitude"=> $case->longitude,
                          "userId"=> $case->userId,
                          "investigator_type"=> $case->investigator_type,
                          "status"=> $case->status,
                          "createdAt"=> $case->createdAt,
                          "salutation"=> $case->salutation,
                          "firstname"=> $case->firstname,
                          "lastname"=> $case->lastname,
                          "uid_to"=> $case->uid_to,
                          "inspector_latitude"=> $inspector_location->latitude,
                          "inspector_longitude"=>$inspector_location->longitude);
      }
    }
    if ($latest_items) {
        $this->response([
            'status' => 200,
            'message' => 'Running Cases',
            'data' => $casedata
        ], REST_Controller::HTTP_OK);
    } else {
        $this->response([
            'status' => 404,
            'message' => 'No items found',
            'data'=>null
        ], REST_Controller::HTTP_NOT_FOUND);
    }
  }else{
    $this->response(array(
      "status" => $authentication['status'],
      "message" => $authentication['message'],
      "data"=>null
    ), REST_Controller::HTTP_BAD_REQUEST);
  }
}

function completecase_get(){
  $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
  if($authentication['status'] == 200){
    $latest_items = $this->auth_model->get_complete_case($authentication['data']['id']);
    if($latest_items != false){
      foreach ($latest_items as $case) {
        $insured_data = $this->getJobdata(json_decode($case->jobdata));
        $inspector_location = $this->auth_model->getinspectorlocation($case->uid_to);
        $casedata[] = array("id"=>$case->id,
                          "aid"=> $case->aid,
                          "contact_person_name"=>$insured_data['contact_person_name'],
                          "contact_person_mobile"=>$insured_data['contact_person_mobile'],
                          "insured_name"=>$insured_data['insured_name'],
                          "tag_vehicle"=>$insured_data['tag_vehicle'],
                          "policy_number"=>$insured_data['policy_number'],
                          "location_survey"=>$insured_data['location_survey'],
                          "cause_loss"=>$insured_data['cause_loss'],
                          "workshop_name"=>$insured_data['workshop_name'],
                          "workshop_advisor_name"=>$insured_data['workshop_advisor_name'],
                          "instruction"=>$insured_data['instruction'],
                          "surveyor_observation"=>$insured_data['surveyor_observation'],
                          "latitude"=> $case->latitude,
                          "longitude"=> $case->longitude,
                          "userId"=> $case->userId,
                          "investigator_type"=> $case->investigator_type,
                          "status"=> $case->status,
                          "createdAt"=> $case->createdAt,
                          "salutation"=> $case->salutation,
                          "firstname"=> $case->firstname,
                          "lastname"=> $case->lastname,
                          "uid_to"=> $case->uid_to,
                          "inspector_latitude"=> $inspector_location->latitude,
                          "inspector_longitude"=>$inspector_location->longitude);
      }
    }
    if ($latest_items) {
        $this->response([
            'status' => 200,
            'message' => 'Completed Cases',
            'data' => $casedata
        ], REST_Controller::HTTP_OK);
    } else {
        $this->response([
            'status' => 404,
            'message' => 'No items found',
            'data'=>null
        ], REST_Controller::HTTP_NOT_FOUND);
    }
  }else{
    $this->response(array(
      "status" => $authentication['status'],
      "message" => $authentication['message'],
      "data"=>null
    ), REST_Controller::HTTP_BAD_REQUEST);
  }
}

function jobdata_post(){
  $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
  if($authentication['status'] == 200){
    $aid = $this->input->post('aid');
    $latest_items = $this->auth_model->get_jobdata_case($aid);
    if($latest_items != false){
        $insured_data = $this->getJobdata(json_decode($latest_items));
        $casedata[] = array(
                          "contact_person_name"=>$insured_data['contact_person_name'],
                          "contact_person_mobile"=>$insured_data['contact_person_mobile'],
                          "insured_name"=>$insured_data['insured_name'],
                          "tag_vehicle"=>$insured_data['tag_vehicle'],
                          "policy_number"=>$insured_data['policy_number'],
                          "location_survey"=>$insured_data['location_survey'],
                          "cause_loss"=>$insured_data['cause_loss'],
                          "workshop_name"=>$insured_data['workshop_name'],
                          "workshop_advisor_name"=>$insured_data['workshop_advisor_name'],
                          "instruction"=>$insured_data['instruction'],
                          "surveyor_observation"=>$insured_data['surveyor_observation']);
    }
    if ($latest_items) {
        $this->response([
            'status' => 200,
            'message' => 'Completed Cases',
            'data' => $casedata
        ], REST_Controller::HTTP_OK);
    } else {
        $this->response([
            'status' => 404,
            'message' => 'No items found',
            'data'=>null
        ], REST_Controller::HTTP_NOT_FOUND);
    }
  }else{
    $this->response(array(
      "status" => $authentication['status'],
      "message" => $authentication['message'],
      "data"=>null
    ), REST_Controller::HTTP_BAD_REQUEST);
  }
}

function running_case_post(){
    $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
    if($authentication['status'] == 200){
        $userid = $authentication['data']['id'];
        $aid = $this->input->post('aid');
        if($aid != null){
          $updatestatus = $this->auth_model->updaterunning_case($aid);
          if($updatestatus){
            $this->response([
              'status' => 200,
              'message' => 'Case is running',
              'data' => null
            ], REST_Controller::HTTP_OK);
          }else{
            $this->response(array(
            "status" => 500,
            "message" => "500 Internal server error!",
            "data"=>null
          ), REST_Controller::HTTP_BAD_REQUEST);
          }
        }else{
            $this->response([
                'status' => 400,
                'message' => 'aid cannot be null',
                'data' => null
            ], REST_Controller::HTTP_NOT_FOUND);
        }
        
        }else{
            $this->response(array(
              "status" => $authentication['status'],
              "message" => $authentication['message'],
              "data"=>null
            ), REST_Controller::HTTP_BAD_REQUEST);
        }
}

function complete_case_post(){
    $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
    if($authentication['status'] == 200){
        $userid = $authentication['data']['id'];
        $aid = $this->input->post('aid');
        if($aid != null){
          $updatestatus = $this->auth_model->updatecomplete_case($aid);
          if($updatestatus){
            $this->response([
              'status' => 200,
              'message' => 'Case successfully completed',
              'data' => null
            ], REST_Controller::HTTP_OK);
          }else{
            $this->response(array(
            "status" => 500,
            "message" => "500 Internal server error!",
            "data"=>null
          ), REST_Controller::HTTP_BAD_REQUEST);
          }
        }else{
            $this->response([
                'status' => 400,
                'message' => 'aid cannot be null',
                'data' => null
            ], REST_Controller::HTTP_NOT_FOUND);
        }
        
        }else{
            $this->response(array(
              "status" => $authentication['status'],
              "message" => $authentication['message'],
              "data"=>null
            ), REST_Controller::HTTP_BAD_REQUEST);
        }
}

function acceptcase_post(){
    $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
    if($authentication['status'] == 200){
        $userid = $authentication['data']['id'];
        $aid = $this->input->post('aid');
        if($aid != null){
            $updatecase = $this->auth_model->accept_case($userid,$aid);
            if($updatecase){
                $updatestatus = $this->auth_model->updateaccepted_case($aid);
                if($updatestatus){
                  $this->response([
                    'status' => 200,
                    'message' => 'Case successfully accepted',
                    'data' => null
                  ], REST_Controller::HTTP_OK);
                }else{
                  $this->response(array(
                  "status" => 500,
                  "message" => "500 Internal server error!",
                  "data"=>null
                ), REST_Controller::HTTP_BAD_REQUEST);
                }
                
            }else {
                $this->response(array(
                  "status" => 500,
                  "message" => "500 Internal server error!",
                  "data"=>null
                ), REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->response([
                'status' => 400,
                'message' => 'aid cannot be null',
                'data' => null
            ], REST_Controller::HTTP_NOT_FOUND);
        }
        
        }else{
            $this->response(array(
              "status" => $authentication['status'],
              "message" => $authentication['message'],
              "data"=>null
            ), REST_Controller::HTTP_BAD_REQUEST);
        }
  }

  function profileUpdate_post(){
    $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
    if($authentication['status'] == 200){
      $userid = $authentication['data']['id'];
      $filename = $_FILES['file']['name']; // Change 'file_name' to 'file'
      $salutation = $this->input->post('salutation');
      $firstname = $this->input->post('firstname');
      $lastname = $this->input->post('lastname');
      $userdata = array('salutation'=>$salutation,
                        'firstname'=>$firstname,
                        'lastname'=>$lastname,
                        'profilephoto'=>$filename);
      if (!is_dir('assets/profile/')) {
            mkdir('assets/profile/', 0777, TRUE);
        }

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $config['upload_path'] = './assets/profile/';
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);
            $upload = $this->upload->do_upload('file');
            
            if($upload === FALSE){
                $this->response(array(
                    "status" => 400,
                    "message" => $this->upload->display_errors(),
                    "data" => null
                ), REST_Controller::HTTP_BAD_REQUEST);
            } else {
                if($this->auth_model->updateProfile($userid,$userdata)){
                  $this->response(array(
                    "status" => 200,
                    "message" => "Profile update successfully",
                    "data" => $userdata
                  ), REST_Controller::HTTP_OK); // Change HTTP_BAD_REQUEST to HTTP_OK
                }
            }
        }

    }else{
      $this->response(array(
        "status" => $authentication['status'],
        "message" => $authentication['message'],
        "data"=>null
      ), REST_Controller::HTTP_BAD_REQUEST);
    }
  }
  public function uploadmedia_post(){
    $filename = $_FILES['file']['name']; // Change 'file_name' to 'file'
    $filetype = $this->input->post('file_type');
    $caseid = $this->input->post('caseid');
    $casereference = $this->input->post('casereference');
    $data = array('directory_name' => $caseid,
                'casereference' => $casereference);
    $exists = $this->auth_model->checkExists($data);
    if (!$exists) {
      $result = $this->auth_model->saveData($data); 
      if($result){
        $this->savemedia($data,$filetype);
        if($_SERVER['REQUEST_METHOD']=='POST'){
          $config['upload_path'] = './uploads/'.$data['directory_name'].'/'.$filetype;
          $config['allowed_types'] = '*';
          $config['overwrite'] = TRUE;
          $this->load->library('upload', $config);
          $upload = $this->upload->do_upload('file');
          if($upload === FALSE){
            $this->response(array(
                "status" => 400,
                "message" => $this->upload->display_errors(),
                "data" => null
            ), REST_Controller::HTTP_BAD_REQUEST);
          } else {
              $this->response(array(
                  "status" => 200,
                  "message" => "File upload successfully",
                  "data" => null
              ), REST_Controller::HTTP_OK); // Change HTTP_BAD_REQUEST to HTTP_OK
          }
        }
      }
    }else{
        $this->savemedia($data,$filetype);
        if($_SERVER['REQUEST_METHOD']=='POST'){
          $config['upload_path'] = './uploads/'.$data['directory_name'].'/'.$filetype;
          $config['allowed_types'] = '*';
          $config['overwrite'] = TRUE;
          $this->load->library('upload', $config);
          $upload = $this->upload->do_upload('file');
          
          if($upload === FALSE){
            $this->response(array(
                "status" => 400,
                "message" => $this->upload->display_errors(),
                "data" => null
            ), REST_Controller::HTTP_BAD_REQUEST);
          } else {
              $this->response(array(
                  "status" => 200,
                  "message" => "File upload successfully",
                  "data" => null
              ), REST_Controller::HTTP_OK); // Change HTTP_BAD_REQUEST to HTTP_OK
          }
        }
    }
  }

  public function savemedia($data,$filetype){
    if (!is_dir('uploads/'.$data['directory_name'].'/'.$filetype)) {
        mkdir('./uploads/'.$data['directory_name'].'/'.$filetype, 0777, TRUE);
    }
    if (!is_dir('./uploads/'.$data['directory_name'].'/images')) {
      mkdir('./uploads/'.$data['directory_name'].'/images', 0777, TRUE);
    }
    if(!is_dir('./uploads/'.$data['directory_name'].'/videos')){
        mkdir('./uploads/'.$data['directory_name'].'/videos', 0777, TRUE);
    }
    if(!is_dir('./uploads/'.$data['directory_name'].'/documents')){
        mkdir('./uploads/'.$data['directory_name'].'/documents', 0777, TRUE);
    }
  }
}
?>
