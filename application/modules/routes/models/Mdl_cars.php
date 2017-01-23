<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_cars extends Response_Model {

	public $table               = 'cars';
	public $primary_key         = 'cars.id';
	//public $date_created_field  = 'date_created';
	//public $date_modified_field = 'date_modified';


	public function default_order_by() {
		$this->db->order_by('cars.id');
	}

	public function validation_rules() {
		return array(
			'car_name' => array(
				'field' => 'car_name',
				'label' => lang('car_name'),
				'rules' => 'required'
			),			
			'email' => array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required'
			),
			'password' => array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
			),
		);
	}
}
?>
