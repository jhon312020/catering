<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Aboutus extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('captions/mdl_captions');
        $this->load->model('settings/mdl_settings');
        $this->load->helper('text');
        $this->path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/aboutus/";
		$this->caption_path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/captions/";
    }

    public function index()
    {
        $this->layout->set(array('aboutus'=>$this->mdl_captions->where(array('type' => 'aboutus'))->order_by('created', 'desc')->get()->result(), 'path'=>$this->path, 'caption_path' => $this->caption_path));
        $this->layout->buffer('content', 'aboutus/index');
        $this->layout->render();
    }

   public function form($id = NULL)
    {
		if(count($this->mdl_captions->where(array('type' => 'aboutus'))->get()->result()) > 0)
			redirect('admin/aboutus');
		
		$error_flg = false;
        if ($this->input->post('btn_cancel'))
        {
            redirect('admin/aboutus');
        }

        if ($this->mdl_aboutus->run_validation())
        {
			unset($_POST['btn_submit']);
			$id = $this->mdl_aboutus->save($id, $this->input->post());
			if(!$error_flg)			
            redirect('admin/aboutus');
        }

        if ($id and !$this->input->post('btn_submit'))
        {
            $this->mdl_aboutus->prep_form($id);
        }
        $this->layout->set(array('path'=>$this->path));
        $this->layout->buffer('content', 'aboutus/form');
        $this->layout->render();
    }

    public function delete($id)
    {
        $this->mdl_aboutus->delete($id);
        redirect('admin/aboutus');
    }

    function do_upload($id)
    {
        $config['upload_path'] = './assets/cc/images/aboutus';
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
                break;
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
