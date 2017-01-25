<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*
 * FusionInvoice
 * 
 * A free and open source web based invoicing system
 *
 * @package		FusionInvoice
 * @author		Jesse Terry
 * @copyright	Copyright (c) 2012 - 2013, Jesse Terry
 * @license		http://www.fusioninvoice.com/license.txt
 * @link		http://www.fusioninvoice.
 * 
 */

class Dashboard extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('settings/mdl_settings');
	}

	public function index() {
		$this->load->model('business/mdl_business');
		$this->load->model('clients/mdl_clients');
		$this->load->model('menus/mdl_menus');

		$today_menus = $this->mdl_menus->where('created_at', date('Y-m-d'))->get()->num_rows();
		$total_clients = $this->mdl_clients->get()->num_rows();
		$total_business = $this->mdl_business->get()->num_rows();
		$data = array(
			'today_menus' => $today_menus,
			'total_clients' => $total_clients,
			'total_business' => $total_business,
		);
		/*$otherdb = $this->load->database('otherdb', TRUE);
		$data = $otherdb->query('show tables')->result_array();
		print_r($data);die;*/
		$this->layout->set($data);
		$this->layout->buffer('content', 'admin/index');
		$this->layout->render();
	}
	
	public function set_lang($lang) {
		if(trim($lang) == "english") {
			$lang = "spanish";
		} else if (trim($lang) == "spanish") {
			$lang = "english";
		}
		$newdata = array(
			'cms_lang'  => $lang,
		);
		//print_r($newdata);die();
		$this->session->set_userdata($newdata);
		$this->load->library('user_agent');
		if ($this->agent->is_referral()) {
			redirect($this->agent->referrer());
		} else{
			redirect('admin/dashboard');
		}
	}
}
?>
