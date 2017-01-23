<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mdl_clients extends Response_Model {

    public $table               = 'clients';
    public $primary_key         = 'clients.id';
    public $date_created_field  = 'date_created';
    //public $date_modified_field = 'date_modified';
	public $rules = array(
            'name' => array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ),
            'surname' => array(
                'field' => 'surname',
                'label' => 'Surname',
                'rules' => 'required'
            ),
            'email' => array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ),
            'phone' => array(
                'field' => 'phone',
                'label' => 'Phone',
                'rules' => 'required'
            ),
            'address' => array(
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required'
            ),
            'cp' => array(
                'field' => 'cp',
                'label' => 'C.P',
                'rules' => 'required'
            ),
            'country' => array(
                'field' => 'country',
                'label' => 'Country',
                'rules' => 'required'
            ),
            'city' => array(
                'field' => 'city',
                'label' => 'City',
                'rules' => 'required'
            ),
            'nationality' => array(
                'field' => 'nationality',
                'label' => 'Nationality',
                'rules' => 'required'
            ),
            'dni_passport' => array(
                'field' => 'dni_passport',
                'label' => 'DNI / Passport',
                'rules' => 'required'
            ),
            'doc_no' => array(
                'field' => 'doc_no',
                'label' => 'Document No',
                'rules' => 'required'
            ),
			'password' => array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            ),
        );
	
    public function default_order_by(){
        $this->db->order_by('clients.id');
    }
	
    public function validation_rules()
    {
        return $this->rules;
    } 
	public function shuttle_validation_rules_array()
    {
		unset($this->rules['doc_no'], $this->rules['dni_passport'], $this->rules['nationality'], $this->rules['city'], $this->rules['phone'], $this->rules['address'], $this->rules['cp'], $this->rules['country'], $this->rules['city']);
		return $this->rules;
    }
	public function shuttle_validation_rules()
    {
		unset($this->rules['password'], $this->rules['doc_no'], $this->rules['dni_passport'], $this->rules['nationality'], $this->rules['city'], $this->rules['phone'], $this->rules['address'], $this->rules['cp'], $this->rules['country'], $this->rules['city']);
		return $this->rules;
    }

}

?>
