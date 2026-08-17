<?php 
class Dashboard extends CI_Controller{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('dashboard_model');
    $this->load->model('company_model','company');
    $this->data = array();
  }

    // public function index() {
    //   if ($this->session->userdata('isLogin') == "loggedIn") {
    //     // $total_incoming_cases = $this->getTotalIncomingCases($defaultcompany, $defaultdepartment, $usertype);
    //     // $total_under_survey_cases = $this->getTotalUnderSurveyCases($defaultcompany, $defaultdepartment, $usertype);
    //     // $total_billing_done = $this->getTotalBillingDone($defaultcompany, $defaultdepartment, $usertype);
    //     // $total_dispatch_cases = $this->getTotalDispatchCases($defaultcompany, $defaultdepartment, $usertype);

    //     // $total_new_assignment = $this->dashboard_model->getAssignmentByDate();

    //     // $dateWiseCases = [];
    //     // foreach ($total_new_assignment as $row) {
    //     //     $dateWiseCases[] = ['title' => (int)$row->total_cases,
    //     //                         'start' => $row->createdat,
    //     //                         'color' => '#e74c3c'];
    //     // }
    //     $user_id = $this->session->userdata('id');
    //     $companies = $this->company->getCompaniesByUserId($user_id);
    //     $data = [
    //             // 'totalincomingcases' => $total_incoming_cases,
    //             // 'datewisecase' => $dateWiseCases,
    //             // 'total_under_survey_cases' => $total_under_survey_cases,
    //             // 'total_billing_done' => $total_billing_done,
    //             // 'total_dispatch_cases' => $total_dispatch_cases,
    //             'companies' =>  $companies,
    //             // 'favcontact' => $this->dashboard_model->allUser(),
    //             'view' => "Dashboard",
    //           ];
    //           // print_r(json_encode($data));
    //           // exit;
    //     if (!empty($companies)) {
    //       $data['show_company_dropdown'] = true;
    //     } else {
    //       $data['show_company_dropdown'] = false;
    //     }
    //     $this->load->view("adminpanel/dashboard", $data);
    //   }
    // }

    public function index() {
      if ($this->session->userdata('isLogin') == "loggedIn") {
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

              $total_incoming_cases = $this->getTotalIncomingCases($defaultcompany, $defaultdepartment, $usertype);
              $total_under_survey_cases = $this->getTotalUnderSurveyCases($defaultcompany, $defaultdepartment, $usertype);
              $total_billing_done = $this->getTotalBillingDone($defaultcompany, $defaultdepartment, $usertype);
              $total_dispatch_cases = $this->getTotalDispatchCases($defaultcompany, $defaultdepartment, $usertype);

              $total_new_assignment = $this->dashboard_model->getAssignmentByDate();

              $dateWiseCases = [];
              foreach ($total_new_assignment as $row) {
                  $dateWiseCases[] = ['title' => (int)$row->total_cases,
                                      'start' => $row->createdat,
                                      'color' => '#e74c3c'];
              }
              $user_id = $this->session->userdata('id');
              // $companies = $this->company->getCompaniesByUserId($user_id);
              $data = [
                'defaultcompany' => $defaultcompany,
                'defaultdepartment' => $defaultdepartment,
                'usertype' => $usertype,
                'totalincomingcases' => $total_incoming_cases,
                'datewisecase' => $dateWiseCases,
                'total_under_survey_cases' => $total_under_survey_cases,
                'total_billing_done' => $total_billing_done,
                'total_dispatch_cases' => $total_dispatch_cases,
                'outgoing_livelocation_cases' => $this->dashboard_model->getOutgoinglivelocationjobs(),
                'favcontact' => $this->dashboard_model->allUser(),
                // 'companies' =>  $companies,
                'view' => "Dashboard",
              ];
              if (!empty($companies)) {
                $data['show_company_dropdown'] = true;
              } else {
                $data['show_company_dropdown'] = false;
              }
              // print_r(json_encode($data));
              // exit;
              $this->load->view("adminpanel/dashboard", $data);
          } else {
              // echo 'Failed to decrypt data.';
          }
        } else {
            // echo 'No data received.';
        }
      }
    }

    private function getTotalIncomingCases($companyid, $departmentid, $user = null){
      return $this->dashboard_model->getTotalIncomingCases($companyid, $departmentid);
    }

    private function getTotalUnderSurveyCases($companyid, $departmentid, $user = null){
      return $this->dashboard_model->getTotalUnderSurveyCases($companyid, $departmentid);
    }

    private function getTotalBillingDone($companyid, $departmentid, $user = null){
      return $this->dashboard_model->getTotalBillingDone($companyid, $departmentid);
    }

    private function getTotalDispatchCases($companyid, $departmentid, $user = null){
      return $this->dashboard_model->getTotalDispatchCases($companyid, $departmentid);
    }    

    public function getJobs(){
        $this->data['jobdata'] = $this->dashboard_model->getallJobs();
        $this->load->view("adminpanel/dashboard", $this->data);
    }
    public function location_based_job(){
        //$this->data['jobdata'] = $this->dashboard_model->getallJobs();
        $this->load->view("adminpanel/jobs/location_based_jobs");
    }

    // by anish  fetch casesdata by date from calender and show it into dataTable
    public function fetch_cases_by_date_server()
    {
      $postData = $this->input->post();
      $cases = $this->dashboard_model->get_cases_by_date($_POST); 

      $accepteduser = null;
      $i = $_POST['start'];
      $viewCaseUrl = encryptUrl($_POST['company'],$_POST['department'],$_POST['user_role']);
      foreach ($jobData as $jobValue) {
          $insureddata = json_decode($jobValue->jobdata);
          $i++;
          $case_status = null;
          $address = null;
          if ($jobValue->status == 1) {
              $case_status = '<span class="label label-info">Under Survey</span>';
          } else if ($jobValue->status == 2) {
              $case_status = '<span class="label label-success">Photo Upload</span>';
          } else if ($jobValue->status == 3) {
              $case_status = '<span class="label label-success">LOR Sent</span>';
          } else if ($jobValue->status == 4) {
              $case_status = '<span class="label label-success">FSR</span>';
          }
          else if ($jobValue->status == 5) {
              $case_status = '<span class="label label-success">Bill Generated</span>';
          }
          else if ($jobValue->status == 6) {
              $case_status = '<span class="label label-warning">Waiting for TI</span>';
          }
          else if ($jobValue->status == 7) {
              $case_status = '<span class="label label-warning">Pending for Dispatch</span>';
          }
          else if ($jobValue->status == 8) {
              $case_status = '<span class="label label-success">Dispatched</span>';
          }
          else if ($jobValue->status == 11) {
              $case_status = '<span class="label label-danger">Cancelled</span>';
              $cancelReason = $this->assignment->getCancelReason($jobValue->aid);
          }
          if ($jobValue->uid_to != 0) {
              $assignTo = $this->home->getuserdatabyid($jobValue->uid_to);
              $accepteduser  = nl2br($assignTo[0]['salutation'] . " " . $assignTo[0]['firstname'] . " " . $assignTo[0]['lastname'] . "\n" . '<span style="color:#0884c7">' . $assignTo[0]['mobile'] . '</span>');
          } else {
              $accepteduser = '<span class="label label-warning">Waiting</span>';
          }

          $totalimages = $this->assignment->countFiles($jobValue->aid, "images");
          $totalvideos = $this->assignment->countFiles($jobValue->aid, "videos");
          $totaldocuments = $this->assignment->countFiles($jobValue->aid, "documents");   

          $action  = '<div class="panel-heading">
                          <div class="dropdown" style="float:none;">
                              <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                                  ' .$case_status .'
                              </button>

                              <ul class="dropdown-menu">
                                  <li><a target="_blank" href="' . base_url() . 'viewcasedetail?q=' . base64_encode($this->encryption->encrypt($jobValue->aid)) . '&data=' . $viewCaseUrl . '" id="' . $jobValue->aid . '"><i class="fa fa-sync"></i>View Case</a></li>
                                  <li><a href="#cancel_case" data-toggle="modal" onclick="cancelJob(\'' . $jobValue->aid . '\')"><i class="fa fa-cogs"></i>Cancel</a></li>
                                  <li><a href="#"><i class="fa fa-images"></i>Images <span class="text-grey">' . $totalimages . '</span></a></li>
                                  <li><a href="#"><i class="fa fa-video"></i>Videos <span class=" text-grey">' . $totalvideos . '</span></a></li>
                                  <li><a href="#"><i class="fa fa-file"></i>Documents <span class=" text-grey">' . $totaldocuments . '</span></a></li>
                                  <li><a href="#"><i class="fa fa-folder"></i>System Driven <span class=" text-grey">' . $totaldocuments . '</span></a></li>
                              </ul>
                          </div>
                      </div>';
          
          if ($jobValue->latitude != "" || $jobValue->longitude != "") {
              $address = $this->getAddressFromLatLng($jobValue->latitude, $jobValue->longitude);
          } else {
              $address = "Location Not Found";
          }
          $language = explode(',', $jobValue->jobdata);
          $media = '<div class="navbar--nav ml-auto">
                      <ul class="nav" style="flex-wrap:unset">
                          <li class="nav-item">
                              <span class="nav-link" style="padding-left:15px; padding-right:15px;">
                                  <i class="fa fa-images"></i>
                                  <span class="badge text-white bg-blue">' . $totalimages . '</span>
                              </span>
                          </li>
                          <li class="nav-item">
                              <span class="nav-link" style="padding-left:15px; padding-right:15px;">
                                  <i class="fa fa-video"></i>
                                  <span class="badge text-white bg-blue">' . $totalvideos . '</span>
                              </span>
                          </li>
                          <li class="nav-item">
                              <span class="nav-link" style="padding-left:15px; padding-right:15px;">
                                  <i class="fa fa-file"></i>
                                  <span class="badge text-white bg-blue">' . $totaldocuments . '</span>
                              </span>
                          </li>
                          <li class="nav-item">
                              <span class="nav-link" style="padding-left:15px; padding-right:15px;">
                                  <i class="fa fa-folder"></i>
                                  <span class="badge text-white bg-blue">' . $totaldocuments . '</span>
                              </span>
                          </li>
                      </ul>
                  </div>';
          $created = date('Y/m/d', strtotime($jobValue->createdAt));
          $insuredName = !empty($jobValue->insured_name) ? 'Insured Name: <span style="color:#0884c7">' . $jobValue->insured_name . '</span>' . "\n" : '';
          $data[] = array(
              nl2br($jobValue->aid . "\n" . '<span style="color:#e16123">' . $jobValue->case_reference . '</span>'. "\n" . '<span style="color:#0884c7">' . $created . '</span>'),
              $accepteduser,
              nl2br($jobValue->investigator_type . "\n" . $insuredName . 'Contact no: <span style="color:#0884c7">' . $insureddata->contact_person_mobile . '</span>'),
              // $address,
              $media,
              $action
          );
      }
      $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->assignment->countallIncomingAssignement(),
          "recordsFiltered" => $this->assignment->countFilteredIncomingAssignment($_POST),
          "data" => $data,
      );
      echo json_encode($output);
      
    }



  /*public function get_translator(){
      if($this->input->post()){
          $language = $this->input->post('language');
          $userId = $this->session->userdata('id');
          $this->data['translator'] = $this->dashboard_model->getTranslator($language, $userId);
          if($this->data['translator'] == FALSE){
              $response = array("status"=>404,'message'=>"No translator available");
              echo json_encode($response);
          }else{
              $response = array("status"=>200,'message'=>"Translator found","data"=>$this->data['translator']);
              echo json_encode($response);
          }
      }
  }*/

    
  // public function successPage(){
  //   $this->load->view("adminpanel/paymentsuccess");
  // }  

 


  public function termsofservice(){
    $this->load->view('adminpanel/jobs/termsofservice');
  }

