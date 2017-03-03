<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_tarifes extends Response_Model {
    public $table               = 'tarifes';
    public $primary_key         = 'tarifes.id';
    public function default_order_by() {
        $this->db->order_by('tarifes.id');
    }
    public function validation_rules() {
        return array(
            'Tarifa' => array(
                'field' => 'Tarifa',
                'label' => lang('tarifa'),
                'rules' => 'required'
            ),
        );
    }
    
    public function get_tarifa_list() {
      $tarifa_list = $this->mdl_tarifes->select('id, Tarifa')->get()->result_array();
      return $tarifa_list = array(''=>'Select') + array_combine(array_column($tarifa_list, 'id'), array_column($tarifa_list, 'Tarifa'));
    }
}
?>
