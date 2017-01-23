<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mdl_Rates extends Response_Model {

	public $table               = 'rates';
	public $primary_key         = 'rates.id';
	public $date_created_field  = 'created';


	public function default_order_by() {
		$this->db->order_by('rates.id');
	}

	public function validation_rules() {
		return array(
			'role'      => array(
				'field' => 'role',
				'label' => lang('user_type'),
				'rules' => 'required'
			),
			'email'     => array(
				'field' => 'email',
				'label' => lang('email'),
				'rules' => 'required|valid_email'
			),
			'first_name'      => array(
				'field' => 'first_name',
				'label' => lang('first_name'),
				'rules' => 'required'
			),
			'last_name'      => array(
				'field' => 'last_name',
				'label' => lang('last_name'),
				'rules' => 'required'
			),
			'password'  => array(
				'field' => 'password',
				'label' => lang('password'),
				'rules' => 'required'
			),
			'user_passwordv' => array(
				'field' => 'user_passwordv',
				'label' => lang('verify_password'),
				'rules' => 'required|matches[password]'
			),
		);
	}

	public function save($id = NULL, $db_array = NULL) {
		$id = parent::save($id, $db_array);
		return $id;
	}
}

?>