//get all running location based Job

  public function live_location_job(){
    $this->data['userdata'] = $this->dashboard_model->get_translation_live_location();  
    $this->data['case_type']='running_case';
    $this->load->view("adminpanel/jobs/live_location_list", $this->data);
  }

//get all deleted case ***delete case status id=7****

  public function deleted_case(){
    $this->data['case_type']='deleted_case';
    $this->data['userdata'] = $this->dashboard_model->deletedd_live_case();  
    $this->load->view("adminpanel/jobs/live_location_list", $this->data);
  }


//get all live completed  case ***delete case status id=6****
 public function completed_case(){
   $this->data['userdata'] = $this->dashboard_model->completed_live_case();  
      $this->data['case_type']='completed_case';
    $this->load->view("adminpanel/jobs/live_location_list", $this->data);
    }


//View Case Details
public function view_case_details($caseaid){

$this->data['userdata'] = $this->dashboard_model->get_Case_details($caseaid);  
$this->data['case_idd']=$caseaid;
  $this->load->view("adminpanel/jobs/view_live_case", $this->data);
    }


//View edit case  Details
public function edit_case_details($caseaid){
$this->data['userdata'] = $this->dashboard_model->get_Case_details($caseaid);  
 $this->data['case_idd']=$caseaid;
  $this->load->view("adminpanel/jobs/edit_live_case", $this->data);
    }



