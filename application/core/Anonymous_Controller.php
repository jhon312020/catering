<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Anonymous_Controller extends MX_Controller {

    public $ajax_controller = false;
    public $settings;
    public function __construct() {
      parent::__construct();
      $this->config->load('my_config');
      // Don't allow non-ajax requests to ajax controllers
      if ($this->ajax_controller and !$this->input->is_ajax_request()) {
        exit;
      }
			
			define('PAGE_LANGUAGE', 'es');
      $ln = $this->uri->segment(1);
      if($ln == "en") {
        $lang = "english";
				define('PAGE_LANGUAGE', 'en');
      } else $lang = "spanish";
			
			/*check valid login clients*/
			$this->load->model('clients/mdl_clients');
			$this->load->library('session');
			$this->load->helper('url');
			$controller_method = $this->router->fetch_method();
			
			$method_array = array('register', 'index');
			
			if($this->mdl_clients->is_login_clients()) {
				
				//check the requested page is an register page.
				if(in_array($controller_method, $method_array)) {
					redirect(PAGE_LANGUAGE.'/profile');
				}
			} else {
				
				//Check if the request is an ajax.
				if($this->input->is_ajax_request()) {
					echo json_encode(array('error' => 'Invalid clients', 'success' => false));
				} else {
					
					//Check if the requested page is not an register or login page.
					if(!in_array($controller_method, $method_array)) {
						redirect(PAGE_LANGUAGE.'/login');
					}
				}
			}
      
			$this->load->library('user_agent');
      
      $this->load->database();
      $this->load->model('settings/mdl_settings');
      $this->settings = $this->mdl_settings->load_settings();
      $this->load->vars(array('settings'=>$this->settings));
      // some define to use globally
      define('IMAGEPATH', base_url()."assets/default/images/");
			
			//Template path for local images.
			define('TEMPLATE_PATH', base_url()."assets/cc/img/");
			
			//Template path for local images.
			define('MENU_IMAGE_PATH', base_url()."assets/cc/images/menus/");
			
      $this->load->helper('language');
      $this->lang->load('cms', $lang);
      $this->load->module('layout');
    }
}
?>
