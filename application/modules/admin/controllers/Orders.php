<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Orders extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('orders/mdl_orders');
		$this->load->model('menus/mdl_menus');
	}

	public function index() {
		$order_date = date('Y-m-d');
		if($this->input->post()) {
			$order_date = date('Y-m-d', strtotime($this->input->post('order_date')));
			//Inorder to re-direct to same page on deleting the orders used the below conditiona
		} else if ($this->session->userdata('last_viewed_order_date')) {
			$order_date = $this->session->userdata('last_viewed_order_date');
			$this->session->unset_userdata('last_viewed_order_date');
		}
		
		$orders = $this->mdl_orders->get_orders_by_date($order_date);
		
		$this->layout->set(array('orders' => $orders, 'order_date' => $order_date));
		$this->layout->buffer('content', 'orders/index');
		$this->layout->render();
	}
	public function form($id = NULL) {
		$error_flg = false;
		$error = array();
		$order = $this->mdl_orders->get_orders_list_by_id($id);
		if ($this->input->post('btn_cancel')) {
			$this->session->set_userdata(array('last_viewed_order_date'=>$order->order_date));
			redirect('admin/orders');
		}
		
		// $order = $this->mdl_orders->get_orders_list_by_id($id);
		
		if($this->input->post('btn_submit')) {
			$post_params = $this->input->post();
			if($post_params['primary_plate'] == '' && $post_params['secondary_plate'] == '') {
				$error[] = 'Atleast select one plate';
			} else {
				
				$data = array('reference_no' => $order->reference_no, 'order_date' => $order->order_date, 'payment_method' => $order->payment_method, 'client_id' => $order->client_id);
				
				if($post_params['primary_plate'] == $post_params['secondary_plate']) {
					$menu_by_id = $this->mdl_menus->get_menu_by_id($post_params['primary_plate']);
					//print_r($menu_by_id);die;
					if($menu_by_id->id) {
						$data['menu_id'] = $post_params['primary_plate'];
						$data['order_type'] = 'both';
						$data['price'] = $menu_by_id->full_price;
						$this->mdl_orders->save(null, $data);
					}
				} else {
					if($post_params['primary_plate'] != '') {
						$menu_by_id = $this->mdl_menus->get_menu_by_id($post_params['primary_plate']);
						//print_r($menu_by_id);die;
						if($menu_by_id->id) {
							$data['menu_id'] = $post_params['primary_plate'];
							$data['order_type'] = 'primary';
							$data['price'] = $menu_by_id->half_price;
							$this->mdl_orders->save(null, $data);
						}
					}
					if($post_params['secondary_plate'] != '') {
						$menu_by_id = $this->mdl_menus->get_menu_by_id($post_params['secondary_plate']);
						//print_r($menu_by_id);die;
						if($menu_by_id->id) {
							$data['menu_id'] = $post_params['secondary_plate'];
							$data['order_type'] = 'secondary';
							$data['price'] = $menu_by_id->half_price;
							$this->mdl_orders->save(null, $data);
						}
					}
				}
				$this->mdl_orders->delete($id);
				redirect('admin/orders');
			}
		}
		
		if ($id and !$this->input->post('btn_submit')) {
			$this->mdl_orders->prep_form($id);
		}
		
		$menus_by_date = $this->mdl_menus->get_menus_by_date($order->order_date);
		
		$primary = array('' => 'Select');
		$secondary = array('' => 'Select');
		foreach($menus_by_date as $menu) {
			$primary[$menu['id']] = $menu['primary_plate'];
			$secondary[$menu['id']] = $menu['secondary_plate'];
		}
		
		$this->layout->set(array('readonly'=>false, 'error'=>$error, 'order' => $order, 'primary' => $primary, 'secondary' => $secondary));
		$this->layout->buffer('content', 'orders/form');
		$this->layout->render();
	}
	public function view($id) {
		$error_flg = false;
		$error = array();
		$order = $this->mdl_orders->get_orders_list_by_id($id);
		if ($this->input->post('btn_cancel')) {
			redirect('admin/orders');
		}
		$this->mdl_orders->prep_form($id);
		
		$menus_by_date = $this->mdl_menus->get_menus_by_date($order->order_date);
		
		$primary = array('' => 'Select');
		$secondary = array('' => 'Select');
		foreach($menus_by_date as $menu) {
			$primary[$menu['id']] = $menu['primary_plate'];
			$secondary[$menu['id']] = $menu['secondary_plate'];
		}
		
		$this->layout->set(array('readonly'=>true, 'error'=>$error, 'order' => $order, 'primary' => $primary, 'secondary' => $secondary));
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
		$order_date = $this->mdl_orders->get_order_date_by_id($id);
		if ($order_date) {
			$this->session->set_userdata(array('last_viewed_order_date'=>$order_date));
		}
		$this->mdl_orders->delete($id);
		redirect('admin/orders');
	}
}