//Delete Case 

public function delete_case($caseaid){

$delete_details = array( 
    
                            "status"=>'7'
                                     
                                 );
                               

  $result= $this->dashboard_model->claims_job_edit($delete_details,$caseaid);

       if($result){
           $response = array('status'=>200, 'message'=>'You have successfully Deleted','data'=>'');
           echo json_encode($response);
       }else{
          $response = array('status'=>500, 'message'=>'Internal Server Error!','data'=>$result);
       echo json_encode($response);
     }


     }

//Get Comment Details 

 public function comment_case($caseaid)
{
  $this->data['userdata'] = $this->dashboard_model->get_Case_details($caseaid);  
$this->data['caseid']=$caseaid;

  $this->load->view("adminpanel/jobs/comment_case", $this->data);
}



//Edit Case Details
public function edit_live_case_report($caseaid){
    $this->input->post('name_contact_person');
    if($_POST)
    {
    $data = array("jobdata"=>json_encode($_POST));
    $result = $this->dashboard_model->claims_job_edit($data,$caseaid);

    if($result == 1){
        ?>
        <script type="text/javascript">
            alert("Edit Successfully");
    window.history.go(-2);
                    
                    </script>
                    <?php

    }
}
}

//Add Comment ON Case
  public function add_comment($idd){

  //  echo 1;
 $dateee=date("Y-m-d h:i A");
    if($_POST){
 $idd;
 $formdata = $this->input->post('formdata');
 $user_id=$this->session->userdata('id');
    parse_str($formdata, $parseData);


if($parseData['file_id']!='')
{
  $file_data = array(         
                                    "file_id"=>$parseData['file_id'],
                                  "file_name"=>$parseData['file_name'],
                                  "file_type"=>$parseData['file_type']

                                 );   
}
else
{
    $file_data='';
}

$caseaid=$parseData['case_id'];
 $admin_objection = array( 
                            "admin_objection"=>'1'
                                     
                                 );
                               

  $objectionadmin= $this->dashboard_model->claims_job_edit($admin_objection,$caseaid);





 $data = array( 
                            "sender_id"=>$parseData['current_admin_id'],
                                 "receiver_id"=>$parseData['inspector_idd'],
                                  "case_aid"=>$parseData['case_id'],
                                   "msg"=>$parseData['comment'],
                                    "file_data"=>json_encode($file_data),
                                     "date_time"=>$dateee
                                     
                                 );
                               

          $result = $this->dashboard_model->comment_on_case($data);
}

       if($result){
           $response = array('status'=>200, 'message'=>'Comment Add successfully','data'=>'');
           echo json_encode($response);
       }else{
          $response = array('status'=>500, 'message'=>'Internal Server Error!','data'=>$result);
       echo json_encode($response);
     }

}

