<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

	class Mdl_promotional_codes extends Response_Model {

	public $table               = 'promotional_codes';
	public $primary_key         = 'promotional_codes.id';

	public function default_order_by() {
		$this->db->order_by('promotional_codes.id');
	}
	public function getcodebycode($data){
		$qry = $this->db->where('code', $data['code'])->get('promotional_codes');
		if($qry->num_rows())
			return current($qry->result_array());
		
		return false;
	}
	public function validation_rules() {
		return array(
			'code' => array(
				'field' => 'code',
				'label' => 'Code',
				'rules' => 'required'
			),
			'discount_type' => array(
				'field' => 'discount_type',
				'label' => 'Discount Type',
				'rules' => 'required'
			),
			'price_or_percentage' => array(
				'field' => 'price_or_percentage',
				'label' => 'Price or Percentage',
				'rules' => 'required'
			),
		);
	}
}

?>
