<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Anonymous_Controller extends MX_Controller {

    public $ajax_controller = false;

    public function __construct() {
      parent::__construct();
      $this->config->load('my_config');
      // Don't allow non-ajax requests to ajax controllers
      if ($this->ajax_controller and !$this->input->is_ajax_request()) {
        exit;
      }
      $this->load->library('session');
      $this->load->helper('url');
      $this->load->database();
      $this->load->model('settings/mdl_settings');
      $this->mdl_settings->load_settings();
      // some define to use globally
      define('IMAGEPATH',base_url()."assets/default/images/");
      $ln = $this->uri->segment(1);
      if($ln == "en") {
        $lang = "english";
      } else $lang = "spanish";
      $this->load->helper('language');
      $this->lang->load('cms', $lang);
      $this->load->model('menu/mdl_menu');
      $this->load->module('layout');
    }
}
?>
