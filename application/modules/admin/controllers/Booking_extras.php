<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

	class Booking_extras extends Admin_Controller {

	var $path = '';

	public function __construct() {
		parent::__construct();
		$this->load->model('booking_extras/mdl_booking_extras');
		$this->path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/booking_extras/";
	}

	public function index() {
		$this->layout->set(array('booking_extras'=>$this->mdl_booking_extras->order_by('created', 'desc')->get()->result()));
		$this->layout->set(array('path'=>$this->path));
		$this->layout->buffer('content', 'booking_extras/index');
		$this->layout->render();
	}

	public function form($id = NULL) {
		$error_flg = false;
		if ($this->input->post('btn_cancel')){
			redirect('admin/booking_extras');
		}

		if ($this->mdl_booking_extras->run_validation()) {
			unset($_POST['btn_submit']);
			$id = $this->mdl_booking_extras->save($id, $this->input->post());
			if ($id && $_FILES['image']['name']) {
				$data = $this->do_upload($id);
			}
			if(!$error_flg)
				redirect('admin/booking_extras');
		}

		if ($id and !$this->input->post('btn_submit')) {
			$this->mdl_booking_extras->prep_form($id);
		}
		$this->db->select(array('name','zone'));
		$this->layout->set(array('path'=>$this->path, 'readonly'=>false));
		$this->layout->buffer('content', 'booking_extras/form');
		$this->layout->render();
	}
	public function view($id) {
		$error_flg = false;
		if ($this->input->post('btn_cancel')) {
			redirect('admin/booking_extras');
		}

		if ($id) {
			$this->mdl_booking_extras->prep_form($id);
		}
		$this->db->select(array('name','zone'));
		
		$this->layout->set(array('path'=>$this->path, 'readonly'=>true));
		$this->layout->buffer('content', 'booking_extras/form');
		$this->layout->render();
	}
	
	/*public function delete($id) {
		$this->db->where('collaborator_id',$id);
		$this->db->delete('tbl_users');
		$this->mdl_booking_extras->delete($id);
		redirect('admin/booking_extras');
	}*/
	
	public function toggle($id, $bool){
		if ($id){
			$bool = ($bool) ? false : true;
			$this->mdl_booking_extras->save($id, array('is_active'=>$bool));
			redirect('admin/booking_extras/index');
		}
	}
	
	function do_upload($id) {
		$config['upload_path'] = './assets/cc/images/booking_extras';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		//print_r($_FILES);
		$files = $_FILES; // storing all the files in a temp variable;
		$cpt = count($_FILES['image']['name']);
		log_message("error", "FILE COUNT = " . $cpt);
		log_message("error", "FILE NAME = " . $files['image']['name']);
		$success = $this->upload->do_upload('image');
		if ( ! $success) {
			$data = array('error' => $this->upload->display_errors());
			echo "Server upload issue.  Please try after sometimes! Kindly press ctrl + F5";
			//print_r($data);
			exit;
			//break;
		} else {
			
			$data0 = $this->upload->data();
			$data = array('upload_data' => $data0);
			$data['upload_data']['file_url'] = $this->path . $data0['file_name'];
			$this->mdl_booking_extras->save($id, array('image'=>$data['upload_data']['file_name']));
		}
		return $data;
    }
}
