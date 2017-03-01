<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation {
		protected $CI;

    public function __construct() {
        parent::__construct();
            // reference to the CodeIgniter super object
        $this->CI =& get_instance();
    }
    public function edit_unique($str, $field) {
			
			sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);
			//echo $field.'---'.$table.'---'.$id;die;
			return isset($this->CI->db)
					? ($this->CI->db->limit(1)->get_where($table, array($field => $str, 'id !=' => $id))->num_rows() === 0)
					: FALSE;
    }

    public function dni_check($str) {
    	$dniLength = strlen($str);
    	$lastCharacter = $str[$dniLength -1];
    	$numericCharacter = substr($str, 0, -1);
    	//return false;
    	//exit;
	    if ($dniLength != 9 || !(is_numeric($numericCharacter)) || !(is_string($lastCharacter))) {
	      $this->CI->form_validation->set_message('dni_check', 'The {field} field is in wrong format eg 12345677M');
	      return FALSE;
	    } else {
	      return TRUE;
	    }
  }
  public function iban_check($str) {
    	$ibanLength = strlen($str);
    	$ibanArray = explode(' ', $str);
    	$ibanCount = count($ibanArray);
	    if ($ibanLength != 24 || $ibanCount != 5) {
	      $this->CI->form_validation->set_message('iban_check', 'The {field} field is in wrong format eg ES33 0000 0000 0000 0000');
	      return FALSE;
	    } else {
	      return TRUE;
	    }
  }

}
