<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


function pdf_create($html, $filename, $stream = TRUE) {
	
	require_once(APPPATH . 'helpers/dompdf/dompdf_config.inc.php');
    
    $dompdf = new DOMPDF();
	
    $paper_size = array(0,0,595,850);
	
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
		if(!is_dir('../uploads/temp/')){
			mkdir('../uploads/temp/', 0755, true);
		}
        write_file('./uploads/temp/' . $filename . '.pdf', $dompdf->output());
		
		return 'uploads/temp/' . $filename . '.pdf';        
    }
    
}

?>
