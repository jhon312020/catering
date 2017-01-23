<?php
/*4548 8120 4940 0004
12/12
123

*/
	$ln = $this->uri->segment(1);
	// Se incluye la librería
	include 'apiRedsys.php';

	// Se crea Objeto
	$miObj = new RedsysAPI;
		
	// Valores de entrada
	$merchantCode 	="336240668";
	$terminal 		="1";
	$amount 		=$_POST['bank_amount'];
	$currency 		="978";
	$transactionType ="0";
	$merchantURL 	=""; /*URL DE NOTIFICACIÓN (URL donde el TPV Virtual enviará una comunicación EN SEGUNDO PLANO con la información de la operación FINALIZADA,
							tanto en operaciones ACEPTADAS como en operaciones DENEGADAS) */
	$urlOK 			= site_url($ln.'/success/?cm='.$_POST['nBookId']); //URL A LA QUE SE REDIRIGIRÁ AL TITULAR CUANDO UNA COMPRA ESTÉ AUTORIZADA
	$urlKO 			= site_url($ln.'/error/?cm='.$_POST['nBookId']); //URL A LA QUE SE REDIRIGIRÁ AL TITULAR CUANDO UNA COMPRA ESTÉ DENEGADA
	$order 			=time();

	//Entorno
	//$urlPago = "https://sis.redsys.es/sis/realizarPago"; //ENTORNO REAL
	$urlPago = "https://sis-t.redsys.es:25443/sis/realizarPago"; //ENTORNO DE PRUEBAS
	$testurlPago = 'https://sis-t.redsys.es:25443/sis/realizarPago';
	$realurlPago = 'https://sis.redsys.es/sis/realizarPago';
	// Se Rellenan los campos
	$miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
	$miObj->setParameter("DS_MERCHANT_ORDER",strval($order));
	$miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$merchantCode);
	$miObj->setParameter("DS_MERCHANT_CURRENCY",$currency);
	$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$transactionType);
	$miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
	$miObj->setParameter("DS_MERCHANT_MERCHANTURL",$merchantURL);
	$miObj->setParameter("DS_MERCHANT_URLOK",$urlOK);		
	$miObj->setParameter("DS_MERCHANT_URLKO",$urlKO);

	//Datos de configuración
	$version="HMAC_SHA256_V1";
	$key = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';//Clave secreta del terminal

	// Se generan los parámetros de la petición
	$request = "";
	$params = $miObj->createMerchantParameters();
	$signature = $miObj->createMerchantSignature($key);
 
?>
<html lang="es">
<head>
</head>
<body onload="document.frm.submit()" style="display:none;">

<form name="frm" action=" <?php echo $urlPago ?>" method="POST">
Ds_Merchant_SignatureVersion <input type="text" name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
Ds_Merchant_MerchantParameters <input type="text" name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
Ds_Merchant_Signature <input type="text" name="Ds_Signature" value="<?php echo $signature; ?>" /></br>
<input type="submit" value="Enviar" >
</form>

</body>
</html>
