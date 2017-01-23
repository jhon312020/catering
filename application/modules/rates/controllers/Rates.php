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
		$this->load->model('mdl_rates');
	}

	public function index() {
		$this->layout->set('rates', $this->mdl_rates->result());
		$this->layout->buffer('content', 'rates/index');
		$this->layout->render();
	}

	public function form($id = NULL) {
		if ($this->input->post('btn_cancel')) {
			redirect('users');
		}

		if ($this->mdl_users->run_validation(($id) ? 'validation_rules_existing' : 'validation_rules')) {
			$this->mdl_users->save($id);
			redirect('users');
		}

		if ($id and !$this->input->post('btn_submit')) {
			$this->mdl_users->prep_form($id);
		}

		$this->layout->buffer('user_client_table', 'users/partial_user_client_table');
		$this->layout->buffer('modal_user_client', 'users/modal_user_client');
		$this->layout->buffer('content', 'users/form');
		$this->layout->render();
	}
}

?>
