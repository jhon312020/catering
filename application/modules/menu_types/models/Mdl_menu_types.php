<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_menu_types extends Response_Model {
    public $table               = 'menu_types';
    public $primary_key         = 'menu_types.id';
    public function default_order_by() {
        $this->db->order_by('menu_types.id');
    }
    public function validation_rules() {
        return array(
            'menu_name' => array(
                'field' => 'menu_name',
                'label' => lang('menu_name'),
                'rules' => 'required'
            ),
        );
    }

    public function get_menu_type_id_list() {
      $menu_type_list = $this->mdl_menu_types
                                  ->select('menu_types.id, menu_types.CodiTipoMenu as code')
                                  ->where('menu_types.is_active', 1)
                                  ->get()->result_array();
      $menu_type_list = array_combine(array_column($menu_type_list, 'code'), array_column($menu_type_list, 'id'));
      //Adding this for key combination of R1N2
      $menu_type_list['N2R1'] =  $menu_type_list['R1N2'];
      return $menu_type_list;
      //echo '<pre>';print_r($menu_type_list);echo '</pre>';
    }
}
?>