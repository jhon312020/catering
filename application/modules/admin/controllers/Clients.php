<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clients extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('comman_helper');
        $this->load->model('users/mdl_clients');
		$this->load->model('users/mdl_users');
    }

	public function index() {
		$data = array(
			'clients' => $this->mdl_clients->order_by('created', 'desc')->get()->result()
		);
		
		$this->layout->set($data);
		$this->layout->buffer('content', 'users/clients_list');
		$this->layout->render();
	}
	public function form($id = NULL) {
		if ($this->input->post('btn_cancel')) {
			redirect('admin/clients');
		}
		$error = array();
		
		$clients = $this->db->where('id', $id)->get('clients')->row();
		
		if ($this->mdl_clients->run_validation()) {
			if($id == null){
				$email_exists = $this->mdl_users->user_exists($this->input->post('email'));
			} else {
				if($clients->email != $this->input->post('email'))
					$email_exists = $this->mdl_users->user_exists($this->input->post('email'));
				else
					$email_exists = false;
			}
			
			if (!$email_exists) {
				$user = array();
				$user['role'] = 4;
				$user['first_name'] = $this->input->post('name');
				$user['last_name'] = $this->input->post('surname');
				$user['email'] = $this->input->post('email');
				$user['password'] = md5($this->input->post('password'));
				$user['secret_key'] = base64_encode($this->input->post('password').'_pickngo');
				$clients = $this->input->post();
				unset($clients['password']);
				unset($clients['fakeusernameremembered']);
				unset($clients['btn_submit']);
				if(is_null($id) || $id == ''){
					$this->mdl_clients->save(null,$clients);
					$user['client_id'] = $this->db->insert_id();
					$this->mdl_users->save(null, $user);
				} else {
					$user_array = current($this->db->from('users')->where('client_id',$id)->get()->result_array());
					$this->mdl_users->save($user_array['id'], $user);
					$this->mdl_clients->save($id,$clients);
				}
				redirect('admin/clients');
			} else {
				$error_flg = true;
				$error[] = lang('exists_username');
				//redirect($this->uri->uri_string());
			}
		}

		if ($id and !$this->input->post('btn_submit')) {
			$this->mdl_clients->prep_form($id);
		}
		$user_array = current($this->db->from('users')->where('client_id',$id)->get()->result_array());
		if($this->input->post('password'))
			$this->mdl_clients->form_values['password'] = $this->input->post('password');
		else
			$this->mdl_clients->form_values['password'] = str_replace('_pickngo', '', base64_decode($user_array['secret_key']));
		$this->layout->set(
			array(
				'id'           => $id,
				'readonly'=>false,
				'user_array'=>$user_array,
				'error'=>$error
			)
		);
		$this->layout->buffer('content', 'users/client_form');
		$this->layout->render();
	}
	public function view($id) {
		$error_flg = false;
		$error = array();
		if ($this->input->post('btn_cancel')) {
			redirect('admin/clients');
		}

		if ($id) {
			$this->mdl_clients->prep_form($id);
		}
		
		$user_array = current($this->db->from('users')->where('client_id',$id)->get()->result_array());
		$this->layout->set(array('id'=>$id, 'readonly'=>true, 'user_array'=>$user_array, 'error'=>$error));
		$this->layout->buffer('content', 'users/client_form');
		$this->layout->render();
	}
	public function toggle($id, $bool){
		if ($id){
			$bool = ($bool) ? false : true;
			$this->mdl_clients->save($id, array('is_active'=>$bool));
			redirect('admin/clients/index');
		}
	}
	public function delete($id) {
		$this->db->where('client_id',$id);
		$this->db->delete('tbl_users');
		$this->mdl_clients->delete($id);
		redirect('admin/clients');
	}

}
