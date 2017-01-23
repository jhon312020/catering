<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_bcnareas extends Response_Model {

    public $table               = 'bcnareas';
    public $primary_key         = 'bcnareas.id';
    //public $date_created_field  = 'date_created';
    //public $date_modified_field = 'date_modified';

    

    public function default_order_by() {
        $this->db->order_by('bcnareas.id');
    }

    public function validation_rules() {
        return array(
            'name' => array(
                'field' => 'name',
                'label' => 'Area Name',
                'rules' => 'required'
            ),
            'zone' => array(
                'field' => 'zone',
                'label' => 'Zone number',
                'rules' => 'required|decimal'
            )
        );
    }

}

?>
