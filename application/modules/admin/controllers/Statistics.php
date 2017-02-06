<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Statistics extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('menus/mdl_menus');
		$this->load->model('orders/mdl_orders');
		$this->load->model('menu_types/mdl_menu_types');
	}
	public function index() {
		$menu_types = $this->mdl_menu_types->get()->result();
		$menus = array();
		foreach($menu_types as $menu_type) {
			$total = $this->mdl_menus->where('menu_type_id', $menu_type->id)->get()->num_rows();
			$menus[$menu_type->id] = array('name' => $menu_type->menu_name, 'total' => $total);
		}
		$overall_total_menus = $this->mdl_menus->get()->num_rows();
		$total_income = $this->mdl_orders->select('SUM(price) as total_income')->where('is_active', 1)->get()->row()->total_income;
		
		$total_income_by_payments = $this->mdl_orders->select('SUM(price) as total_income, payment_method')->where('is_active', 1)->group_by('payment_method')->get()->result_array();
		//print_r($total_income_by_payments);die;
		$this->layout->set(array('menus' => $menus, 'overall_total_menus' => $overall_total_menus, 'total_income' => $total_income, 'total_income_by_payments' => $total_income_by_payments));
		$this->layout->buffer('content', 'statistics/index');
		$this->layout->render();
	}
}