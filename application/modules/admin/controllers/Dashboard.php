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
		$this->load->model('collaborators/mdl_collaborators');
		$this->load->model('routes/mdl_calendars');
		$this->load->model('routes/mdl_routes');
		$this->load->model('faq/mdl_faq');
		$this->load->model('shuttles/mdl_shuttles');
		$this->load->model('partners/mdl_partners');
		$this->load->model('contacts/mdl_contacts');
		$this->load->model('users/mdl_clients');
		$this->load->model('charts/mdl_charts');
		$total_passengers = $this->db->query("select sum(kids+adults) as total from tbl_booking where is_active=1")->row();
		$total_price = $this->db->query("select sum(price) as total from tbl_booking where is_active=1")->row();
		$today_sales = $this->db->query("select sum(price) as total from tbl_booking where is_active=1 and created like '".Date('Y-m-d')."%'")->row();
		$today_billing = $this->db->query("select sum(price) as total from tbl_booking where is_active=1 and start_journey = '".Date('Y-m-d')."'")->row();
		$today_passengers = $this->db->query("select sum(kids+adults) as total from tbl_booking where is_active=1 and start_journey = '".Date('Y-m-d')."'")->row();
		$data = array(
			'shuttles' =>$this->mdl_shuttles->get()->num_rows(),
			'partners' =>$this->mdl_partners->get()->num_rows(),
			'contacts' =>$this->mdl_contacts->get()->num_rows(),
			'collaborators' =>$this->mdl_collaborators->get()->num_rows(),
			'calendars' => $this->mdl_calendars->get()->num_rows(),
			'clients' => $this->mdl_clients->get()->num_rows(),
			'routes' => $this->mdl_routes->get()->num_rows(),
			'faq' =>$this->mdl_faq->get()->num_rows(),
			'total_passengers' =>$total_passengers->total,
			'total_price'=>$total_price->total,
			'passengers_country'=>$this->mdl_charts->get_passengerByCountry(),
			'today_booking'=>$this->mdl_shuttles->where("start_journey = '".Date('Y-m-d')."' and is_active = 1")->get()->num_rows(),
			'today_billing'=>$today_billing->total,
			'today_sales'=>$today_sales->total,
			'today_passengers'=>$today_passengers->total
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
