<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Homepage extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('homepage/mdl_slider');
		$this->load->model('homepage/mdl_box');
		$this->load->model('settings/mdl_settings');
		$this->path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/homepage/";
	}

	public function index() {
		redirect('admin/homepage/slider');
	}

	public function slider() {
		$this->layout->set(array('path'=>$this->path, 'sliders'=>$this->mdl_slider->get()->result()));
		$this->layout->buffer('content', 'homepage/slider');
		$this->layout->render();
	}
	
	public function slidtoggle($id, $bool){
		if ($id){
			$bool = ($bool) ? false : true;
			$this->mdl_slider->save($id, array('is_active'=>$bool));
			redirect('admin/homepage/slider');
		}
	}
	
	public function banner() {
		$banners = $this->db->get_where('boxes', array('location'=>'banner'))->result();
		$this->layout->set(array('path'=>$this->path, 'boxes'=>$banners, 'type'=>'banner'));
		$this->layout->buffer('content', 'homepage/box');
		$this->layout->render();
	}

	public function box() {
		$boxes = $this->db->get_where('boxes', array('location'=>'boxes'))->result();
		$this->layout->set(array('path'=>$this->path, 'boxes'=>$boxes, 'type'=>'box'));
		$this->layout->buffer('content', 'homepage/box');
		$this->layout->render();
	}

	/**
	 * [form description]
	 * @param  [type] $type [description]
	 * @param  [type] $id   [description]
	 * @return [type]       [description]
	 */
	public function form($type = null, $id = null) {
		//echo '<pre>';
		//print_r($_FILES);
		//print_r($_POST);
		if (is_null($type) || $type === '') {
			redirect('admin/homepage/slider');
		} else if($this->input->post('btn_cancel')) {
			redirect('admin/homepage/'.$type);
		}
		$model  = 'mdl_';
		$model .= ($type == 'banner') ? 'box' : $type;
		if ($type == 'banner' && $this->input->post('btn_submit')) {
			$_POST['title'] = 'banner';
			$_POST['title_es'] = 'banner';
			$_POST['location'] = 'banner';
		}

		if ($this->{$model}->run_validation()) {
			unset($_POST['btn_submit']);
			/*$slider = array(
				'slogan_en'  => $this->input->post('slogan_en'),
				'slogan_es'  => $this->input->post('slogan_es'),
				'image'  => $this->input->post('image')
			);*/
			$id = $this->{$model}->save($id, $this->input->post());
			$data = $this->do_upload($type, $id, 'image');
			
			if($type == 'banner' || $type == 'box') {
				if (isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name']) || isset($_FILES['image_es']) && is_uploaded_file($_FILES['image_es']['tmp_name'])) {
					$data = $this->do_upload($type, $id, 'image_es');
				} 
			}
			if(isset($data['error'])) {
				if(strip_tags($data['error']) == "You did not select a file to upload."){
					//no file uploaded
				} else {
					pr($data['error']);die();
				}
			}
			redirect('admin/homepage/'.$type);
		}
		$count=0;
		if ($id and !$this->input->post('btn_submit')) {
			$this->{$model}->prep_form($id);
			if($type == 'box'){
				$count = current($this->db->select('count(*) as boxcnt')->from('boxes')->where('location','boxes')->get()->result_array());
			}
		}
		
		$colors = array(''=>'Select Color', '#46234B'=>'Purple', '#EE7325'=>'Orange', '#E1A5AD'=>'Pink');
		$this->layout->set(array('path'=>$this->path, 'type'=>$type, 'id'=>$id, 'colors'=>$colors, 'boxcnt'=>$count));
		$this->layout->buffer('content', 'homepage/form');
		$this->layout->render();
	}

	/**
	 * [do_upload description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function do_upload($type, $id, $fname) {
		$config['upload_path'] = './assets/cc/images/homepage/'.($type == 'box' ? 'boxes' : $type) ;
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		$files = $_FILES; // storing all the files in a temp variable;
		$cpt = count($_FILES[$fname]['name']);
		log_message("error", "FILE COUNT = " . $cpt);
		log_message("error", "FILE NAME = " . $files[$fname]['name']);
		$success = $this->upload->do_upload($fname);
		if (!$success) {
			$data = array('error' => $this->upload->display_errors());
		}
		else {
			$data0 = $this->upload->data();
			$data = array('upload_data' => $data0);
			$data['upload_data']['file_url'] = $this->path . $data0['file_name'];
			$model  = 'mdl_';
			$model .= ($type == 'banner') ? 'box' : $type;
			$this->{$model}->save($id, array($fname=>$data['upload_data']['file_name']));
		}
		return $data;
	}

	/**
	 * [delete description]
	 * @param  [type] $type [description]
	 * @param  [type] $id   [description]
	 * @return [type]       [description]
	 */
	public function delete($type = null, $id = null) {
		if (is_null($type) || $type === '' || is_null($id) || $id === '') {
			redirect('admin/homepage/slider');
		}
		$model  = 'mdl_';
		$model .= ($type == 'banner') ? 'box' : $type;
		$this->{$model}->delete($id);
		redirect('admin/homepage/'.$type);
	}
}
