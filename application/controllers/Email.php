<?php defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
require_once APPPATH . 'libraries/stripe-php/init.php';

class Email extends CI_Controller{
    
    public function __construct()
   	{
        parent::__construct();
        $this->load->library('email');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Case_model','case_model');
   	}

    // public function index(){
    //     $data['view'] = "Email Configuration";
    //     $this->load->view('adminpanel/setting/email_configuration',$data);
    // }

    public function send_email()
    {
        $this->form_validation->set_rules('smtp_host', 'SMTP Host', 'required');
        $this->form_validation->set_rules('smtp_port', 'SMTP Port', 'required|numeric');
        $this->form_validation->set_rules('smtp_user', 'SMTP User', 'required|valid_email');
        $this->form_validation->set_rules('smtp_pass', 'SMTP Password', 'required');
        $this->form_validation->set_rules('to_email', 'Recipient Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            // Form validation failed
            $data = array(
                'success' => false,
                'message' => validation_errors()
            );
            echo json_encode($data);
            return;  
        } else {
            // Get form data
            $smtp_host = $this->input->post('smtp_host');
            $smtp_port = $this->input->post('smtp_port');
            $smtp_user = $this->input->post('smtp_user');
            $smtp_pass = $this->input->post('smtp_pass');
            $to_email = $this->input->post('to_email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            // Email configuration
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => $smtp_host,
                'smtp_port' => $smtp_port,
                'smtp_user' => $smtp_user,
                'smtp_pass' => $smtp_pass,
                'mailtype'  => 'html', 
                'charset'   => 'iso-8859-1',
                'smtp_crypto' => 'tls',
            );

            $this->email->initialize($config);
            $this->email->set_newline("\r\n");

            // Email content
            $this->email->from($smtp_user, 'Adwiti');
            $this->email->to($to_email);
            $this->email->subject($subject, 'Testing email');
            $this->email->message($message,'This is testing mail');

            // Send email
            if($this->email->send()) {
                $data = array(
                    'success' => true,
                    'message' => 'Email sent successfully.'
                );
            } else {
                $data = array(
                    'success' => false,
                    'message' => 'Failed to send email. ' . $this->email->print_debugger()
                );
            }
            echo json_encode($data); 
            return;
            
        }
    }
   
    /*
    * Email Settings (NANDINI)
    */
    public function emailSetting(){
        if ($this->session->userdata('id') != null) {
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
            
                    $data = [
                        'defaultcompany' => $defaultcompany,
                        'defaultdepartment' => $defaultdepartment,
                        'usertype' => $usertype,
                        'fields' => $this->case_model->get_field_names(),
                        'surveyors' => $this->case_model->get_survey_names(),
                        'view' => "Email Configuration",
                    ];
                    $this->load->view("emailsetting/settings", $data);
                }
            }    
            // $data['view'] = "Email Configuration";
            // $this->load->view('emailsetting/settings', $data);
        }
        else{
            redirect('user_logout');
        }
    }

    public function save_email()
    {
        $data = [
            'host' => $this->input->post('smtp_host'),
            'port' => $this->input->post('smtp_port'),
            'encryption' => $this->input->post('smtp_crypto'),
            'username' => $this->input->post('smtp_user'),
            'password' => $this->input->post('smtp_pass'),
        ];
        $result = $this->case_model->save_email_config($data);
        if ($result) {
            $response = [
                'success' => true,
                'message' => 'Email configuration saved successfully!'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to save email configuration!'
            ];
        }
        echo json_encode($response);
    }
    
   
}