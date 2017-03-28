<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cron extends Anonymous_Controller {
	public function __construct() {
        parent::__construct();
    }

	/**
     * Function check_order_status()
     * Used to remove orded exists 5 mins booking.
     * @return array of booking id
     */
	public function check_order_status() {
		$newTime = strtotime('-5 minutes');
		$time = date('Y-m-d H:i:s', $newTime);

		$qry = $this->db->from('booking')->where(array('book_status'=>'pending', 'is_active'=>1))
									->where("created < '$time'")->get();
		if ($qry->num_rows()) {
			$result = $qry->result_array();
			$id = array_map(function ($value) {return  $value['id'];}, $result);
			$this->db->set(array('is_active'=>0))->where_in('id',$id)->update('booking');
			$this->db->set(array('is_active'=>0))->where_in('book_id',$id)->update('seats');
			echo "Total no of records removed ".count($id);
			echo "The following book id has been removed";
			echo "<pre>";
			print_r($id);
		}
	}
}