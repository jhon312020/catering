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

}
