<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Dashboard Controller 
 * for admin user
 * 
 */

class Dashboard extends Admin_Controller {

	/**
   * class constructor
   *
   * @return  void
   * 
   */
  public function __construct() {
		parent::__construct();
		$this->load->model('settings/mdl_settings');
	}
  
  /**
   * Function index
   * Displays the dashboard page
   *
   * @return  void
   * 
   */
	public function index() {
		$this->load->model('business/mdl_business');
		$this->load->model('clients/mdl_clients');
		$this->load->model('orders/mdl_orders');

		$total_clients = $this->mdl_clients->get()->num_rows();
		$total_business = $this->mdl_business->get()->num_rows();
		$today_menus =  $this->mdl_orders->where(array('order_date' => date('Y-m-d'), 'is_active'=>1))->get()->num_rows();
		$total_orders =  $this->mdl_orders->where(array('is_active'=>1))->get()->num_rows();

		$data = array(
			'today_menus' => $today_menus,
			'total_clients' => $total_clients,
			'total_business' => $total_business,
			'total_orders' => $total_orders,
		);
		$this->layout->set($data);
		$this->layout->buffer('content', 'admin/index');
		$this->layout->render();
	}
	
  /**
   * Set the Language
   *
   * @return  redirect to referrer 
   * or dashboard page
   */
	public function set_lang($lang) {
		if(trim($lang) == "english") {
			$lang = "spanish";
		} else if (trim($lang) == "spanish") {
			$lang = "english";
		}
		$newdata = array(
			'cms_lang'  => $lang,
		);
		//print_r($newdata);die();
		$this->session->set_userdata($newdata);
		$this->load->library('user_agent');
		$referrer = $this->agent->referrer();
    if (!empty($referrer)) {
      redirect($referrer);
    } else{
      redirect('admin/dashboard');
    }
	}
}
?>
