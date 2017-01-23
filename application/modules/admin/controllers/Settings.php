<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * FusionInvoice
 * 
 * A free and open source web based invoicing system
 *
 * @package		FusionInvoice
 * @author		Jesse Terry
 * @copyright	Copyright (c) 2012 - 2013, Jesse Terry
 * @license		http://www.fusioninvoice.com/license.txt
 * @link		http://www.fusioninvoice.
 * 
 */

	class Settings extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('settings/mdl_settings');
		$this->load->model('users/mdl_users');
	}

	public function index() {
		$error = array();
		if ($this->input->post('btn_submit')) {
			foreach ($this->input->post('settings') as $key => $value) {
				$this->mdl_settings->save($key, $value);
			}
			
			if(isset($_FILES['media_admin_logo']['name']) && $_FILES['media_admin_logo']['name'] != "") {
				$config['upload_path'] = './assets/cc/images/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload("media_admin_logo")){
					$media = $this->upload->data();
					$media['file_url'] = $this->mdl_settings->setting('site_url').$config['upload_path'].$media['file_name'];
					$this->mdl_settings->save("media_admin_logo", $media['file_url']);
				}
			}
			if ($this->mdl_users->run_validation('validation_rules_change_password_setting')) {
				$this->mdl_users->save_change_password($this->session->userdata('user_id'), $this->input->post('user_password'));
			}
			/*Editor details change*/
			if ($this->mdl_users->run_validation('validation_rules_editors')) {
				$editor = $this->mdl_users->where('role', '6')->get()->row();
				if($editor->email != $this->input->post('editor_email')) {
					$user_exists = $this->mdl_users->user_exists($this->input->post('editor_email'));
					if(!$user_exists) {
						$this->mdl_users->save_editor_details($this->input->post('editor_email'), $this->input->post('editor_password'));
						$this->session->set_flashdata('alert_success', lang('settings_successfully_saved'));
					} else {
						$error[] = lang('exists_username');
						$this->session->set_flashdata('alert_error', 'Editors '.lang('exists_username'));
					}
				}
			}
			redirect('admin/settings');
		}
		$editor = $this->mdl_users->getEditorDetails();
		//$this->layout->set('theme', $this->theme['name']);
		$this->layout->set(array('editor'=> $editor, 'error' => $error));
		$this->layout->buffer('content', 'settings/index');
		$this->layout->render();
	}

	public function rates() {
		$this->layout->buffer('content', 'settings/rates');
		$this->layout->render();
	}
}
?>
