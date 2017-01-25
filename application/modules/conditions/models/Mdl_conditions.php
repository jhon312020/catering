<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mdl_conditions extends Response_Model {
    public $table = 'conditions';
    public $primary_key = 'conditions.id';
    public function default_order_by() {
        $this->db->order_by('conditions.id');
    }
    public function validation_rules() {
			
    }
}
?>