<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Orders extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('orders/mdl_orders');
	}

	public function index() {
		$orders = $this->mdl_orders
							->select('clients.name, clients.client_code, business.name as business, orders.id, orders.order_date, orders.is_active, menu_types.menu_name')
							->join('clients', 'clients.id = orders.client_id', 'left')
							->join('business', 'business.id = clients.business_id', 'left')
							->join('menus', 'menus.id = orders.menu_id', 'left')
							->join('menu_types', 'menus.menu_type_id = menu_types.id', 'left')
							->get()->result();
		$this->layout->set(array('orders' => $orders));
		$this->layout->buffer('content', 'orders/index');
		$this->layout->render();
	}
	public function form($id = NULL) {
		$error_flg = false;
		$error = array();
		if ($this->input->post('btn_cancel')) {
			redirect('admin/orders');
		}
		if($this->input->post('btn_submit')) {
			$this->mdl_orders->save($id,$data);
			redirect('admin/orders');
		}
		
		if ($id and !$this->input->post('btn_submit')) {
			$this->mdl_orders->prep_form($id);
		}
		$this->layout->set(array('readonly'=>false, 'error'=>$error));
		$this->layout->buffer('content', 'orders/form');
		$this->layout->render();
	}
	public function view($id) {
		$error_flg = false;
		$error = array();
		if ($this->input->post('btn_cancel')) {
			redirect('admin/collaborators');
		}
		$this->mdl_orders->prep_form($id);
		$this->layout->set(array('readonly'=>true, 'error'=>$error));
		$this->layout->buffer('content', 'orders/form');
		$this->layout->render();
	}
	public function toggle($id, $bool){
		if ($id){
			$bool = ($bool) ? false : true;
			$this->mdl_orders->save($id, array('is_active'=>$bool));
			redirect('admin/orders');
		}
	}
	public function delete($id) {
		$this->mdl_orders->delete($id);
		redirect('admin/orders');
	}
}