<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_orders extends Response_Model {
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
			$orders_client_by_date = $this->mdl_orders
																	->select('id, SUM(price) as total_price, reference_no, menu_id, order_type, order_date, payment_method')
																	->where(array('is_active' => 1, 'client_id' => $this->session->userdata('client_id')))
																	->group_by('reference_no')
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
																	->select('orders.id, orders.order_date, orders.order_type, orders.menu_id, menus.menu_date, menus.menu_type_id, menus.complement, menus.primary_plate, menus.description_primary_plate, menus.secondary_plate, menus.description_secondary_plate, menus.postre, menus.full_price, menus.half_price, menu_types.menu_name, orders.payment_method, orders.price')
																	->join('menus', 'menus.id = orders.menu_id', 'left')
																	->join('menu_types', 'menu_types.id = menus.menu_type_id', 'left')
																	->where(array('orders.is_active' => 1, 'orders.client_id' => $this->session->userdata('client_id'), 'orders.reference_no' => $reference_no))
																	->group_by('orders.reference_no')
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
											->select('clients.name, clients.client_code, business.name as business, orders.id, orders.order_date, orders.is_active, menu_types.menu_name, clients.telephone, clients.email, orders.order_type, orders.menu_id, orders.reference_no, orders.payment_method, orders.client_id')
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
											->select('clients.name, clients.client_code, business.name as business, orders.id, orders.order_date, orders.is_active, menu_types.menu_name')
											->join('clients', 'clients.id = orders.client_id', 'left')
											->join('business', 'business.id = clients.business_id', 'left')
											->join('menus', 'menus.id = orders.menu_id', 'left')
											->join('menu_types', 'menus.menu_type_id = menu_types.id', 'left')
											->where('orders.order_date', $order_date)
											->get()->result();
											
		return $orders_list_by_date;
	}
	/**
   * Function insert_from_temperory
   *
   * @return  Array
   * 
  */
	public function insert_from_temperory() {
		$total_price = 0;
		$temperory_orders = $this->mdl_temporary_orders->get_client_today_menus();
		$temperory_order_ids = [];
		$reference_no = '';
		foreach($temperory_orders as $key => $order) {
			$order_type = $order['order_type'];
			$price = $order['half_price'];
			if($order_type == 'both') {
				$price = $order['full_price'];
			}
			
			$total_price += $price;
			$data = array('client_id' => $order['client_id'], 'menu_id' => $order['menu_id'], 'order_type' => $order_type, 'order_date' => date('Y-m-d'), 'price' => $price, 'payment_method' => 'Bank', 'reference_no' => $reference_no);
			
			$order = $this->mdl_orders->save(null, $data);
			
			if($key == 0) {
				$reference_no = $order->client_id.''.date('d').''.$order->id;
				$this->mdl_orders->save($order->id, $reference_no);
			}
			
			$cool_drinks = json_decode($order['cool_drinks_array'], true);
			
			$drinks_data = array();
			if(count($cool_drinks) > 0) {
				foreach($cool_drinks as $drinks) {
					$drinks_data[] = array('order_id' => $order->id, 'drinks_id' => $drinks);
				}
				
				$this->mdl_order_drinks->insert($drinks_data);
			}
			
			$temperory_order_ids[] = $order['id'];
		}
		
		$this->mdl_temporary_orders->order_delete_using_id($temperory_order_ids);
		
		$return_data = array('total_price' => $total_price);
		
		return $return_data;
	}
	
}
?>