<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Translation_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->data = array();
  }
}