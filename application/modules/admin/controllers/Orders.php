<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Orders extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('orders/mdl_orders');
		$this->load->model('menus/mdl_menus');
		$this->load->model('plats/mdl_plats');
		$this->load->model('drinks/mdl_drinks');
	}

	public function index() {
		$this->load->helper("order_helper");
		$order_date = date('Y-m-d');
		$past = 0;
		$params = $this->input->post();
		if (isset($params['order_date'])) {
			$order_date = $params['order_date'];
			$this->session->set_userdata('order_date',$order_date);
		} else {
			if ($this->session->userdata('order_date')) {
				$order_date = $this->session->userdata('order_date');
			}
		}
		$export_title = "GC_Pedidos_";
		$export_title .= date('d-m-Y' , strtotime($order_date));

		$this->layout->set(array('orders' => [], 'order_date' => $order_date, 'export_title'=>$export_title,'past'=>0));
		$this->layout->buffer('content', 'orders/index');
		$this->layout->render();
	}

	public function past() {
		$this->load->helper("order_helper");
		$order_date = date('Y-m-d');
		if (isset($params['order_date'])) {
			$order_date = $params['order_date'];
			$this->session->set_userdata('order_date',$order_date);
		} else {
			if ($this->session->userdata('order_date')) {
				$order_date = $this->session->userdata('order_date');
			}
		}
		$export_title = "GC_Pedidos_".date('d-m-Y' , strtotime($order_date));
		$this->layout->set(array('orders' => [], 'order_date' => $order_date, 'export_title'=>$export_title,'past'=>1));
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
		//$this->mdl_orders->prep_form($id);
		
		/*$menus_by_date = $this->mdl_menus->get_menus_by_date($order->order_date);
		
		$primary = array('' => 'Select');
		$secondary = array('' => 'Select');
		foreach($menus_by_date as $menu) {
			$primary[$menu['id']] = $menu['Primer'];
			$secondary[$menu['id']] = $menu['Segon'];
		}*/
		$plates = $this->mdl_plats->get_plat_list();
		$cool_drink_list = $this->mdl_drinks->get_cool_drink_list();
		$this->layout->set(array('readonly'=>true, 'error'=>$error, 'order' => $order, 'plates'=>$plates, 'cool_drink_list'=>$cool_drink_list));
		$this->layout->buffer('content', 'orders/view');
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

	public function datasource() {
		$this->load->helper("order_helper");
		$params = $this->input->post();
		$drinks_list = $this->mdl_drinks->get_cool_drink_list();

		$order_date = $params['order_date'];
		$past = $params['past'];

		if ($past) {
			$orders = $this->mdl_orders->get_orders_by_date($order_date,'<', $params['length'],$params['start']);
			$condition = array('order_date <'=>$order_date, 'is_active'=>1);
			$totalRecords = $this->mdl_orders->get_count_of_orders($condition);
		} else {
			$orders = $this->mdl_orders->get_orders_by_date($order_date,'=', $params['length'],$params['start']);
			$condition = array('order_date'=>$order_date, 'is_active'=>1);
			$totalRecords = $this->mdl_orders->get_count_of_orders($condition);
		}

		$datas = [];
		foreach ($orders as $order) {
			$data = [];
			$data[] = $order->client_code . '<br/>Order Ref : '. $order->reference_no;
			$data[] = date('d/m/Y', strtotime($order->order_date));
			$data[] = $order->name . ' ' . $order->surname;
			$data[] = $order->business.' - '.$order->Centre;
			$data[] = $order->payment_method;
			$data[] = str_replace(',','',$order->order_code);
			$data[] = getDrinksInformation($order, $drinks_list);
			$actionHtml = sprintf('<a class="btn btn-info btn-sm" href="%s"><i class="entypo-eye"></i></a>',site_url('admin/orders/view/' . $order->id));
			$actionHtml .= sprintf('<a class="btn btn-danger btn-sm" href="%s" onclick="return confirm('.lang("delete_record_warning").');" ><i class="entypo-trash"></i></a>',site_url('admin/orders/delete/' . $order->id));
			$data[] = $actionHtml;
			$datas[] = $data;
		}

		$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $datas
		);
		echo json_encode($json_data);
	}

}