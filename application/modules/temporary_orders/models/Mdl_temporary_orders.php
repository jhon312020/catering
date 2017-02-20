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
			$order_code = [];
			
			$totalPrice = 0;
			foreach ($menus as $menu) {
				$data = [];
				
				if (count($menu_orders[$menu['id']]) == 2) {
					$data['price'] = $menu['full_price'];
					$data['order_type'] = 'full';
					$data['menu_id'] = $menu['id'];
				} else {
					$data['price'] = $menu['half_price'];
					$data['order_type'] = 'half';
					$data['menu_id'] = $menu['id'];
				}

				$orders = [];
				$orders = $menu_orders[$menu['id']];
				$orders['Guarnicio'] = $menu['Guarnicio'];
				$orders['Postre'] = $menu['Postre'];
				$data['order'] = $orders;
				if (array_key_exists('Primer', $orders) && !array_key_exists('Segon', $orders)) {
					if ($menu['menu_type_id'] == 1) {
						$order_code[] = 	'N1';
					} else {
						$order_code[] = 	'R1';
					}
				} elseif (!array_key_exists('Primer', $orders) && array_key_exists('Segon', $orders)) {
					if ($menu['menu_type_id'] == 1) {
						$order_code[] = 	'N2';
					} else {
						$order_code[] = 	'R2';
					}
				} elseif (array_key_exists('Primer', $orders) && array_key_exists('Segon', $orders)) {
					if ($menu['menu_type_id'] == 1) {
						$order_code[] = 	'N';
					} else {
						$order_code[] = 	'R';
					}					
				}

				if (isset($post_params['cool_drinks'][$menu['id']])) {
		          $cool_drinks = json_encode($post_params['cool_drinks'][$menu['id']]);
					foreach ($post_params['cool_drinks'][$menu['id']] as $cool_drink) {
						$data['price'] += $cool_drink_list[$cool_drink]['price'];
						$data['cool_drink'][] = $cool_drink_list[$cool_drink]['id'];
					}
		        }

				$totalPrice += $data['price'];
				$selectedMenus[$menu['menu_type_id']]['menu_type_id'] = $menu['menu_type_id'];
				$selectedMenus[$menu['menu_type_id']][] = $data;
			}
			if (count($selectedMenus) > 1) {
				$order_title = 	'combine';
			} else {
				$order_title = 	'single';
			}
			$selectedMenus['totalPrice'] = $totalPrice;
			$selectedMenus['order_code'] = $order_code;
			$selectedMenus = json_encode($selectedMenus);
			
			$insert[] = array( 'order_date' => date('Y-m-d',strtotime($post_params['order_date'])), 'client_id' => $this->session->userdata('client_id'), 'order_title' => $order_title, 'order_detail'=>$selectedMenus, 'price' => $totalPrice);



			//$price_orders = $post_params['select_order'];
			//$cool_drink_list = $this->mdl_drinks->get_cool_drink_list();
			/*foreach($menu_orders as $menu_id => $order) {
				$price = 0;
				$menuObject = $this->mdl_menus->get_menu_by_id($menu_id);
				$typeCount = count($order);
				
				if($typeCount == 2) {
					$order_type = 'both';
					$price = $menuObject->full_price;
				} else {
					$order_type = $order[0];
					$price = $menuObject->half_price;
				}
				
		        if (isset($post_params['cool_drinks'][$menu_id])) {
		          $cool_drinks = json_encode($post_params['cool_drinks'][$menu_id]);
							foreach ($post_params['cool_drinks'][$menu_id] as $cool_drink) {
								$price += $cool_drink_list[$cool_drink];
							}
		        } else {
		          $cool_drinks = '';
		        }
				
				$data[] = array('menu_id' => $menu_id, 'order_date' => $menuObject->menu_date, 'client_id' => $this->session->userdata('client_id'), 'order_type' => $order_type, 'cool_drinks_array' => $cool_drinks, 'price' => $price);
			}*/
			
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
