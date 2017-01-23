<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Node extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('node/mdl_nodes');
        $this->load->model('media/mdl_media');
    }

    public function index()
    {
        $this->layout->set('nodes', $this->mdl_nodes->get()->result());
        $this->layout->buffer('content', 'node/index');
        $this->layout->render();
    }

    public function form($id = NULL)
    {
        if ($this->input->post('btn_cancel'))
        {
            redirect('admin/node');
        }

        if ($this->mdl_nodes->run_validation())
        {
			$node= array(
				'title'		=>$this->input->post('title'),
				'show_title'=>($this->input->post('show_title')?1:0),
				'body'		=>$this->input->post('body'),
				'url'		=>$this->input->post('url'),
				'template'	=>$this->input->post('template'),
				'seo_keywords'	=>$this->input->post('seo_keywords'),
				'seo_meta_tags'	=>$this->input->post('seo_meta_tags'),
				'seo_meta_desc'	=>$this->input->post('seo_meta_desc'),
			);
            $this->mdl_nodes->save($id, $node);
            redirect('admin/node');
        }

        if ($id and !$this->input->post('btn_submit'))
        {
			
            $this->mdl_nodes->prep_form($id);
        }

        $this->layout->set('medias', $this->mdl_media->get()->result());
        $this->layout->buffer('content', 'node/form');
        $this->layout->render();
    }

   

    public function delete($id)
    {
        $this->mdl_nodes->delete($id);
        redirect('admin/node');
    }


}

?>
