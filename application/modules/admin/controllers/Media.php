<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Media extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('media/mdl_media');
        $this->load->model('settings/mdl_settings');
    }

    public function index()
    {
        $this->layout->set('medias', $this->mdl_media->get()->result());
        $this->layout->buffer('content', 'media/index');
        $this->layout->render();
    }

    public function form($id = NULL)
    {
		$error_flg = false;
        if ($this->input->post('btn_cancel'))
        {
            redirect('admin/media');
        }

        if ($this->mdl_media->run_validation())
        {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
			
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload("media_file"))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('alert_error', $error['error']);
				$error_flg = true;
			}
			else
			{
				$media = $this->upload->data();
				$media['file_url'] = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder').$media['file_name'];
				$this->mdl_media->save($id, $media);
			}
			if(!$error_flg)
            redirect('admin/media');
        }

        if ($id and !$this->input->post('btn_submit'))
        {
			
            $this->mdl_media->prep_form($id);
        }

        $this->layout->buffer('content', 'media/form');
        $this->layout->render();
    }

   

    public function delete($id)
    {
        $this->mdl_media->delete($id);
        redirect('admin/media');
    }


}

?>
