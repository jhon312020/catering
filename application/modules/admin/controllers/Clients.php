<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clients extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('clients/mdl_clients');
		$this->load->model('business/mdl_business');
		$this->load->model('orders/mdl_orders');
		$data = array();
		$business_list = $this->mdl_business->select('id, name')->where('is_active', 1)->get()->result_array();
		$data['business_list'] = array(''=>'Select') + array_combine(array_column($business_list, 'id'), array_column($business_list, 'name'));
		$this->load->vars($data);
		$this->path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/clients/";
	}
	public function index() {
		
		$pending_clients = $this->mdl_clients->get_pending_clients();
		
		$clients_list = $this->mdl_clients->get_active_clients();

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
		if($this->input->post('bill') == 1) {
			//echo "true";die;
			$this->mdl_clients->form_validation->set_rules('billing_data', lang('billing_data'), 'required');
			
		} 
		if($id) {
			$this->mdl_clients->form_validation->set_rules('email', lang('email'), 'required|valid_email|edit_unique[clients.email.'.$id.']');
			$this->mdl_clients->form_validation->set_rules('client_code', lang('client_code'), 'required|min_length[4]|edit_unique[clients.client_code.'.$id.']');
		}
		else {
			$this->mdl_clients->form_validation->set_rules('email', lang('email'), 'required|valid_email|is_unique[clients.email]');
			$this->mdl_clients->form_validation->set_rules('client_code', lang('client_code'), 'required|min_length[4]|is_unique[clients.client_code]');
		}
		
		if ($this->mdl_clients->run_validation()) {
			$data = $this->input->post();
			$password = $this->input->post('password');
			$data['password'] = md5($password);
			$data['password_key'] = base64_encode($password.'_catering');
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
		
		$orders_by_client_id = $this->mdl_orders->get_orders_by_client_id($id);
		
		$this->layout->set(array('readonly'=>false, 'error'=>$error, 'orders_by_client_id' => $orders_by_client_id));
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
		$orders_by_client_id = $this->mdl_orders->get_orders_by_client_id($id);
		
		$this->layout->set(array('readonly'=>true, 'error'=>$error, 'path'=>'./assets/cc/images/clients/', 'orders_by_client_id' => $orders_by_client_id));
		$this->layout->buffer('content', 'clients/form');
		$this->layout->render();
	}
	public function toggle($id, $bool){
		if ($id){
			$bool = ($bool) ? false : true;
			$this->mdl_clients->save($id, array('is_active'=>$bool));
			if ($bool){
				$client = $this->mdl_clients->get_by_id($id);
				$this->load->library('email');
				$message  = "Hola ".$client->name. " " .$client->surname;
				$message .=",<br/>Tu solicitud ha sido validada y aceptada. Ya puedes empezar a disfrutar de nuestros menús desde este acceso: http://www.gumen-catering.com/Delivery";
				$emailBody['body'] = $message;
				$this->email->set_mailtype("html");
				//Need to change admin email dynamically
				$this->email->from('admin@gumen-catering.com', 'Gumen-Catering');
				$this->email->to($data['email']); 
				$this->email->subject('Validated');
				$body = $this->load->view('layout/emails/mail.php',$emailBody, TRUE);
				$this->email->message($body);
				$this->email->send();
			}
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