<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mdl_partners extends Response_Model {

    public $table               = 'partners';
    public $primary_key         = 'partners.id';
    //public $date_created_field  = 'date_created';
    //public $date_modified_field = 'date_modified';

    

    public function default_order_by()
    {
        $this->db->order_by('partners.id');
    }

    public function validation_rules()
    {
        return array(
            'name' => array(
                'field' => 'name',
                'label' => 'Partner Name',
                'rules' => 'required'
            ),
            /*'logo' => array(
                'field' => 'logo',
                'label' => 'Logo',
                'rules' => 'required'
            ),*/
            /* 'url' => array(
                'field' => 'url',
                'label' => 'Url',
                'rules' => 'required'
            ) */
        );
    }

}

?>
