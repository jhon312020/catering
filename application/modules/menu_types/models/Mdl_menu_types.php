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
}
?>