<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Auth_testing extends REST_Controller{

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
      $this->load->model(array("api/authmodel"));
      $this->load->library(array("form_validation"));
      $this->load->helper("security");
      $this->load->helper('jwt_helper');
      $this->load->helper('custom_helper');
      $this->authorizationKey = "eyJhbGciOiJIUzI1NiJ9.eyJSb2xlIjoiQWRtaW4iLCJJc3N1ZXIiOiJJc3N1ZXIiLCJVc2VybmFtZSI6IkphdmFJblVzZSIsImV4cCI6MTcwNDY5MDE0OSwiaWF0IjoxNzA0NjkwMTQ5fQ.fmSHFg5JYAoTKbj94Mu9gLrkQpy898m8xtSV_VCzOwg";
    }

    // Function to calculate distance between two points using Haversine formula
    private function calculateDistance($lat1, $lon1, $inspectorid) {
        // Radius of the Earth (in kilometers)
        $R = 6371;

        $inspectorlocation = $this->authmodel->getinspectorlocation($inspectorid);
        // Convert latitude and longitude from degrees to radians
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($inspectorlocation->latitude);
        $lon2 = deg2rad($inspectorlocation->longitude);

        // Calculate differences
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;

        // Calculate distance using Haversine formula
        $a = sin($dlat/2) * sin($dlat/2) + cos($lat1) * cos($lat2) * sin($dlon/2) * sin($dlon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distance = $R * $c;

        return $distance; // Distance in kilometers
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
            $result = $this->authmodel->getUserverification($userId);
            
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
    $data = $this->authmodel->get_data($page, $limit, $search);
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
    $locationdata = get_object_vars(json_decode($this->input->raw_input_stream));

    $latitude = $locationdata['latitude'];
    $longitude = $locationdata['longitude'];
    $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));

    if($authentication['status'] == 200){
      if ($latitude && $longitude) {
        $data = array("latitude"=>$latitude,
                      "longitude"=>$longitude,
                      "inspectorId"=>$authentication['data']['id']);
        $result = $this->authmodel->updateLocationById($data);
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
    // Check for required parameters 
    $casedata = get_object_vars(json_decode($this->input->raw_input_stream));
    // $formData = $this->input->post('formData');
    $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
    if($authentication['status'] == 200){
      $aid = date("dmyhis").rand(10,100);
      $data = array("aid"=>$aid,
                    "jobdata"=>json_encode($casedata['formData']),
                    "natureofjob"=>$casedata['formname'],
                    "status"=>"Professional yet to be assigned",
                    "userId"=>$authentication['data']['id']);
        $result = $this->authmodel->createcase($data);
        if(!empty($result)){
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
      if($this->authmodel->is_mobile_exists($mobile)){
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
      if($user = $this->authmodel->validate_user($data)){
        $token_data = array(
          'user_id' => $user->id,
          'salutation' => $user->salutation,
          'firstname' => $user->firstname,
          'lastname' => $user->lastname,
          'state' => $user->state,
          'city' => $user->city,
          'mobile' => $user->mobile,
          'profilephoto' => "".base_url().'assets/profile/'.$user->profilephoto."",
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
        if($this->authmodel->is_mobile_exists($mobile)){
          $data = array("salutation"=>$salutation,
                  "firstname"=>$firstname,
                  "lastname"=>$lastname,
                  "mobile"=>$mobile,
                  "passcode"=>md5($passcode),
                  "termsandconditions"=>true,
                  "is_active"=>true);
          $result = $this->authmodel->updateUser($data);
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
    if($this->form_validation->run() === FALSE){
      $this->response(array(
        "status" => 400,
        "message" => "Mobile number required"
      ) , REST_Controller::HTTP_OK);
    }else{
      if($this->is_mobileexist($mobile)){
        if($this->is_mobileverified($mobile)){
          $sendotp = array('otp'=>$otprand,'mobile'=>$mobile['mobile']);
            if(sendotp($sendotp['otp'],$sendotp['mobile'])){
                if($this->authmodel->updateUser($sendotp)){
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

/**
 * @OTP verification
 * POST mobile number and otp 
 * */
function otpverification_post(){
    if($_POST){
        $otp = $this->input->post('otp');
        $mobile = $this->input->post('mobile');
        $data = array('otp'=>$otp,'mobile'=>$mobile);
        $is_verified = $this->authmodel->otpverify($data);
        if($is_verified){
            $data['mobile_verified'] = 1;
            $is_update = $this->authmodel->updateUser($data);
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


function is_mobileexist($data){
    if($this->authmodel->mobile_exist($data)){
        return true;
    }else{
        return false;
    }
}

function is_mobileverified($data){
    if($this->authmodel->mobile_verify($data)){
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
                if($this->authmodel->updateUser($sendotp)){
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
            if($this->authmodel->createuser($sendotp)){
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
  $users = $this->authmodel->getusers();
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
    $latest_items = $this->authmodel->get_upcoming_cases($authentication['data']['id']);
    foreach ($latest_items as $case) {
      $insured_data = $this->getJobdata(json_decode($case->jobdata));
      $casedata[] = array("id"=>$case->id,
                        "aid"=> $case->aid,
                        "contact_person_name"=>$insured_data['contact_person_name'],
                        "contact_person_mobile"=>$insured_data['contact_person_mobile'],
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
                        "distance"=>$this->calculateDistance($case->latitude, $case->longitude, $case->uid_to));
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
                     'contact_person_mobile'=>$data->contact_person_mobile);
  return $insureddata;
}

function acceptedcase_get(){
  $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
  if($authentication['status'] == 200){
    $latest_items = $this->authmodel->get_accepted_cases();
    if ($latest_items) {
        $this->response([
            'status' => 200,
            'message' => 'Accepted Cases',
            'data' => $latest_items
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

function acceptcase_post(){
    $authentication = $this->userAuthorization($this->input->get_request_header('Authorization'));
    if($authentication['status'] == 200){
        $userid = $authentication['data']['id'];
        $aid = $this->input->post('aid');
        if($aid != null){
            $updatecase = $this->authmodel->accept_case($userid,$aid);
            if($updatecase){
                $updatestatus = $this->authmodel->updateaccepted_case($aid);
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
}
?>
