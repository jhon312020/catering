<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mdl_contact extends Response_Model {

    public $table               = 'contacts';
    public $primary_key         = 'contacts.id';
    //public $date_created_field  = 'date_created';
   // public $date_modified_field = 'date_modified';

    

    public function default_order_by()
    {
        $this->db->order_by('contacts.nid');
    }

    public function validation_rules()
    {
        return array(
            'name'      => array(
                'field' => 'name',
                'label' => 'name',
                'rules' => 'required'
            ),
            'email'      => array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'required'
            ),
            'description'     => array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required'
            ),
        );
    } 

}

?>
