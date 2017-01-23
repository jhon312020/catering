<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

	class Promotional_codes extends Admin_Controller {

	var $path = '';

	public function __construct() {
		parent::__construct();
		$this->load->model('promotional_codes/mdl_promotional_codes');
		$this->path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/promotional_codes/";
	}

	public function index() {
		$this->layout->set(array('promotional_codes'=>$this->mdl_promotional_codes->order_by('created', 'desc')->get()->result()));
		$this->layout->set(array('path'=>$this->path));
		$this->layout->buffer('content', 'promotional_codes/index');
		$this->layout->render();
	}

	public function form($id = NULL) {
		$error_flg = false;
		if ($this->input->post('btn_cancel')) {
			redirect('admin/promotional_codes');
		}
		if ($this->mdl_promotional_codes->run_validation()) {
			unset($_POST['btn_submit']);
			$id = $this->mdl_promotional_codes->save($id, $this->input->post());
			if(!$error_flg)
				redirect('admin/promotional_codes');
		}

		if ($id and !$this->input->post('btn_submit')) {
			$this->mdl_promotional_codes->prep_form($id);
		}
		$this->db->select(array('name','zone'));
		$this->layout->set(array('path'=>$this->path, 'readonly'=>false));
		$this->layout->buffer('content', 'promotional_codes/form');
		$this->layout->render();
	}
	public function view($id) {
		$error_flg = false;
		if ($this->input->post('btn_cancel')) {
			redirect('admin/promotional_codes');
		}

		if ($id) {
			$this->mdl_promotional_codes->prep_form($id);
		}
		$this->db->select(array('name','zone'));
		
		$this->layout->set(array('path'=>$this->path, 'readonly'=>true));
		$this->layout->buffer('content', 'promotional_codes/form');
		$this->layout->render();
	}
	public function getcodes(){
		$res = $this->mdl_promotional_codes->getcodebycode($this->input->post());
		if($res)
			echo json_encode($res);
		else
			echo json_encode(array('error'=>"Invalid codes"));
	}
	/*public function delete($id) {
		$this->db->where('collaborator_id',$id);
		$this->db->delete('tbl_users');
		$this->mdl_promotional_codes->delete($id);
		redirect('admin/promotional_codes');
	}*/
	
	public function toggle($id, $bool){
		if ($id){
			$bool = ($bool) ? false : true;
			$this->mdl_promotional_codes->save($id, array('is_active'=>$bool));
			redirect('admin/promotional_codes/index');
		}
	}
	
	public function validate_price_or_percentage() {
		return false;
	}

}
