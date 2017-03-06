<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends Anonymous_Controller {
	/**
   * class constructor
   *
   * @return  void
   * 
   */
  
  public function __construct() {
    parent::__construct();
		$this->load->model('orders/mdl_orders');
		$this->load->model('clients/mdl_clients');
  }
  /**
   * Function bankPaymentProcess
   *
   * @return  void
   * 
   */
	public function checkout() {
		//$result = $this->mdl_orders->check_today_menus_insert();
		$payment_type = '';
		if ($this->input->post('payment_type')) {
			switch ($this->input->post('payment_type')) {
				case 'card':
					$payment_type = 'Credit/Debit';
				break;
				case 'draft':;
					if (!$this->mdl_clients->validateIBAN($this->session->userdata('client_id'))) {
						echo json_encode(array('success' => false, 'msg' => 'Invalid IBAN number.  Kindly check your profile page to update it!'));
						exit;
					}
					$payment_type = 'Bank Draft';
				break;
				case 'ticket':;
					$payment_type = 'Ticket Restaurant';
				break;
				default:
					echo json_encode(array('success' => false, 'msg' => 'Invalid order data'));
			}
			$result = $this->mdl_orders->check_today_menus_insert($payment_type);
			if(!$result['success']) {
				echo json_encode($result); exit;
			}
			if ($payment_type == 'Credit/Debit') {
				echo $this->bankPaymentProcess($result);
			} else {
				echo json_encode(array('success' => true, 'process_type'=>'others', 'redirectUrl' => site_url('es/success/?cm='.$result['order_data']['reference_no'])));
			}
		}
	}


  public function bankPaymentProcess($result) {
		
		$orders = $result['order_data'];

		/*
		Test card information
		4548 8120 4940 0004
		12/12
		123
		http://localhost/~megamind-mac/catering/es/success/?cm=312314879610003357
		*/
		
		if($orders['total_price'] > 0) {
			
			$amount = $orders['total_price'];
			
			$this->load->library('apiRedsys');
			$miObj = new apiRedsys;
			
			//$merchantCode = "336472105";
			$merchantCode = "336472105";
			$terminal = "001";
			$amount = str_replace('.', '', number_format($amount, 2));
			//$amount = '2';
			$currency = "978";
			$transactionType = "0";
			$merchantURL = "";
			//Needs to be changed to order id
			$reference_no = $orders['reference_no'];
			$urlOK = site_url('es/success/?cm='.$reference_no);
			$urlKO = site_url('es/error/?cm='.$reference_no);

			$order = time();
			$testurlPago = 'https://sis-t.redsys.es:25443/sis/realizarPago';
			//$realurlPago = 'https://sis.redsys.es/sis/realizarPago';
			
			$miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
			$miObj->setParameter("DS_MERCHANT_ORDER", strval($order));
			$miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $merchantCode);
			$miObj->setParameter("DS_MERCHANT_CURRENCY", $currency);
			$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $transactionType);
			$miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
			$miObj->setParameter("DS_MERCHANT_MERCHANTURL", $merchantURL);
			$miObj->setParameter("DS_MERCHANT_URLOK", $urlOK);   
			$miObj->setParameter("DS_MERCHANT_URLKO", $urlKO);
			
			$version="HMAC_SHA256_V1";
			$testKey = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
			//$key = 'MIwogh31NprCbvsoQY0fvVkHRt8Wcvia';
			
			$request = "";
			$params = $miObj->createMerchantParameters();
			$signature = $miObj->createMerchantSignature($testKey);
			
			return json_encode(array('success' => true, 'version' => $version, 'params' => $params, 'signature' => $signature, 'bank_url' => $testurlPago, 'process_type'=>'credit'));exit;
			/*Sabadell payment end*/
			
		} else {
				return json_encode(array('success' => false, 'msg' => 'Invalid order data'));exit;
		}
  }
}
?>
