<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_drinks extends Response_Model {
    public $table               = 'cool_drinks';
    public $primary_key         = 'cool_drinks.id';
    public function default_order_by() {
        $this->db->order_by('cool_drinks.id');
    }
    public function validation_rules() {
			return array('price' => array(
						'field' => 'price',
						'label' => lang('price'),
						'rules' => 'required|numeric'
				),
			);
    }
		/**
   * Function get_cool_drinks
   *
   * @return  Array
   * 
  */
		public function get_cool_drinks() {
			$cool_drinks = $this->mdl_drinks->where(array('is_active' => 1))->get()->result();
			
			return $cool_drinks;
		}
}
?>
