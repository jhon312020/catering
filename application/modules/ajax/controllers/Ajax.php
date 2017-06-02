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
		$this->load->model('promotional_codes/mdl_promotional_codes');
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
					$payment_type = 'TPV Online';
				break;
				case 'draft':;
					if (!$this->mdl_clients->validateIBAN($this->session->userdata('client_id'))) {
						echo json_encode(array('success' => false, 'msg' => 'Para poder continuar, por favor, introduzca su número IBAN en su perfil de cuenta.'));
						exit;
					}
					$payment_type = 'Gir bancari';
				break;
				case 'ticket':;
					$payment_type = 'Ticket Restaurant';
				break;
				case 'cash':;
					$payment_type = 'Efectiu Dia';
				break;
				default:
					echo json_encode(array('success' => false, 'msg' => 'Invalid order data'));
			}
			$discount = $this->input->post('discount');
			$result = $this->mdl_orders->check_today_menus_insert($payment_type,$discount);
			if(!$result['success']) {
				echo json_encode($result); exit;
			}
			if ($payment_type == 'TPV Online') {
				if ($discount && $result['order_data']['total_price'] == 0) {
					echo json_encode(array('success' => true, 'process_type'=>'others', 'redirectUrl' => site_url('es/success/?cm='.$result['order_data']['reference_no'])));
				} else {
					echo $this->bankPaymentProcess($result);
				}
			} else {
				echo json_encode(array('success' => true, 'process_type'=>'others', 'redirectUrl' => site_url('es/success/?cm='.$result['order_data']['reference_no'])));
			}
		} else {
			if ($this->input->post('paid_by_company') == 1){
				$payment_type = 'Empresa';
				$discount = $this->input->post('discount');
				$result = $this->mdl_orders->check_today_menus_insert($payment_type,$discount);
				if (!$result['success']) {
					echo json_encode($result); exit;
				} else {
					echo json_encode(array('success' => true, 'process_type'=>'others', 'redirectUrl' => site_url('es/success/?cm='.$result['order_data']['reference_no']))); exit;
				}
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
			//$testurlPago = 'https://sis-t.redsys.es:25443/sis/realizarPago';
			$prodUrlPago = 'https://sis.redsys.es/sis/realizarPago';
			
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
			//$testKey = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
      $prodKey = "gMEM0dJin2K4JNpF9UjjncUKVS34FHWA";
			//$key = 'MIwogh31NprCbvsoQY0fvVkHRt8Wcvia';
			
			$request = "";
			$params = $miObj->createMerchantParameters();
			$signature = $miObj->createMerchantSignature($prodKey);
			
			return json_encode(array('success' => true, 'version' => $version, 'params' => $params, 'signature' => $signature, 'bank_url' => $prodUrlPago, 'process_type'=>'credit'));exit;
			/*Sabadell payment end*/
			
		} else {
				return json_encode(array('success' => false, 'msg' => 'Invalid order data'));exit;
		}
  }

  function getPromoCodeDetail() {
	if ($this->input->post('code') && $this->input->post('total_price')) {
		$promo_code_record = $this->mdl_promotional_codes->getcodebycode($this->input->post('code'),1);
		$result = array();
		if ($promo_code_record) {
			$total_price = $this->input->post('total_price');
			$result = $this->mdl_promotional_codes->calculateTotalPrice($total_price, $promo_code_record);
			$result['id'] = $promo_code_record['id'];
			$result['detail'] = $promo_code_record;
			echo json_encode($result);
			exit;
		} else {
			echo json_encode(array('error'=>'Invalid Código Promocional'));
			exit;
		}
	}	
  }

}
?>
