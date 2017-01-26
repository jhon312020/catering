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
        );
    }
}
?>