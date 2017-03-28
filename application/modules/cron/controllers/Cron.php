<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cron extends Anonymous_Controller {
	public function __construct() {
        parent::__construct();
    }

	/**
     * Function clean_incomplete_orders()
     * Used to remove orded exists 5 mins booking.
     * @return array of orders id
     */
	public function clean_incomplete_orders() {
		/*$newTime = strtotime('-5 minutes');
		$time = date('Y-m-d H:i:s', $newTime);*/

		$qry = $this->db->from('orders')->where(array('order_code !='=>'', 'is_active'=>0))
									->where("created_at < date_sub(now(),INTERVAL 5 MINUTE)")->get();
		if ($qry->num_rows()) {
			$result = $qry->result_array();
			$id = array_map(function ($value) {return  $value['id'];}, $result);
			$this->db->where(array('order_code !='=>'', 'is_active'=>0))->where("created_at < date_sub(now(),INTERVAL 5 MINUTE)");
			$this->db->delete('orders');
			$this->db->where_in('order_id',$id);
			$this->db->delete(array('order_drinks','order_reports'));
			echo "Total no of records removed ".count($id);
			echo "<br/>The following ids has been removed";
			echo "<pre>";
			print_r($id);
		}
	}
}