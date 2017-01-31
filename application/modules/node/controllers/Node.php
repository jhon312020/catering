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
		$this->load->model('business/mdl_business');
    $this->load->vars(array('user_info'=>$this->session->get_userdata()));
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
    $method = strtolower($this->input->method(TRUE));
    if ($method == 'post') {
      if ($this->mdl_clients->run_validation('validation_rules_on_register_page')) {
        $data = $this->input->post();
        if (isset($data['terms'])){
          unset($data['terms']);
        }
        $data['password'] = md5($data['password']);
        $data['is_active'] = 0;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $id = $this->mdl_clients->save(null, $data);
        $this->session->set_flashdata('alert_success', lang('record_successfully_created'));
        redirect($this->uri->segment(1));
      } else {
        $this->session->set_flashdata('alert_error', validation_errors());
        redirect($this->uri->segment(1).'/register');
      }
    }
    $data_array = array(
      'list_of_business' => $this->mdl_business->select(['id','name'])->where('is_active', 1)->get()->result_array()
    );
    $this->load->view('layout/templates/register', $data_array);
  }
  
  public function listmenu() {
		if (!$this->session->userdata('user_name'))
			redirect($this->uri->segment(1));
		
    $data_array = array();
    $this->load->view('layout/templates/listmenu', $data_array);
  }
  
  public function menus() {
		if (!$this->session->userdata('user_name'))
			redirect($this->uri->segment(1));
		
    $data_array = array();
    $this->load->view('layout/templates/menus', $data_array);
  }
  
  public function payment() {
		if ($this->session->userdata('user_name'))
			redirect($this->uri->segment(1));
		
    $data_array = array();
    $this->load->view('layout/templates/payment', $data_array);
  }
  /**
   * Function profile
   *
   * @return  void
   * 
   */
  public function profile() {
		if (!$this->session->userdata('user_name'))
			redirect($this->uri->segment(1));
    $data_array = '';
    $this->load->view('layout/templates/profile', $data_array);
  }
  /**
   * Function contact
   *
   * @return  void
   * 
   */
  public function contact() {
    if (!$this->session->userdata('user_name'))
			redirect($this->uri->segment(1));
    $method = strtolower($this->input->method(TRUE));
    if ($method == 'post') {
        $this->load->library('email');
        $this->email->from($this->input->post('email'), $this->input->post('name'));
        $this->email->to($this->settings['site_email']); 
        $this->email->subject('Enquiry');
        $this->email->message($this->input->post('description'));
        if ($this->email->send()) {
          $this->session->set_flashdata('alert_success', lang('email_send'));
        } else {
          $this->session->set_flashdata('alert_fail', lang('server_error'));
        }
        redirect($this->uri->segment(1).'/contact');
    }
		$data_array = '';
    $this->load->view('layout/templates/contact', $data_array);
  }
  /**
   * Function contact
   *
   * @return  void
   * 
   */
  public function logout(){
    $this->session->sess_destroy();
    redirect($this->uri->segment(1));
  }
}
?>
