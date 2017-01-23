<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Concierge extends Admin_Controller {

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
        $this->layout->set(array('concierge' => $this->mdl_captions->where(array('type' => 'concierge'))->order_by('created', 'desc')->get()->result(), 'path'=>$this->path, 'caption_path' => $this->caption_path));
        $this->layout->buffer('content', 'concierge/index');
        $this->layout->render();
    }

   public function form($id = NULL)
    {
		if(count($this->mdl_captions->where(array('type' => 'aboutus'))->get()->result()) > 0)
			redirect('admin/franchises');
		
		$error_flg = false;
        if ($this->input->post('btn_cancel'))
        {
            redirect('admin/franchises');
        }

        if ($this->mdl_aboutus->run_validation())
        {
			unset($_POST['btn_submit']);
			$id = $this->mdl_aboutus->save($id, $this->input->post());
			if(!$error_flg)			
            redirect('admin/franchises');
        }

        if ($id and !$this->input->post('btn_submit'))
        {
            $this->mdl_aboutus->prep_form($id);
        }
        $this->layout->set(array('path'=>$this->path));
        $this->layout->buffer('content', 'franchises/form');
        $this->layout->render();
    }

    public function delete($id)
    {
        $this->mdl_aboutus->delete($id);
        redirect('admin/franchises');
    }
}