<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


	class contacts extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('contacts/mdl_contacts');
		$this->load->model('settings/mdl_settings');
		$this->caption_path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/captions/";
	}

	public function index() {
    $contact = $this->mdl_contacts->where(array('is_active' => 1))->get()->row();
		$this->layout->buffer('content', 'contacts/index', array('contact'=>$contact));
		$this->layout->render();
	}

	public function form($id = NULL) {
		$error_flg = false;
		if ($this->input->post('btn_cancel')) {
			redirect('admin/contacts');
		}
		log_message("debug", "%^%^% Saving contacts outside");
		if ($this->mdl_contacts->run_validation()) {
			$contacts= array(
				'email'				=>$this->input->post('email'),
				'name'				=>$this->input->post('name'),
				'address'				=>$this->input->post('address'),
				'telephone'				=>$this->input->post('telephone'),
			);
			log_message("debug", "%^%^% Saving contacts " . implode(",", $contacts));
			$this->mdl_contacts->save($id, $contacts);

			if(!$error_flg)
				redirect('admin/contacts');
		}

		if ($id and !$this->input->post('btn_submit')) {
			$this->mdl_contacts->prep_form($id);
		}

		$this->layout->buffer('content', 'contacts/form');
		$this->layout->render();
	}

	public function delete($id) {
		$this->mdl_contacts->delete($id);
		redirect('admin/contacts');
	}
}
?>
