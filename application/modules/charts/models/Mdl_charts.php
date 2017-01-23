<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_charts extends Response_Model {
	/**
     * Function get_booklist()
     * @param  [type] $start_date    [description]
     * @param  [type] $end_date [description]
     * @return [type]          [description]
     */
    public function get_booklist($start_date, $end_date) {
		$data['list'] = $this->db->query("SELECT count(id) as book_count, DATE_FORMAT(start_journey,'%d/%m/%Y') as start_journey
											FROM tbl_booking where start_journey between '$start_date' and '$end_date' and is_active=1 group by start_journey order by start_journey asc")->result_array();
		$data['count'] = $this->db->query("SELECT count(id) as book_count FROM tbl_booking where start_journey between '$start_date' 									and '$end_date' and is_active=1")->row();
		//print_r($data);die;
        return $data;
    }
	/**
     * Function get_bookbill()
     * @param  [type] $start_date    [description]
     * @param  [type] $end_date [description]
     * @return [type]          [description]
     */
	public function get_bookbill($start_date, $end_date) {
		$data['list'] = $this->db->query("SELECT sum(price) as book_bill, DATE_FORMAT(start_journey,'%d/%m/%Y') as start_journey FROM 	tbl_booking where start_journey between '$start_date' and '$end_date' and is_active=1 group by start_journey order by start_journey asc")->result_array();
		
		$data['count'] = $this->db->query("SELECT sum(price) as book_bill FROM tbl_booking where start_journey between '$start_date' 									and '$end_date' and is_active=1")->row();
        return $data;
    }
	/**
     * Function get_passengerByZone()
     * @param  [type] $start_date    [description]
     * @param  [type] $end_date [description]
     * @return [type]          [description]
     */
	public function get_passengerByZone($start_date, $end_date) {
		$result = array();
		$i = 0;
		$data['count'] = $this->db->query("SELECT sum(adults+kids) as total_passengers FROM tbl_booking where start_journey between '$start_date' and '$end_date' and is_active=1")->row();
		$bcn_area = $this->db->from('bcnareas')->get()->result_array();
		$bcn_array = array();
		array_walk($bcn_area, function($item) use (&$bcn_array) {
			$bcn_array[$item['zone']] = $item['name'];
		});
		
		$data['bcn'] = $bcn_array;
		while($start_date <= $end_date) {
			$result_array = $this->db->query("SELECT sum(adults+kids) as book_bill, case end_at when 'Barcelona Airport Terminal 1' then start_from when 'Barcelona Airport Terminal 2' then start_from else end_at end as zone_no FROM tbl_booking where start_journey = '$start_date' and is_active=1 group by zone_no")->result_array();
			//print_r($result_array);
			$result[$i]['start_journey'] = Date('d/m/Y', strtotime($start_date));
			$zone_no = array();
			$zone_no['zone'] = array();
			foreach($result_array as $item) {
				array_push($zone_no['zone'], $item['zone_no']);
				$zone_no[$item['zone_no']] = $item['book_bill'];
			}
			$bcn_no = array();
			$bcn_value = array();
			//print_r($zone_no);die;
			foreach($bcn_area as $bcn) {
				array_push($bcn_no, $bcn['zone']);
				array_push($bcn_value, $bcn['name']);
				if(in_array($bcn['zone'], $zone_no['zone'])) {
					$result[$i][$bcn['zone']] = $zone_no[$bcn['zone']];
				} else {
					$result[$i][$bcn['zone']] = 0;
				}
			}
			$start_date = Date('Y-m-d', strtotime('+1 day',strtotime($start_date)));
			$i++;
		}
		$data['passenger_by_zone'] = $result;
		$data['bcn_no'] = $bcn_no;
		$data['bcn_value'] = $bcn_value;
		//echo "<pre>";print_r($data);die;
		return $data;
    }
	/**
     * Function get_passengerByCountry()
     * @return [type]          [description]
     */
	public function get_passengerByCountryDate($start_date, $end_date) {
		$data['passenger_count'] = $this->db->query("SELECT country, sum(adults+kids) as passenger_count, '#06b53c' as color FROM tbl_booking where start_journey between '$start_date' and '$end_date' and is_active=1 group by country")->result_array();
		$res = array();
		array_walk($data['passenger_count'], function($item) use (&$res) {
			// flatten the array
			//$res['color'][$item['country']] = '#06b53c';
			$res['color'][$item['country']] = '#FF9900';
			$res['count'][$item['country']] = $item['passenger_count'];
		});
		$data['country_color'] = $res['color'];
		$data['country_count'] = $res['count'];
        return $data;
	}
	/**
     * Function get_passengerByCountry()
     * @return [type]          [description]
     */
	public function get_passengerByCountry() {
		$data['passenger_count'] = $this->db->query("SELECT country, sum(adults+kids) as passenger_count, '#06b53c' as color FROM tbl_booking where is_active=1 group by country")->result_array();
		$res = array();
		array_walk($data['passenger_count'], function($item) use (&$res) {
			// flatten the array
			//$res['color'][$item['country']] = '#06b53c';
			$res['color'][$item['country']] = '#FF9900';
			$res['count'][$item['country']] = $item['passenger_count'];
		});
		$data['country_color'] = $res['color'];
		$data['country_count'] = $res['count'];
        return $data;
	}
	/**
     * Function get_bookBillByCollaborator()
     * @param  [type] $start_date    [description]
     * @param  [type] $end_date [description]
     * @return [type]          [description]
     */
	public function get_bookBillByCollaborator($start_date, $end_date) {
		$data = $this->db->query("SELECT sum(price) as book_bill, DATE_FORMAT(start_journey,'%d/%m/%Y') as start_journey FROM tbl_booking where start_journey between '$start_date' and '$end_date' and is_active=1 and book_role=2 group by start_journey order by start_journey asc")->result_array();
        return $data;
    }
	/**
     * Function get_bookCountByCollaborator()
     * @param  [type] $start_date    [description]
     * @param  [type] $end_date [description]
     * @return [type]          [description]
     */
	public function get_bookCountByCollaborator($start_date, $end_date) {
		$data = $this->db->query("SELECT sum(adults+kids) as passenger_count, count(id) as book_count, DATE_FORMAT(start_journey,'%d/%m/%Y') as start_journey FROM tbl_booking where start_journey between '$start_date' and '$end_date' and is_active=1 and book_role=2 group by start_journey order by start_journey asc")->result_array();
		//echo "<pre>";print_r($data);die;
        return $data;
    }
	/**
     * Function get_bookBillByCollaboratorId()
     * @param  [type] $start_date    [description]
     * @param  [type] $end_date [description]
     * @return [type]          [description]
     */
	public function get_bookBillByCollaboratorId($start_date, $end_date, $col_id) {
		
		$date1 = new DateTime($start_date);
		$date2 = new DateTime($end_date);
		$diff = $date2->diff($date1)->format("%a") + 1;
		$start_date = Date('Y-m-d', strtotime('-1 day', strtotime($start_date)));
		
		/*$data = $this->db->query("SELECT sum(price) as book_bill, DATE_FORMAT(start_journey,'%d/%m/%Y') as start_journey FROM tbl_booking where start_journey between '$start_date' and '$end_date' and is_active=1 and book_role=2 and collaborator_id ='".$col_id."' group by start_journey order by start_journey asc")->result_array();
		//print_r($data);die;*/
		$data['list'] = $this->db->query(
					"select
					  DATE_FORMAT(AllDaysYouWant.MyJoinDate,'%d/%m/%Y') as start_journey,
					  IFNULL(sum( U.price ),0) as book_bill
				   from
					  ( select
							  @curDate := Date_Add(@curDate, interval 1 day) as MyJoinDate
						   from
							  ( select @curDate := '$start_date' ) sqlvars,
							  tbl_booking
						   limit $diff ) AllDaysYouWant
					  LEFT JOIN tbl_booking U
						 on AllDaysYouWant.MyJoinDate = U.start_journey and U.is_active=1 and U.book_role=2 and U.collaborator_id ='".$col_id."'
					
				   group by
					  AllDaysYouWant.MyJoinDate"
					)->result_array();
		$data['count'] = $this->db->query("SELECT IFNULL(sum(price),0) as bill_amount FROM tbl_booking where start_journey between '$start_date' and '$end_date' and is_active=1 and book_role=2 and collaborator_id ='".$col_id."'")->row();
					
		//print_r($data);die;
        return $data;
		
    }
	/**
     * Function get_bookCountByCollaboratorId()
     * @param  [type] $start_date    [description]
     * @param  [type] $end_date [description]
     * @return [type]          [description]
     */
	public function get_bookCountByCollaboratorId($start_date, $end_date, $col_id) {
		$date1 = new DateTime($start_date);
		$date2 = new DateTime($end_date);
		$diff = $date2->diff($date1)->format("%a") + 1;
		$start_date = Date('Y-m-d', strtotime('-1 day', strtotime($start_date)));
		//print_r($date1).'<br>';print_r($date2).'<br>';echo $start_date.'--------'.$end_date.'----------'.$diff;die;
		$data['list'] = $this->db->query(
				"select
				  DATE_FORMAT(AllDaysYouWant.MyJoinDate,'%d/%m/%Y') as start_journey,
				  IFNULL(sum( U.adults + U.kids ),0) as passenger_count,
				  IFNULL(count(id), 0) as book_count
			   from
				  ( select
						  @curDate := Date_Add(@curDate, interval 1 day) as MyJoinDate
					   from
						  ( select @curDate := '$start_date' ) sqlvars,
						  tbl_booking
					   limit $diff ) AllDaysYouWant
				  LEFT JOIN tbl_booking U
					 on AllDaysYouWant.MyJoinDate = U.start_journey and U.is_active=1 and U.book_role=2 and U.collaborator_id ='".$col_id."'
				
			   group by
				  AllDaysYouWant.MyJoinDate"
				)->result_array();
		$data['count'] = $this->db->query("SELECT IFNULL(sum(adults+kids),0) as passenger_count, IFNULL(count(id),0) as book_count FROM tbl_booking where start_journey between '$start_date' and '$end_date' and is_active=1 and book_role=2  and collaborator_id ='".$col_id."'")->row();
		//echo "<pre>";print_r($data);die;
        return $data;
    }
}

?>
