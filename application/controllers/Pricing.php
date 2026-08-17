<?php defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
class Pricing extends CI_Controller{
    
    public function __construct()
   	{
       parent::__construct();
       $this->load->model('pricing_model'); 
   	}

    public function getPricingList(){
        if($this->session->userdata('id') != null){
            $data = array();
            $pricingData = $this->pricing_model->getPricingData($_POST);
            $i = $_POST['start'];
            foreach($pricingData as $pricingValue){
            $i++;
            $data[] = array($i,$pricingValue->investigator_type,$pricingValue->unit,$pricingValue->rate,$pricingValue->time);
            }
            $output = array(    
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->pricing_model->countAllPricingData(),
                "recordsFiltered" => $this->pricing_model->countFilteredPricingData($_POST),
                "data" => $data,
            );
            echo json_encode($output);
        }else{
            redirect('user_logout');
        }
    }
}