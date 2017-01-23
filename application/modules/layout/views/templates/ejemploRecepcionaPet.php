<html> 
<body> 
<?php

	include 'apiRedsys.php';

	// Se crea Objeto
	$miObj = new RedsysAPI;


	if (!empty( $_POST ) ) 
	{
					
		$version = $_POST["Ds_SignatureVersion"];
		$datos = $_POST["Ds_MerchantParameters"];
		$signatureRecibida = $_POST["Ds_Signature"];
							
		$key = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave del terminal
		$firma = $miObj->createMerchantSignatureNotif($key,$datos);	
		$decodec = $miObj->decodeMerchantParameters($datos);

		if ($firma === $signatureRecibida)
		{
			//FIRMA OK. Hacer tareas del servidor

			$codigoRespuesta = $miObj->getParameter("Ds_Response"); // Con esta función es posible 
																	//recoger cualquier variable de notificación, teniendo en cuenta que deben estar 
																	//en formato CamelCase
		} 
		else 
		{
			//FIRMA KO. Error, firma inválida
		}
	}

?>
</body> 
</html> 