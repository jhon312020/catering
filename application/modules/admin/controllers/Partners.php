<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Partners extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('partners/mdl_partners');
		$this->load->model('captions/mdl_captions');
        $this->load->model('settings/mdl_settings');
        $this->load->helper('text');
        $this->path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/partners/";
		$this->caption_path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/captions/";
    }

    public function index()
    {
        $this->layout->set(array('partners'=>$this->mdl_partners->order_by('created', 'desc')->get()->result(), 
								'banner'=>$this->mdl_captions->where(array('type' => 'partners'))->order_by('created', 'desc')->get()->result(), 'path'=>$this->path, 'caption_path' => $this->caption_path));
        $this->layout->buffer('content', 'partners/index');
        $this->layout->render();
    }

   public function form($id = NULL)
    {
		$error_flg = false;
        if ($this->input->post('btn_cancel'))
        {
            redirect('admin/partners');
        }

        if ($this->mdl_partners->run_validation())
        {
			$partners = array(
				'name'	=> $this->input->post('name'),
				'url'	=> $this->input->post('url')
			);
			$id = $this->mdl_partners->save($id, $partners);
            if(isset($_FILES['logo']['name'])) {
                $data = $this->do_upload($id);
                if(isset($data['error'])){
                    if(strip_tags($data['error']) == "You did not select a file to upload."){
                    //no file uploaded
                    }else{
                        print_r($data['error']);die();
                    }
                }
            }

			
			if(!$error_flg)			
            redirect('admin/partners');
        }

        if ($id and !$this->input->post('btn_submit'))
        {
            $this->mdl_partners->prep_form($id);
        }
        $this->layout->set(array('path'=>$this->path));
        $this->layout->buffer('content', 'partners/form');
        $this->layout->render();
    }

    public function delete($id)
    {
        $this->mdl_partners->delete($id);
        redirect('admin/partners');
    }

    function do_upload($id)
    {
        $config['upload_path'] = './assets/cc/images/partners';
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
            if ( ! $success)
            {
                $data = array('error' => $this->upload->display_errors());
                //break;
            }
            else
            {
                $data0 = $this->upload->data();
                $data = array('upload_data' => $data0);

                $data['upload_data']['file_url'] = $this->path . $data0['file_name'];
                $this->mdl_partners->save($id, array('logo'=>$data['upload_data']['file_name']));
            }
        return $data;
    }
}