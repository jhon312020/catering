<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cron extends Anonymous_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('routes/mdl_routes');
        $this->load->model('routes/mdl_calendars');
        $this->load->helper('comman_helper');
    }

    /**
     * Function syncRoutes()
     * Used to fetch & update the everyday routes on the calendar table.
     * @recommended cron_time 1 AM CET / 6.30 PM CDT
     * @return null
     */
    public function syncRoutes(){
    	$sync = false;
        $calendar = $this->mdl_calendars->where('is_active',1)->order_by('service_date DESC')->limit(1)->get()->result();
        $date = ($calendar) ? date('Y-m-d', strtotime($calendar['0']->service_date . '+1 day')) : date('Y-m-d');
    	$todayDate = 'PNG-'.date('dmY', strtotime($date)).'-';
    	$referenceIDColumn = "CONCAT('$todayDate', (reference_id)) AS reference_id";
    	$liveRoutes = $this->mdl_routes->select('id AS route_id,'.$referenceIDColumn.',car, driver AS service_date,driver,seats,days,from_zone,from_time,to_zone,to_time,steps')->where('is_active',1)->get()->result_array();
        $serialize = json_encode($liveRoutes);
        $regex = "/\"service_date\":\"(.*?)\"/";
        $serialize = preg_replace($regex, '"service_date":"'.$date.'"', $serialize);
    	if ($liveRoutes){
    		$sync = $this->db->insert_batch('tbl_calendars', json_decode($serialize, true));
    	}
    	if ($sync){
            echo 'Routes synchronizing has been completed!!';
        }
        else {
            echo 'Synchronizing can\'t be done, check the code or May be the data has been already populated!';
            echo '<br/><br/>DB Query:<br/>'.$this->db->last_query();
        }
    }

    /**
     * Function first3months()
     * Used to populate first 3 months route.
     * @return [type] [description]
     */
    public function first3months(){
        $ninetyDate = date('d-m-Y', strtotime('+90 days'));
        $date = date('dmY');
        $liveRoutes = array();
        $dayCount = 1;
        $todayDate = 'PNG-'.$date.'-';
        $referenceIDColumn = "CONCAT('$todayDate', (reference_id)) AS reference_id";
        $liveRoutes = $this->mdl_routes->select('id AS route_id,'.$referenceIDColumn.',car,driver,seats,days,from_zone,from_time,to_zone,to_time,steps')->where('is_active',1)->get()->result_array();
        $date = date('d-m-Y');
        $errors = array();
        while(strtotime($date) <= strtotime($ninetyDate)){
            $serialize = json_encode($liveRoutes);
            $serialize = str_replace(date('dmY'), date('dmY', strtotime($date)), $serialize);
            $serialize = preg_replace('/\"from_zone\"/', '"service_date":"'.date('Y-m-d', strtotime($date)).'","from_zone"', $serialize);
            $data = json_decode($serialize, true);
            $sync = $this->db->insert_batch('tbl_calendars', $data);
            if (!$sync){ $errors[] = $date(); }
            $date = date('d-m-Y', strtotime('+'.$dayCount.' days'));
            $dayCount++;
        }
        if($errors){
            echo "The following dates are not populated : ".implode(',', $errors);
        }
        else {
            echo "Route populated upto ".$ninetyDate;
        }
    }
	/**
     * Function check_book_status()
     * Used to remove reservation payment exists 5 mins booking.
     * @return array of booking id
     */
	public function check_book_status() {
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
	public function check_time(){
		$newTime = strtotime('-5 minutes');
		$time = date('Y-m-d H:i:s', $newTime);
		echo date('Y-m-d H:i:s')."<br>";
		echo $time;die;
	}
}