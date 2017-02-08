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
			$price_orders = $post_params['select_order'];
			foreach($menu_orders as $menu_id => $order) {
				
				$typeCount = count($order);
				//echo $typeCount;die;
				if($typeCount == 2) {
					$order_type = 'both';
				} else {
					$order_type = $order[0];
				}
				
				$cool_drinks = json_encode($post_params['cool_drinks'][$menu_id]);
				
				$price = $price_orders[$menu_id];
				
				$data[] = array('menu_id' => $menu_id, 'order_date' => date('Y-m-d'), 'client_id' => $this->session->userdata('client_id'), 'order_type' => $order_type, 'cool_drinks_array' => $cool_drinks, 'price' => $price);
			}
			//print_r($data);die;
			if(count($data) > 0) {
				$this->db->insert_batch('temporary_orders', $data);
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
			$today_menus = $this->mdl_temporary_orders
													->select('temporary_orders.id, temporary_orders.order_date, temporary_orders.order_type, temporary_orders.menu_id, menus.menu_date, menus.menu_type_id, menus.complement, menus.primary_plate, menus.description_primary_plate, menus.secondary_plate, menus.description_secondary_plate, menus.postre, menus.full_price, menus.half_price, menu_types.menu_name, temporary_orders.cool_drinks_array, temporary_orders.price')
													->join('menus', 'menus.id = temporary_orders.menu_id', 'left')
													->join('menu_types', 'menu_types.id = menus.menu_type_id', 'left')
													->where(array('order_date' => date('Y-m-d'), 'client_id' => $this->session->userdata('client_id')))
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
}
?>
