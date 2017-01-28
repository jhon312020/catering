<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Node Controller for frontend pages
 *
 * @return  void
 * 
 */
class Node extends Anonymous_Controller {
  /**
   * class constructor
   *
   * @return  void
   * 
   */
  public function __construct() {
    parent::__construct();
		$this->load->model('clients/mdl_clients');
  }
  
  /**
   * Function index
   *
   * @return  void
   * 
   */
  public function index($lang = 'es') {
		$this->display_home($lang);
  }
  
  /**
   * Function display_home
   *
   * @return  void
   * 
   */
  public function display_home($lang) {
		if ($this->session->userdata('user_name'))
			redirect($this->uri->segment(1).'/profile');
		
		if ($this->mdl_clients->run_validation('validation_rules_clients_login')) {
      $data = $this->mdl_clients->check_clients($this->input->post());
			if ($data) {
				redirect($this->uri->segment(1).'/profile');
			} else {
				redirect("es");
			}
		}
    $res = array();
    $ln = $this->uri->segment(1);
    if ($ln == '')
      redirect("es");
    
    $this->load->view('layout/templates/login', $res);
  }

	/**
   * Function register
   *
   * @return  void
   * 
   */
  public function register() {
		$message = '';
    if ($this->session->userdata('user_name'))
			redirect($this->uri->segment(1).'/profile');
      
		if ($this->mdl_clients->run_validation('validation_rules_client_register')) {
      $data = $this->input->post();
			$data['password'] = md5($data['password']);
			$data['password_key'] = base64_encode($data['password'].'_catering');
			$id = $this->mdl_clients->save(null, $data);
      echo $message = 'Succesfully registered';
		} 
    $data_array = array();
    $this->load->view('layout/templates/register', $data_array);
  }
  
  public function listmenu() {
		if ($this->session->userdata('user_name'))
			redirect($this->uri->segment(1));
		
    $data_array = array();
    $this->load->view('layout/templates/listmenu', $data_array);
  }
  
  public function menu() {
		if ($this->session->userdata('user_name'))
			redirect($this->uri->segment(1));
		
    $data_array = array();
    $this->load->view('layout/templates/menu', $data_array);
  }
  
  public function payment() {
		if ($this->session->userdata('user_name'))
			redirect($this->uri->segment(1));
		
    $data_array = array();
    $this->load->view('layout/templates/payment', $data_array);
  }
  
  public function profile() {
		if ($this->session->userdata('user_name'))
			redirect($this->uri->segment(1));
		
    $data_array = array();
    $this->load->view('layout/templates/profile', $data_array);
  }
  
  public function contact() {
		if ($this->session->userdata('user_name'))
			redirect($this->uri->segment(1));
		
    $this->load->view('layout/templates/contact');
  }
}
?>
