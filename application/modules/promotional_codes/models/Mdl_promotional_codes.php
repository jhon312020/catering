<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

	class Mdl_promotional_codes extends Response_Model {

	public $table               = 'promotional_codes';
	public $primary_key         = 'promotional_codes.id';

	public function default_order_by() {
		$this->db->order_by('promotional_codes.id');
	}
	public function getcodebycode($code, $is_active = 0){
		if ($is_active) {
			$qry = $this->db->where('code', $code)->where('is_active',1)->get('promotional_codes');	
		} else {
			$qry = $this->db->where('code', $code)->get('promotional_codes');
		}
		
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

	public function calculateTotalPrice($total_price, $record) {
		switch ($record['discount_type']) {
			case 'percentage':
					$discount = $total_price*$record['price_or_percentage']/100;
				break;
			case 'price':
					$discount = $record['price_or_percentage'];
				break;
		}
		$total_price = $total_price-$discount;
		if ($total_price < 0) {
			$total_price = 0.00;
		} else {
			$total_price = number_format($total_price,2,'.','');
		}
		$discount = number_format($discount,2,'.','');
		return array('total_price'=>$total_price,'discount'=>$discount);
	}
}

?>
