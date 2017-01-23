<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('mdl_settings');
    $this->mdl_settings->load_settings();
        $this->load->library('form_validation');
        $this->load->helper('number');
        $this->load->helper('pager');
        $this->load->helper('date');

    $this->load->library('ckeditor');
    $this->load->library('ckfinder');
    
    define('IMAGEPATH',base_url()."assets/default/images/");
    
    $this->lang->load('cms', $this->session->userdata('cms_lang'));
    
    $this->ckeditor->basePath = base_url().'assets/ckeditor/';
    $this->ckeditor->config['toolbar'] = array(
            array( 'Source', '-', 'Bold', 'Italic',  'Underline', '-', 'Cut', 'Copy', 'Paste','PasteText','PasteFromWord', '-', 'Undo', 'Redo' ),
             array('JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'),
            );
    $this->ckeditor->config['language'] = 'en';
    $this->ckeditor->config['width'] = '600px';
    $this->ckeditor->config['height'] = '300px';            
    $this->ckeditor->config['allowedContent'] = TRUE;
  }
}
