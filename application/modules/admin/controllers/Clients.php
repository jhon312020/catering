<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clients extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('clients/mdl_clients');
		$this->load->model('business/mdl_business');
		$this->load->model('orders/mdl_orders');
		$this->load->model('centres/mdl_centres');
		$data = array();
		$business_list = $this->mdl_business->select('id, name')->where('is_active', 1)->get()->result_array();
		$data['centre_list'] = $this->mdl_centres->select('Id, Centre, bussiness_id')->where('is_active', 1)->get()->result();
		// echo '<pre>';print_r($data['centre_list']); echo'</pre>';
		$data['business_list'] = array(''=>'Select') + array_combine(array_column($business_list, 'id'), array_column($business_list, 'name'));
		$this->load->vars($data);
		$this->path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/clients/";
	}
	public function index() {
		
		$this->layout->set(array('pending_clients' => [], 'clients_list' => []));
		$this->layout->buffer('content', 'clients/index');
		$this->layout->render();
	}

	protected function _buildQuery($query, $params){
		$columns = array( 
			0 =>'clients.client_code',
			1 =>'clients.name', 
			2 => 'clients.surname',
			3 => 'business.name'
		);
		if( !empty($params['search']['value']) ) {
			$query = $query->group_start()
				->like('clients.name', $params['search']['value'])
				->or_like('clients.surname', $params['search']['value'])
				->or_like('clients.client_code', $params['search']['value'])
				->or_like('business.name', $params['search']['value'])
			->group_end();
		}
		$query->where('clients.is_active', intval($params['is_active']) ? 1 : 0);
		if (isset($params['order'][0]['column']) && isset($columns[$params['order'][0]['column']])){
			$query->order_by($columns[$params['order'][0]['column']], $params['order'][0]['dir']);
		}
		return $query;
	}

	public function datasource(){
		$params = $this->input->post();
		$results_in_single_assoc_array = array();
		$pending_clients_query = $this->mdl_clients->select(
				'clients.id, clients.client_code, clients.name, clients.surname, clients.is_active, business.name as business, centres.Centre as centre'
			)
			->join('business', 'business.id = clients.business_id', 'left')
			->join('centres', 'centres.Id = clients.centre_id', 'left')
			->group_by('clients.id');
		$pending_clients_query = $this->_buildQuery($pending_clients_query, $params);

		if ($params['length'] == -1){
			$pending_clients_query = $pending_clients_query->get();
		}
		else{
			$pending_clients_query = $pending_clients_query->limit($params['length'],$params['start'])->get();
		}

		if ($params['is_active'] == 0) {
			foreach ($pending_clients_query->result_array() as $key => $value) {
				$editFieldHtml = sprintf("<a class='btn btn-info btn-sm' style='margin-right:4px;' href='%s'><i class='entypo-eye'></i></a>
					<a class='btn btn-primary edit btn-sm' style='margin-right:4px;' href='%s'><i class='entypo-pencil'></i></a>
					<a class='btn btn-warning btn-sm%s' style='margin-right:4px;' href='%s'><i class='entypo-check' title='%s'></i></a>
					<a class='btn btn-warning btn-sm' style='margin-right:4px;' href='%s'><i class='entypo-cancel' title=''></i></a>
					<a class='btn btn-danger btn-sm' style='margin-right:4px;' href='%s' onclick='return confirm('%s');'><i class='entypo-trash'></i></a>", 
					site_url('admin/clients/view/' . $value['id']), 
					site_url('admin/clients/form/' . $value['id']),
					$value['is_active'] ? '' : ' inactive', 
					site_url('admin/clients/toggle/' . $value['id'] . '/' . $value['is_active']),
					$value['is_active'] ? 'Active' : 'In Active', 
					site_url('admin/clients/cancel/' . $value['id']),
					site_url('admin/clients/delete/' . $value['id']), lang('delete_record_warning')
				);
				$results_in_single_assoc_array[$key] = array(
					$value['client_code'], $value['name'], $value['surname'], $value['business'].' - '.$value['centre'], $editFieldHtml
				);
			}
		} else {
			foreach ($pending_clients_query->result_array() as $key => $value) {
				$editFieldHtml = sprintf("<a class='btn btn-info btn-sm' style='margin-right:4px;' href='%s'><i class='entypo-eye'></i></a>
					<a class='btn btn-primary edit btn-sm' style='margin-right:4px;' href='%s'><i class='entypo-pencil'></i></a>
					<a class='btn btn-warning btn-sm%s' style='margin-right:4px;' href='%s'><i class='entypo-check' title='%s'></i></a>
					<a class='btn btn-danger btn-sm' style='margin-right:4px;' href='%s' onclick='return confirm('%s');'><i class='entypo-trash'></i></a>", 
					site_url('admin/clients/view/' . $value['id']), 
					site_url('admin/clients/form/' . $value['id']),
					$value['is_active'] ? '' : ' inactive', 
					site_url('admin/clients/toggle/' . $value['id'] . '/' . $value['is_active']),
					$value['is_active'] ? 'Active' : 'In Active', 
					site_url('admin/clients/delete/' . $value['id']), lang('delete_record_warning')
				);
				$results_in_single_assoc_array[$key] = array(
					$value['client_code'], $value['name'], $value['surname'], $value['business'].' - '.$value['centre'], $editFieldHtml
				);
			}
		}
		/*if (isset($params['order'])){
			echo $this->db->last_query();exit;
		}*/

		$totalRecords = $this->_buildQuery($this->mdl_clients->join('business', 'business.id = clients.business_id', 'left'), $params)->get()->num_rows();

		$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $results_in_single_assoc_array
		);
		echo json_encode($json_data);
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
		if($id != NULL) {
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
		$this->load->model('tarifes/mdl_tarifes');
		$data = array();
		$tarifa_list = $this->mdl_tarifes->get_tarifa_list();
		$orders_by_client_id = $this->mdl_orders->get_orders_by_client_id($id);
		
		//$clientCode = 'GC-CL-' . sprintf("%04s", $this->mdl_clients->getNextIncrementId());

		$this->layout->set(array('readonly'=>false, 'error'=>$error, 'orders_by_client_id' => $orders_by_client_id, 'tarifa_list'=>$tarifa_list));
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
				$message .=",<br/>Tu solicitud ha sido validada y aceptada. Ya puedes empezar a disfrutar de nuestros menús desde este acceso:<br/>http://www.gumen-catering.com/Delivery";
				$emailBody['body'] = $message;
				$this->email->set_mailtype("html");
				//Need to change admin email dynamically
				$this->email->from('admin@gumen-catering.com', 'Gumen-Catering');
				$this->email->to($client->email); 
				$this->email->subject('Cuenta validada');
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
  public function cancel($id){
		if ($id){
				$client = $this->mdl_clients->get_by_id($id);
				$this->load->library('email');
				$message  = "Hola ".$client->name. " " .$client->surname;
				$message .=",<br/>Upps!  Por el momento no servimos en tu zona o empresa. Por favor envíanos tu email y te avisaremos en cuanto podamos enviarte nuestros menús!";
				$emailBody['body'] = $message;
				$this->email->set_mailtype("html");
				//Need to change admin email dynamically
				$this->email->from('admin@gumen-catering.com', 'Gumen-Catering');
				$this->email->to($client->email); 
				$this->email->subject('Cuenta validada');
				$body = $this->load->view('layout/emails/mail.php',$emailBody, TRUE);
				$this->email->message($body);
				$this->email->send();
				redirect('admin/clients');
		}
	}
}