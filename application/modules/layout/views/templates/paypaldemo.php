<?php

$padata  =  '&METHOD=SetExpressCheckout';

$padata .=  '&RETURNURL='.urlencode('http://pickngo.com/node/phpversion');
$padata .=  '&CANCELURL='.urlencode('http://pickngo.com/node/phpversion/1');
$padata .=  '&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE");
$padata .=  '&PAYMENTREQUEST_0_CUSTOM=test';
$products = array();
$products[0]['ItemName'] = 'Bright'; //Item Name
        $products[0]['ItemPrice'] = '1'; //Item Price
        $products[0]['ItemNumber'] = '1'; //Item Number
        $products[0]['ItemDesc'] = 'Test'; //Item Number
        $products[0]['ItemQty'] = '1'; // Item Quantity
        $products[0]['BookId']  = '12'; // Item Quantity
        
        
$charges = array();
        //Other important variables like tax, shipping cost
        $charges['TotalTaxAmount'] = 0;  //Sum of tax for all items in this order. 
        $charges['HandalingCost'] = 0;  //Handling cost for this order.
        $charges['InsuranceCost'] = 0;  //shipping insurance cost for this order.
        $charges['ShippinDiscount'] = 0; //Shipping discount for this order. Specify this as negative number.
        $charges['ShippinCost'] = 0; //Although you may change the value later, try to pass in a shipping amount that is 


foreach($products as $p => $item){
                
                $padata .=  '&L_PAYMENTREQUEST_0_NAME'.$p.'='.urlencode($item['ItemName']);
                $padata .=  '&L_PAYMENTREQUEST_0_NUMBER'.$p.'='.urlencode($item['ItemNumber']);
                $padata .=  '&L_PAYMENTREQUEST_0_DESC'.$p.'='.urlencode($item['ItemDesc']);
                $padata .=  '&L_PAYMENTREQUEST_0_AMT'.$p.'='.urlencode($item['ItemPrice']);
                $padata .=  '&L_PAYMENTREQUEST_0_QTY'.$p.'='. urlencode($item['ItemQty']);
            }

/* 

//Override the buyer's shipping address stored on PayPal, The buyer cannot edit the overridden address.

$padata .=  '&ADDROVERRIDE=1';
$padata .=  '&PAYMENTREQUEST_0_SHIPTONAME=J Smith';
$padata .=  '&PAYMENTREQUEST_0_SHIPTOSTREET=1 Main St';
$padata .=  '&PAYMENTREQUEST_0_SHIPTOCITY=San Jose';
$padata .=  '&PAYMENTREQUEST_0_SHIPTOSTATE=CA';
$padata .=  '&PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE=US';
$padata .=  '&PAYMENTREQUEST_0_SHIPTOZIP=95131';
$padata .=  '&PAYMENTREQUEST_0_SHIPTOPHONENUM=408-967-4444';

*/

        			
$padata .=  '&NOSHIPPING='.$noshipping; //set 1 to hide buyer's shipping address, in-case products that does not require shipping
			
$padata .=  '&PAYMENTREQUEST_0_ITEMAMT='.urlencode('1');

$padata .=  '&PAYMENTREQUEST_0_TAXAMT='.urlencode($charges['TotalTaxAmount']);
$padata .=  '&PAYMENTREQUEST_0_SHIPPINGAMT='.urlencode($charges['ShippinCost']);
$padata .=  '&PAYMENTREQUEST_0_HANDLINGAMT='.urlencode($charges['HandalingCost']);
$padata .=  '&PAYMENTREQUEST_0_SHIPDISCAMT='.urlencode($charges['ShippinDiscount']);
$padata .=  '&PAYMENTREQUEST_0_INSURANCEAMT='.urlencode($charges['InsuranceCost']);
$padata .=  '&PAYMENTREQUEST_0_AMT='.urlencode('1');
$padata .=  '&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode('EUR');

//paypal custom template

$padata .=  '&LOCALECODE=EN'; //PayPal pages to match the language on your website;
$padata .=  '&LOGOIMG='; //site logo
$padata .=  '&CARTBORDERCOLOR=FFFFFF'; //border color of cart
$padata .=  '&ALLOWNOTE=1';
//echo $padata;die;
############# set session variable we need later for "DoExpressCheckoutPayment" #######

$_SESSION['ppl_products'] =  $products;
$_SESSION['ppl_charges']    =  $charges;



$API_UserName = urlencode('bright-es_api1.proisc.com');
$API_Password = urlencode('CL9Z5XMUA7GXWSXT');
$API_Signature = urlencode('AFcWxV21C7fd0v3bYYYRCpSSRl31A6xW0WF-446ecLmr7Ms7xFBUdnLn');

//$paypalmode = (PPL_MODE=='sandbox') ? '.sandbox' : '';

$API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
$version = urlencode('109.0');

// Set the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');

// Turn off the server and peer verification (TrustManager Concept).
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);

// Set the API operation, version, and API signature in the request.
$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";

// Set the request as a POST FIELD for curl.
curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

// Get response from the server.
$httpResponse = curl_exec($ch);

if(!$httpResponse) {
	exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
}

// Extract the response details.
$httpResponseAr = explode("&", $httpResponse);

$httpParsedResponseAr = array();
foreach ($httpResponseAr as $i => $value) {
	
	$tmpAr = explode("=", $value);
	
	if(sizeof($tmpAr) > 1) {
		
		$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
	}
}

if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
	
	exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
}



$httpParsedResponseAr = $httpResponseAr;

//Respond according to message we receive from Paypal
if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])){

	$paypalmode = (PPL_MODE=='sandbox') ? '.sandbox' : '';

	//Redirect user to PayPal store with Token received.
	
	$paypalurl ='https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"].'';
	
	header('Location: '.$paypalurl);
}
else{
	
	//Show error message
	
	echo '<div style="color:red"><b>Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
	
	echo '<pre>';
		
		print_r($httpParsedResponseAr);
	
	echo '</pre>';
}
