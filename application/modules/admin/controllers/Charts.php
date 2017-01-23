<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Charts extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('charts/mdl_charts');
	}

	public function index() {
		$end_date = Date('Y-m-d');
		$start_date = date('Y-m-d', strtotime('-7 days'));
		$error = array();
		if($this->input->post('start_date')) {
			$chartStartDate = str_replace('/','-',$this->input->post('start_date'));
			$startDate = date('Y-m-d', strtotime($chartStartDate));
			$chartEndDate = str_replace('/','-',$this->input->post('end_date'));
			$endDate = date('Y-m-d', strtotime($chartEndDate));
			if($startDate <= $endDate) {
				$end_date = $endDate;
				$start_date = $startDate;
			} else {
				$error['error'] = 'Start date should be less than the end date';
			}
		}
		//print_r($error);die;
		$this->layout->set(
						array(
							'book_list' => $this->mdl_charts->get_booklist($start_date, $end_date),
							'book_bill' => $this->mdl_charts->get_bookbill($start_date, $end_date),
							'passenger_by_zone'=>$this->mdl_charts->get_passengerByZone($start_date, $end_date),
							'passengers_country'=>$this->mdl_charts->get_passengerByCountryDate($start_date, $end_date),
							/*'collaborator_book_bill' => $this->mdl_charts->get_bookBillByCollaborator($start_date, $end_date), 'collaborator_book_count' => $this->mdl_charts->get_bookCountByCollaborator($start_date, $end_date),*/ 'start_date'=>$start_date, 'end_date' => $end_date, 'error'=> $error
						));
		$this->layout->buffer('content', 'charts/index');
		$this->layout->render();
	}

}
?>
