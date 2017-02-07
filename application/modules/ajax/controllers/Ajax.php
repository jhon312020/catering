<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends Anonymous_Controller {
  public $details = array();
  /**
   * Function bankPaymentProcess
   *
   * @return  void
   * 
   */
  public function bankPaymentProcess() {
    $this->load->model('menus/mdl_menus');
    $this->load->model('temporary_orders/mdl_temporary_orders');
    //Need to work on orders insertion
    $orders = $this->mdl_temporary_orders->getClientOrders();
    //print_r($orders);
    $amount = 0;
    foreach ($orders as $order) {
      if (strtolower($order['order_type']) == 'both') {
        $amount += $order['full_price'];
      } else {
        $amount += $order['half_price'];
      }
    }
    $this->load->library('apiRedsys');
    $miObj = new apiRedsys;
    
    $merchantCode = "336472105";
    $terminal = "001";
    $amount = str_replace('.', '', number_format($amount, 2));
    $currency = "978";
    $transactionType = "0";
    $merchantURL = "";
    //Needs to be changed to order id
    $clientId = $this->session->userdata('client_id');
    $urlOK = site_url('es/success/?cm='.$clientId);
    $urlKO = site_url('es/error/?cm='.$clientId);
    $order = time();
    $testurlPago = 'https://sis-t.redsys.es:25443/sis/realizarPago';
    //$realurlPago = 'https://sis.redsys.es/sis/realizarPago';
    
    $miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
    $miObj->setParameter("DS_MERCHANT_ORDER",strval($order));
    $miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$merchantCode);
    $miObj->setParameter("DS_MERCHANT_CURRENCY",$currency);
    $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$transactionType);
    $miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
    $miObj->setParameter("DS_MERCHANT_MERCHANTURL",$merchantURL);
    $miObj->setParameter("DS_MERCHANT_URLOK",$urlOK);   
    $miObj->setParameter("DS_MERCHANT_URLKO",$urlKO);
    
    $version="HMAC_SHA256_V1";
    $testKey = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
    //$key = 'MIwogh31NprCbvsoQY0fvVkHRt8Wcvia';
    
    $request = "";
    $params = $miObj->createMerchantParameters();
    $signature = $miObj->createMerchantSignature($testKey);
    
    $bank['version'] = $version;
    $bank['params'] = $params;
    $bank['signature'] = $signature;
    $bank['bank_url'] = $testurlPago;
    echo json_encode($bank);
    /*Sabadell payment end*/
  }
}
?>
