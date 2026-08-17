<?php defined('BASEPATH') or exit('No direct script access allowed');
class Admin_model extends CI_Model
{
  public $formattedDateTime;
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('array');
    $this->load->helper('date');
    date_default_timezone_set('Asia/Kolkata');
    $currentDateTime = now();
    $this->formattedDateTime = date('d-m-Y H:i:s', $currentDateTime);
  }
}