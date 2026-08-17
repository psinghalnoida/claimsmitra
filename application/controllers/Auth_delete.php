<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

    public function __construct()
    { 
        parent::__construct();
        $this->data = array();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        $this->load->helper('custom_helper');

    }

    public function decode_token($data){
        $token = $data;
        $jwt = new JWT();
        $jwtSecretKey = "NewClaimsmitrapolicywallet";
        $decode_token = $jwt->decode($token,$jwtSecretKey,'HS256');
        return $decode_token;
    }


    public function verifyphone(){
        if($_POST){
            $otprand=rand(1000,9999);
            $phone = $this->input->post('mobile');
            if($phone!=null){
                $result = $this->Auth_model->getUserbyphone($phone);
                if($result){
                    $response = array("status"=>true,"message"=>"Phone number already exist!");
                    echo json_encode($response);
                }else{
                    $data = array('otp'=>$otprand,'mobile'=>$phone,);
                    if(sendotp($data['otp'],$data['mobile'])){
                        $this->Auth_model->createuser($data);
                        $response = array("status"=>false,"message"=>"New Registration");
                        echo json_encode($response);
                    }else{
                        $response = array("status"=>false,"message"=>"Enter correct number!");
                        echo json_encode($response);
                    }
                }
            }else{
                $response = array("status"=>false,"message"=>"Enter phone number!");
                echo json_encode($response);
            }
        }
    }

    public function otpverify(){
        if($_POST){
            $mobile = $this->input->post('mobile');
            $otp = $this->input->post('otp');
            $data = array('mobile'=>$mobile,'otp'=>$otp);
            $verified = $this->Auth_model->verifyotp($data);
            if($verified){
                $response = array("status"=>true,"message"=>"Phone verified!");
                echo json_encode($response);
            }else{
                $response = array("status"=>false,"message"=>"Phone not verified!");
                echo json_encode($response);
            }
        }
    }

    public function login(){
        $data = array();
        if($_POST){
            $mobile = $this->input->post('mobile');
            $passcode = $this->input->post('passcode');
            $con = array('mobile'=> $mobile,'passcode' => md5($passcode),'is_active' => 1 ); 
            $result = $this->Auth_model->userlogin($con);

            if($result!=null){
                foreach ($result as $userdata) {
                $data = array("id"=>$userdata['id'],
                                "salutation"=>$userdata['salutation'],
                                "firstname"=>$userdata['firstname'],
                                "lastname"=>$userdata['lastname'],
                                "dob"=>$userdata['dob'],
                                "mobile"=>$userdata['mobile'],
                                "otp"=>$userdata['otp'],
                                "alt_mobile"=>$userdata['alt_mobile'],
                                "landline"=>$userdata['landline'],
                                "email"=>$userdata['email'],
                                "professionid"=>$this->Auth_model->getprofession($userdata['professionid']),
                                "termsandconditions"=>$userdata['termsandconditions'],
                                "state"=>$userdata['state'],
                                "city"=>$userdata['city'],
                                "address"=>$userdata['address'],
                                "pincode"=>$userdata['pincode'],
                                "profilephoto"=> $userdata['profilephoto'] != null ? $this->getimageurl($userdata['profilephoto']) : null,
                                "email_verified"=>$userdata['email_verified'],
                                "mobile_verified"=>$userdata['mobile_verified'],
                                "usertype"=>$userdata['usertype'],
                                "visitor"=>$userdata['visitor'],
                                "is_active"=>$userdata['is_active'],
                                "createdat"=>$userdata['createdat']);
            }   
                $jwt = new JWT();
                $jwtSecretKey = "NewClaimsmitrapolicywallet";
                $token = $jwt->encode($data,$jwtSecretKey,'HS256');
                $data['token'] = $token;
                $response = array("status"=>true,"message"=>"Authentication Successful!","data"=>$data);
                echo json_encode($response);
            }else{
                $response = array("status"=>false,"message"=>"Authentication Failed!","data" => null);
                echo json_encode($response);
            }
        }
    }

    public function getimageurl($data){
        return base_url('/assets/profile/'.$data);
    }

    public function getclaimbymobile(){
        $data = array();
        $headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[1];
        $decode_data = $this->decode_token($token);
        $inspector = array("inspector"=>$decode_data->mobile);
        $result['claimlist'] = $this->Auth_model->getclaimlistbymobile($inspector);
        
        if($result['claimlist'] != false){
            foreach ($result['claimlist'] as $value) {
            $data[] = array("id"=>$value['id'],
                            "salutation"=>$value['salutation'],
                            "fullname"=>$value['fullname'],
                            "mobile"=>$value['mobile'],
                            "email"=>$value['email'],
                            "typeofpolicy"=>$value['typeofpolicy'],
                            "subjectmatter"=>$value['subjectmatter'],
                            "nameofinsured"=>$value['nameofinsured'],
                            "dateofloss"=>$value['dateofloss'],
                            "placeofsurvey"=>$value['placeofsurvey'],
                            "nameofcontactperson"=>$value['nameofcontactperson'],
                            "mobileofcontactperson"=>$value['mobileofcontactperson'],
                            "locationlink"=>$value['locationlink'],
                            "images"=>$value['images'] != null ? $this->extractimage(unserialize($value['images'])) : null,
                            "status" =>$value['status'],
                            "createdat"=>$value['createdat'],
                            "updatedat"=>$value['updatedat']);
            }
            $response = array("status"=>200,
                              "message"=>"data fetched!",
                             "data"=>$data);
            echo json_encode($response);
        }else{  
            $response = array("status"=>400,
                              "message"=>"data not found!",
                             "data"=>null);
            echo json_encode($response);
        }
    }

    /*public function getimageurl($data){
        return base_url('/assets/profile/'.$data);
    }*/

    public function extractimage($data){
        
        foreach ($data as $key => $value) {
            $images = array(base_url('assets/claimimages/'.$value));        
        }
        return $images;
    }

    public function getupcommingcase(){
        $data = array();
        $headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[1];
        $decode_data = $this->decode_token($token);
        $inspector = array("inspector"=>$decode_data->mobile);
        $result['claimlist'] = $this->Auth_model->getclaimlistbymobile($inspector);
        
        if($result['claimlist'] != false){
            foreach ($result['claimlist'] as $value) {
            $data[] = array("id"=>$value['id'],
                            "salutation"=>$value['salutation'],
                            "fullname"=>$value['fullname'],
                            "mobile"=>$value['mobile'],
                            "email"=>$value['email'],
                            "typeofpolicy"=>$value['typeofpolicy'],
                            "subjectmatter"=>$value['subjectmatter'],
                            "nameofinsured"=>$value['nameofinsured'],
                            "dateofloss"=>$value['dateofloss'],
                            "placeofsurvey"=>$value['placeofsurvey'],
                            "nameofcontactperson"=>$value['nameofcontactperson'],
                            "mobileofcontactperson"=>$value['mobileofcontactperson'],
                            "locationlink"=>$value['locationlink'],
                            "images"=>unserialize($value['images']),
                            "status" =>$value['status'],
                            "createdat"=>$value['createdat'],
                            "updatedat"=>$value['updatedat']);
            }
            $response = array("status"=>200,
                              "message"=>"data fetched!",
                             "data"=>$data);
            echo json_encode($response);
        }else{  
            $response = array("status"=>400,
                              "message"=>"data not found!",
                             "data"=>null);
            echo json_encode($response);
        }
    }

    public function signup(){
        if($_POST){
            $salutation=$this->input->post('salutation');
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $dob=date('y-m-d', strtotime($this->input->post('dob')));
            $mobile=$this->input->post('mobile');
            $passcode=$this->input->post('passcode');
            $alt_mobile=$this->input->post('alt_mobile');
            $email=$this->input->post('email');
            $pincode=$this->input->post('pincode'); 
            $terms=$this->input->post('terms');
            $profession = "Insured";

            $insured = $this->Auth_model->getuserprofession($profession);

            $data = array("salutation"=>$salutation,
                          "firstname"=>$firstname,
                          "lastname"=>$lastname,
                          "dob"=>$dob,
                          "mobile"=>$mobile,
                          "passcode"=>md5($passcode),
                          "alt_mobile"=>$alt_mobile,
                          "email"=>$email,
                          "professionid"=>$insured,
                          "pincode"=>$pincode,
                          "termsandconditions"=>$terms,
                          "mobile_verified"=>true,
                          "is_active"=>true);
            $userupdate = $this->Auth_model->updateUser($data);
            if($userupdate){
                $response = array("status"=>true,
                                  "message"=>"User update successfully!");
                echo json_encode($response);
            }else{
                $response = array("status"=>false,
                                  "message"=>"Email already exist!");
                echo json_encode($response);
            }
        }
    }

    public function updateprofile(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $userid=$this->input->post('userid');
            $salutation=$this->input->post('salutation');
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $dob=date('y-m-d', strtotime($this->input->post('dob')));
            $alt_mobile=$this->input->post('alt_mobile');
            $email=$this->input->post('email');
            $pincode=$this->input->post('pincode'); 
            $profession=$this->input->post('userprofession'); 
            $profession_id = $this->Auth_model->getuserprofession($profession);
            $imagename = basename($_FILES["image"]["name"]);
            if($imagename != null){
                preg_match('/(?<extension>\.\w+)$/im', $imagename, $matches);
                $extension = $matches['extension'];
                $thumbnail = 'thumb_'.sha1($imagename.time()) . $extension;

                if($_FILES["image"] != null){
                $config['upload_path'] = './assets/profile';
                $config['allowed_types'] = 'wmv|mp4|avi|mov|png|jpeg|jpg|svg';
                $config['file_name'] = $thumbnail;

                $this->load->library('upload', $config);
                if (!is_dir('./assets/profile')) {
                    mkdir('./assets/profile',0777,TRUE);
                }
                $uploadimage = $this->upload->do_upload('image');
            }
            }else{
                $thumbnail = null;
            }
        
            
            
            $userdata = array("salutation"=>$salutation,
                          "firstname"=>$firstname,
                          "lastname"=>$lastname,
                          "dob"=>$dob,
                          "alt_mobile"=>$alt_mobile,
                          "email"=>$email,
                          "professionid"=>$profession_id,
                          "pincode"=>$pincode,
                          "profilephoto"=>$thumbnail);

            $recordupdate = $this->Auth_model->updateprofile($userid,$userdata);
            if($recordupdate){
            $response = $this->Auth_model->getuserbyid($userid);
            foreach ($response as $userdata) {
            $data['userdata'] = array("id"=>$userdata['id'],
                                    "salutation"=>$userdata['salutation'],
                                    "firstname"=>$userdata['firstname'],
                                    "lastname"=>$userdata['lastname'],
                                    "dob"=>$userdata['dob'],
                                    "mobile"=>$decode_data->mobile,
                                    "otp"=>$userdata['otp'],
                                    "alt_mobile"=>$userdata['alt_mobile'],
                                    "landline"=>$userdata['landline'],
                                    "email"=>$userdata['email'],
                                    "professionid"=>$this->Auth_model->getprofession($userdata['professionid']),
                                    "termsandconditions"=>$userdata['termsandconditions'],
                                    "state"=>$userdata['state'],
                                    "city"=>$userdata['city'],
                                    "address"=>$userdata['address'],
                                    "pincode"=>$userdata['pincode'],
                                    "profilephoto"=> $userdata['profilephoto'] != null ? $this->getimageurl($userdata['profilephoto']) : null,
                                    "email_verified"=>$userdata['email_verified'],
                                    "mobile_verified"=>$userdata['mobile_verified'],
                                    "usertype"=>$userdata['usertype'],
                                    "visitor"=>$userdata['visitor'],
                                    "is_active"=>$userdata['is_active'],
                                    "createdat"=>$userdata['createdat']);
            }
                $result['success'] = true; 
                $result['message'] = "Your profile successfully update!"; 
                $result['data'] = $data['userdata']; 
            }
        }else{
            $result['success'] = false; 
            $result['message'] = "404 Error!"; 
            $result['data'] = null; 
        } 
            echo json_encode($result);
        }

    public function forgotpassword(){
        if($_POST){
            $otprand=rand(1000,9999);
            $mobile = $this->input->post('mobile');
            $result = $this->Auth_model->getUserbyphone($mobile);
            if($result){
                $data = array('otp'=>$otprand,
                             'mobile'=>$mobile);
                if(sendotp($data['otp'],$data['mobile'])){
                    if($this->Auth_model->updateUser($data)){
                        $response = array("status"=>true,"message"=>"Otp send on your mobile number");
                        echo json_encode($response);
                    }else{
                        $response = array("status"=>false,"message"=>"500 Internal Server error!");
                        echo json_encode($response);
                    } 
                }
            }else{
                $response = array("status"=>false,"message"=>"Phone number does not exist!");
                echo json_encode($response);
            }
        }
    }
    
    public function updatenewpasscode(){
        if($_POST){
            $mobile = $this->input->post('mobile');
            $passcode = $this->input->post('passcode');
            $data = array('passcode'=>md5($passcode),
                            'mobile'=>$mobile);
            $result = $this->Auth_model->updateUser($data);
            if($result){
                $response = array("status"=>true,"message"=>"Passcode successfully changed!");
                echo json_encode($response);
            }else{
                $response = array("status"=>false,"message"=>"500 Internal server error!");
                echo json_encode($response);
            }
        }
    }

    public function getrelationlist(){
        $result = $this->Auth_model->fetchrelationlist();
        $response = array("status"=>true,
                          "message"=>"Relation list successfully featched!",
                          "data"=>$result);
        echo json_encode($response);
    }

    public function gettypeofpolicy(){
        $data = array();
        $result = $this->Auth_model->fetchtypeofpolicylist();
        foreach ($result as $value) {
            $data[] = array("id"=>$value['id'],
                          "policyname"=>$value['policyname'],
                          "policyicon"=>base_url('/assets/upload/'.$value['policyicon']));
        }
        $response = array("status"=>true,
                          "message"=>"Type of policy successfully featched!",
                          "data"=>$data);
        echo json_encode($response);
    }

    public function createpolicy(){
        $typeofpolicy = $this->input->post('typeofpolicy');
        $policynumber = $this->input->post('policynumber');
        $policystartdate = date('y-m-d', strtotime($this->input->post('policystartdate')));
        $policyenddate = date('y-m-d', strtotime($this->input->post('policyenddate')));
        $premium = $this->input->post('premium');
        $policyname = $this->input->post('policy_name');
        $headerToken = $this->input->get_request_header('Authorization');

        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[1];

        $decode_data = $this->decode_token($token);
        /*foreach ($decode_data as $value) {
            $userdata = array("mobile"=>$value->mobile);
        }*/
        $mobile = array("mobile"=>$decode_data->mobile);
        $verified = $this->Auth_model->verifytoken($mobile);

        if($verified){
            $data = array("customerId"=>$decode_data->id,
                        "typeofpolicy"=>$typeofpolicy,
                        "policyno"=>$policynumber,
                        "policystartdate"=>$policystartdate,
                        "policyenddate"=>$policyenddate,
                        "policy_name"=>$policy_name,
                        "premiun"=>$premium);
            $result['policyid'] = $this->Auth_model->insertpolicy($data);
            $response = array("status"=>true,
                          "message"=>"Policy successfully created!",
                          "data"=>$result);
            echo json_encode($response);
        }else{
            $response = array("status"=>false,
                          "message"=>"You are not authorized user!");
            echo json_encode($response);
        }

    }

    public function uploadpolicydocs(){
        $result = array();
        $data = array();
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $policyid = str_replace( '/', '_', $_POST['policyid']);
            $ocrdata = str_replace( '', '_', $_POST['ocrdata']);
            $customerId = str_replace( '', '_', $_POST['customerId']);
            $imagename = basename($_FILES["image"]["name"]);
            
            $config['upload_path'] = './assets/policydata';
            $config['allowed_types'] = 'wmv|mp4|avi|mov|png|jpeg|jpg|svg';
            $this->load->library('upload', $config);

            if (!is_dir('./assets/policydata')) {
                mkdir('./assets/policydata',0777,TRUE);
            }
            $upload = $this->upload->do_upload('image');
                if(!$upload){
                    $result['success'] = false; 
                    $result['message'] = "file doesn't upload!";
                }else{
                    
                    $images = $this->Auth_model->getimagesfrompolicy($policyid,$customerId);

                     if($images!=null){
                        $data = array("ocrdata"=>$ocrdata,
                                    "imagename"=>$imagename);
                        $checkimage = json_decode($images);
                        array_push($checkimage,$data);
                        $policydata = array("images"=>json_encode($checkimage));
                     }else{
                        $data[] = array("ocrdata"=>$ocrdata,
                                    "imagename"=>$imagename); 
                        $policydata = array("images"=>json_encode($data));
                     }
                    $recordupdate = $this->Auth_model->uploadImage($policyid,$customerId,$policydata);
                    $result['success'] = true; 
                    $result['message'] = "file upload successfully!";
                }
            }else{
                $result['success'] = false; 
                $result['message'] = "files not found!"; 
            } 
            echo json_encode($result);
    }

    public function policylist(){
        $headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[1];
        $decode_data = $this->decode_token($token);
        $mobile = array("mobile"=>$decode_data->mobile);
        $verified = $this->Auth_model->verifytoken($mobile);

        if($verified){
            $policylist = $this->Auth_model->getpolicylist($decode_data->id);
            if($policylist !== null){
                foreach ($policylist as $policydata) {
                $data[] = array("policyid"=>$policydata['id'],
                              "customerid"=>$policydata['customerId'],
                              "typeofpolicy"=>$this->Auth_model->gettypeofpolicy(array('policyname'=>$policydata['typeofpolicy'])),
                              "agentid"=>$this->Auth_model->userlogin(array('id'=>$policydata['agentId'])),
                              "policynumber"=>$policydata['policyno'],
                              "policystartdate"=>$policydata['policystartdate'],
                              "policyenddate"=>$policydata['policyenddate'],
                              "premiun"=>$policydata['premiun'],
                              "policydata"=>json_decode($policydata['policydata']),
                              "status"=>$policydata['status'],
                              "createdAt"=>$policydata['createdAt'],
                              "updatedAt"=>$policydata['updatedAt'],
                              "images"=>json_decode($policydata['images']));
                }
                $response = array("status"=>true,"message"=>"Policy List","data"=>$data);
                echo json_encode($response);
            }else{
                $response = array("status"=>true,"message"=>"No data found!");
                echo json_encode($response);
            }
        }else{
            $response = array("status"=>true,"message"=>"You are not authorized!");
            echo json_encode($response);
        }
        

    }



    public function linkagenttopolicy(){
        if($_POST){
            $agentid = $this->input->get_request_header('agentid');
            $policyid = $this->input->get_request_header('policyid');
            $userid = $this->input->get_request_header('userid');
            $data = array("customerId"=>$userid,
                        "id"=>$policyid,
                        "agentId"=>$agentid);
            $result = $this->Auth_model->linkagent($data);
            if($result){
                $response = array("status"=>true,
                                  "message"=>"Agent linked with policy successfully");
                echo json_encode($response);
            }else{
                $response = array("status"=>false,
                                  "message"=>"404 page not found!");
                echo json_encode($response);
            }
        }
    }

    public function deletefamilymember(){
        $headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[1];
        $userdata = $this->decode_token($token);
        $familymemberid = $this->input->get_request_header('familymemberid');
    }

    public function getuserbymobile(){
        if($_POST){
            $mobile = $this->input->post('mobile');
            $result['userdata'] = $this->Auth_model->getuserbymobile($mobile);
            if($result['userdata'] !=null || $result['userdata'] != ""){
                foreach ($result as $user) {
                $data = array("id"=>$user->id,
                            "salutation"=>$user->salutation,
                            "firstname"=>$user->firstname,
                            "lastname"=>$user->lastname,
                            "mobile"=>$user->mobile,
                            "email"=>$user->email);
                }
                $response['success'] = true; 
                $response['message'] = "User detail";
                $response['data'] = $data;
            }else{
                $response['success'] = false; 
                $response['message'] = "user not found!";
            }

            echo json_encode($response);
        }
    }

    public function familymembers(){
        $headerToken = $this->input->get_request_header('Authorization');
        $relation = $this->input->post('relation');
        $salutation = $this->input->post('salutation');
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $mobile = $this->input->post('mobile');
        $email = $this->input->post('email');
        $is_mobileverified = $this->input->post('is_mobileverified');
        $dob = date('y-d-m', strtotime($this->input->post('dob'))); 

        $splitToken = explode(" ", $headerToken);
        
        $token =  $splitToken[1];
        $decode_data = $this->decode_token($token);
        /*foreach ($decode_data as $value) {
            $userdata = array("mobile"=>$value->mobile);
        }*/
        $mobile = array("mobile"=>$decode_data->mobile);

        if($is_mobileverified){
            $active = true;
        }else{
            $active = false;
        }
        if($decode_data->mobile != $mobile){
            $familymemberid = $this->Auth_model->getuserdata($mobile);
            
            if($familymemberid != null){
                $data = array("relation"=>$relation,
                                "userId"=>$decode_data->id,
                                "familymemberId"=>$familymemberid,
                                "status"=>$active);
                $check_relation = $this->Auth_model->check_relation($familymemberid, $decode_data->id);
                if($check_relation){
                    $response = array("status"=>false,
                          "message"=>"Family member already added");
                    echo json_encode($response);
                }else{
                    $this->Auth_model->createrelation($data);
                    $response = array("status"=>true,
                              "message"=>"Family member added successfully");
                    echo json_encode($response);
                }
            }else{
                $data = array("salutation"=>$salutation,
                          "firstname"=>$firstname,
                          "lastname"=>$lastname,
                          "dob"=>$dob,
                          "email"=>$email,
                          "mobile"=>$mobile,
                          "mobile_verified"=>$is_mobileverified,
                          "is_active"=>$active);

                $create_user = $this->Auth_model->createuser($data);
                if($create_user != true){
                    $familymemberid = $this->Auth_model->getuserdata($mobile);
                    $data = array("relation"=>$relation,
                                    "userId"=>$decode_data->id,
                                    "familymemberId"=>$familymemberid,
                                    "status"=>$active);
                    $add_relation = $this->Auth_model->createrelation($data);
                    if($add_relation){
                        $response = array("status"=>true,"message"=>"Family member added successfully");
                        echo json_encode($response);
                    }else{
                        $response = array("status"=>false,"message"=>$add_relation['message']);
                        echo json_encode($response);
                    }
                }else{
                    $response = array("status"=>false,"message"=>$create_user['message']);
                    echo json_encode($response);
                }
            }
        }else{
            $response = array("status"=>false,"message"=>"Your mobile number and your relative number can not be same");
            echo json_encode($response);
        }
    }

    public function familymemberlist(){
        $headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[1];
        $decode_data = $this->decode_token($token);
        /*foreach ($decode_data as $value) {
            $userdata = array("id"=>$value->id,
                            "mobile"=>$value->mobile);
        }*/
        $mobile = array("mobile"=>$decode_data->mobile);

        $familymemberid = $this->Auth_model->getuserdata($decode_data->mobile);
        if($familymemberid!=null){
            $result = $this->Auth_model->getfamilymembers($decode_data->id);
            if($result != false){
                $response = array("status"=>false,
                          "message"=>"List of Family Members",
                          "data"=>$result);
                echo json_encode($response);
            }
        }
        else{
            $response = array("status"=>false,
                          "message"=>"You are not authorized user!");
            echo json_encode($response);
        }
    }

    public function createagent(){
        if($_POST){
            $salutation=$this->input->post('salutation');
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $dob=date('y-m-d', strtotime($this->input->post('dob')));
            $mobile=$this->input->post('mobile');
            $alt_mobile=$this->input->post('alt_mobile');
            $email=$this->input->post('email');
            $pincode=$this->input->post('pincode'); 
            $profession = "Insured";
            $insured = $this->Auth_model->getuserprofession($profession);
            $data = array("salutation"=>$salutation,
                          "firstname"=>$firstname,
                          "lastname"=>$lastname,
                          "dob"=>$dob,
                          "mobile"=>$mobile,
                          "alt_mobile"=>$alt_mobile,
                          "email"=>$email,
                          "professionid"=>$insured,
                          "pincode"=>$pincode,
                          "mobile_verified"=>true,
                          "is_active"=>true);
            $result = $this->Auth_model->getUserbyphone($mobile);
            if($result){
                $response = array("status"=>true,
                                  "message"=>"Mobile number already exist!");
                echo json_encode($response);
            }else{
                $createuser = $this->Auth_model->createuser($data);
                if($createuser){
                    $response = array("status"=>true,
                                  "message"=>"Agent created successfully!");
                    echo json_encode($response);
                }else{
                    $response = array("status"=>false,
                                  "message"=>"404 page not found!");
                    echo json_encode($response);
                }
                
            }

        }
    }

    public function applyforclaims(){
        if($_POST){
        $fullname = $this->input->post('fullname');
        $mobile = $this->input->post('mobile');
        $email = $this->input->post('email');
        $typeofpolicy = $this->input->post('typeofpolicy');
        $nameofinsured = $this->input->post('nameofinsured');
        $subjectmatter = $this->input->post('subjectmatter');
        $dateofloss = date('y-m-d', strtotime($this->input->post('dateofloss')));
        $placeofsurvey = $this->input->post('placeofsurvey');
        $nameofcontactperson = $this->input->post('nameofcontactperson');
        $mobileofcontactperson = $this->input->post('mobileofcontactperson');
        $longitude = $this->input->post('longitude');
        $latitude = $this->input->post('latitude');
        
        $link =  "https://www.google.com/maps/search/?api=1&query=$latitude,$longitude";
        $data = array("fullname"=>$fullname,
                        "mobile"=>$mobile,
                        "email"=>$email,
                        "typeofpolicy"=>$typeofpolicy,
                        "subjectmatter"=>$subjectmatter,
                        "nameofinsured"=>$nameofinsured,
                        "dateofloss"=>$dateofloss,
                        "placeofsurvey"=>$placeofsurvey,
                        "nameofcontactperson"=>$nameofcontactperson,
                        "mobileofcontactperson"=>$mobileofcontactperson,
                        "locationlink"=>$link,
                        "status"=>true);
        $result = $this->Auth_model->applyforclaim($data);
        if($result){
            $response = array("status"=>true,
                              "message"=>"You have successfully apply for claim");
            echo json_encode($response);
        }else{
            $response = array("status"=>false,
                              "message"=>"404 page not found!");
            echo json_encode($response);
        }
    }else{
        $response = array("status"=>false,
                          "message"=>"404 page not found!");
        echo json_encode($response);
    }
        
    }

    
    public function uploaddocumnetforclaim(){
        $result = array();
        $data = array();
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $claimid = str_replace( '/', '_', $_POST['claimid']);
            $customerId = str_replace( '', '_', $_POST['customerId']);
            $imagename = basename($_FILES["image"]["name"]);
            
            $config['upload_path'] = './assets/claimdata';
            $config['allowed_types'] = 'wmv|mp4|avi|mov|png|jpeg|jpg|svg';
            $this->load->library('upload', $config);

            if (!is_dir('./assets/claimdata')) {
                mkdir('./assets/claimdata',0777,TRUE);
            }
            $upload = $this->upload->do_upload('image');
                if(!$upload){
                    $result['success'] = false; 
                    $result['message'] = "file doesn't upload!";
                }else{
                    
                    $images = $this->Auth_model->getimagesfromclaim($claimid,$customerId);
                     if($images!=null){
                        $data = array("imagename"=>$imagename);
                        $checkimage = json_decode($images);
                        array_push($checkimage,$data);
                        $policydata = array("images"=>json_encode($checkimage));
                     }else{
                        $data[] = array("ocrdata"=>$ocrdata,
                                    "imagename"=>$imagename); 
                        $policydata = array("images"=>json_encode($data));
                     }
                    $recordupdate = $this->Auth_model->uploadclaimdata($claimid,$customerId,$policydata);
                    $result['success'] = true; 
                    $result['message'] = "file upload successfully!";
                }
            }else{
                $result['success'] = false; 
                $result['message'] = "files not found!"; 
            } 
            echo json_encode($result);
    }

    public function getcasebymobile(){
        $headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[1];
        $decode_data = $this->decode_token($token);
        /*foreach ($decode_data as $value) {
            $userdata = array("id"=>$value->id,
                            "mobile"=>$value->mobile);
        }*/
        $caselist = $this->Auth_model->getallcasesbymobile($decode_data->mobile);
        echo json_encode($caselist);
    }

    /**
     * Api for Inspector App
     * Store live location of Inspector
     * */

    public function inspector_location(){
        if($_POST){
        $headerToken = $this->input->get_request_header('Authorization');
        $splitToken = explode(" ", $headerToken);
        $token =  $splitToken[1];

        $decode_data = $this->decode_token($token);
        /*foreach ($decode_data as $value) {
            $userdata = array("id"=>$value->id,
                            "mobile"=>$value->mobile);
        }*/
        $mobile = array("mobile"=>$decode_data->mobile);
        $verified = $this->Auth_model->verifytoken($mobile);

        $longitude = $this->input->post('longitude');
        $latitude = $this->input->post('latitude');
        $device_token = $this->input->post('device_token');
        $available = $this->input->post('available');
        $google_address = $this->input->post('google_address');

        $location = array(
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'google_address' => $google_address,
                    'userid'=>$decode_data->id,
                    'device_token'=>$device_token,
                    'available'=>$available);
            $locationinsert = $this->Auth_model->updatelivelocation($location);
            if($locationinsert){
            $response = array("status"=>true,
                             "message"=>"location update successfully");
                echo json_encode($response);
            }else{
                $response = array("status"=>false,
                                 "message"=>"500 Internal server error");
                echo json_encode($response);
            }
        }else{
            $response = array("status"=>false,
                             "message"=>"404 Page not found");
                    echo json_encode($response);
        }
    }

    public function inspectoravailablity(){
        if($_POST){
            $headerToken = $this->input->get_request_header('Authorization');
            $splitToken = explode(" ", $headerToken);
            $token =  $splitToken[1];

            $decode_data = $this->decode_token($token);
            /*foreach ($decode_data as $value) {
                $userdata = array("id"=>$value->id,
                                "mobile"=>$value->mobile);
            }*/
            $mobile = array("mobile"=>$decode_data->mobile);
            $verified = $this->Auth_model->verifytoken($mobile);
            $available = $this->input->post('available');
            $data = array('available'=>$available,
                          'userid'=>$decode_data->id);

            $response = $this->Auth_model->update_availablity($data);
            if($response){
                $response = array("status"=>true,
                                "message"=>"Status update successfully");
                echo json_encode($response);
            }else{
                $response = array("status"=>false,
                                "message"=>"500 Internal server error");
                echo json_encode($response);
            }
        }else{
            $response = array("status"=>false,
                             "message"=>"404 Page not found");
                echo json_encode($response);
        }
    }

    public function getbannerlist(){
        $result = $this->Auth_model->fetchbanner();
        $response = array("status"=>true,
                          "message"=>"banner list successfully featched!",
                          "data"=>$result);
        echo json_encode($response);
    }

    public function acceptclaim(){
        if($_POST){
            $headerToken = $this->input->get_request_header('Authorization');
            $splitToken = explode(" ", $headerToken);
            $token =  $splitToken[1];

            $decode_data = $this->decode_token($token);            
            $mobile = array("mobile"=>$decode_data->mobile);
            $verified = $this->Auth_model->verifytoken($mobile);
            if(!$verified){
                $response = array("status"=>false,
                             "message"=>"You are not authorized user!");
                echo json_encode($response);
            }else{
                $data = array("claimid"=>$this->input->post('claimid'),
                              "userid"=>$decode_data->id,
                            "status"=>1); 
                if($this->Auth_model->acceptclaimbyuser($data)){
                    $response = array("status"=>true,
                             "message"=>"Claim successfully assigned to you");
                    echo json_encode($response);
                }else{
                    $response = array("status"=>false,
                             "message"=>"500 internal server error!");
                    echo json_encode($response);
                }
            }
        }else{
            $response = array("status"=>false,
                             "message"=>"404 Page not found");
            echo json_encode($response);
        }
    }

    public function rejectclaim(){
        if($_POST){
            $headerToken = $this->input->get_request_header('Authorization');
            $splitToken = explode(" ", $headerToken);
            $token =  $splitToken[1];

            $decode_data = $this->decode_token($token);            
            $mobile = array("mobile"=>$decode_data->mobile);
            $verified = $this->Auth_model->verifytoken($mobile);
            if(!$verified){
                $response = array("status"=>false,
                             "message"=>"You are not authorized user!");
                echo json_encode($response);
            }else{
                $data = array("claimid"=>$this->input->post('claimid'),
                              "userid"=>$decode_data->id,
                            "status"=>0); 
                if($this->Auth_model->acceptclaimbyuser($data)){
                    $response = array("status"=>true,
                             "message"=>"Claim successfully rejected");
                    echo json_encode($response);
                }else{
                    $response = array("status"=>false,
                             "message"=>"500 internal server error!");
                    echo json_encode($response);
                }
            }
        }else{
            $response = array("status"=>false,
                             "message"=>"404 Page not found");
            echo json_encode($response);
        }
    }




}