//Get Working INspector Details...
     public function assign_inspector_list($case_id){


           $this->data['case_id']=$case_id;
 
 $this->data['userdata'] = $this->dashboard_model->getinspector();  
            $this->load->view("adminpanel/jobs/inspector_list", $this->data);
    }




//Assign Inspector To Case
  public function asign_to_inspector($idd){
$inspe_id=$idd;
  $user_id=$this->session->userdata('id');

 $case_id = $this->input->post('case_id');

  $result = $this->dashboard_model->check_valid_asign($case_id);

if($result==1)
{
 
$casestatus = array(
    "status"=>'1'
);
                   
  $result= $this->dashboard_model->claims_job_edit($casestatus,$case_id);
   $dateee=date("Y-m-d H:i:s");
 $data = array("date_time"=>$dateee,
                                "uid_from"=>$user_id,
                                "uid_to"=>$inspe_id,
                                    );

    $update_result= $this->dashboard_model->update_asign_case($case_id,$data);
 if($update_result){
           $response = array('status'=>200, 'message'=>'You have successfully Assign Another Inspector','data'=>'');
           echo json_encode($response);
       }else{
          $response = array('status'=>500, 'message'=>'Internal Server Error!','data'=>$result);
       echo json_encode($response);
     }


}
else
{

//insert asign new case

  $dateee=date("Y-m-d H:i:s");
 $data = array("date_time"=>$dateee,
                                "uid_from"=>$user_id,
                                 "aid"=>$case_id,
                                "uid_to"=>$inspe_id,
                                    );

    $resulttt_insert= $this->dashboard_model->jobassignTo($data);

    $casestatus = array(
    "status"=>'1'
);
                               

  $result= $this->dashboard_model->claims_job_edit($casestatus,$case_id);

 if($resulttt_insert){
           $response = array('status'=>200, 'message'=>'You have successfully Assign Inspector','data'=>'');
           echo json_encode($response);
       }else{
          $response = array('status'=>500, 'message'=>'Internal Server Error!','data'=>$result);
       echo json_encode($response);
     }

  
}

}


