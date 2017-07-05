<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_orders extends Response_Model {
		public $payment_types = array('Gir bancari', 'Ticket Restaurant', 'Efectiu Dia', 'TPV Online','Empresa');
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
											->select('id, Total as total_price, reference_no, order_detail, order_type, order_date, payment_method')
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
											->select('clients.name, clients.client_code, business.name as business, orders.id, orders.order_date, orders.is_active, orders.Total')
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
											->select('clients.name, clients.client_code, business.name as business, centres.Centre, orders.id, orders.order_date, orders.is_active,  clients.telephone, clients.email, orders.order_type, orders.reference_no as reference_no, orders.payment_method, orders.client_id, orders.price,orders.menu_type_id as order_code, orders.order_detail, orders.Total')
											->join('clients', 'clients.id = orders.client_id', 'left')
											->join('business', 'business.id = clients.business_id', 'left')
											->join('centres', 'centres.Id = clients.centre_id', 'left')
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
											->select('clients.name, clients.client_code, business.name as business, orders.id, orders.order_date, orders.is_active, orders.menu_type_id as order_code, orders.order_detail, centres.Centre')
											->join('clients', 'clients.id = orders.client_id', 'left')
											->join('business', 'business.id = clients.business_id', 'left')
											->join('centres', 'centres.Id = clients.centre_id', 'left')
											->where('orders.client_id', $client_id)
											->where('orders.is_active', 1)
											->get()->result();
											
		return $orders_by_client_id;
	}
	/**
   * Function get_orders_by_date
   *
   * @return  Array
   * 
  */
	public function get_orders_by_date($order_date, $operator = '=', $limit = 25, $offset = 0, $search) {
		$orders_list_by_date = $this->mdl_orders
											->select('clients.name,clients.surname, clients.client_code, business.name as business, orders.id, orders.order_date, orders.payment_method,orders.reference_no as reference_no,orders.price, orders.is_active,orders.menu_type_id as order_code, orders.order_detail, centres.Centre, orders.drink1_id, orders.drink2_id')
											->join('clients', 'clients.id = orders.client_id', 'left')
											->join('business', 'business.id = clients.business_id', 'left')
											->join('centres', 'centres.Id = clients.centre_id', 'left')
											->where('orders.order_date '.$operator, $order_date)
											->where('orders.is_active', 1)
											->order_by('orders.id','desc');
		if ($limit != -1) {
			$orders_list_by_date->limit($limit, $offset);
		}

		if ($search) {
			$orders_list_by_date = $orders_list_by_date->group_start()
										->or_like('clients.client_code', $search)
										->or_like('orders.reference_no',$search)
										->group_end();
		}
		
		$orders_list_by_date = $orders_list_by_date->get()->result();

		return $orders_list_by_date;
	}

	/**
   * Function insert_from_temporary
   *
   * @return  Array
   * 
  */
	public function insert_from_temporary($payment_type = null, $discount) {
		
		$this->load->model('order_drinks/mdl_order_drinks');
		$this->load->model('formapago/mdl_formapago');
		$this->load->model('menu_types/mdl_menu_types');
    $menu_type_list = $this->mdl_menu_types->get_menu_type_id_list();
    
		
		$total_price = 0;
		$temporary_orders = $this->mdl_temporary_orders->get_client_today_menus();
		$temporary_order_ids = [];
		$reference_no = '';

 		foreach($temporary_orders as $key => $order) {
			$order_type = $order['order_title'];
			$price = $order['price'];
			$order_code = json_decode($order['order_detail'],true);
			$order_code = $order_code['order_code'];
			$menu_type = implode('',$order_code);
			$menu_type_id = $menu_type_list[$menu_type];
			$total_price += $order['Total'];
			$client_id = $this->session->userdata('client_id');
			//$data = array('client_id' => $client_id, 'order_detail' => $order['order_detail'], 'order_type' => $order_type, 'order_date' => $order['order_date'], 'price' => $price, 'payment_method' => 'Bank', 'menu_type_id'=>implode('', $order_code),'Total'=>$order['Total'], 'drink1_id'=>$order['drink1_id'],'drink2_id'=>$order['drink2_id'],'priced1'=>$order['priced1'],'priced2'=>$order['priced2']);
			$data = array('client_id' => $client_id, 'order_detail' => $order['order_detail'], 'order_type' => $order_type, 'order_date' => $order['order_date'], 'price' => $price, 'payment_method' => 'Bank', 'reference_no' => $reference_no, 'order_code'=>implode(',',$order_code), 'menu_type_id'=>$menu_type_id,'Total'=>$order['Total'], 'drink1_id'=>$order['drink1_id'],'drink2_id'=>$order['drink2_id'],'priced1'=>$order['priced1'],'priced2'=>$order['priced2']);
			$data['is_active'] = 0;
			$this->payment_types = $this->mdl_formapago->get_pay_list();
			$payment_id = array_search($payment_type, $this->payment_types);
			if ($payment_id) {
				$data['payment_method'] = $payment_type;
				$data['FormaPago_id'] = $payment_id;
			}


			$order_id = $this->mdl_orders->save(null, $data);
			
			if($key == 0) {
				
				//$reference_no = $client_id.''.strtotime(date('Y-m-d')).''.$order_id;
				$reference_no = $order_id;
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

		if ($discount) {
			$this->load->model('promotional_codes/mdl_promotional_codes');
			$qry = $this->db->where('id', $discount['id'])->get('promotional_codes');
			if($qry->num_rows()){
				$promo_code_record = current($qry->result_array());
			}
			if ($promo_code_record) {
				$result = $this->mdl_promotional_codes->calculateTotalPrice($total_price, $promo_code_record);
				if ($result) {
					$data = array('reference_no'=>$reference_no, 
								'promotional_code_id'=>$discount['id'],
								'original_total_price'=>$return_data['total_price'],
								'discount' => $result['discount'],
								'total_price' => $result['total_price'] );
					$this->db->insert('discount_applied', $data);
					$return_data['total_price'] = $result['total_price'];
				}
			}
		}
		
		return $return_data;
	}
	/**
   * Function insert_from_temporary
   *
   * @return  Array
   * 
  */
	public function check_today_menus_insert($payment_type = null, $discount) {
		
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
			$data = $this->mdl_orders->insert_from_temporary($payment_type, $discount);
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
		$total_income = $this->mdl_orders->select('count(price) as total_income, order_code')
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
		//only full_group_by_error
		$this->db->query("SET sql_mode =''");
		$orders = $this->mdl_orders
							->select('reference_no as reference_no, sum(Total) as total_price, order_detail, order_type, DATE(created_at) as ordered_date, payment_method')
							->limit($limit, $from)
							->order_by('created_at','desc')
							->group_by('reference_no')
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
	function get_count_of_orders($condition = NULL, $search = NULL) {
		if ($condition) {
			$this->mdl_orders = $this->mdl_orders->where($condition);	
		}
		if ($search) {
			$this->mdl_orders = $this->mdl_orders->join('clients', 'clients.id = orders.client_id', 'left');
			$this->mdl_orders = $this->mdl_orders->group_start()
										->or_like('clients.client_code', $search)
										->or_like('orders.reference_no',$search)
										->group_end();
		}
		$row = $this->mdl_orders->select('count(*) as count')->get()->row_array();
		return $row['count'];
	}

	function get_count_of_orders_pagination($condition){
		if ($condition) {
			$this->mdl_orders = $this->mdl_orders->where($condition);	
		}
		$count = $this->mdl_orders->select('count(*) as count')->group_by('reference_no')->get()->num_rows();
		return $count;
	}


	function updateBusinessIds() {
		$this->db->query("UPDATE tbl_clients t1 INNER JOIN tbl_centres t2 ON t1.centre_id = t2.id SET t1.business_id = t2.bussiness_id");
	}

	function referenceNoExists($reference_no, $client_id) {
		$result = $this->mdl_orders->where('reference_no',$reference_no)->where('client_id',$client_id)->get()->result();
		if ($result) {
			return true;
		} else {
			return false;
		}
	}
	/**
   * Get the order by user id amd month
   *
   * @return  Array
   * 
  */
	public function get_orders_by_user_month ($user_id, $month, $year) {

		$query = 
			$this->mdl_orders
				->select('clients.name as invoice_to, clients.surname, clients.client_code as code, business.name as business, orders.id, orders.order_date, orders.payment_method,orders.reference_no as reference_no, SUM(IF(tbl_discount_applied.id is null, tbl_orders.price, tbl_discount_applied.total_price)) as price, orders.is_active,orders.menu_type_id as order_code, orders.order_detail, centres.Centre, orders.drink1_id, orders.drink2_id, clients.telephone as phone')
				->join('clients', 'clients.id = orders.client_id', 'left')
				->join('business', 'business.id = clients.business_id', 'left')
				->join('discount_applied', 'discount_applied.reference_no = orders.reference_no', 'left')
				->join('centres', 'centres.Id = clients.centre_id', 'left')
				->where('MONTH(tbl_orders.order_date)', $month)
				->where('YEAR(tbl_orders.order_date)', $year)
				->where('orders.is_active', 1)
				->where('orders.client_id', $user_id)
				->group_by('orders.order_date')
				->order_by('orders.id','desc');
		
		$orders_list_by_month = $query->get()->result_array();

		return $orders_list_by_month;
	}
	/**
   * Get the order by company id amd month
   *
   * @return  Array
   * 
  */
	public function get_orders_by_business_month ($company_id, $month, $year, $offset = null) {
		/*
			SELECT tor.* FROM `tbl_orders` tor left join tbl_clients tc on tc.id = tor.client_id left join tbl_business tb on tb.id = tc.business_id   where tor.is_active=1 and tb.id = 1 and month(tor.order_date) = 03 and year(tor.order_date) = 2017  group by tor.client_id, tor.order_date
		*/
			
		$query = 
			$this->mdl_orders
				->select('clients.name,clients.surname, clients.client_code, business.name as business, orders.id, orders.order_date, orders.payment_method,orders.reference_no as reference_no, SUM(IF(tbl_discount_applied.id is null, tbl_orders.price, tbl_discount_applied.total_price)) as price, orders.is_active,orders.menu_type_id as order_code, orders.order_detail, centres.Centre, orders.drink1_id, orders.drink2_id, business.telephone as phone, business.CodiEmpresa as code, business.name as invoice_to')
				->join('clients', 'clients.id = orders.client_id', 'left')
				->join('business', 'business.id = clients.business_id', 'left')
				->join('discount_applied', 'discount_applied.reference_no = orders.reference_no', 'left')
				->join('centres', 'centres.Id = clients.centre_id', 'left')
				->where('MONTH(tbl_orders.order_date)', $month)
				->where('YEAR(tbl_orders.order_date)', $year)
				->where('orders.is_active', 1)
				->where('business.id', $company_id)
				->group_by(['orders.order_date', 'orders.client_id'])
				->order_by('orders.order_date','asc');
		if ($offset >= 0) {
			$query->limit(PDF_LIMIT, $offset);
		}
		
		$orders_list_by_month = $query->get()->result_array();

		return $orders_list_by_month;
	}

	/**
   * Get the order by company id amd month
   *
   * @return  Array
   * 
  */
	public function get_orders_by_business_month_count ($company_id, $month, $year) {
		$query = 
			$this->mdl_orders
				->select('clients.name,clients.surname, clients.client_code, business.name as business, orders.id, orders.order_date, orders.payment_method,orders.reference_no as reference_no, SUM(IF(tbl_discount_applied.id is null, tbl_orders.price, tbl_discount_applied.total_price)) as price, orders.is_active,orders.menu_type_id as order_code, orders.order_detail, centres.Centre, orders.drink1_id, orders.drink2_id, business.telephone as phone, business.CodiEmpresa as code, business.name as invoice_to')
				->join('clients', 'clients.id = orders.client_id', 'left')
				->join('business', 'business.id = clients.business_id', 'left')
				->join('discount_applied', 'discount_applied.reference_no = orders.reference_no', 'left')
				->join('centres', 'centres.Id = clients.centre_id', 'left')
				->where('MONTH(tbl_orders.order_date)', $month)
				->where('YEAR(tbl_orders.order_date)', $year)
				->where('orders.is_active', 1)
				->where('business.id', $company_id)
				->group_by(['orders.order_date', 'orders.client_id'])
				->order_by('orders.order_date','asc');
		
		$orders_list_by_month_count = $query->get()->num_rows();

		return $orders_list_by_month_count;
	}

}
?>
