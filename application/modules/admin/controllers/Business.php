<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Business extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('business/mdl_business');
		$this->load->model('centres/mdl_centres');
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
		$centres = false;
		if ($this->input->post('btn_cancel')) {
			redirect('admin/business');
		}
		$zone_exists = false;
		$business = $this->db->where('id', $id)->get('business')->row();
		if ($this->mdl_business->run_validation()) {
			//echo'<pre>'; print_r($_POST); echo '</pre>';
			//exit;
			if ($id == null) {
				$email_exists = $this->mdl_business->email_exists($this->input->post('email'));
			} else {
				if ($business->email != $this->input->post('email'))
					$email_exists = $this->mdl_business->email_exists($this->input->post('email'));
				else
					$email_exists = false;
			}
			if (!$email_exists) {
				$data = $this->input->post();
				$checkboxFields = array('card','draft','ticket','cash');
				foreach ($checkboxFields as $field) {
					if (!isset($data[$field])) {
						$data[$field] = 0;
					}
				}
				$centers = $data['center'];
				unset($data['hours'], $data['minutes'], $data['btn_submit'], $data['center'], $data['form_number']);
				if (is_null($id) || $id == '') {
					$data['created_at'] = date('Y-m-d H:i:s');
					$id = $this->mdl_business->save(null, $data);
					if ($id) {
						$this->save_centres($id, $centers);
					}
				} else {
					$data['updated_at'] = date('Y-m-d H:i:s');
					$this->mdl_business->save($id, $data);
					$this->save_centres($id, $centers);
				}
			} else {
				$error[] = lang('exists_username');
			}
			if (!$error_flg) {
				redirect('admin/business');
			}
		}
		if ($id and !$this->input->post('btn_submit')) {
			$this->mdl_business->prep_form($id);
			$centres = $this->mdl_centres->getByBusinessId($id);
		}
		$this->layout->set(array('readonly'=>false, 'error'=>$error, 'centres'=>$centres));
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
		$centres = $this->mdl_centres->getByBusinessId($id);
		$this->layout->set(array('readonly'=>true, 'error'=>$error, 'centres'=>$centres));
		$this->layout->buffer('content', 'business/form');
		$this->layout->render();
	}
	public function toggle($id, $bool) {
		if ($id) {
			$bool = ($bool) ? false : true;
			$this->mdl_business->save($id, array('is_active'=>$bool, 'updated_at'=>date('Y-m-d H:i:s')));
			$this->mdl_centres->update('centres', array('is_active'=>$bool, 'updated_at'=>date('Y-m-d H:i:s')), array('bussiness_id'=>$id));
			redirect('admin/business');
		}
	}
	public function delete($id) {
		$this->mdl_business->delete($id);
		$this->mdl_centres->delete('centres', array('bussiness_id'=>$id));
		redirect('admin/business');
	}
	/***
	 * Function save_centres
	 * used to save all the centres
	 */
	public function save_centres($bussiness_id, $centers) {
		foreach ($centers as $key => $center) {
			$center['time_limit'] = date('H:i', strtotime($center['hours'].':'.$center['minutes']));
			 unset($center['hours'], $center['minutes']);
			 if (isset($center['Id'])) {
			 	$center['updated_at'] = date('Y-m-d H:i:s');
			 	$this->mdl_centres->save($center['Id'], $center);
			 } else {
				 $center['bussiness_id'] = $bussiness_id;
				 $center['created_at'] = date('Y-m-d H:i:s');
				 $center_id = $this->mdl_centres->save(null, $center);
			}
		}
	}
}
