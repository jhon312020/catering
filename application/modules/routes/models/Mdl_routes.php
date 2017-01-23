<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_routes extends Response_Model {

    public $table               = 'routes';
    public $primary_key         = 'routes.id';
    //public $date_created_field  = 'date_created';
    //public $date_modified_field = 'date_modified';

    

    public function default_order_by() {
        $this->db->order_by('routes.id');
    }

    public function validation_rules() {
        return array(
            'reference_id' => array(
                'field' => 'reference_id',
                'label' => 'Reference ID',
                'rules' => 'required'
            ),
            'car' => array(
                'field' => 'car',
                'label' => lang('car'),
                'rules' => 'required'
            ),
            'driver' => array(
                'field' => 'driver',
                'label' => lang('driver'),
                'rules' => 'required'
            ),
            'seats' => array(
                'field' => 'seats',
                'label' => lang('seats'),
                'rules' => 'required'
            ),
            'from_zone' => array(
                'field' => 'from_zone',
                'label' => 'First Step - Zone',
                'rules' => 'required'
            ),
            'from_time' => array(
                'field' => 'from_time',
                'label' => 'First Step - Hour & Minutes',
                'rules' => 'required'
            ),
            'to_zone' => array(
                'field' => 'to_zone',
                'label' => 'Last Step - Zone',
                'rules' => 'required'
            ),
            'to_time' => array(
                'field' => 'to_time',
                'label' => 'Last Step - Hour & Minutes',
                'rules' => 'required'
            ),
            'days' => array(
                'field' => 'days',
                'label' => 'Days of the week',
                'rules' => 'required'
            )
        );
    }

    public function prep_form($id = NULL)
    {
        if ($id) { // This is for an existing record

            // Have the base model do the initial form preparation
            parent::prep_form($id);
            $days = $this->form_value('days');
            $steps = $this->form_value('steps');
            $steps = json_decode($steps, true);
            if ($steps) {
                $this->set_form_value('steps', $steps);
                if (isset($steps['zone']) && $steps['zone']){
                    $this->set_form_value('zone', $steps['zone']);
                }
                if (isset($steps['hours']) && $steps['hours']){
                    $this->set_form_value('hours', $steps['hours']);
                }
                if (isset($steps['minutes']) && $steps['minutes']){
                    $this->set_form_value('minutes', $steps['minutes']);
                }
            }
            if($days){
                $this->set_form_value('days', json_decode($days, true));
            }
        }
    }
	/**
     * Function getcarAPI()
     * @param  [type] $data    [description]
     * @param  [type] $details [description]
     * @return [type]          [description]
     */
	public function getcarAPI($data) {
		if($data['start_from'] != '56|airport' && $data['end_at'] != '733|city') {
			$result['error'] = 'Invalid Details';
			return $result;exit;
		}
		
		$journeyStartDate 	  = str_replace('/','-',$data['start_journey']);
		$journeyStartDate 	  = date('Y-m-d', strtotime($journeyStartDate));
		$journeyStartTime	  = $data['hours'].':'.$data['minutes'];
		$journeyStartDateTime = $journeyStartDate.' '.$journeyStartTime;
		$startTime = Date('H:i', strtotime($journeyStartTime));
		
		$total_seats = $data['seats'];

		$toZone = END_ZONE_NO;
		$fromZone = 'Terminal 1';
		$this->db->from('calendars')->where(array('service_date' =>$journeyStartDate, 'is_active'=>1));
		$this->db->like('steps','Terminal 1');
		$this->db->like('steps','Terminal 2');
		$this->db->like('steps','"'.$toZone.'"');
		$this->db->like('days', date('D', strtotime($journeyStartDate)));
		$this->db->where("seats >= '$total_seats'");
		$qry = $this->db->get();
		if($qry->num_rows() > 0){
			$results = $qry->result_array();
			foreach($results as $key=>$value) {
				$steps 		= json_decode($value['steps'], true);
				$zone 		= $steps['zone'];
				$hours 		= $steps['hours'];
				$minutes 	= $steps['minutes'];
				$flip_array = array_flip($zone);
				$from_key 	= $flip_array[$fromZone];
				$to_key 	= $flip_array[$toZone];
				//print_r($flip_array);die;
				if($from_key <= $to_key){
					array_walk($hours, function(&$value, $index) use(&$minutes){
						$value = $value.':'.$minutes[$index];
					});
					$zone_step = array_combine($zone,$hours);
					$zone_time =  date('H:i', strtotime($zone_step[$fromZone]));
					
					$results[$key]['journey_start'] = $zone_time;
					$results[$key]['start_from'] = $fromZone;
					$results[$key]['end_at'] = $toZone;
					$results[$key]['journey_end'] = date('H:i', strtotime($zone_step[$toZone]));
					if ($value['seats'] < $total_seats){
						unset($results[$key]);continue;
					}
					
					if ($zone_time > $startTime) {
						unset($results[$key]);continue;
					}
					/*Seats calculation start*/
					$step_list = array('Terminal 1', 'Terminal 2');
					
					$this->db->from('seats')->where("calendar_id = ".$value['id']." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");							
					
					$seat_com = $this->db->get()->result_array();
					$seat_occupy = 0;
					foreach($seat_com as $data1){
						$seat_occupy += $data1['seats'];
					}
					
					$seats = $value['seats'] - $seat_occupy;
					if($seats < $total_seats){
						unset($results[$key]);continue;
					}
					/*Seats calculation end*/
				}
				else{
					unset($results[$key]);
				}
			}
			$result['data'] = $results;
			if(count($result['data']) > 0) {
				return $results;exit;
			} else {
				$result['error'] = 'There is no avaliable routes';
				return $result;exit;	
			}
		} else {
			$result['error'] = 'There is no avaliable routes';
			return $result;exit;
		}
	}
    /**
     * Function getcar()
     * @param  [type] $data    [description]
     * @param  [type] $details [description]
     * @return [type]          [description]
     */
	public function getcar($data, $details){

		// Journey Starting Date and Time
		$journeyStartDate 	  = str_replace('/','-',$this->input->post('start_journey'));
		$journeyStartDate 	  = date('Y-m-d', strtotime($journeyStartDate));
		$journeyStartTime	  = $data['hours'].':'.$data['minutes'];
		$journeyStartDateTime = $journeyStartDate.' '.$journeyStartTime;

		$startDateTime = date('Y-m-d H:i',strtotime('+30 minutes',strtotime($journeyStartDateTime)));
		if($data['start_from1'] == 'city') {
			$startDateTime = date('Y-m-d H:i',strtotime('-2 hour -30 minutes',strtotime($journeyStartDateTime)));
		}
		
		// Query Filter - Start Date and Time
		$startDate = date('Y-m-d', strtotime($startDateTime));
		$startTime = date('H:i', strtotime($startDateTime));
		
		$tommorrowDateTime = date('Y-m-d H:i', strtotime('+4 hour'));
		/*echo "<pre>";print_r($this->input->post());
		echo '<br/>FROM Date : ' . $startDate . '<br/>FROM Time : ' . $startTime;*/
		$zone = $data['zone'];
		$dayJourney = true;
		$nightJourney = true;
		$bcnaddress_id = '';
		if($zone == '' || $data['bcnarea_address_id'] != '') {
			$zone_qry = $this->db->select('bcnareas_address.id,bcnareas.zone,bcnareas.name')
						->join('bcnareas', 'bcnareas.id=bcnareas_address.bcnarea_id', 'left')
						->from('bcnareas_address')
						->where('bcnareas_address.postal_code', $data['postal_code'])
						->get();
			if($zone_qry->num_rows() > 0) {
				$zone_number = $zone_qry->row();
				$data['zone'] = $zone_number->zone;
				$bcnaddress_id = $zone_number->id;
			}
		}			
		if($data['zone'] != '') {
			if(strtotime($journeyStartDateTime) > strtotime($tommorrowDateTime)){
				// Zone details
				$arr = array('Barcelona Airport Terminal 1', 'Barcelona Airport Terminal 2');
				$fromZone 	= in_array($data['start_from'], $arr) ? str_replace('Barcelona Airport ', '', $data['start_from']) : $data['zone'];
				$toZone 	= in_array($data['end_at'], $arr) ? str_replace('Barcelona Airport ', '', $data['end_at']) : $data['zone'];
				if (is_numeric($toZone)){
					$toZone = END_ZONE_NO;
				}
				//echo '<br/>FROM : ' . $fromZone . '<br/>TO : ' . $toZone . '<br/><br/>';

				/*Collaborators*/
				$total_seats = $data['adults'];
				$oneway_rates = 0;
				$twoway_rates = 0;
				$night_oneway_rates = 0;
				$night_twoway_rates = 0;
				$collaborators = true;
				/* if($this->session->userdata('user_type') && $this->session->userdata('user_type') == 2 && $details['collaborator_details']['available_seats'] == 'activate'){
					if($total_seats <= $details['collaborator_details']['no_of_available_seats']){
						$this->db->from('collaborators')->where('id',$details['collaborator_details']['id']);
						$collaborators_qry = $this->db->get();
						$collaborators = $collaborators_qry->result_array();
						$result['collaborators'] = $collaborators;
					}
					else{
						$collaborators = false;
					}
				} */
				//echo $this->db->last_query();die;
				//echo "<pre>";print_r($_POST);
				if($collaborators){
					$this->db->from('calendars')->where(array('service_date' =>$startDate, 'is_active'=>1));
					$this->db->like('steps','"'.$fromZone.'"');
					$this->db->like('steps','"'.$toZone.'"');
					$this->db->like('days', date('D', strtotime($startDate)));
					if($data['start_from1'] == 'city') {
						$this->db->where("from_time <= '$startTime'");
					}
					$this->db->where("seats >= '$total_seats'");
					$qry = $this->db->get();
					//echo $this->db->last_query();die;

					if($qry->num_rows() > 0){
						
						
						/*Rate calculation start*/
						$this->db->from('rates')->where('rate_type',(isset($details['collaborator_details']['price'])?$details['collaborator_details']['price']:'rate1'));
						$rates = $this->db->get()->result_array();
						
						//$noofseats = array_map(function ($value) {return  $value['no_of_seats'];}, $rate);


						//$one_way = array_combine($noofseats, array_column($rate, 'rate_for_one_way'));
						//$two_way = array_combine($noofseats, array_column($rate, 'rate_for_round_a_trip'));
						$rate_count = count($rates);
						foreach ($rates as $rate) {
							$one_way[$rate['no_of_seats']] = $rate['rate_for_one_way'];
							$two_way[$rate['no_of_seats']] = $rate['rate_for_round_a_trip'];
							$night_one_way[$rate['no_of_seats']] = $rate['night_rate_for_one_way'];
							$night_two_way[$rate['no_of_seats']] = $rate['night_rate_for_round_a_trip'];
						}
						//print_r($one_way);
						//print_r($two_way);
						//exit;
						
						if($total_seats > $rate_count){
							$first = (int)($total_seats/$rate_count);
							$last = $total_seats%$rate_count;
							
							$oneway_rates += $first*$one_way[$rate_count];
							$twoway_rates += $first*$two_way[$rate_count];
							if($last != 0) {
								$oneway_rates += $first*$one_way[$last];
								$twoway_rates += $first*$two_way[$last];
							}
							
							$night_oneway_rates += $first*$night_one_way[$rate_count];
							$night_twoway_rates += $first*$night_two_way[$rate_count];
							if($last != 0) {
								$night_oneway_rates += $night_one_way[$last];
								$night_twoway_rates += $night_two_way[$last];
							}
						}
						else{
							$oneway_rates += $one_way[$total_seats];
							$twoway_rates += $two_way[$total_seats];
							
							$night_oneway_rates += $night_one_way[$total_seats];
							$night_twoway_rates += $night_two_way[$total_seats];
						}
						/*Rate calculation end*/
						
						
						$results = $qry->result_array();
						//print_r($results);exit;
						foreach($results as $key=>$value){
							$steps 		= json_decode($value['steps'], true);
							$zone 		= $steps['zone'];
							$hours 		= $steps['hours'];
							$minutes 	= $steps['minutes'];
							$flip_array = array_flip($zone);
							$from_key 	= $flip_array[$fromZone];
							$to_key 	= $flip_array[$toZone];
							//print_r($flip_array);die;
							if($from_key <= $to_key){
								array_walk($hours, function(&$value, $index) use(&$minutes){
									$value = $value.':'.$minutes[$index];
								});
								$zone_step = array_combine($zone,$hours);
								$zone_time =  date('H:i', strtotime($zone_step[$fromZone]));
								//if($zone_time < date('H:i', strtotime($tommorrowDateTime)) && $startDate == date('Y-m-d')){
								if($zone_time < date('H:i') && $startDate == date('Y-m-d')){	
									unset($results[$key]);continue;
								}
								$results[$key]['journey_start'] = $zone_time;
								$results[$key]['start_from'] = $fromZone;
								$results[$key]['end_at'] = $toZone;
								$results[$key]['journey_end'] = date('H:i', strtotime($zone_step[$toZone]));
								if ($value['seats'] < $total_seats){
									unset($results[$key]);continue;
								}
								//echo '<br/>' . $fromZone . ' ==> Zone Time : '.$zone_time.' Time : '.$startTime.' Tomorrow time: '.date('H:i', strtotime($tommorrowDateTime)).'(all)<br/>';
								if (($data['start_from1'] == 'city' && $zone_time > $startTime) || ($data['start_from1'] == 'airport' && $zone_time < $startTime)){
									unset($results[$key]);continue;
								}
								/*Seats calculation start*/
								$step_list = array('Terminal 1', 'Terminal 2');
								if($toZone == END_ZONE_NO){
									if($fromZone == 'Terminal 1') {
										$this->db->from('seats')->where("calendar_id = ".$value['id']." and is_active = 1 and (from_zone in ('".implode("','", $step_list)."') or to_zone='Terminal 2')");
									} else {
										$this->db->from('seats')->where("calendar_id = ".$value['id']." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
									}
								}
								else{
									if($toZone == 'Terminal 2') {
										$this->db->from('seats')->where("calendar_id = ".$value['id']." and is_active = 1 and (to_zone in ('".implode("','", $step_list)."') or from_zone='Terminal 1')");
									} else {
										$this->db->from('seats')->where("calendar_id = ".$value['id']." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
									}
								}
								
								$seat_com = $this->db->get()->result_array();
								//echo $this->db->last_query();die;
								$seat_occupy = 0;
								foreach($seat_com as $data1){
									$seat_occupy += $data1['seats'];
								}
								
								$seats = $value['seats'] - $seat_occupy;
								if($seats < $total_seats){
									unset($results[$key]);continue;
								}
								/*Seats calculation end*/
								//oneway_rates, night_oneway_rates, twoway_rates, night_twoway_rates
								/*Rates start*/
								$results[$key]['oneway_rates'] = 0;
								$results[$key]['twoway_rates'] = 0;
								$results[$key]['morning'] = false;
								$results[$key]['night'] = false;
								if($data['return_journey'] == '') {
									if($zone_time >= Date('H:i', strtotime('06:00')) && $zone_time <= Date('H:i', strtotime('19:59'))) {
										$results[$key]['oneway_rates'] = $oneway_rates;
										$results[$key]['morning'] = true;
									} else {
										$results[$key]['night'] = true;
										if((float)$night_oneway_rates > 0)
											$results[$key]['oneway_rates'] = $night_oneway_rates;
										else
											$results[$key]['oneway_rates'] = $oneway_rates;
									}
								} else {
									if($zone_time >= Date('H:i', strtotime('06:00')) && $zone_time <= Date('H:i', strtotime('19:59'))) {
										$results[$key]['oneway_rates'] = $oneway_rates;
										$results[$key]['twoway_rates'] = $twoway_rates;
										$results[$key]['morning'] = true;
									} else {
										$results[$key]['night'] = true;
										if((float)$night_oneway_rates > 0)
											$results[$key]['oneway_rates'] = $night_oneway_rates;
										else
											$results[$key]['oneway_rates'] = $oneway_rates;
										
										if((float)$night_twoway_rates > 0)
											$results[$key]['twoway_rates'] = $night_twoway_rates;
										else
											$results[$key]['twoway_rates'] = $twoway_rates;
									}
								}
								/*Rates end*/
								
								 
								
								//echo '<br/>' . $fromZone . ' ==> Zone Time : '.$zone_time.' Time : '.$startTime.' (filtered)<br/>';
											
								
							}
							else{
								unset($results[$key]);
							}
						}
						usort($results, function($a,$b){
							if ($a['from_time']==$b['from_time']) return 0;
							return ($a['from_time']<$b['from_time'])?-1:1;
						});
						$result['data'] = $results;
						
						/*return journey*/
						$result['return'] = array();
						if($data['return_journey'] != ''){
							$journeyReturnDate 		= str_replace('/', '-', $this->input->post('return_journey'));
							$journeyReturnDate 		= date('Y-m-d', strtotime($journeyReturnDate));
							$journeyReturnTime 		= $data['return_hours'].':'.$data['return_minutes'];
							$journeyReturnDateTime	= $journeyReturnDate.' '.$journeyReturnTime;
							
							$result['format_returndate'] = date('l d - F', strtotime($journeyReturnDateTime));
							$result['format_returntime'] = date('H:i', strtotime($journeyReturnDateTime));
							
							$returnDateTime = date('Y-m-d H:i',strtotime('-2 hour -30 minutes',strtotime($journeyReturnDateTime)));
							if($data['start_from1'] == 'city') {
								$returnDateTime = date('Y-m-d H:i',strtotime('+30 minutes',strtotime($journeyReturnDateTime)));
							}
							if ($toZone == END_ZONE_NO){
								$toZone = $data['zone'];
							}
							
							$returnTime = date('H:i', strtotime($returnDateTime));
							$returnDate = date('Y-m-d', strtotime($returnDateTime));

							$this->db->from('calendars')->where(array('service_date' =>$returnDate, 'is_active'=>1));
							$this->db->like('steps','"'.$fromZone.'"');
							$this->db->like('steps','"'.$toZone.'"');
							$this->db->like('days',date('D', strtotime($returnDate)));
							$this->db->where("seats >= '$total_seats'");
							if ($data['start_from1'] == 'airport'){
								$this->db->where("from_time <= '$returnTime'");
							}
							
							$qry = $this->db->get();

							if($qry->num_rows() > 0){
								$return_results = $qry->result_array();
								/*echo "<pre>";
								echo $fromZone.'----'.$toZone.'<br/>';
								print_r($return_results);die;*/
								foreach($return_results as $key=>$value){
									$steps = json_decode($value['steps'], true);
									$zone = $steps['zone'];
									$hours = $steps['hours'];
									$minutes = $steps['minutes'];
									$flip_array = array_flip($zone);
									$from_key = $flip_array[$toZone];
									$to_key = $flip_array[$fromZone];
									//
									//if($from_key >= $to_key){
										array_walk($hours, function(&$value, $index) use(&$minutes){
											$value = $value.':'.$minutes[$index];
										});
										$zone_step = array_combine($zone,$hours);
										$zone_time = ($toZone == END_ZONE_NO) ? $zone_step[$data['zone']] : $zone_step[$toZone];
										$zone_time =  date('H:i', strtotime($zone_time));
										/*if($zone_time < date('H:i') && $returnDate == date('Y-m-d')){
											unset($return_results[$key]);continue;
										}*/
										if($zone_time < date('H:i') && $returnDate == date('Y-m-d')){
											unset($return_results[$key]);continue;
										}
										$return_results[$key]['journey_start'] = $zone_time;
										$return_results[$key]['start_from'] = $toZone;
										$return_results[$key]['end_at'] = $fromZone;
										$jEndTime = ($toZone == END_ZONE_NO) ? $zone_step[$fromZone] : $value['to_time'];
										$return_results[$key]['journey_end'] = date('H:i', strtotime($jEndTime));
										
										if ($value['seats'] < $total_seats){
											unset($return_results[$key]);continue;
										}
										
										//echo '<br/>' . $toZone . ' ==> Zone Time : '.$zone_time.' Return Time : '.$returnTime.' (all)<br/>';
										if (($data['start_from1'] == 'city' && $zone_time < $returnTime) || ($data['start_from1'] == 'airport' && $zone_time > $returnTime)){
											unset($return_results[$key]);continue;
										}
										//echo '<br/>' . $toZone . ' ==> Zone Time : '.$zone_time.' Return Time : '.$returnTime.' (filtered)<br/>';

										/*Seats calculation start*/
										$step_list = array('Terminal 1', 'Terminal 2');
										if($toZone == END_ZONE_NO) {
											if($fromZone == 'Terminal 2') {
												$this->db->from('seats')->where("calendar_id = ".$value['id']." and is_active = 1 and (to_zone in ('".implode("','", $step_list)."') or from_zone='Terminal 1')");
											} else {
												$this->db->from('seats')->where("calendar_id = ".$value['id']." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
											}
										} else {
											if($toZone == 'Terminal 1') {
												$this->db->from('seats')->where("calendar_id = ".$value['id']." and is_active = 1 and (from_zone in ('".implode("','", $step_list)."') or to_zone='Terminal 2')");
											} else {
												$this->db->from('seats')->where("calendar_id = ".$value['id']." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
											}
										}
								
										$seat_com = $this->db->get()->result_array();
										//echo $this->db->last_query();die;
										$seat_occupy = 0;
										foreach($seat_com as $data1){
											$seat_occupy += $data1['seats'];
										}
										$seats = $value['seats'] - $seat_occupy;
										
										if($seats < $total_seats){
											unset($return_results[$key]);continue;
										}
										/*Seats calculation end*/									
										
										/*Rates start*/
										$return_results[$key]['oneway_rates'] = 0;
										$return_results[$key]['twoway_rates'] = 0;
										$return_results[$key]['morning'] = false;
										$return_results[$key]['night'] = false;
										if($zone_time >= Date('H:i', strtotime('06:00')) && $zone_time <= Date('H:i', strtotime('19:59'))) {
											$return_results[$key]['oneway_rates'] = $oneway_rates;
											$return_results[$key]['twoway_rates'] = $twoway_rates;
											$return_results[$key]['morning'] = true;
										} else {
											$return_results[$key]['night'] = true;
											if((float)$night_oneway_rates > 0)
												$return_results[$key]['oneway_rates'] = $night_oneway_rates;
											else
												$return_results[$key]['oneway_rates'] = $oneway_rates;
											
											if((float)$night_twoway_rates > 0)
												$return_results[$key]['twoway_rates'] = $night_twoway_rates;
											else
												$return_results[$key]['twoway_rates'] = $twoway_rates;	
										}
										/*Rates end*/
										
									/*}
									else{
										unset($return_results[$key]);
									}*/							
								}
								usort($return_results, function($a,$b){
									if ($a['from_time']==$b['from_time']) return 0;
									return ($a['from_time']<$b['from_time'])?-1:1;
								});
								$result['return'] = $return_results;
								$result['return_journey'] = $journeyReturnDate;
							}
						}
						$result['from_zone'] = $data['start_from'];
						$result['to_zone'] = $data['end_at'];
						$result['start_journey'] = $journeyStartDate;
						$result['total_seats'] = $total_seats;
						//echo "<pre>";print_r($data);print_r($result);die;
						
						
						//$rates = explode('^', (isset($rate[$total_seats]))?$rate[$total_seats]:end($rate));
						$result['rates'] = 0;
						$result['format_startdate'] = date('l d - F', strtotime($journeyStartDateTime));
						$result['format_starttime'] = date('H:i', strtotime($journeyStartDateTime));
						$result['bcnaddress_id'] = $bcnaddress_id;
						$result['zone'] = $data['zone'];
						if(count($result['data']) == 0 || ($data['return_journey']!= '' && count($result['return']) == 0)){
							//$this->session->set_flashdata('alert_error', lang('reserve_error'));
							$result['error'] = lang('reserve_error');
							return $result;
						}
						else{
							return $result;
						}
					}
					else{
						//$this->session->set_flashdata('alert_error', lang('reserve_error'));
						$result['error'] = lang('reserve_error');
						return $result;
					}
				}
				else{
					//$this->session->set_flashdata('alert_error', lang('seats_error'));
					$result['error'] = lang('seats_error');
					return $result;
				}
			}
			else{
				//$this->session->set_flashdata('alert_error', lang('date_error'));
				$result['error'] = lang('date_error');
				return $result;
			}	
		} else {
			//$this->session->set_flashdata('alert_error', lang('invalid_postcode'));
			$result['error'] = lang('invalid_postcode');
			return $result;
		}
	}

}

?>
