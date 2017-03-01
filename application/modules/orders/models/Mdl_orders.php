<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_orders extends Response_Model {
		public $payment_types = array('Bank Draft', 'Ticket Restaurant');
    public $table               = 'orders';
    public $primary_key         = 'orders.id';
    public function default_order_by() {
        //$this->db->order_by('orders.id');
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
											->select('clients.name, clients.client_code, business.name as business, orders.id, orders.order_date, orders.is_active')
											->join('clients', 'clients.id = orders.client_id', 'left')
											->join('business', 'business.id = clients.business_id', 'left')
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
											->select('clients.name, clients.client_code, business.name as business, orders.id, orders.order_date, orders.is_active,  clients.telephone, clients.email, orders.order_type, orders.reference_no, orders.payment_method, orders.client_id, orders.price,orders.order_code, orders.order_detail')
											->join('clients', 'clients.id = orders.client_id', 'left')
											->join('business', 'business.id = clients.business_id', 'left')
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
											->select('clients.name, clients.client_code, business.name as business, orders.id, orders.order_date, orders.is_active, orders.order_code, orders.order_detail')
											->join('clients', 'clients.id = orders.client_id', 'left')
											->join('business', 'business.id = clients.business_id', 'left')
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
	public function get_orders_by_date($order_date, $operator = '=') {
		$orders_list_by_date = $this->mdl_orders
											->select('clients.name,clients.surname, clients.client_code, business.name as business, orders.id, orders.order_date, orders.payment_method,orders.reference_no,orders.price, orders.is_active,orders.order_code, orders.order_detail, centres.Centre')
											->join('clients', 'clients.id = orders.client_id', 'left')
											->join('business', 'business.id = clients.business_id', 'left')
											->join('centres', 'centres.Id = clients.centre_id', 'left')
											->where('orders.order_date '.$operator, $order_date)
											->order_by('orders.order_date','desc')
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
			
			$total_price += $order['Total'];
			$client_id = $this->session->userdata('client_id');
			$data = array('client_id' => $client_id, 'order_detail' => $order['order_detail'], 'order_type' => $order_type, 'order_date' => $order['order_date'], 'price' => $price, 'payment_method' => 'Bank', 'reference_no' => $reference_no, 'order_code'=>implode(',',$order_code), 'Total'=>$order['Total'], 'drink1_id'=>$order['drink1_id'],'drink2_id'=>$order['drink2_id'],'priced1'=>$order['priced1'],'priced2'=>$order['priced2']);
			$data['is_active'] = 0;
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
							'is_active'=>$data['is_active'],
							'Primer' => 0,
							'Segon' => 0,
							'created_at'=>date('Y:m:d H:i:s'),
							'updated_at'=>date('Y:m:d H:i:s'));
					if (isset($report['order']['Primer'])) {
						$reportData['Primer'] = $report['order']['Primer'];
					}
					if (isset($report['order']['Segon'])) {
						$reportData['Segon'] = $report['order']['Segon'];
					}
					$insertReportData[] = $reportData;
					if (isset($report['cool_drink'])) {
						foreach ($report['cool_drink'] as $drink_id) {
							$drinksData[] = array('order_id'=>$order_id,
												'drinks_id'=>$drink_id,
												'created_at'=>date('Y:m:d H:i:s'),
												'updated_at'=>date('Y:m:d H:i:s'));
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
		$this->load->model('menus/mdl_menus');
		$this->load->model('centres/mdl_centres');
		
		
		$selectedMenus = $this->mdl_temporary_orders->get_client_today_menus();

		$today_menus_removed = [];
		
		/*Check and remove the expired data from the temporary order table*/
		$left_time = 0;
		$centre_id = $this->session->userdata('centre_id');
	    $centreInfo = $this->mdl_centres->centreInfo($centre_id);
	    
	    if ($centreInfo) {
	      $time1 = strtotime($centreInfo->time_limit);
	      $time2 = time();
			if($time1 > $time2) {
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

	public function _findMenuType($order_code) {
		$order_code = explode(',',$order_code);
		$menu_type = '';
		switch (count($order_code)) {
			case 0:
				break;
			case 1:
				switch ($order_code[0]) {
					case 'N':
						$menu_type = lang('basic_menu');
						break;
					case 'R':
						$menu_type = lang('diet_menu');
						break;
					default:
						$menu_type = lang('medio_menu');
				}
				break;
			default:
				$order_code = array_unique($order_code);
				if (!in_array('N1', $order_code) && !in_array('N2', $order_code)) {
					$menu_type = lang('diet_menu');
				} elseif (!in_array('R1', $order_code) && !in_array('R2', $order_code)) {
					$menu_type = lang('basic_menu');
				} else {
					$menu_type = lang('combine_menu');
				}
		}
		return $menu_type;
	}

	public function get_payment_statistics_by_date($from_date, $to_date) {
		$total_income_by_payments = $this->mdl_orders->select('SUM(price) as total_income, payment_method')
										->where('order_date >=', $from_date)
										->where('order_date <=', $to_date)
										->where('is_active', 1)
										->group_by('payment_method')->get()->result();

		$payment_income = [];
		foreach ($total_income_by_payments as $payment) {
			$payment_income[$payment->payment_method] = $payment->total_income;
		}
		return $payment_income;
	}

	public function get_menu_statistics_by_date($from_date, $to_date) {
		$total_income = $this->mdl_orders->select('SUM(price) as total_income, order_code')
							->where('order_date >=', $from_date)
							->where('order_date <=', $to_date)
							->where('is_active', 1)
							->group_by('order_code')->get()->result();
		
		$menu_income = [lang('basic_menu')=>0,lang('diet_menu')=>0,lang('combine_menu')=>0,lang('medio_menu')=>0];
		foreach ($total_income as $income){
			$menu_income[$this->_findMenuType($income->order_code)] += $income->total_income;
		}
		return $menu_income;
	}

	public function setActive($reference_no) {
		//$this->db->query("UPDATE tbl_ SET menu_date = '$update_clone_date', created_at='$today';");
		$data = array('is_active'=>1);
		$this->db->where('reference_no',$reference_no);
		$this->db->update('orders', $data);
		$this->db->where('reference_no',$reference_no);
		$this->db->update('order_reports', $data);
	}

	/**
    * Function get_orders_by_pagination
   	*
   	* @return  Array
   	* 
  	*/
	public function get_orders_by_pagination($page=1, $limit=10, $condition = NULL) {
		$page = $page-1;
		if ($page < 0) {
			$page = 0;
		}
		$from = $page * $limit;
		$client_id = $this->session->userdata('client_id');
		if ($condition) {
			$this->mdl_orders = $this->mdl_orders->where($condition);	
		}
		$orders = $this->mdl_orders
							->select('id, price as total_price, reference_no, order_detail, order_type, order_date, payment_method')
							->limit($limit, $from)
							->order_by('order_date','desc')
							->get()
							->result_array();
		return $orders;
	}

	/**
    * Function get_count_of_orders
   	*
   	* @return  Integer
   	* 
  	*/
	function get_count_of_orders($condition = NULL) {
		if ($condition) {
			$this->mdl_orders = $this->mdl_orders->where($condition);	
		}
		$row = $this->mdl_orders->select('count(*) as count')->get()->row_array();
		return $row['count'];
	}


}
?>
