<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menus extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('menus/mdl_menus');
		$this->load->model('menu_types/mdl_menu_types');
		$this->path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/menus/";
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
	public function form($id = NULL) {
		$error_flg = false;
		$error = array();
		if ($this->input->post('btn_cancel')) {
			redirect('admin/menus');
		}
		$editForm = false;
		//var_dump($this->mdl_menus->run_validation());die;
		if ($this->mdl_menus->run_validation()) {
			$data = $this->input->post();
			unset($data['btn_submit']);
			$data['menu_date'] = date('Y-m-d', strtotime($data['menu_date']));
			if(is_null($id) || $id == '') {
				$menu_data = $this->mdl_menus->where(['menu_date' => $data['menu_date'], 'menu_type_id' => $data['menu_type_id']])->get()->row();
				$id = null;
				if($menu_data) {
					$id = $menu_data->id;
				}
				$res = $this->mdl_menus->save($id, $data);
			}
			else{
				$this->mdl_menus->save($id,$data);
			}
			$file_array = array('primary_image', 'secondary_image');
			foreach($file_array as $file) {
				if(isset($_FILES[$file]['name']) && $_FILES[$file]['name']) {
					$data = $this->do_upload($id, $file);
				}
			}
			if(!$error_flg) {
				redirect('admin/menus');
			}
		}
		$menuEdit = false;
		$menu_types = $this->mdl_menu_types->where('is_active', 1)->get()->result();
		if($id) {
			$menuEdit = true;
			$data = $this->mdl_menus->where('id', $id)->get()->result_array();
			$menu_types = $this->mdl_menu_types->where('id', $data[0]['menu_type_id'])->get()->result();
		}
		if(($id && !$this->input->post('btn_submit')) or ($id && $this->input->post('btn_submit')) or $this->input->post('btn_submit')) {
			$editForm = true;
		}
		$post_params = $this->input->post();
		$menu_id = $id;
		if(!$id) {
			$menu = $this->mdl_menus->where('menu_date', date('Y-m-d'))->get()->result_array();
			if($menu) {
				$menu_id = array_column($menu, 'id');
			}
		}
		
		$result = array();
		if ($menu_id and !$this->input->post('btn_submit')) {
			if(is_array($menu_id)) {
				$data = $this->mdl_menus->where_in('id', $menu_id)->get()->result_array();
			} else {
				$data = $this->mdl_menus->where('id', $menu_id)->get()->result_array();
				$menu_types = $this->mdl_menu_types->where('id', $data[0]['menu_type_id'])->get()->result();
			}
			foreach($data as $row) {
				$result[$row['menu_type_id']] = $row;
			}
		}
		$show_image = true;
		if($this->input->post('btn_submit')) {
			$show_image = false;
			$result[$post_params['menu_type_id']] = $post_params;
		}
		//print_r($menu_types);die;
		//print_r($result);die;
		/* echo "<pre>";
		echo $editForm;
		print_r(menu_types);
		print_r($result);die; */
		//echo $menuEdit;die;
		$this->layout->set(array('readonly'=>false, 'error'=>$error, 'path'=>base_url().'assets/cc/images/menus/', 'result' => $result, 'menu_types' => $menu_types, 'editForm' => $editForm, 'show_image' => $show_image, 'menuEdit' => $menuEdit));
		$this->layout->buffer('content', 'menus/form');
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
		$this->layout->set(array('readonly'=>true, 'error'=>$error, 'path'=>'./assets/cc/images/menus/'));
		$this->layout->buffer('content', 'menus/form');
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
}