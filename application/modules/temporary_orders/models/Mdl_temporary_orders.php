<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_temporary_orders extends Response_Model {
    public $table               = 'temporary_orders';
    public $primary_key         = 'temporary_orders.id';
    public function default_order_by() {
        $this->db->order_by('temporary_orders.id');
    }
    public function validation_rules() {
     
    }
		/**
		 * Function order_delete
		 *
		 * @return  Bool
		 * 
		*/
		public function order_delete($id) {
			if(is_array($id)) {
				$qry = $this->db->where_in('menu_id', $id);
			} else {
				$qry = $this->db->where('menu_id', $id);
			}
			$qry->where(array('client_id' => $this->session->userdata('client_id'), 'order_date' => date('Y-m-d')))
					->delete('temporary_orders');
			
			return true;
		}
		/**
		 * Function order_delete
		 *
		 * @return  Bool
		 * 
		*/
		public function order_delete_using_id($id) {
			if(is_array($id)) {
				$qry = $this->db->where_in('id', $id);
			} else {
				$qry = $this->db->where('id', $id);
			}
			$qry->delete('temporary_orders');
			
			return true;
		}
		/**
		 * Function insert_temporary_orders
		 *
		 * @return  Array
		 * 
		*/
		public function insert_temporary_orders($post_params) {
			$data = [];
			$menu_orders = $post_params['select_food'];
			if (isset($post_params['cool_drinks'])){
				$cool_drink_lists = $this->mdl_drinks->select('id, drinks_name, price')->get()->result_array();
				$cool_drink_list = [];
				foreach ($cool_drink_lists as $list) {
					$cool_drink_list[$list['id']] = $list;
				}
			}

			$menu_ids = array_keys($menu_orders);
			$menus = $this->mdl_menus->where_in('id',$menu_ids)->get()->result_array();
			$selectedMenus = [];
			$drink1_id = 0;
			$drink2_id = 0;
			$priced1 = 0.00;
			$priced2 = 0.00;
			$order_code = [];
			$this->load->model('preus/mdl_preus');
			$price_list = $this->mdl_preus->get_price_list($this->session->userdata('Tarifa_id'));
			
			$totalPrice = $price_list[$post_params['order_code']];
			foreach ($menus as $menu) {
				$data = [];
				if (count($menu_orders[$menu['id']]) == 2) {
					$data['order_type'] = 'full';
					$data['menu_id'] = $menu['id'];
				} else {
					$data['order_type'] = 'half';
					$data['menu_id'] = $menu['id'];
				}
				$orders = [];
				$orders = $menu_orders[$menu['id']];
				$orders['Guarnicio'] = $menu['Guarnicio'];
				$orders['Postre'] = $menu['Postre'];
				$data['order'] = $orders;
				if (isset($post_params['cool_drinks'][$menu['id']])) {
		          $cool_drinks = json_encode($post_params['cool_drinks'][$menu['id']]);
					foreach ($post_params['cool_drinks'][$menu['id']] as $cool_drink) {
						$totalPrice += $cool_drink_list[$cool_drink]['price'];
						$data['cool_drink'][] = $cool_drink_list[$cool_drink]['id'];
						if ($drink1_id == 0) {
							$drink1_id = $cool_drink;
							$priced1 = $cool_drink_list[$cool_drink]['price'];
						} else if ($drink2_id == 0){
							$drink2_id = $cool_drink;
							$priced2 = $cool_drink_list[$cool_drink]['price'];
						}
					}
		        }
				$selectedMenus[$menu['menu_type_id']]['menu_type_id'] = $menu['menu_type_id'];
				$selectedMenus[$menu['menu_type_id']][] = $data;
			}
			//print_r($post_params['order_code']); 
			if (count($selectedMenus) > 1) {
				$order_title = 	'combine';
			} else {
				$order_title = 	'single';
			}
			$selectedMenus['totalPrice'] = $totalPrice;
			$order_code = [];
			if (strlen($post_params['order_code']) == 1 || strlen($post_params['order_code']) == 2) {
				$order_code[] = $post_params['order_code'];
			} else {
				$order_code[] = substr($post_params['order_code'],0,2);
				$order_code[] = substr($post_params['order_code'],2,2);
			}
			//print_r($order_code); exit;
			$selectedMenus['order_code'] = $order_code;
			$selectedMenus = json_encode($selectedMenus);
			
			$insert[] = array( 'order_date' => date('Y-m-d',strtotime($post_params['order_date'])), 'client_id' => $this->session->userdata('client_id'), 'order_title' => $order_title, 'order_detail'=>$selectedMenus, 'price' => $totalPrice-($priced1+$priced2), 'Total'=>$totalPrice, 'drink1_id'=>$drink1_id, 'drink2_id'=>$drink2_id, 'priced1'=>$priced1, 'priced2'=>$priced2);

			if(count($data) > 0) {
				$this->db->insert_batch('temporary_orders', $insert);
			}
			
			return true;
		}
		/**
   * Function get_client_today_menus
   *
   * @return  Array
   * 
  */
		public function get_client_today_menus() {
			/*$today_menus = $this->mdl_temporary_orders
													->select('temporary_orders.id, temporary_orders.order_date, temporary_orders.order_type, temporary_orders.menu_id, menus.menu_date, menus.menu_type_id, menus.complement, menus.primary_plate, menus.description_primary_plate, menus.secondary_plate, menus.description_secondary_plate, menus.postre, menus.full_price, menus.half_price, menu_types.menu_name, temporary_orders.cool_drinks_array, temporary_orders.price')
													->join('menus', 'menus.id = temporary_orders.menu_id', 'left')
													->join('menu_types', 'menu_types.id = menus.menu_type_id', 'left')
													->where(array('date(tbl_temporary_orders.created_at)' => date('Y-m-d'), 'client_id' => $this->session->userdata('client_id')))
													->get()
													->result_array();*/
			$today_menus = $this->mdl_temporary_orders->where(array('date(created_at)' => date('Y-m-d'), 'client_id' => $this->session->userdata('client_id')))
													->get()
													->result_array();
														
			return $today_menus;
		}
    
  /**
   * Function getClientOrders
   * 
   * 
   * 
   */
  public function getClientOrders() {
    $today_orders = $this->mdl_temporary_orders
													->select('temporary_orders.id, temporary_orders.order_type, menus.full_price, menus.half_price, temporary_orders.price')
													->join('menus', 'menus.id = temporary_orders.menu_id', 'left')
													->join('menu_types', 'menu_types.id = menus.menu_type_id', 'left')
													->where(array('order_date' => date('Y-m-d'), 'client_id' => $this->session->userdata('client_id')))
													->get()
													->result_array();		
    return $today_orders;
  }
	/**
   * Function get_order_ids_by_menu_id
   * 
   * 
   * 
   */
  public function get_order_ids_by_menu_id($menu_ids) {
		$orders_id = $this->mdl_temporary_orders->select('id')
											->where_in('menu_id', $menu_ids)
											->where('client_id', $this->session->userdata('client_id'))
											->get()->result_array();
											
		return $orders_id;
	}
	
}
?>
