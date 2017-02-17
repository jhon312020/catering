<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Plats extends Admin_Controller {
 /**
  * Function index
  * Displays the list of plates
  * @return  Array
  * 
  */
 var $internal_codes = array(0=>'', 1=>1, 2=>2, 3=>3, 4=>4);
	public function __construct() {
		parent::__construct();
		$this->load->model('plats/mdl_plats');
		$this->path = base_url().$this->mdl_settings->setting('upload_folder')."images/plats/";
	}

 /**
  * Function index
  * Displays the list of plats
  * @return  Array
  * 
  */
	public function index() {
		$plats = $this->mdl_plats->get_all_plats();
		$this->layout->set(array('plats' => $plats));
		$this->layout->buffer('content', 'plats/index');
		$this->layout->render();
	}
 /**
  * Function form
  * Displays the list of plats
  * @return  Array
  * 
  */
	public function form($id = NULL) {
		$error_flg = false;
		$error = array();
		if ($this->input->post('btn_cancel')) {
			redirect('admin/plats');
		}
		if ($this->input->post()) {
			if (empty($_FILES['image']['name'])) {
			    $this->form_validation->set_rules('image', lang('image'), 'required');
			}
			if ($this->mdl_plats->run_validation()) {
				$data = $this->input->post();
				unset($data['btn_submit']);
				if (is_null($id) || $id == ''){
					$id = $this->mdl_plats->save(null, $data);
				} else {
					$this->mdl_plats->save($id,$data);
				}
				if (isset($_FILES['image']['name'])) {
					$data = $this->do_upload($id);
					if (isset($data['error'])) {
						if (strip_tags($data['error']) == "You did not select a file to upload."){
						} else {
							print_r($data['error']);die();
						}
					}
				}
				if (!$error_flg) {
					redirect('admin/plats');
				}
			}
		}
		if ($id and !$this->input->post('btn_submit')) {
			$this->mdl_plats->prep_form($id);
		}
		$this->layout->set(array('readonly'=>false, 'error'=>$error, 'internal_codes'=>$this->internal_codes));
		$this->layout->buffer('content', 'plats/form');
		$this->layout->render();
	}
	/**
   * Function edit
   * it displays the edit page
   * for plats
   * @return  Array
   * 
   */
	public function edit($id) {
		$error = [];
		$bool = true;
		if ($this->input->post('btn_cancel')) {
			redirect('admin/plats');
		}
		if ($this->input->post()) {
			$plat_obj = $this->mdl_plats->get_by_id($id);
			//Checking already image exists
			$old_image_exists = false;
			if (is_object($plat_obj) && $plat_obj->image != '') {
				$old_image_exists = true;
			}
			if (empty($_FILES['image']['name']) && !($old_image_exists)) {
			    $this->form_validation->set_rules('image', lang('image'), 'required');
			}
			if ($this->mdl_plats->run_validation()) {
				$data = $this->input->post();
				
				if ($bool) {
					unset($data['btn_submit']);
					$this->mdl_plats->save($id, $data);
					
					$data = $this->do_upload($id);
					if (isset($data['error'])) {
						if (strip_tags($data['error']) == "You did not select a file to upload."){
						} else {
							print_r($data['error']);die();
						}
					}
					redirect('admin/plats');
				}
			}
		}
		$this->mdl_plats->prep_form($id);
		$this->layout->set(array('readonly'=>false, 'path' => $this->path, 'error'=>$error, 'internal_codes'=>$this->internal_codes));
		$this->layout->buffer('content', 'plats/edit');
		$this->layout->render();
	}
	/**
   * Function view
   * it displays the view page
   * for plats
   * @return  Array
   * 
   */
	public function view($id) {
		$error_flg = false;
		$error = array();
		if ($this->input->post('btn_cancel')) {
			redirect('admin/plats');
		}
		$this->mdl_plats->prep_form($id);
		$this->layout->set(array('readonly'=>true, 'error'=>$error, 'path'=> $this->path, 'internal_codes'=>$this->internal_codes));
		$this->layout->buffer('content', 'plats/edit');
		$this->layout->render();
	}
	public function toggle($id, $bool){
		if ($id){
			$bool = ($bool) ? false : true;
			$this->mdl_plats->save($id, array('is_active'=>$bool));
			redirect('admin/plats');
		}
	}
	public function delete($id) {
		$this->mdl_plats->delete($id);
		redirect('admin/plats');
	}
	/**
   * Function do_upload
   * for selected date.
   * @return  Array
   * 
   */
	function do_upload($id) {
		$config['upload_path'] = './assets/cc/images/plats';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		$files = $_FILES; // storing all the files in a temp variable;
		$cpt = count($_FILES['image']['name']);
		log_message("error", "FILE COUNT = " . $cpt);
		log_message("error", "FILE NAME = " . $files['image']['name']);
		$success = $this->upload->do_upload('image');
		if ( ! $success) {
			$data = array('error' => $this->upload->display_errors());
		} else {
			$data0 = $this->upload->data();
			$data = array('upload_data' => $data0);

			$data['upload_data']['file_url'] = $this->path . $data0['file_name'];
			$this->mdl_plats->save($id, array('image'=>$data['upload_data']['file_name']));
		}
		return $data;
	}
}