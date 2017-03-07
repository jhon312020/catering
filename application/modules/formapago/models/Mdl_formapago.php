<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_formapago extends Response_Model {
    public $table               = 'FormaPago';
    public $primary_key         = 'FormaPago.id';
    public function default_order_by() {
        $this->db->order_by('FormaPago.id');
    }
    
    public function get_pay_list() {
      $pay_list = $this->mdl_formapago->select('id, FormaPago')->where(array('is_active'=>1))->get()->result_array();
      return $pay_list = array(''=>'Select') + array_combine(array_column($pay_list, 'id'), array_column($pay_list, 'FormaPago'));
    }
}
?>
