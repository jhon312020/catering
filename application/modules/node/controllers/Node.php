<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Node extends Anonymous_Controller {
  public function __construct() {
    parent::__construct();
  }

  public function index($lang = 'es') {
		$this->display_home($lang);
  }
  
  public function display_home($lang) {
    $res = array();
    $ln = $this->uri->segment(1);
    if ($ln == '')
      redirect("en");
    
    $this->load->view('layout/templates/login', $res);
  }

  public function register() {
    $data_array = array();
    $this->load->view('layout/templates/register', $data_array);
  }
  
  public function listmenu() {
    $data_array = array();
    $this->load->view('layout/templates/listmenu', $data_array);
  }
  
  public function menu() {
    $data_array = array();
    $this->load->view('layout/templates/menu', $data_array);
  }
  
  public function payment() {
    $data_array = array();
    $this->load->view('layout/templates/payment', $data_array);
  }
  
  public function profile() {
    $data_array = array();
    $this->load->view('layout/templates/profile', $data_array);
  }
  
  public function contact() {
    $this->load->view('layout/templates/contact');
  }
}
?>
