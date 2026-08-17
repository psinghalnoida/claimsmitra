<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chat_model extends CI_Model{

  public function __construct(){
    parent::__construct();

  }
  public function allUsers()
  {
    $this->db->select('id,salutation, firstname, lastname, profilephoto');
    $userid = $this->session->userdata('id');
    $data = $this->db->get('claims_users');
    if ($data->num_rows() > 0) {
        return $data->result_array();
    } else {
        return false;
    }
  }


  public function saveMessage($senderId, $receiverId, $message)
    {
        $data = array(
            'sender_message_id' => $senderId,
            'receiver_message_id' => $receiverId,
            'message' => $message,
            'time' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('user_messages', $data);
    }
    public function getMessages($receiverId, $senderId) {
      $this->db->select('message, time');
      $this->db->from('user_messages');
      $this->db->where('receiver_message_id', $receiverId);
      $this->db->where('sender_message_id', $senderId);
      $this->db->order_by('time', 'asc'); 
      $query = $this->db->get();
      
      $result = $query->result_array();
      return $result;
  }
  
}