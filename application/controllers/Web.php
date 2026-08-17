<?php 
class Web extends CI_Controller{
public function __construct()
{ 
    parent::__construct();
    $this->data = array();
    $this->load->model('company_model', 'company');
}
    /**
     * @function
     * User Index Page bydefault
     * Post data through ajax.
     * Created by Arpit Singh Dated:25-06-2022
     */
    public function index(){
        $this->load->view("web/index");
    }

    public function termsandcondition(){
        $this->load->view("web/termsandcondition");
    }

    public function privacypolicy(){
        $this->load->view("web/privacypolicy");
    }

    public function refundpolicy(){
        $this->load->view("web/refundpolicy");
    }

    // for the redirection to profile page (BY NANDINI)
    public function user_profile()
    {
        $data = $this->input->post();
        $user_id = $this->session->userdata('id');
        $userdata['departments'] = $this->company->fetchDepartmentNamesByCorporateId(0, $user_id);
        if (!empty($userdata['departments'][0])) {
            $data_array = [
                'defaultcompany' => "0",
                'defaultdepartment' => $userdata['departments'][0]['id'],
                'usertype' => $userdata['departments'][0]['usertype']
            ];
            $json_data = json_encode($data_array);
            $encrypted_json = base64_encode($this->encryption->encrypt($json_data));
            $url = base_url('profilemanagement') . '?data=' . $encrypted_json;
            redirect($url);
        }
    }
}