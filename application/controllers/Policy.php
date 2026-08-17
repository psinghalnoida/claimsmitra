<?php 
class Policy extends CI_Controller{
    public function __construct()
   	{
       parent::__construct();
       $this->load->library('form_validation');
       $this->load->model('Policy_model');
   	}
    public function index(){
        $this->load->view("adminpanel/policy/policylist");
    }
    public function getpolicylist(){
    $data = $row = array();
    $policyData = $this->Policy_model->getRows($_POST);
    $i = $_POST['start'];
    foreach($policyData as $policy){
      $i++;
      $created = date( 'jS M Y', strtotime($policy->createdAt));
      $status = ($policy->status == 1)?'<span class="label label-success">Active</span>':'<span class="label label-warning">Inactive</span>';
      $typeofpolicy = $policy->typeofpolicy;
      $policyno = $policy->policyno;
      $policystartdate = $policy->policystartdate;
      $policyenddate = $policy->policyenddate;
      $premiun = $policy->premiun;
      $action = '<div class="dropleft">
                  <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                  <div class="dropdown-menu">
                    <a href="#largeModal" data-toggle="modal" onClick="policybyid('.$policy->id.')" class="dropdown-item">View</a>
                    <a href="#" class="dropdown-item">Unblock</a>
                  </div>
                </div>';
      $data[] = array($i,$policy->salutation." ".$policy->firstname." ".$policy->lastname,$policyno, $typeofpolicy,$policystartdate,$policyenddate, $premiun,$status,$created,$action);
    }
    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->Policy_model->countAll(),
      "recordsFiltered" => $this->Policy_model->countFiltered($_POST),
      "data" => $data,
    );
    echo json_encode($output);
    }


    public function getpolicybyid(){
        if($_POST){
            $data = array();
            $policyid = $this->input->post('id');   
            $policydata = $this->Policy_model->getpolicydatabyid($policyid);
            foreach ($policydata  as  $policy) {
                $data = array("images"=>json_decode($policy->images));
            }
            echo json_encode($data);
        }else{
            $response = array('status'=>false,'data'=>"404 Page not found");
            echo json_encode($response);
        }
    }
        
}