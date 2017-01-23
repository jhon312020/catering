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

class Rates extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('rates/mdl_rates');
	}

	public function index() {
		$rates1 = $this->db->get_where('rates', array('rate_type'=>'rate1'))->result();
		$rates2 = $this->db->get_where('rates', array('rate_type'=>'rate2'))->result();
		$rates3 = $this->db->get_where('rates', array('rate_type'=>'rate3'))->result();
		$this->layout->set('rates1', $rates1);
		$this->layout->set('rates2', $rates2);
		$this->layout->set('rates3', $rates3);
		$this->layout->buffer('content', 'rates/index');
		$this->layout->render();
	}

	public function form($id = NULL) {
		/*if ($this->mdl_users->run_validation(($id) ? 'validation_rules_existing' : 'validation_rules')) {
			$this->mdl_users->save($id);
			redirect('users');
		}*/
		foreach($this->input->post('rates') as $id=>$rates) {
			if ($id) {
				$this->mdl_rates->save($id, $rates);
			}
		}
		redirect('admin/rates/index');
	}
}

?>