//create New Live location Case
    public function create_live_newcase()
    {
 $dateee=date("Y-m-d H:i:s");
    if($_POST)
    {

 $formdata = $this->input->post('formdata');

  $nature_job = $this->input->post('nature_id');
  $user_id=$this->session->userdata('id');
  parse_str($formdata, $parseData);
 //$aid = date("dmyhis").rand(10,100); //reason aid started with 0 becase date like 04 but year shold not be 0..
$aid = date("ymdhis").rand(10,100);

if($nature_job==26||$nature_job==27||$nature_job==28||$nature_job==29)
{
//motor_assignment

    
  $language = array("name_contact_person"=>$parseData['motor_name_contact_person'],
                      "mobile_contact_person"=>$parseData['motor_mobile_contact_person'],
                      "name_vehicle_owner"=>$parseData['motor_name_vehicle_owner'],
                       "cause_of_Loss"=>$parseData['motor_cause_of_Loss'],
                       "vehicle_type"=>$parseData['Vehicle_type'],
                       "vehicle_number"=>$parseData['motor_vehicle_number'],
                      "policy_number"=>$parseData['motor_policy_number'],
                       "location"=>$parseData['motor_location'],
                      "name_of_work_shop"=>$parseData['motor_name_of_work_shop'],
                       "name_workshop_advisor"=>$parseData['motor_name_workshop_advisor'],
                      "instruction"=>$parseData['motor_instruction']);



                $data = array("aid"=>$aid,
                                "natureofjob"=>$nature_job,
                                "jobdata"=>json_encode($language),
                                 "job_type"=>'live_location_based',
                                
                                "userId"=>$user_id,
                                "docs"=>'',
                                "createdAt"=>$dateee);

 $result = $this->dashboard_model->claims_job_assignment($data);

 
}
else if($nature_job==30||$nature_job==31||$nature_job==32||$nature_job==33)
{

//marine_assignement
  
        $language = array(
           
                    "name_contact_person"=>$parseData['marine_name_contact_person'],
                      "mobile_contact_person"=>$parseData['marine_mobile_contact_person'],
                      "name_owner_goods"=>$parseData['marine_name_owner_goods'],
                       "commodity"=>$parseData['marine_commodity'],
                      "policy_number"=>$parseData['marine_policy_number'],
                       "conveyance"=>$parseData['marine_conveyance'],
                      "invoice_number"=>$parseData['marine_invoice_number'],
                       "gr_bl_awb_rr_number"=>$parseData['marine_gr_bl_awb_rr_number'],
                      "location"=>$parseData['marine_location'],
                       "cause_of_Loss"=>$parseData['marine_cause_of_Loss'],
                       "instruction"=>$parseData['marine_instruction']);

                $data = array("aid"=>$aid,
                                "natureofjob"=>$nature_job,
                                "jobdata"=>json_encode($language),
                                 "job_type"=>'live_location_based',
                                
                                "userId"=>$user_id,
                                "docs"=>'',
                                "createdAt"=>$dateee);


         $result = $this->dashboard_model->claims_job_assignment($data);

}
else if($nature_job==34||$nature_job==35)
{

 //cattle_assignment
        $language = array(
                     
                      "name_contact_person"=>$parseData['cattle_name_contact_person'],
                       "mobile_contact_person"=>$parseData['cattle_mobile_contact_person'],
                      "name_beneficiary"=>$parseData['cattle_name_beneficiary'],
                       "animal_tag_number"=>$parseData['cattle_animal_tag_number'],
                      "policy_number"=>$parseData['cattle_policy_number'],
                       "location"=>$parseData['cattle_location'],
                      "instruction"=>$parseData['cattle_instruction']);


  $data = array("aid"=>$aid,
                                "natureofjob"=>$nature_job,
                                "jobdata"=>json_encode($language),
                                 "job_type"=>'live_location_based',
                                
                                "userId"=>$user_id,
                                "docs"=>'',
                                "createdAt"=>$dateee);

         $result = $this->dashboard_model->claims_job_assignment($data);

}
else if($nature_job==36||$nature_job==37)
{

        $language = array(
                     
                      "name_contact_person"=>$parseData['death_name_contact_person'],
                      "mobile_contact_person"=>$parseData['death_mobile_contact_person'],
                       "name_of_employer"=>$parseData['death_name_of_employer'],
                      "name_of_affected_person"=>$parseData['death_name_of_affected_person'],
                       "nature_of_assignment"=>$parseData['death_nature_of_assignment'],
                      "policy_number"=>$parseData['death_policy_number'],
                       "location"=>$parseData['death_location'],
                      "instruction"=>$parseData['death_instruction']);



 $data = array("aid"=>$aid,
                                "natureofjob"=>$nature_job,
                                "job_type"=>'live_location_based',
                                "jobdata"=>json_encode($language),
                                "userId"=>$user_id,
                                "docs"=>'',
                                "createdAt"=>$dateee);

// json_encode($data);
         $result = $this->dashboard_model->claims_job_assignment($data);
}


       if($result){
        $hashed_idd = password_hash($result, PASSWORD_DEFAULT);
$baseurl=base_url();
           $response = array('status'=>200, 'message'=>'You have successfully registered','data'=>$hashed_idd,'url'=>$baseurl);
           echo json_encode($response);
       }else{
          $response = array('status'=>500, 'message'=>'Internal Server Error!','data'=>$result);
       echo json_encode($response);
     }

    }

}

//sharma
  

// ----- CHATTING SYSTEM BY VIDHI SHARMA ---------
public function sendMessage() {
  $postData = json_decode(file_get_contents('php://input'), true);
  $senderId = $this->session->userdata('id');
  $receiverId = $postData['receiverId'];
  $message = $postData['message'];
  $this->dashboard_model->saveMessage($senderId, $receiverId, $message);
  $response = array('status' => 'success', 'message' => 'Message sent successfully');
  echo json_encode($response);
}


public function receiveMessages() {
$receiverId = $this->session->userdata('id');
$postData = json_decode(file_get_contents('php://input'), true);
if (isset($postData['senderId'])) {
    $senderId = $postData['senderId'];
    $messages = $this->dashboard_model->getMessages($receiverId, $senderId);
    header('Content-Type: application/json');
    echo json_encode($messages);
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'senderId not provided'));
}
}
   
// -----END CHATTING SYSTEM BY VIDHI SHARMA ---------

}

  
