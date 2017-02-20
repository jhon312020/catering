<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_orders extends Response_Model {
		public $payment_types = array('Bank Draft', 'Ticket Restaurant');
    public $table               = 'orders';
    public $primary_key         = 'orders.id';
    public function default_order_by() {
        $this->db->order_by('orders.id');
    }
    public function validation_rules() {
        return array(
            'client_code' => array(
                'field' => 'client_code',
                'label' => lang('client_code'),
                'rules' => 'required'
            ),
        );
    }
		/**
   * Function get_order_by_client
   *
   * @return  Array
   * 
  */
		public function get_orders_by_client_date() {
			$client_id = $this->session->userdata('client_id');
			/*$orders_client_by_date = $this->mdl_orders
											->select('id, ref_order.total_price, ref_order.reference_no, order_detail, order_type, order_date, payment_method')
											->join('(SELECT reference_no, SUM(price) as total_price FROM tbl_orders where is_active = 1 and client_id = '.$client_id.' GROUP BY reference_no) as ref_order', 'ref_order.reference_no = tbl_orders.reference_no', 'inner')
											->where(array('is_active' => 1, 'client_id' => $client_id))
											->group_by('reference_no')
											->get()
											->result_array();*/
			$orders_client_by_date = $this->mdl_orders
											->select('id, price as total_price, reference_no, order_detail, order_type, order_date, payment_method')
											->where(array('is_active' => 1, 'client_id' => $client_id))
											->get()
											->result_array();
			
			return $orders_client_by_date;
		}

	/**
	* Function get_orders_by_ref_no
	*
	* @return  Array
	* 
	*/
	public function get_orders_by_ref_no($reference_no) {
		/*$orders_client_by_ref_no = $this->mdl_orders
										->select('orders.id, orders.order_date, orders.order_type, orders.menu_id, menus.menu_date, menus.menu_type_id, menus.complement, menus.primary_plate, menus.description_primary_plate, menus.secondary_plate, menus.description_secondary_plate, menus.postre, menus.full_price, menus.half_price, menu_types.menu_name, orders.payment_method, orders.price, (SELECT GROUP_CONCAT(drinks_id) from tbl_order_drinks where order_id = tbl_orders.id) as drinks_id')
										->join('menus', 'menus.id = orders.menu_id', 'left')
										->join('menu_types', 'menu_types.id = menus.menu_type_id', 'left')
										->where(array('orders.is_active' => 1, 'orders.client_id' => $this->session->userdata('client_id'), 'orders.reference_no' => $reference_no))
										->get()
										->result_array();*/
		$orders_client_by_ref_no = $this->mdl_orders
										->where(array('is_active' => 1, 'client_id' => $this->session->userdata('client_id'), 'reference_no' => $reference_no))
										->get()
										->result_array();
		return $orders_client_by_ref_no;
	}
	
	/**
   * Function get_orders_list
   *
   * @return  Array
   * 
  */
	public function get_orders_list() {
		$orders_list = $this->mdl_orders
											->select('clients.name, clients.client_code, business.name as business, orders.id, orders.order_date, orders.is_active, menu_types.menu_name')
											->join('clients', 'clients.id = orders.client_id', 'left')
											->join('business', 'business.id = clients.business_id', 'left')
											->join('menus', 'menus.id = orders.menu_id', 'left')
											->join('menu_types', 'menus.menu_type_id = menu_types.id', 'left')
											->get()->result();
											
		return $orders_list;
	}
	/**
   * Function get_orders_list
   *
   * @return  Array
   * 
  */
	public function get_orders_list_by_id($order_id) {
		$order_list = $this->mdl_orders
											->select('clients.name, clients.client_code, business.name as business, orders.id, orders.order_date, orders.is_active, menu_types.menu_name, clients.telephone, clients.email, orders.order_type, orders.menu_id, orders.reference_no, orders.payment_method, orders.client_id, orders.price')
											->join('clients', 'clients.id = orders.client_id', 'left')
											->join('business', 'business.id = clients.business_id', 'left')
											->join('menus', 'menus.id = orders.menu_id', 'left')
											->join('menu_types', 'menus.menu_type_id = menu_types.id', 'left')
											->where('orders.id', $order_id)
											->get()->row();
											
		return $order_list;
	}
	/**
   * Function get_orders_by_client_id
   *
   * @return  Array
   * 
  */
	public function get_orders_by_client_id($client_id) {
		$orders_by_client_id = $this->mdl_orders
											->select('clients.name, clients.client_code, business.name as business, orders.id, orders.order_date, orders.is_active, menu_types.menu_name')
											->join('clients', 'clients.id = orders.client_id', 'left')
											->join('business', 'business.id = clients.business_id', 'left')
											->join('menus', 'menus.id = orders.menu_id', 'left')
											->join('menu_types', 'menus.menu_type_id = menu_types.id', 'left')
											->where('orders.client_id', $client_id)
											->get()->result();
											
		return $orders_by_client_id;
	}
	/**
   * Function get_orders_by_date
   *
   * @return  Array
   * 
  */
	public function get_orders_by_date($order_date) {
		$orders_list_by_date = $this->mdl_orders
											->select('clients.name,clients.surname, clients.client_code, business.name as business, orders.id, orders.order_date, orders.payment_method,orders.reference_no,orders.price, orders.is_active, menu_types.menu_name')
											->join('clients', 'clients.id = orders.client_id', 'left')
											->join('business', 'business.id = clients.business_id', 'left')
											->join('menus', 'menus.id = orders.menu_id', 'left')
											->join('menu_types', 'menus.menu_type_id = menu_types.id', 'left')
											->where('orders.order_date', $order_date)
											->get()->result();
											
		return $orders_list_by_date;
	}
	/**
   * Function insert_from_temporary
   *
   * @return  Array
   * 
  */
	public function insert_from_temporary($payment_type = null) {
		
		$this->load->model('order_drinks/mdl_order_drinks');
		
		$total_price = 0;
		$temporary_orders = $this->mdl_temporary_orders->get_client_today_menus();
		$temporary_order_ids = [];
		$reference_no = '';

 		foreach($temporary_orders as $key => $order) {
			$order_type = $order['order_title'];
			$price = $order['price'];
			$order_code = json_decode($order['order_detail'],true);
			$order_code = $order_code['order_code'];
			
			$total_price += $price;
			$client_id = $this->session->userdata('client_id');
			$data = array('client_id' => $client_id, 'order_detail' => $order['order_detail'], 'order_type' => $order_type, 'order_date' => $order['order_date'], 'price' => $price, 'payment_method' => 'Bank', 'reference_no' => $reference_no, 'order_code'=>implode(',',$order_code));
			if (in_array($payment_type, $this->payment_types)) {
				$data['is_active'] = 1;
				$data['payment_method'] = $payment_type;
			}


			$order_id = $this->mdl_orders->save(null, $data);
			
			if($key == 0) {
				$reference_no = $client_id.''.strtotime(date('Y-m-d')).''.$order_id;
				$this->mdl_orders->save($order_id, array('reference_no' => $reference_no));
			}

			$order['order_detail'] = json_decode($order['order_detail'],true);

			unset($order['order_detail']['totalPrice']);
			unset($order['order_detail']['order_code']);

			$insertReportData = [];
			$drinksData = [];
			foreach ($order['order_detail'] as $menu_types) {
				foreach ($menu_types as $report) {
					if (!is_array($report)) {
						continue;
					}
					$reportData = array('order_id'=>$order_id, 
							'reference_no'=>$reference_no,
							'menu_id'=>$report['menu_id'],
							'is_active'=>$data['is_active']);
					if (isset($report['menu_id']['order']['Primer'])) {
						$reportData['Primer'] = $report['menu_id']['order']['Primer'];
					}
					if (isset($report['menu_id']['order']['Segon'])) {
						$reportData['Segon'] = $report['menu_id']['order']['Segon'];
					}
					$insertReportData[] = $reportData;
					if (isset($report['cool_drink'])) {
						foreach ($report['cool_drink'] as $drink_id) {
							$drinksData[] = array('order_id'=>$order_id,'drinks_id'=>$drink_id);
						}
					}	
				}
			}

			if ($drinksData) {
				$this->db->insert_batch('tbl_order_drinks', $drinksData);
			}

			if ($insertReportData) {
				$this->db->insert_batch('tbl_order_reports', $insertReportData);
			}
			
			/*$cool_drinks = json_decode($order['cool_drinks_array'], true);
			
			$drinks_data = array();
			if(count($cool_drinks) > 0) {
				foreach($cool_drinks as $drinks) {
					$drinks_data[] = array('order_id' => $order_id, 'drinks_id' => $drinks);
				}
				
				$this->db->insert_batch('order_drinks', $drinks_data);
			}*/
			
			$temporary_order_ids[] = $order['id'];
		}
		
		if(count($temporary_order_ids) > 0) {
			$this->mdl_temporary_orders->order_delete_using_id($temporary_order_ids);
		}
		
		$return_data = array('total_price' => number_format($total_price, 2), 'reference_no' => $reference_no);
		
		return $return_data;
	}
	/**
   * Function insert_from_temporary
   *
   * @return  Array
   * 
  */
	public function check_today_menus_insert($payment_type = null) {
		
		$this->load->model('temporary_orders/mdl_temporary_orders');
		$this->load->model('business/mdl_business');
		$this->load->model('menus/mdl_menus');
		
		$selectedMenus = $this->mdl_temporary_orders->get_client_today_menus();

		$today_menus_removed = [];
		
		/*Check and remove the expired data from the temporary order table*/
		$business_id = $this->session->userdata('business_id');
		
		$businessInfo = $this->mdl_business->businessInfo($business_id);
		
		$left_time = 0;
		
	    if ($businessInfo) {
	      $time1 = strtotime($businessInfo->time_limit);
				
	      $time2 = time();
				
				if ($time1 > $time2) {
					$left_time = ($time1 - $time2);
				}
	    }

		if ($left_time == 0) {
			$menus = $this->mdl_menus->select('id')->where('menu_date', date('Y-m-d'))->get()->result_array();
			$menus_id = array_column($menus, 'id');
			
			$selectedMenusIds = array_column($selectedMenus, 'menu_id');
			
			$menusExists = array_intersect($menus_id, $selectedMenusIds);
			
			if(count($menusExists) > 0) {
				$today_orders_removed = $this->mdl_temporary_orders->get_order_ids_by_menu_id($menusExists);
				$this->mdl_temporary_orders->order_delete($menusExists);
			}
		}
		
		if(count($today_menus_removed) > 0) {
			return array('success' => false, 'msg' => 'Today menus expired', 'order_ids' => array_column($today_orders_removed, 'id'));
		} else {
			$data = $this->mdl_orders->insert_from_temporary($payment_type);
			return array('success' => true, 'msg' => 'Order successfully placed', 'order_data' => $data);
		}
	}
	
	/**
   * Function get_orders_by_client_id
   *
   * @return  Array
   * 
  */
	public function get_order_date_by_id($order_id) {
		$order_date = null; 
		$order_object = $this->mdl_orders
											->select('orders.order_date')
											->where('orders.id', $order_id)
											->get()->row();
		if ($order_object) {
			$order_date = $order_object->order_date;
		}
		return $order_date;
	}
}
?>
