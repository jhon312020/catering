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
														->select('SUM(price) as total_price, reference_no, menu_id, order_type, order_date, payment_method')
														->where(array('is_active' => 1, 'client_id' => $this->session->userdata('client_id')))
														->group_by('order_date')
														->get()
														->result_array();
			
			return $orders_client_by_date;
		}
}
?>