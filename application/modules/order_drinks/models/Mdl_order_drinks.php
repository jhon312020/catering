<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_order_drinks extends Response_Model {
    public $table               = 'order_drinks';
    public $primary_key         = 'order_drinks.id';
    public function default_order_by() {
        $this->db->order_by('order_drinks.id');
    }
    public function validation_rules() {
			
    }
}
?>
