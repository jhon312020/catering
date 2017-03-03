<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_preus extends Response_Model {
    public $table               = 'preus';
    public $primary_key         = 'preus.id';
    public function default_order_by() {
        $this->db->order_by('preus.id');
    }
  
    public function get_price_list($tarifa_id = 1) {
      $price_list = $this->mdl_preus
																	->select('menu_types.CodiTipoMenu as code, preus.Preu')
																	->join('menu_types', 'menu_types.id = preus.menu_type_id', 'left')
																	->where('preus.is_active', 1)
																	->where('preus.tarifa_id', $tarifa_id)
																	->get()->result_array();
      $price_list = array_combine(array_column($price_list, 'code'), array_column($price_list, 'Preu'));
      //Adding this for key combination of R1N2
      $price_list['N2R1'] =  $price_list['R1N2'];
      return $price_list;
      //echo '<pre>';print_r($price_list);echo '</pre>';
    }
}
?>
