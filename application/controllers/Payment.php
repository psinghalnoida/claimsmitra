<?php defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Payment extends CI_Controller{
    
    public function __construct()
	{
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('payment_model');
      $this->load->model('home_model');
	}

    public function index(){
      
    }
    public function getWallet(){
        if($this->session->userdata('id') != null){
            if($_POST){
                $data = array();
                $payindata = $this->payment_model->getRows($_POST);
                $i = $_POST['start'];
                foreach($payindata as $value){
                    $i++;
                    $data[] = array($value['aid'],
                                    $value['investigator_type'],
                                    '₹ ' . $value['totalamount'],
                                    '₹ ' . $value['pavablepeg'],
                                    '₹ ' . $value['balanceamount'],
                                    '₹ ' . $value['totaltds'],
                                    $value['paymentat'],);
                }
                $output = array(    
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->payment_model->countAll(),
                    "recordsFiltered" => $this->payment_model->countFiltered($_POST),
                    "data" => $data,
                );
                echo json_encode($output);
            }else{
                $data['case'] = 'Wallet';
                $this->load->view('adminpanel/payment/wallet', $data);
            }
            }else{
                redirect('user_logout');
            }
    }

    public function addMoney(){
        if($this->session->userdata('id') != null){
            if($this->input->method() == "post"){

            }else{
                $data['case'] = "Add Money";
                $this->load->view('adminpanel/payment/addmoney', $data);
            }
        }else{
            redirect('user_logout');
        }
    }
   
    public function incomingpayment(){
        if($this->session->userdata('id') != null){
            if($_POST){
                $data = array();
                $payindata = $this->payment_model->getRows($_POST);
                $i = $_POST['start'];
                foreach($payindata as $value){
                    $i++;
                    $data[] = array($value['aid'],
                                    $value['investigator_type'],
                                    '₹ ' . $value['totalamount'],
                                    '₹ ' . $value['pavablepeg'],
                                    '₹ ' . $value['balanceamount'],
                                    '₹ ' . $value['totaltds'],
                                    $value['paymentat'],);
                }
                $output = array(    
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->payment_model->countAll(),
                    "recordsFiltered" => $this->payment_model->countFiltered($_POST),
                    "data" => $data,
                );
                echo json_encode($output);
            }else{
                $data['case'] = 'Incoming Payment';
                $this->load->view('adminpanel/payment/incomingpayment', $data);
            }
            }else{
                redirect('user_logout');
            }
    }


    public function getbalanceamount(){
        if($this->session->userdata('id') != null){
            if($_POST){
                $data = array();
                $payindata = $this->payment_model->getBalanceRows($_POST);
                $i = $_POST['start'];
                foreach($payindata as $value){
                    $i++;
                    $data[] = array(
                                $value['aid'],
                                $value['investigator_type'],
                                '₹ ' . $value['totalamount'],
                                '₹ ' . $value['receivedamount'],
                                '₹ ' . $value['balanceamount'],
                                '<button onclick="payduepayment('.$value['aid'].')" class="btn btn-rounded btn-success">Make Payment</button>');
                }
                $output = array(    
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->payment_model->countBalanceAll(),
                    "recordsFiltered" => $this->payment_model->countBalanceFiltered($_POST),
                    "data" => $data,
                );
                echo json_encode($output);
            }else{
                $data['case'] = 'Balance Payment';
                $this->load->view('adminpanel/payment/balanceamount', $data);
            }
        }else{
            redirect('user_logout');
        }
    }

}