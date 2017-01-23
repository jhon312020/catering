<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mdl_Menu extends Response_Model {

    public $table               = 'menu';
    public $primary_key         = 'menu.mid';
    //public $date_created_field  = 'date_created';
    //public $date_modified_field = 'date_modified';

    

    public function default_order_by()
    {
        $this->db->order_by('menu.weight');
    }

    public function validation_rules()
    {
        return array(
            'title'      => array(
                'field' => 'title',
                'label' => 'title',
                'rules' => 'required'
            ),
            'url'      => array(
                'field' => 'url'
            ),
            'weight'     => array(
                'field' => 'weight',
            ),
        );
    } 

}

?>
