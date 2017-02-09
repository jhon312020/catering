<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menus extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('menus/mdl_menus');
		$this->load->model('menu_types/mdl_menu_types');
		$this->path = base_url().$this->mdl_settings->setting('upload_folder')."images/menus/";
	}
	public function index() {
		$menus = $this->mdl_menus
							->select('menus.id, menus.menu_type_id, menus.menu_date, menus.complement, menus.primary_plate, menus.description_primary_plate, menus.secondary_plate, menus.description_secondary_plate, menus.postre, menus.disabled, menus.is_active, menu_types.menu_name')
							->join('menu_types', 'menu_types.id = menus.menu_type_id', 'left')
							->order_by('menu_date')
							->get()->result();
		$this->layout->set(array('menus' => $menus));
		$this->layout->buffer('content', 'menus/index');
		$this->layout->render();
	}
	public function form() {
		$error = [];
		$bool = true;
		$isBasicHasRecords = false;
		$isDietHasRecords = false;
		if ($this->input->post('btn_cancel')) {
			redirect('admin/menus');
		}
		$data = $this->input->post();
		if ($data){
			if ($data['Basic']['primary_plate'] || $data['Basic']['description_primary_plate'] || $data['Basic']['secondary_plate'] || $data['Basic']['description_secondary_plate']){
				$isBasicHasRecords = true;
				$this->form_validation->set_data($data['Basic']);
				unset($data['Basic']['primary_image'], $data['Basic']['secondary_image']);
				if(!$_FILES['Basic']['name']['primary_image']) {
					$bool = false;
					$error[] = 'The primary image field is required.';
				}
				if(!$_FILES['Basic']['name']['secondary_image']) {
					$bool = false;
					$error[] = 'The secondary image field is required.';
				}
			}
			if ($data['Diet']['primary_plate'] || $data['Diet']['description_primary_plate'] || $data['Diet']['secondary_plate'] || $data['Diet']['description_secondary_plate']){
				$isDietHasRecords = true;
				$this->form_validation->set_data($data['Diet']);
				unset($data['Diet']['primary_image'], $data['Diet']['secondary_image']);
				if(!$_FILES['Diet']['name']['primary_image']) {
					$bool = false;
					$error[] = 'The primary image field is required.';
				}
				if(!$_FILES['Diet']['name']['secondary_image']) {
					$bool = false;
					$error[] = 'The secondary image field is required.';
				}
			}
		}
		
		if ($this->mdl_menus->run_validation()) {
			unset($data['btn_submit']);
			if($bool) {
				if ($isBasicHasRecords && $isDietHasRecords){
					foreach ($data as $key => $record) {
						$id = $this->mdl_menus->save(null, $record);
						$this->_resetFilesInputBasedOnMenuType($key);
						$files = array('primary_image', 'secondary_image');
						foreach($files as $file) {
							$this->do_upload($id, $file);
						}
					}
				}
				elseif ($isBasicHasRecords) {
					$id = $this->mdl_menus->save(null, $data['Basic']);
					$this->_resetFilesInputBasedOnMenuType('Basic');
					$files = array('primary_image', 'secondary_image');
					foreach($files as $file) {
						$this->do_upload($id, $file);
					}
				}
				elseif ($isDietHasRecords) {
					$id = $this->mdl_menus->save(null, $data['Diet']);
					$this->_resetFilesInputBasedOnMenuType('Diet');
					$files = array('primary_image', 'secondary_image');
					foreach($files as $file) {
						$this->do_upload($id, $file);
					}
				}

				/*$id = $this->mdl_menus->save(null, $data);
				$files = array('primary_image', 'secondary_image');
				foreach($files as $file) {
					$this->do_upload($id, $file);
				}*/
				redirect('admin/menus');
			}
		}
		
		$menu_types = $this->mdl_menu_types->get()->result();
		$this->mdl_menus->prep_form(null);
		$this->layout->set(array('readonly'=>false, 'error'=>$error, 'menu_types' => $menu_types));
		$this->layout->buffer('content', 'menus/form');
		$this->layout->render();
	}
	public function edit($id) {
		$error = [];
		$bool = true;
		if ($this->input->post('btn_cancel')) {
			redirect('admin/menus');
		}
		if ($this->mdl_menus->run_validation()) {
			$data = $this->input->post();
			unset($data['btn_submit'], $data['primary_image'], $data['secondary_image']);
			if($bool) {
				$this->mdl_menus->save($id, $data);
				if($_FILES['primary_image']['name']) {
					$this->do_upload($id, 'primary_image');
				}
				if($_FILES['secondary_image']['name']) {
					$this->do_upload($id, 'secondary_image');
				}
				redirect('admin/menus');
			}
		}
		
		$this->mdl_menus->prep_form($id);
		
		$menu_type_id = $this->mdl_menus->form_value('menu_type_id');
		$menu_types = $this->mdl_menu_types->where('id', $menu_type_id)->get()->result();
		
		
		$this->layout->set(array('readonly'=>false, 'path' => $this->path, 'error'=>$error, 'menu_types' => $menu_types));
		$this->layout->buffer('content', 'menus/edit');
		$this->layout->render();
	}
	public function getMenus() {
		$data = $this->input->post();
		$menus = $this->mdl_menus->where('menu_date', date('Y-m-d', strtotime($data['menu_date'])))->get()->result_array();
		$menu_type_id = array_column($menus, 'menu_type_id');
		echo json_encode($menu_type_id);exit;
	}
	public function view($id) {
		$error_flg = false;
		$error = array();
		if ($this->input->post('btn_cancel')) {
			redirect('admin/menus');
		}
		$this->mdl_menus->prep_form($id);
		
		$menu_type_id = $this->mdl_menus->form_value('menu_type_id');
		$menu_types = $this->mdl_menu_types->where('id', $menu_type_id)->get()->result();
		
		$this->layout->set(array('readonly'=>true, 'error'=>$error, 'path'=> $this->path, 'menu_types' => $menu_types));
		$this->layout->buffer('content', 'menus/edit');
		$this->layout->render();
	}
	public function toggle($id, $bool){
		if ($id){
			$bool = ($bool) ? false : true;
			$this->mdl_menus->save($id, array('is_active'=>$bool));
			redirect('admin/menus');
		}
	}
	public function delete($id) {
		$this->mdl_menus->delete($id);
		redirect('admin/menus');
	}
	function do_upload($id, $name) {
		$config['upload_path'] = './assets/cc/images/menus/';
		if(!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, true);
		}
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		//print_r($_FILES);
		$files = $_FILES; // storing all the files in a temp variable;
		$cpt = count($_FILES[$name]);
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
			$this->mdl_menus->save($id, array($name=>$data['file_name']));
		}
		return $data;
  }

  function _resetFilesInputBasedOnMenuType($type){
  	$_FILES['primary_image']['name'] = $_FILES[$type]['name']['primary_image'];
  	$_FILES['primary_image']['type'] = $_FILES[$type]['type']['primary_image'];
  	$_FILES['primary_image']['size'] = $_FILES[$type]['size']['primary_image'];
  	$_FILES['primary_image']['error'] = $_FILES[$type]['error']['primary_image'];
  	$_FILES['primary_image']['tmp_name'] = $_FILES[$type]['tmp_name']['primary_image'];
  	$_FILES['secondary_image']['name'] = $_FILES[$type]['name']['secondary_image'];
  	$_FILES['secondary_image']['type'] = $_FILES[$type]['type']['secondary_image'];
  	$_FILES['secondary_image']['size'] = $_FILES[$type]['size']['secondary_image'];
  	$_FILES['secondary_image']['error'] = $_FILES[$type]['error']['secondary_image'];
  	$_FILES['secondary_image']['tmp_name'] = $_FILES[$type]['tmp_name']['secondary_image'];
  	unset($_FILES['Basic']);
  }
}