<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Drinks extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('drinks/mdl_drinks');
	}

	public function index() {
		$cool_drinks = $this->mdl_drinks->get()->result();
		$this->layout->set(array('cool_drinks' => $cool_drinks));
		$this->layout->buffer('content', 'drinks/index');
		$this->layout->render();
	}
	public function form($id = NULL) {
		$error_flg = false;
		$error = array();
		if ($this->input->post('btn_cancel')) {
			redirect('admin/business');
		}
		if($id) {
			$this->mdl_drinks->form_validation->set_rules('drinks_name', lang('drinks_name'), 'required|edit_unique[cool_drinks.drinks_name.'.$id.']');
		}
		else {
			$this->mdl_drinks->form_validation->set_rules('drinks_name', lang('drinks_name'), 'required|is_unique[cool_drinks.drinks_name]');
		}
		
		if ($this->mdl_drinks->run_validation()) {
			$data = $this->input->post();
			unset($data['btn_submit']);
			if(is_null($id) || $id == ''){
				$id = $this->mdl_drinks->save(null, $data);
			}
			else{
				$this->mdl_drinks->save($id,$data);
			}
			if(!$error_flg) {
				redirect('admin/drinks');
			}
		}
		if ($id and !$this->input->post('btn_submit')) {
			$this->mdl_drinks->prep_form($id);
		}
		$this->layout->set(array('readonly'=>false, 'error'=>$error));
		$this->layout->buffer('content', 'drinks/form');
		$this->layout->render();
	}
	public function view($id) {
		$error_flg = false;
		$error = array();
		if ($this->input->post('btn_cancel')) {
			redirect('admin/drinks');
		}
		$this->mdl_drinks->prep_form($id);
		$this->layout->set(array('readonly'=>true, 'error'=>$error));
		$this->layout->buffer('content', 'drinks/form');
		$this->layout->render();
	}
	public function toggle($id, $bool){
		if ($id){
			$bool = ($bool) ? false : true;
			$this->mdl_drinks->save($id, array('is_active'=>$bool));
			redirect('admin/drinks');
		}
	}
	public function delete($id) {
		$this->mdl_drinks->delete($id);
		redirect('admin/drinks');
	}
}
