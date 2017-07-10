<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


function pdf_create($html, $filename, $stream = TRUE) {
	
	require_once(APPPATH . 'helpers/dompdf/dompdf_config.inc.php');

	$dompdf = new DOMPDF();

	$paper_size = array(0,0,660,900);

	$dompdf->set_paper($paper_size);

	$dompdf->load_html($html);

	$dompdf->render();

	if ($stream) {

		//$dompdf->stream($filename . '.pdf', array("Attachment"=>false));
		$dompdf->stream($filename . '.pdf');

	}

	else {

		$CI =& get_instance();

		$CI->load->helper('file');
		$path = './uploads/temp/' . $filename. '.pdf';
		$dirname = dirname($path);
		if(!is_dir($dirname)){
			mkdir($dirname, 0755, true);
		}
		write_file($path, $dompdf->output());

		return $path;
	}
    
}

?>
