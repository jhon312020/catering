<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clients extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('clients/mdl_clients');
		$this->load->model('business/mdl_business');
		$data = array();
		$business_list = $this->mdl_business->select('id, name')->where('is_active', 1)->get()->result_array();
		$data['business_list'] = array(''=>'Select') + array_combine(array_column($business_list, 'id'), array_column($business_list, 'name'));
		$this->load->vars($data);
		$this->path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/clients/";
	}
	public function index() {
		$pending_clients = $this->mdl_clients
								->select('clients.id, clients.client_code, clients.name, clients.surname, clients.business_id, clients.email, clients.password, clients.telephone, clients.dni, clients.intolerances, clients.iban, clients.bill, clients.billing_data, clients.is_active, clients.created_at, clients.updated_at, business.name as business')
								->join('business', 'business.id = clients.business_id', 'left')
								->where('clients.is_active', 0)
								->get()->result();
		$clients_list = $this->mdl_clients
								->select('clients.id, clients.client_code, clients.name, clients.surname, clients.business_id, clients.email, clients.password, clients.telephone, clients.dni, clients.intolerances, clients.iban, clients.bill, clients.billing_data, clients.is_active, clients.created_at, clients.updated_at, business.name as business')
								->join('business', 'business.id = clients.business_id', 'left')
								->where('clients.is_active', 1)
								->get()->result();						
		$this->layout->set(array('pending_clients' => $pending_clients, 'clients_list' => $clients_list));
		$this->layout->buffer('content', 'clients/index');
		$this->layout->render();
	}
	public function form($id = NULL) {
		$error_flg = false;
		$error = array();
		if ($this->input->post('btn_cancel')) {
			redirect('admin/clients');
		}
		if ($this->mdl_clients->run_validation()) {
			$data = $this->input->post();
			$data['password'] = md5($data['password']);
			$data['password_key'] = base64_encode($data['password'].'_catering');
			unset($data['btn_submit']);
			if(is_null($id) || $id == ''){
				$id = $this->mdl_clients->save(null, $data);
			}
			else{
				$this->mdl_clients->save($id,$data);
			}
			if(!$error_flg) {
				redirect('admin/clients');
			}
		}
		if ($id and !$this->input->post('btn_submit')) {
			$this->mdl_clients->prep_form($id);
		}
		$this->layout->set(array('readonly'=>false, 'error'=>$error));
		$this->layout->buffer('content', 'clients/form');
		$this->layout->render();
	}
	public function view($id) {
		$error_flg = false;
		$error = array();
		if ($this->input->post('btn_cancel')) {
			redirect('admin/clients');
		}
		$this->mdl_clients->prep_form($id);
		$this->layout->set(array('readonly'=>true, 'error'=>$error, 'path'=>'./assets/cc/images/clients/'));
		$this->layout->buffer('content', 'clients/form');
		$this->layout->render();
	}
	public function toggle($id, $bool){
		if ($id){
			$bool = ($bool) ? false : true;
			$this->mdl_clients->save($id, array('is_active'=>$bool));
			redirect('admin/clients');
		}
	}
	public function delete($id) {
		$this->mdl_clients->delete($id);
		redirect('admin/clients');
	}
	function do_upload($id, $name) {
		$config['upload_path'] = './assets/cc/images/clients/'.$name.'/'.$id.'/';
		if(!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, true);
		}
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		//print_r($_FILES);
		$files = $_FILES; // storing all the files in a temp variable;
		$cpt = count($_FILES[$name]['name']);
		log_message("error", "FILE COUNT = " . $cpt);
		log_message("error", "FILE NAME = " . $files[$name]['name']);
		$success = $this->upload->do_upload($name);
		if (!$success) {
			$data = array('error' => $this->upload->display_errors());
			echo "Server upload issue.  Please try after sometimes! Kindly press ctrl + F5";
			//print_r($data);
			exit;
			//break;
		} else {
			$data = $this->upload->data();
		}
		return $data;
  }
}