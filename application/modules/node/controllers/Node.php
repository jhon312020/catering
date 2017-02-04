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
		$this->load->model('menus/mdl_menus');
		$this->load->model('orders/mdl_orders');
		$this->load->model('menu_types/mdl_menu_types');
		$this->load->model('temporary_orders/mdl_temporary_orders');
		
		if($this->session->userdata('client_id')) {
			$selectedMenus = $this->mdl_temporary_orders->get_client_today_menus();
			
			$todaySelectedMenus = [];
			foreach($selectedMenus as $menus) {
				$todaySelectedMenus[$menus['menu_id']] = $menus;
			}
			
			//print_r($todaySelectedMenus);die;
			
			$this->load->vars(array('todaySelectedMenus'=>$todaySelectedMenus));
		}
		
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
		
		if ($this->mdl_clients->run_validation('validation_rules_clients_login')) {
      $data = $this->mdl_clients->check_clients($this->input->post());
			if ($data) {
				redirect(PAGE_LANGUAGE.'/profile');
			} else {
				redirect(PAGE_LANGUAGE);
			}
		}
    $res = array();
    
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
        redirect(PAGE_LANGUAGE);
      } else {
        $this->session->set_flashdata('alert_error', validation_errors());
        redirect(PAGE_LANGUAGE.'/register');
      }
    }
    $data_array = array(
      'list_of_business' => $this->mdl_business->select(['id','name'])->where('is_active', 1)->get()->result_array()
    );
    $this->load->view('layout/templates/register', $data_array);
  }
  
  public function listmenu() {
		
    $data_array = array();
    $this->load->view('layout/templates/listmenu', $data_array);
  }
  /**
   * Function menus
   *
   * @return  void
   * 
  */
  public function menus() {
		
		$menuDate = date('Y-m-d');
    $data_array = array();
		
		if($this->input->post()) {
			$postParams = $this->input->post();
			
			$menuDate = date('Y-m-d', strtotime($postParams['menu_date']));
		}
		
		$menu_list = $this->mdl_menus->get_menus_by_date($menuDate);
		
		$data_array['menu_types'] = $this->mdl_menu_types->get()->result_array();
		
		$data_menu = [];
		
		//Set menu_type_id as key in all menus list.
		foreach($menu_list as $menus) {
			$data_menu[$menus['menu_type_id']][] = $menus;
		}
		$data_array['menu_lists'] = $data_menu;
		$data_array['menu_date'] = date('d-m-Y', strtotime($menuDate));
    $this->load->view('layout/templates/menus', $data_array);
  }
	/**
   * Function addMenu
   *
   * @return  void
   * 
  */
  public function addMenu() {
		
		$purchasedItems = $this->input->post('select_food');
		
		$menuListIds = json_decode($this->input->post('menu_list_ids'), true);
		
		//print_r($menuListIds);die;
		//print_r($purchasedItems);die;
		
		if($purchasedItems) {
			$purchase_ids = array_keys($purchasedItems);
			$ids = array_diff($menuListIds, $purchase_ids);
			//print_r($ids);die;
			if($ids) {
				$this->mdl_temporary_orders->order_delete($ids);
				
				$menuListIds = array_diff($purchase_ids, $ids);
			}
			$this->mdl_temporary_orders->order_exists_update_or_insert($menuListIds, $purchasedItems, $purchase_ids);
			
		} else {
			
			//print_r($menuListIds);die;
			$this->mdl_temporary_orders->order_delete($menuListIds);
		}
		
		redirect(PAGE_LANGUAGE.'/payment');
	}
  public function payment() {
		
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
        redirect(PAGE_LANGUAGE.'/contact');
    }
		$data_array = '';
    $this->load->view('layout/templates/contact', $data_array);
  }
	/**
   * Function clientPayment
   *
   * @return  void
   * 
   */
  public function clientPayment() {
		
		$disabledMenus = $this->mdl_menus->check_disabled_menus_selected_orders();
		if($disabledMenus) {
			
		}
		
		$this->load->view('layout/templates/orders', $data_array);
  }
	/**
   * Function orders
   *
   * @return  void
   * 
   */
  public function orders() {
		
		$data_array['orders'] = $this->mdl_orders->get_orders_by_client_date();
		
		$this->load->view('layout/templates/orders', $data_array);
  }
	
  /**
   * Function Logout
   *
   * @return  void
   * 
   */
  public function logout(){
    $this->session->sess_destroy();
    redirect(PAGE_LANGUAGE);
  }
}
?>
