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
		$params = $this->input->post();
		$from_date = date('Y-m-d', strtotime('-29 days'));
		$to_date = date('Y-m-d');
		if (isset($params['from_date']) && isset($params['to_date'])) {
			$from_date = $params['from_date'];
			$to_date = $params['to_date'];
		}
		$menu_income = $this->mdl_orders->get_menu_statistics_by_date($from_date, $to_date);
		$payment_income = $this->mdl_orders->get_payment_statistics_by_date($from_date, $to_date);
		$this->layout->set(array('menu_income' => $menu_income, 'payment_income' => $payment_income, 'from_date'=>$from_date, 'to_date'=>$to_date));
		$this->layout->buffer('content', 'statistics/index');
		$this->layout->render();
	}
}