<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Business extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('business/mdl_business');
	}

	public function index() {
		$business_list = $this->mdl_business->get()->result();
		$this->layout->set(array('business_list' => $business_list));
		$this->layout->buffer('content', 'business/index');
		$this->layout->render();
	}
	public function form($id = NULL) {
		$error_flg = false;
		$error = array();
		if ($this->input->post('btn_cancel')) {
			redirect('admin/business');
		}
		$zone_exists = false;
		$business = $this->db->where('id', $id)->get('business')->row();
		if ($this->mdl_business->run_validation()) {
			if($id == null) {
				$email_exists = $this->mdl_business->email_exists($this->input->post('email'));
			}
			else{
				if($business->email != $this->input->post('email'))
					$email_exists = $this->mdl_business->email_exists($this->input->post('email'));
				else
					$email_exists = false;
			}
			if(!$email_exists){
				$data = $this->input->post();
				$data['time_limit'] = date('H:i', strtotime($data['hours'].':'.$data['minutes']));
				unset($data['hours'], $data['minutes'], $data['btn_submit']);
				if(is_null($id) || $id == ''){
					$id = $this->mdl_business->save(null, $data);
				}
				else{
					$this->mdl_business->save($id,$data);
				}
			}
			else{
				$error_flg = true;
				$error[] = lang('exists_username');
			}
			if(!$error_flg) {
				redirect('admin/business');
			}
		}
		if ($id and !$this->input->post('btn_submit')) {
			$this->mdl_business->prep_form($id);
		}
		$this->layout->set(array('readonly'=>false, 'error'=>$error));
		$this->layout->buffer('content', 'business/form');
		$this->layout->render();
	}
	public function view($id) {
		$error_flg = false;
		$error = array();
		if ($this->input->post('btn_cancel')) {
			redirect('admin/business');
		}
		$this->mdl_business->prep_form($id);
		$this->layout->set(array('readonly'=>true, 'error'=>$error));
		$this->layout->buffer('content', 'business/form');
		$this->layout->render();
	}
	public function toggle($id, $bool){
		if ($id){
			$bool = ($bool) ? false : true;
			$this->mdl_business->save($id, array('is_active'=>$bool));
			redirect('admin/business');
		}
	}
	public function delete($id) {
		$this->mdl_business->delete($id);
		redirect('admin/business');
	}
}
