<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cron extends Anonymous_Controller {
	private $site_contact = '';
	public function __construct() {
    parent::__construct();
    $this->load->model('contacts/mdl_contacts');
    $this->load->model('clients/mdl_clients');
    $this->load->model('business/mdl_business');
    $this->load->model('orders/mdl_orders');

    $this->load->helper("order_helper");
    $this->site_contact = $this->mdl_contacts->where(array('is_active' => 1))->get()->row();
  }

	/**
     * Function clean_incomplete_orders()
     * Used to remove orded exists 5 mins booking.
     * @return array of orders id
     */
	public function clean_incomplete_orders() {
		/*$newTime = strtotime('-5 minutes');
		$time = date('Y-m-d H:i:s', $newTime);*/

		$qry = $this->db->from('orders')->where(array('order_code !='=>'', 'is_active'=>0))
									->where("created_at < date_sub(now(),INTERVAL 5 MINUTE)")->get();
		if ($qry->num_rows()) {
			$result = $qry->result_array();
			foreach ($result as $key=>$record) {
				$result[$key]['reason'] = 'expired';
			}
			$this->db->insert_batch('tbl_orders_deleted',$result);
			$id = array_map(function ($value) {return  $value['id'];}, $result);
			$this->db->where(array('order_code !='=>'', 'is_active'=>0))->where("created_at < date_sub(now(),INTERVAL 5 MINUTE)");
			$this->db->delete('orders');
			$this->db->where_in('order_id',$id);
			$this->db->delete(array('order_drinks','order_reports'));
			echo "Total no of records removed ".count($id);
			echo "<br/>The following ids has been removed";
			echo "<pre>";
			print_r($id);
		}
	}

	/**
	 * @Function invoiceUsers
	 * Create the pdf for users with in month
   * for payment success
   * @params
   *  	$month                   - Month which is going to generate the pdf for users
   *  	$year                    - Year which is going to generate the pdf for users
   *  	$user_id                 - Unique id for the users.
	 *
	 * @return
	 * 		The generated pdf url.
   * 
	*/
  public function invoiceUsers ($user_id, $month, $year) {
  	//echo $user_id.'-----'.$month.'-----'.$year;die;
  	$data_array = [];
  	$date = '01-'.$month.'-'.$year;
  	$month_text = date('F', strtotime($date));
  	$data_array['orders'] = $this->mdl_orders->get_orders_by_user_month($user_id, $month, $year);
  	/*echo "<pre>";
  	print_r($data_array);die;*/
  	$users = $this->mdl_clients->where('id', $user_id)->get()->row();
    $emailToAddress = $users->email;
    //$emailToAddress = 'bright@proisc.com';

  	$pdf = $this->load->view('layout/pdf/invoice_users.php',$data_array, TRUE);
		$this->load->helper(array('dompdf', 'file'));
    $output = pdf_create($pdf, 'user_invoice_'.$users->id.'_'.$month.'_'.$year, false);

    /*Email*/
    $this->load->library('email');
		$subject  = 'Pedido online orders for the month  '.$month_text.' '.$year;
		$body = "Please find the attached pdf for orders in the month of ".$month_text.' '.$year;
    $this->email->set_mailtype("html");
    //Need to change admin email dynamically
    $this->email->from($this->site_contact->email, 'Gumen-Catering');
    $this->email->to($emailToAddress);
    //$this->email->to('jeeva@proisc.com');
    $this->email->subject($subject);
    $this->email->message($body);
    $this->email->attach($output);
		$this->email->send();

		return true;
  }

	/**
	 * @Function invoiceBussiness
	 * Create the pdf for bussiness with in month
   * for payment success
   * @params
   *  	$month                   - Month which is going to generate the pdf for users
   *  	$year                    - Year which is going to generate the pdf for users
   *  	$business_id            - Unique id for the bussiness.
	 *
	 * @return
	 * 		The generated pdf url.
   * 
	*/
  public function invoiceBusiness ($business_id, $month, $year) {
  	$data_array = [];

  	$business = $this->mdl_business->where('id', $business_id)->get()->row();
    $emailToAddress = $business->email;
    //$emailToAddress = 'bright@proisc.com';

  	//echo "<pre>";
  	$date = '01-'.$month.'-'.$year;
  	$month_text = date('F', strtotime($date));
  	$length = $this->mdl_orders->get_orders_by_business_month_count($business_id, $month, $year);
  	//echo $length;die;
  	$this->load->helper(array('dompdf', 'file'));
  	$file_lists = [];
  	$i = 0;
  	$pdf_limit = PDF_LIMIT;

  	$this->load->library('email');
  	if ($length >= $pdf_limit) {
  		$count = floor($length/$pdf_limit);
  		//echo $count;die;
  		while ($count >= 1) {
  			$limit = $i + $pdf_limit;
  			if ($count == 1) {
  				$limit = $length % $pdf_limit;
  			}

  			/*PDF creation*/
  			$data_array['orders'] = $this->mdl_orders->get_orders_by_business_month($business_id, $month, $year, $i);
  			/*echo "<pre>";
  			print_r($data_array);die;*/
  			$pdf = $this->load->view('layout/pdf/invoice_business.php',$data_array, TRUE);		
  			$file_name = 'business_'.$business_id.'_'.$month.'_'.$year.'_'.($i + 1).'_to_'.$limit;
  			$output = pdf_create($pdf, $file_name, false);
  			//$file_lists[] = $file_name;

  			/*Email*/
  			$subject  = 'Pedido online orders for the month  '.$month_text.' '.$year.' record from '.($i + 1).' to '.$limit;
  			$body = "Please find the attached pdf for orders in the month of ".$month_text.' '.$year;
		    $this->email->set_mailtype("html");
		    //Need to change admin email dynamically
		    $this->email->from($this->site_contact->email, 'Gumen-Catering');
		    $this->email->to($emailToAddress);
		    //$this->email->to('jeeva@proisc.com');
		    $this->email->subject($subject);
		    $this->email->message($body);
		    $this->email->attach($output);
    		$this->email->send();

  			$count--;
  			$i+=$pdf_limit;
  		}
  	} else {

  		/*PDF creation*/
  		$data_array['orders'] = $this->mdl_orders->get_orders_by_business_month($business_id, $month, $year, $i);
			//print_r($data_array['orders']);die;
			$pdf = $this->load->view('layout/pdf/invoice_business.php',$data_array, TRUE);		
			$file_name = 'business_'.$month.'_'.$year;
			$output = pdf_create($pdf, $file_name, false);

			/*Email*/
			$subject  = 'Pedido online orders for the month  '.date('F', strtotime($date)).' '.$year;
			$body = "Please find the attached pdf for orders in the month of ".date('F', strtotime($date)).' '.$year;
	    $this->email->set_mailtype("html");
	    //Need to change admin email dynamically
	    $this->email->from($this->site_contact->email, 'Gumen-Catering');
	    $this->email->to($emailToAddress);
	    //$this->email->to('jeeva@proisc.com');
	    $this->email->subject($subject);
	    $this->email->message($body);
	    $this->email->attach($output);
  		$this->email->send();
			//$file_lists[] = $file_name;

  	}
  	return true;
  }
}