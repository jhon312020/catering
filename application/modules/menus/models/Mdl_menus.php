<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_menus extends Response_Model {
    public $table               = 'menus';
    public $primary_key         = 'menus.id';
    public function default_order_by() {
        $this->db->order_by('menus.id');
    }
    public function validation_rules() {
        return array(
            'complement' => array(
                'field' => 'complement',
                'label' => lang('complement'),
                'rules' => 'required'
            ),
            'primary_plate' => array(
                'field' => 'primary_plate',
                'label' => lang('primary_plate'),
                'rules' => 'required'
            ),
						'description_primary_plate' => array(
                'field' => 'description_primary_plate',
                'label' => lang('description_primary_plate'),
                'rules' => 'required'
            ),
						/* 'primary_image' => array(
                'field' => 'primary_image',
                'label' => lang('primary_image'),
                'rules' => 'required'
            ), */
            'secondary_plate' => array(
                'field' => 'secondary_plate',
                'label' => lang('secondary_plate'),
                'rules' => 'required'
            ),
						'description_secondary_plate' => array(
                'field' => 'description_secondary_plate',
                'label' => lang('description_secondary_plate'),
                'rules' => 'required'
            ),
						/* 'secondary_image' => array(
                'field' => 'secondary_image',
                'label' => lang('secondary_image'),
                'rules' => 'required'
            ), */
						'postre' => array(
                'field' => 'postre',
                'label' => lang('postre'),
                'rules' => 'required'
            ),
						'half_price' => array(
                'field' => 'half_price',
                'label' => lang('half_price'),
                'rules' => 'required|numeric'
            ),
						'full_price' => array(
                'field' => 'full_price',
                'label' => lang('full_price'),
                'rules' => 'required|numeric'
            ),
        );
    }
		/**
   * Function get_menus_by_date
   *
   * @return  Array
   * 
  */
		public function get_menus_by_date($date) {
			$menus_by_date = $this->mdl_menus->where(array('menu_date' => $date, 'disabled' => 0))->get()->result_array();
			
			return $menus_by_date;
		}
		/**
   * Function get_menu_by_id
   *
   * @return  Array
   * 
  */
		public function get_menu_by_id($id) {
			$menu_by_id = $this->mdl_menus->where(array('id' => $id))->get()->row();
			
			return $menu_by_id;
		}
  /**
   * Function getClientOrders
   * 
   * 
   * 
   */
  public function getClientOrders() {
    $clientId = $this->session->userdata('client_id');
    $this->mdl_menus->select('SUM(total) AS price');
    $this->mdl_menus->where('`id` NOT IN (SELECT `menu_id` FROM `tbl_temporary_orders` WHERE `client_id` ='.$clientId.')', NULL, FALSE);
    echo $this->mdl_menus->get();
    echo $this->db->last_query();
    exit;											
    return $today_menus;
  }
}
?>
