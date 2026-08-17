<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller{
    
   public function __construct()
	{
    parent::__construct();
    $this->load->model('Chat_model');
	}
      
public function index(){
    if ($this->session->userdata('isLogin') == "loggedIn") {
        $data['case'] = "Chat";
        $data['users'] = $this->Chat_model->allUsers();
        $data['currentUserId'] = $this->session->userdata('id');
        $data['currentUserName'] = $this->session->userdata('firstname'); // Adjust this based on your userdata keys

        $this->load->view('adminpanel\chat\index', $data);
    } else if ($this->session->userdata('isLogin') == "screenlocked") {
        redirect("dashboardlock");
    } else {
        redirect("home");
    }
}



   public function sendMessage() {
      $postData = json_decode(file_get_contents('php://input'), true);
      $senderId = $this->session->userdata('id');
      $receiverId = $postData['receiverId'];
      $message = $postData['message'];
      print_r($message);
      $this->Chat_model->saveMessage($senderId, $receiverId, $message);
      $response = array('status' => 'success', 'message' => 'Message sent successfully');
      echo json_encode($response);
    }
    
    
    public function receiveMessages() {
        $receiverId = $this->session->userdata('id');
        $postData = json_decode(file_get_contents('php://input'), true);
        if (isset($postData['senderId'])) {
            $senderId = $postData['senderId'];
            $messages = $this->Chat_model->getMessages($receiverId, $senderId);
            header('Content-Type: application/json');
            echo json_encode($messages);
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'senderId not provided'));
        }
        }
}