<?php
//Seller Sandbox Credentials- Sample credentials already provided
//define("PP_USER_SANDBOX", "supersandy_api1.gmail.com");
define("PP_USER_SANDBOX", "bright-es_api1.proisc.com");
//define("PP_PASSWORD_SANDBOX", "1400525332");
define("PP_PASSWORD_SANDBOX", "CL9Z5XMUA7GXWSXT");
//define("PP_SIGNATURE_SANDBOX", "AdUaGhfPganVo2IfGf2Ctordn94OASnvL6qF4D-pnHb6hEQCLBWKbzmq");
define("PP_SIGNATURE_SANDBOX", "AFcWxV21C7fd0v3bYYYRCpSSRl31A6xW0WF-446ecLmr7Ms7xFBUdnLn");

//Seller Live credentials.
define("PP_USER","hello_api1.pickngo.com");
define("PP_PASSWORD", "XRKKHLNT87JW6WJX");
define("PP_SIGNATURE","AdGW3ggVzK6uzgEzbOWEsfhEHs5PARtb.LuL8TLT3SgoZrUlaXFtvE40");
/*define("PP_USER", "bright_api1.proisc.com");
define("PP_PASSWORD", "NF7UHSVYMK4AWWXQ");
define("PP_SIGNATURE", "AFcWxV21C7fd0v3bYYYRCpSSRl31ASsF8-4QwZ4r5QypkfOSMiNrNOuz");*/

//Set this constant EXPRESS_MARK = true to skip review page
define("EXPRESS_MARK", true);

//Set this constant ADDRESS_OVERRIDE = true to prevent from changing the shipping address
define("ADDRESS_OVERRIDE", true);

//Set this constant USERACTION_FLAG = true to skip review page
define("USERACTION_FLAG", false);

//Based on the USERACTION_FLAG assign the page
if(USERACTION_FLAG){
	$page = 'return.php';
} else {	
	$page = 'review.php';
}

//The URL in your application where Paypal returns control to -after success (RETURN_URL) using Express Checkout Mark Flow
/*Local data start
define("RETURN_URL_MARK",'http://'.$_SERVER['HTTP_HOST'].preg_replace('/paypal_ec_redirect.php/','return.php',$_SERVER['REQUEST_URI']));

//The URL in your application where Paypal returns control to -after success (RETURN_URL) and after cancellation of the order (CANCEL_URL) 
define("RETURN_URL",'http://'.$_SERVER['HTTP_HOST'].preg_replace('/paypal_ec_redirect.php/','lightboxreturn.php',$_SERVER['REQUEST_URI']));
define("CANCEL_URL",'http://'.$_SERVER['HTTP_HOST'].preg_replace('/paypal_ec_redirect.php/','cancel.php',$_SERVER['REQUEST_URI']));
Local data end
*/

//define("RETURN_URL_MARK",'http://'.$_SERVER['HTTP_HOST'].'/www/Pick-n-Go/en/success');
define("RETURN_URL_MARK",'http://'.$_SERVER['HTTP_HOST'] . str_replace('/node/paypal_ec_redirect','/en/success',$_SERVER['REQUEST_URI']));

//The URL in your application where Paypal returns control to -after success (RETURN_URL) and after cancellation of the order (CANCEL_URL) 
//define("RETURN_URL",'http://'.$_SERVER['HTTP_HOST'].'/www/Pick-n-Go/en/success');
define("RETURN_URL",'http://'.$_SERVER['HTTP_HOST'] . str_replace('/node/paypal_ec_redirect','/en/success',$_SERVER['REQUEST_URI']));
//define("CANCEL_URL",'http://'.$_SERVER['HTTP_HOST'].'/www/Pick-n-Go/en/error');
define("CANCEL_URL",'http://'.$_SERVER['HTTP_HOST'] . str_replace('/node/paypal_ec_redirect','/en/error',$_SERVER['REQUEST_URI']));

//Whether Sandbox environment is being used, Keep it true for testing
define("SANDBOX_FLAG", true);

if(SANDBOX_FLAG){
	$merchantID=PP_USER_SANDBOX;  /* Use Sandbox merchant id when testing in Sandbox */
	$env= 'sandbox';
}
else {
	$merchantID=PP_USER;  /* Use Live merchant ID for production environment */
	$env='production';
}

//Proxy Config
define("PROXY_HOST", "127.0.0.1");
define("PROXY_PORT", "808");

//In-Context in Express Checkout URLs for Sandbox
define("PP_CHECKOUT_URL_SANDBOX", "https://www.sandbox.paypal.com/checkoutnow?token=");
define("PP_NVP_ENDPOINT_SANDBOX","https://api-3t.sandbox.paypal.com/nvp");

//Express Checkout URLs for Sandbox
//define("PP_CHECKOUT_URL_SANDBOX", "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=");
//define("PP_NVP_ENDPOINT_SANDBOX","https://api-3t.sandbox.paypal.com/nvp");

//In-Context in Express Checkout URLs for Live
define("PP_CHECKOUT_URL_LIVE","https://www.paypal.com/checkoutnow?token=");
define("PP_NVP_ENDPOINT_LIVE","https://api-3t.paypal.com/nvp");

//Express Checkout URLs for Live
//define("PP_CHECKOUT_URL_LIVE","https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=");
//define("PP_NVP_ENDPOINT_LIVE","https://api-3t.paypal.com/nvp");

//Version of the APIs
define("API_VERSION", "109.0");

//ButtonSource Tracker Code
define("SBN_CODE","PP-DemoPortal-EC-IC-php");
?>