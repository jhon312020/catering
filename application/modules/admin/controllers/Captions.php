<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


	class Captions extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('captions/mdl_captions');
		$this->load->model('settings/mdl_settings');
		$this->load->helper('text');
		$this->path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/captions/";
	}

	/* public function index()
	{
		$this->layout->set(array('partners'=>$this->mdl_partners->get()->result(), 'path'=>$this->path));
		$this->layout->buffer('content', 'partners/index');
		$this->layout->render();
	} */

	public function form($id = NULL) {
		$name = (is_numeric($this->uri->segment(4)))?$this->uri->segment(5):$this->uri->segment(4);
		$data = $this->mdl_captions->where(array('type'=>$this->uri->segment(4)))->get()->result();
		if(count($data) > 0)
			redirect('admin/'.$name.'/index');
		
		$error_flg = false;
		if ($this->input->post('btn_cancel')) {
			redirect('admin/'.$name);
		}
		if($this->input->post()) {
			if (isset($_POST['settings'])) {
				foreach ($this->input->post('settings') as $key => $value) {
					$this->mdl_settings->save($key, $value);
				}
				unset($_POST['settings']);
			}
			$valid = true;
			if($name != 'faq')
				$valid = $this->mdl_captions->run_validation();
			if ($valid) {
				$captions = array(
					'title_en'	=> $this->input->post('title_en'),
					'title_es'	=> $this->input->post('title_es'),
					'subtitle_en'	=> $this->input->post('subtitle_en'),
					'subtitle_es'	=> $this->input->post('subtitle_es'),
				);
				if ($name !== 'contacts') {
					$captions['content_en']	= $this->input->post('content_en');
					$captions['content_es']	= $this->input->post('content_es');
					if($name !== 'partners') {
						$captions['subcontent_en'] = $this->input->post('subcontent_en');
						$captions['subcontent_es'] = $this->input->post('subcontent_es');
					}
				}
				if(!is_numeric($id)) {
					$id = NULL;
					$captions['type'] = $this->uri->segment(4);
				}
				$id = $this->mdl_captions->save($id, $captions);
				if(isset($_FILES['logo']['name'])) {
					//echo 'comes in';
					//exit;
					$data = $this->do_upload($id);
					if(isset($data['error'])) {
						if(strip_tags($data['error']) == "You did not select a file to upload."){
						//no file uploaded
						} else {
							print_r($data['error']);die();
						}
					}
				}
				$this->load->library('user_agent');
				if(in_array($name, array('franchises', 'aboutus', 'concierge', 'terms_and_conditions'))) {
					redirect($this->agent->referrer());
					//redirect('admin/captions/form/'.$id.'/'.$name);
				}
				else{
					redirect('admin/'.$name.'/index');
				}
			}
		}
		if (is_numeric($id) and !$this->input->post('btn_submit')) {
			$this->mdl_captions->prep_form($id);
		}
		$this->layout->set(array('path'=>$this->path));
		$this->layout->buffer('content', 'captions/form');
		$this->layout->render();
	}

	public function delete($id) {
		$name = (is_numeric($this->uri->segment(4)))?$this->uri->segment(5):$this->uri->segment(4);
		$this->mdl_captions->delete($id);
		redirect('admin/'.$name);
	}

	function do_upload($id) {
		$config['upload_path'] = './assets/cc/images/captions';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		$files = $_FILES; // storing all the files in a temp variable;
		$cpt = count($_FILES['logo']['name']);
		log_message("error", "FILE COUNT = " . $cpt);
		log_message("error", "FILE NAME = " . $files['logo']['name']);
			// overwriting the required data back to $_FILES array.
			/*$_FILES['logo']['name']= $files['logo']['name'];
			$_FILES['logo']['type']= $files['logo']['type'];
			$_FILES['logo']['tmp_name']= $files['logo']['tmp_name'];
			$_FILES['logo']['error']= $files['logo']['error'];
			$_FILES['logo']['size']= $files['logo']['size'];*/
			
			$success = $this->upload->do_upload('logo');
			if ( ! $success) {
				$data = array('error' => $this->upload->display_errors());
				//print_r($data);
				//exit;
				//break;
			}
			else {
				$data0 = $this->upload->data();
				$data = array('upload_data' => $data0);

				$data['upload_data']['file_url'] = $this->path . $data0['file_name'];
				$this->mdl_captions->save($id, array('image'=>$data['upload_data']['file_name']));
			}
		return $data;
	}
}
