<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mdl_Contacts extends Response_Model {

    public $table               = 'contacts';
    public $primary_key         = 'contacts.id';
    //public $date_created_field  = 'date_created';
    //public $date_modified_field = 'date_modified';

    

    public function default_order_by()
    {
        $this->db->order_by('contacts.id');
    }

    public function validation_rules()
    {
        return array(
			/*'address_line1' => array(
                'field' => 'address_line1',
                'label' => 'Address Line 1',
                'rules' => 'required'
            ),
			'address_line2' => array(
                'field' => 'address_line2',
                'label' => 'Address Line 1',
            ),            
            'city' => array(
                'field' => 'city',
                'label' => 'City',
                'rules' => 'required'
            ),
            'country'      => array(
                'field' => 'country',
                'label' => 'Country',
                'rules' => 'required'
            ),
			'phone_1' => array(
                'field' => 'phone_1',
                'label' => 'Phone 1',
                'rules' => 'required'
            ),
			'phone_2' => array(
                'field' => 'phone_2',
                'label' => 'Phone 2',
            ),
			'fax' => array(
                'field' => 'fax',
                'label' => 'Fax',
            ),*/
			'email' => array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required'
            ),
			'name' => array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ),
			'description' => array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required'
            ),
        );
    } 

}

?>
