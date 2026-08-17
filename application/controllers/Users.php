<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->data = array();
    $this->load->model('user_model');
  }

  public function index(){
    if($this->session->userdata('isLogin') == "loggedIn") {
      $this->load->view("adminpanel/users/users");
    }else if($this->session->userdata('isLogin') == "screenlocked"){
        redirect("dashboardlock");
    }else{
        redirect("home");
    }
    //$this->load->view("adminpanel/users/users");
  }



  public function getuserslist(){
    if($this->session->userdata('id') != null){
      $data = array();
      // Fetch member's records
      $userData = $this->user_model->getRows($_POST);
      $i = $_POST['start'];
      foreach($userData as $userValue){
          $i++;
          $case_status = null;
          if($userValue->is_active == 0){
              $case_status = '<span class="label label-warning">Inactive</span>';
          }else{
              $case_status = '<span class="label label-success">Active</span>';
          }
          $action = '<div class="dropleft">
                          <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                          <div class="dropdown-menu">
                              <a href="'.base_url().'job/viewcase/'.$userValue->id.'" class="dropdown-item">View</a>
                              <a href="#" class="dropdown-item">Reject</a>
                              <a href="#" class="dropdown-item">Archive</a>
                          </div>
                          <i class="fa fa-mobile" style="color:#e16123; margin-left:10px; font-size:25px" aria-hidden="true"></i>
                      </div>';
          $username = '<a href="#">'.$userValue->salutation." ".$userValue->firstname." ".$userValue->lastname . '</a>';
          $profession = '<span>Insured</span>';
          $created = date( 'Y/m/d H:i', strtotime($userValue->createdat));
          $data[] = array($userValue->id,
              nl2br($username ."\n" . '<span style="color:#2bb3c0">'.$userValue->mobile.'</span>'),
              $profession,
              $created,
              $case_status,
              '<input type="checkbox" id="toggle-one" onclick="allowforMobile('.$userValue->id.');" data-toggle="toggle" data-on="Enabled" data-off="Disabled">',
              '<a href="javascript:void(0);" onclick="liveLocation('.$userValue->id.')" id="'.$userValue->id.'" ><i class="fa fa-map-marker" style="color:#000000; margin-left:10px; font-size:25px" aria-hidden="true"></i></a>');
      }
      
      $output = array(    
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->user_model->countAll(),
          "recordsFiltered" => $this->user_model->countFiltered($_POST),
          "data" => $data,
      );
      echo json_encode($output);
    }else{
    redirect('user_logout');
    }
  }    

  public function userLocation($userid){
      echo json_encode($this->user_model->getLocationById($userid));
  }

  // public function allowformobile(){
  //   $userId = $this->input->post('userId');
  //   $result = $this->user_model->allowforappById($userId);
  //   if($result){
      
  //   }
  // }
}