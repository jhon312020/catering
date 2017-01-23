<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Base_Controller extends MX_Controller {

    public $ajax_controller = false;
	public $tables = array('1'=>'table 1', '2' => 'table 2');
	public $templates;
	
    public function __construct()
    {
        parent::__construct();

        $this->config->load('my_config');

        // Don't allow non-ajax requests to ajax controllers
        if ($this->ajax_controller and !$this->input->is_ajax_request())
        {
            exit;
        }

        $this->load->library('session');
        $this->load->helper('url');

        $this->load->database();
		$this->load->helper('language');
		$this->lang->load('cms', $this->session->userdata('cms_lang'));
		//print_r($this->session->all_userdata());die();
		
        $this->load->library('form_validation');
        $this->load->helper('number');
        $this->load->helper('pager');
        $this->load->helper('date');
        $this->load->library('sphinxsearch');
		$this->sphinxsearch->SetMatchMode( SPH_MATCH_EXTENDED2 );
		// Load setting model and load settings
        $this->load->model('settings/mdl_settings');
        $this->mdl_settings->load_settings();
		
        // some define to use globally
		define('IMAGEPATH',base_url()."assets/default/images/");
		
		$this->load->helper('language');

        $this->load->module('layout');
        //ckeditor
        //http://stackoverflow.com/questions/11814937/ckeditor-in-codeigniter
        $this->load->library('ckeditor');
		$this->load->library('ckfinder');



		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
						array( 'Source', '-', 'Bold', 'Italic',  'Underline', '-', 'Cut', 'Copy', 'Paste','PasteText','PasteFromWord', '-', 'Undo', 'Redo' ),
						 array('JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'),
						);
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['width'] = '600px';
		$this->ckeditor->config['height'] = '300px';            
		$this->ckeditor->config['allowedContent'] = TRUE;     
		//Add Ckfinder to Ckeditor

		
		$this->ckfinder->SetupCKEditor($this->ckeditor,"../../../../assets/ckfinder/"); 
		
		$this->getTemplates();
		
    }

	/*
	 * @for developer
	 * @debug the data passed
	 */

	function debug($data, $print_r = TRUE){
		// Print $data contents to string.
	  $string = $print_r ? print_r($data, TRUE) : var_export($data, TRUE);

	  // Display values with pre-formatting to increase readability.
	  $caller = current(debug_backtrace());
	  //print_r($caller);
	  echo "<div style='background-color:#D5F4D5'>";
	  printf ( 'Debugging from file :%s line %d',  $caller['file'], $caller['line']);
	  $string = '<pre>' . $string . '</pre>';
	  print($string);
	  echo "</div>";
	}
	function getTemplates(){
		$this->load->helper('directory');
		$this->templates = directory_map('application/modules/layout/views/templates/', FALSE, TRUE);		
	}
}

?>
