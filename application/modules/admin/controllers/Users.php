<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


	class Users extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('users/mdl_users');
	}

	public function index() {
		$this->layout->set('users', $this->mdl_users->get()->result());
		$this->layout->set('user_types', $this->mdl_users->user_types());
		$this->layout->buffer('content', 'users/index');
		$this->layout->render();
	}

	public function form($id = NULL) {
		if ($this->input->post('btn_cancel')) {
			redirect('admin/users');
		}

		if ($this->mdl_users->run_validation(($id) ? 'validation_rules_existing' : 'validation_rules')) {
			unset($_POST['user_passwordv']);
			$this->mdl_users->save($id);
			redirect('admin/users');
		}

		if ($id and !$this->input->post('btn_submit')) {
			$this->mdl_users->prep_form($id);
		}
		$this->layout->set(
			array(
				'id'           => $id,
				'user_types'   => $this->mdl_users->user_types(),
			)
		);
		$this->layout->buffer('content', 'users/form');
		$this->layout->render();
	}
	public function change_password($user_id) {
		if ($this->input->post('btn_cancel')) {
			redirect('admin/users');
		}

		if ($this->mdl_users->run_validation('validation_rules_change_password')) {
			$this->mdl_users->save_change_password($user_id, $this->input->post('password'));
			redirect('admin/users/form/' . $user_id);
		}

		$this->layout->buffer('content', 'users/form_change_password');
		$this->layout->render();
	}

	public function delete($id) {
		$this->mdl_users->delete($id);
		redirect('admin/users');
	}

	public function delete_user_client($user_id, $user_client_id) {
		$this->mdl_user_clients->delete($user_client_id);
		redirect('admin/users/form/' . $user_id);
	}
}
?>
