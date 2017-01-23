<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Routes extends Admin_Controller {

    //var $event = false;

    public function __construct() {
        parent::__construct();
        //$this->event = $this->uri->rsegment(3);

        $this->load->model('routes/mdl_routes');
        $this->load->model('users/mdl_users');
        $this->load->model('routes/mdl_cars');
        $this->load->model('routes/mdl_calendars');
        $this->load->model('routes/mdl_bcnareas');
		$this->load->model('routes/mdl_bcnareas_address');
        $this->load->model('settings/mdl_settings');
        $this->load->model('shuttles/mdl_shuttles');
        //$this->load->helper('text');
        $this->path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/routes/";
    }

    public function schedule() {
        $this->session->set_userdata('methodFrom', 'schedule');
        $bcn = $this->db->get_where('tbl_bcnareas', array('is_active'=>1))->result_array();
        foreach ($bcn as $key => $data){
            $bcn[$data['zone']] = 'Zone '.$data['zone'].' ( '. $data['name']. ')';
            unset($bcn[$key]);
        }
        $bcn = array(''=>'Zona XX') + $bcn;
        $this->layout->set(array('routes'=>$this->db->select('cars.car_name as car,routes.id,routes.reference_id,routes.car as car_id, routes.driver,routes.seats,routes.days,routes.from_zone,routes.from_time,routes.to_zone,routes.to_time,routes.steps,routes.is_active')->join('cars', 'cars.id=routes.car', 'left')->from('routes')->order_by('routes.created', 'desc')->get()->result(), 'path'=>$this->path, 'bcn'=>$bcn));
        $this->layout->buffer('content', 'routes/schedule');
        $this->layout->render();
    }

    public function bcn_area(){
        $places = $this->mdl_bcnareas->get()->result();
        $this->layout->set(array('places'=>$places, 'path'=>$this->path));
        $this->layout->buffer('content', 'routes/bcn_area');
        $this->layout->render();
    }
	public function bcntoggle($id, $bool){
        if ($id){
            $bool = ($bool) ? false : true;
            $this->mdl_bcnareas->save($id, array('is_active'=>$bool));
            redirect('admin/routes/bcn_area');
        }
    }
    public function bcn_form($id = null){
        if ($this->input->post('btn_cancel')){
            redirect('admin/routes/bcn_area');
        }
        if ($this->mdl_bcnareas->run_validation()){
            unset($_POST['btn_submit']);
            $id = $this->mdl_bcnareas->save($id, $this->input->post());
            redirect('admin/routes/bcn_area');
        }

        if ($id and !$this->input->post('btn_submit')){
            $this->mdl_bcnareas->prep_form($id);
        }

        $this->layout->set(array('path'=>$this->path));
        $this->layout->buffer('content', 'routes/bcn_form');
        $this->layout->render();
    }

    /**
     * Function form()
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function form($id = NULL) {
        if ($this->input->post('btn_cancel')){
            redirect('admin/routes/schedule');
        }
        $error = array();
        $routeRefId = $this->input->post('reference_id');

        $days = $this->input->post('days');
        $zone = $this->input->post('zone');
        $hours = $this->input->post('hours');
        $steps = array();
        if ($zone){
            $len = count($zone);
            $_POST['from_zone'] = $zone[0];
            $_POST['to_zone'] = $zone[$len-1];
            $steps['zone'] = $zone;
            unset($_POST['zone']);
        }
        if ($hours){
            $len = count($hours);
            $minutes = $this->input->post('minutes');
            $_POST['from_time'] = ($hours[0] || $minutes[0]) ? $hours[0] .':'.$minutes[0] : null;
            $_POST['to_time'] = ($hours[$len-1] || $minutes[$len-1]) ? $hours[$len-1] .':'.$minutes[$len-1] : null;
            $steps['hours'] = $hours;
            $steps['minutes'] = $minutes;
            unset($_POST['hours']);
            unset($_POST['minutes']);
        }
        if ($steps){
            $_POST['steps'] = json_encode($steps);
        }
        if ($days && is_array($days)){
            $_POST['days'] = json_encode($days);
        }

        if ($this->mdl_routes->run_validation()){
            unset($_POST['btn_submit']);
            $newId = $this->mdl_routes->save($id, $this->input->post());
            if ($id) {
                unset($_POST['reference_id']);
                $this->db->where('route_id', $id);
                $this->db->where('service_date >=', date('Y-m-d'));
                $this->db->update('tbl_calendars', $this->input->post());
            }
            else {                    
                $this->mdl_calendars->where('is_active',1);
                $this->mdl_calendars->where('service_date >=', date('Y-m-d'));
                $this->mdl_calendars->group_by('service_date');
                $countOfDates = $this->mdl_calendars->get()->num_rows();
				$countOfDates = ($countOfDates > 0) ? $countOfDates : 90;
                $routes = array();
                if ($countOfDates){
                    for($i=0;$i<$countOfDates;$i++){
                        $data = $this->input->post();
                        $date = date('Y-m-d', strtotime('+'.$i.' days'));
                        $data['reference_id'] = 'PNG-'.date('dmY', strtotime($date)).'-'.$data['reference_id'];
                        $data['service_date'] = $date;
                        $data['route_id'] = $newId;
                        $routes[] = $data;
                    }
                }
                $this->db->insert_batch('tbl_calendars', $routes);
            }
            redirect('admin/routes/schedule');
        }

        if ($id and !$this->input->post('btn_submit')){
            $this->mdl_routes->prep_form($id);
        }

        $routes_qry = $this->db->where('id', $id)->get('routes');
        $cars_array = $this->mdl_cars->get()->result_array();
        $cars = array();
        foreach($cars_array as $key=>$value) {
            $cars[$value['id']] = $value['car_name'];
        }

        if($this->input->post('car')){
            $this->mdl_routes->form_values['car'] = $this->input->post('car');
        } else {
            if($routes_qry->num_rows > 0){
                $routes_array = $routes_qry->row();
                $this->mdl_routes->form_values['car'] = $routes_array->car;
            } else {
                $this->mdl_routes->form_values['car'] = '';
            }
        }
        $bcn = $this->db->get_where('tbl_bcnareas', array('is_active'=>1))->result_array();
        foreach ($bcn as $key => $data){
            $bcn[$data['zone']] = 'Zone '.$data['zone'].' ( '. $data['name']. ')';
            unset($bcn[$key]);
        }
        $bcn = array(''=>'Zona XX', 'Terminal 1'=>'Terminal 1', 'Terminal 2'=>'Terminal 2') + $bcn;
        $prepend = array('00', '01','02','03','04','05','06','07','08','09');
        $hours = array_merge(array(''=>'Hours'), $prepend, range(10, 23));
        $minutes = array('00'=>'00','05'=>'05') + array_combine(range(10, 55, 5), range(10, 55, 5));

        $this->layout->set(array('path'=>$this->path, 'routeRefId'=>$routeRefId, 'bcn'=>$bcn, 'hours'=>$hours, 'minutes'=>$minutes, 'readonly'=>false, 'error'=>$error, 'cars'=>$cars));
        $this->layout->buffer('content', 'routes/form');
        $this->layout->render();
    }

    /**
     * [view description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function view($id){
        $error = array();
        // Get the reference_id
        $this->mdl_routes->select('reference_id');
        $this->mdl_routes->order_by('id', 'DESC');
        if (!is_null($id) && is_numeric($id)){
            $this->mdl_routes->where('id',$id);
        }
        $this->mdl_routes->where('is_active',1);
        $this->mdl_routes->limit(1);
        $routeRefId = $this->mdl_routes->get()->result_array();
        $routeRefId = count($routeRefId) > 0 ? $routeRefId[0]['reference_id'] : '00000';
        $routeRefId = is_null($id) ? str_pad(intval($routeRefId)+1, 5, 0, STR_PAD_LEFT) : $routeRefId;
        
        if ($id){
            $this->mdl_routes->prep_form($id);
        }

        $routes_array = $this->mdl_routes->where('id', $id)->get()->row();
        $cars_array = $this->mdl_cars->get()->result_array();
        $cars = array();
        foreach($cars_array as $key=>$value) {
            $cars[$value['id']] = $value['car_name'];
        }

        if($this->input->post('car')){
            $this->mdl_routes->form_values['car'] = $this->input->post('car');
        }
        else{
            $this->mdl_routes->form_values['car'] = $routes_array->car;
        }

        $bcn = $this->db->get_where('tbl_bcnareas', array('is_active'=>1))->result_array();
        foreach ($bcn as $key => $data){
            $bcn[$data['zone']] = 'Zone '.$data['zone'].' ( '. $data['name']. ')';
            unset($bcn[$key]);
        }
        $bcn = array(''=>'Zona XX', 'Terminal 1'=>'Terminal 1', 'Terminal 2'=>'Terminal 2') + $bcn;
        $prepend = array('00', '01','02','03','04','05','06','07','08','09');
        $hours = array_merge(array(''=>'Hours'), $prepend, range(10, 23));
        $minutes = array_merge(array(''=>'Minutes'), $prepend, range(10, 59));

        $this->layout->set(array('path'=>$this->path, 'routeRefId'=>$routeRefId, 'bcn'=>$bcn, 'hours'=>$hours, 'minutes'=>$minutes, 'readonly'=>true, 'error'=>$error, 'cars' => $cars));
        $this->layout->buffer('content', 'routes/form');
        $this->layout->render();
    }

    /**
     * [toggle description]
     * @param  [type] $id   [description]
     * @param  [type] $bool [description]
     * @return [type]       [description]
     */
    public function toggle($id, $bool){
        if ($id){
            $bool = ($bool) ? false : true;
            
            if ($bool === false) {
                $this->db->where('route_id', $id);
                $this->db->where('service_date >=', date('Y-m-d'));
                $this->db->delete('tbl_calendars');
            }
            else {
                $this->mdl_calendars->where('is_active',1);
                $this->mdl_calendars->where('service_date >=', date('Y-m-d'));
                $this->mdl_calendars->group_by('service_date');
                $countOfDates = $this->mdl_calendars->get()->num_rows();
                $routes = array();
                if ($countOfDates){
                    $data = (array) $this->mdl_routes->get_by_id($id);
                    $reference_id = $data['reference_id'];
                    unset($data['id']);
                    unset($data['created']);
                    unset($data['is_active']);
                    for($i=0;$i<$countOfDates;$i++){
                        $date = date('Y-m-d', strtotime('+'.$i.' days'));
                        $data['reference_id'] = 'PNG-'.date('dmY', strtotime($date)).'-'.$reference_id;
                        $data['service_date'] = $date;
                        $data['route_id'] = $id;
                        $routes[] = $data;
                    }
                }
                $this->db->insert_batch('tbl_calendars', $routes);
            }

            $this->mdl_routes->save($id, array('is_active'=>$bool));
            redirect('admin/routes/schedule');
        }
    }
	
    /**
     * [delete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id) {
        $this->mdl_routes->delete($id);
        if ($id){
            $this->db->where('route_id', $id);
            $this->db->where('service_date >=', date('Y-m-d'));
            $this->db->delete('tbl_calendars');
        }
        redirect('admin/routes/schedule');
    }

    /**
     * [calendar description]
     * @return [type] [description]
     */
    public function calendar() {
        $fromDate = $toDate = date('d-m-Y');
        $bcn = $this->mdl_bcnareas->where('is_active',1)->get()->result_array();
        foreach ($bcn as $key => $data){
            $bcn[$data['zone']] = 'Zone '.$data['zone'].' ( '. $data['name']. ')';
            unset($bcn[$key]);
        }
        $bcn = array(''=>'Zona XX', 'Terminal 1'=>'Terminal 1', 'Terminal 2'=>'Terminal 2') + $bcn;

        if ($this->input->post('from_date') && $this->input->post('to_date')){
            $fromUnixTime = strtotime(str_replace('/', '-', $this->input->post('from_date')));
            $toUnixTime = strtotime(str_replace('/', '-', $this->input->post('to_date')));
            if ($toUnixTime < $fromUnixTime) {
                $this->session->set_flashdata('alert_error', 'From and To Dates are out of range.');
                redirect('/admin/routes/calendar');
            }
            $fromDate = date('d-m-Y', $fromUnixTime);
            $toDate = date('d-m-Y', $toUnixTime);
            $this->mdl_calendars->where('DATE(service_date) >= ', date('Y-m-d', $fromUnixTime));
            $this->mdl_calendars->where('DATE(service_date) <= ', date('Y-m-d', $toUnixTime));
        }
        else {
            $this->mdl_calendars->where('DATE(service_date) = ', date('Y-m-d', strtotime($fromDate)));
            $this->mdl_calendars->order_by('service_date ASC');
        }
        
        $routes = $this->mdl_calendars->get()->result_array();
		/*$this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "filename_you_wish.csv";
        $query = "SELECT * FROM tbl_routes";
        $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);*/
		
		foreach($routes as $key=>$data){
			$steps 		= json_decode($data['steps'], true);
			$zone 		= $steps['zone'];
			$hours 		= $steps['hours'];
			$minutes 	= $steps['minutes'];
			$step_list = array('Terminal 1', 'Terminal 2');
			
			$this->db->from('seats')->where("calendar_id = ".$data['id']." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
			$seat_com = $this->db->get()->result_array();
			$seat_occupy = 0;
			foreach($seat_com as $data1){
				$seat_occupy += $data1['seats'];
			}
			$seats = $data['seats'] - $seat_occupy;
			$routes[$key]['go_seats'] = $seats;
			
			$this->db->from('seats')->where("calendar_id = ".$data['id']." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
			$seat_com = $this->db->get()->result_array();
			$seat_occupy = 0;
			foreach($seat_com as $data1){
				$seat_occupy += $data1['seats'];
			}
			$seats = $data['seats'] - $seat_occupy;
			$routes[$key]['return_seats'] = $seats;
		}
		$routes = json_decode(json_encode($routes,false));
		
        /*if ($routes && !$this->input->post('from_date')){
            $len = count($routes);
            //$fromDate = date('d-m-Y', strtotime($routes[0]->service_date));
            $toDate = date('d-m-Y', strtotime($routes[$len-1]->service_date));
        }
        $this->session->set_userdata('methodFrom', 'calendar');*/
        $this->layout->set(array(
            'routes'=>$routes, 'path'=>$this->path, 'bcn'=>$bcn, 'fromDate'=>$fromDate, 'toDate'=>$toDate
        ));
        $this->layout->buffer('content', 'routes/schedule');
        $this->layout->render();
    }

    /**
     * [calendarToggle description]
     * @param  [type] $id   [description]
     * @param  [type] $bool [description]
     * @return [type]       [description]
     */
    public function calendarToggle($id, $bool){
        if ($id){
            $bool = ($bool) ? false : true;
            $this->mdl_calendars->save($id, array('is_active'=>$bool));
			/*Booking update start*/
			$book_info = $this->db->from('booking')->where('calendar_id', $id)->get()->result_array();
			$book_id = array();
			foreach($book_info as $book){
				array_push($book_id, $book['id']);
				if($book['return_book_id'] > 0)
					array_push($book_id, $book['return_book_id']);
				if($book['round_trip'] == 1){
					$rid = $this->db->from('booking')->where('return_book_id', $book['id'])->get()->row();
					array_push($book_id, $rid->id);
				}
			}
			$this->db->set(array('updated_by' =>'calendar Active', 'is_active'=>$bool))->where_in('id', $book_id)->update('booking');
			$this->db->set(array('is_active'=>$bool))->where_in('book_id', $book_id)->update('seats');
			/*Booking update end*/
            redirect('admin/routes/calendar');
        }
    }

    /**
     * [calendarDelete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function calendarDelete($id) {
        if($id) {
			$book_info = $this->db->from('booking')->where('calendar_id', $id)->get()->result_array();
			$book_id = array();
			foreach($book_info as $book){
				array_push($book_id, $book['id']);
				if($book['return_book_id'] > 0)
					array_push($book_id, $book['return_book_id']);
				if($book['round_trip'] == 1){
					$rid = $this->db->from('booking')->where('return_book_id', $book['id'])->get()->row();
					array_push($book_id, $rid->id);
				}
			}
			$this->db->set(array('updated_by' =>'calendar delete', 'is_active'=>0))->where_in('id', $book_id)->update('booking');
			$this->db->set(array('is_active'=>0))->where_in('book_id', $book_id)->update('seats');
		}
		$this->db->set(array('is_active'=>0))->where('id', $id)->update('calendars');
		//$this->mdl_calendars->delete($id);
        redirect('admin/routes/calendar');
    }

    /**
     * [calendarForm description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function calendarForm($id = NULL) {
        if ($this->input->post('btn_cancel')){
            redirect('admin/routes/calendar');
        }

        $routeRefId = $this->input->post('reference_id');

        $zone = $this->input->post('zone');
        $hours = $this->input->post('hours');
        $steps = array();
        if ($zone){
            $len = count($zone);
            $_POST['from_zone'] = $zone[0];
            $_POST['to_zone'] = $zone[$len-1];
            $steps['zone'] = $zone;
            unset($_POST['zone']);
        }
        if ($hours){
            $len = count($hours);
            $minutes = $this->input->post('minutes');
            $_POST['from_time'] = ($hours[0] || $minutes[0]) ? $hours[0] .':'.$minutes[0] : null;
            $_POST['to_time'] = ($hours[$len-1] || $minutes[$len-1]) ? $hours[$len-1] .':'.$minutes[$len-1] : null;
            $steps['hours'] = $hours;
            $steps['minutes'] = $minutes;
            unset($_POST['hours']);
            unset($_POST['minutes']);
        }
        if ($steps){
            $_POST['steps'] = json_encode($steps);
        }

        if ($this->mdl_calendars->run_validation()){
            unset($_POST['btn_submit']);
            $id = $this->mdl_calendars->save($id, $this->input->post());
            redirect('admin/routes/calendar');
        }

        if ($id and !$this->input->post('btn_submit')){
            $this->mdl_calendars->prep_form($id);
        }
	
		$book_info = $this->db->select('collaborators_address.address as mainaddress,collaborators_address.zone as col_zone,booking.start_from,booking.end_at,booking.client_array,clients.name,clients.surname,booking.adults,booking.kids,
									booking.baby,booking.id as book_id,clients.id as client_id,calendars.reference_id,collaborators.name as collaborators_name, booking.book_status, booking.price, collaborators.address as collaborator_address')->from('booking')
								->where(array('booking.is_active'=>1, 'booking.calendar_id'=>$id))
								->join('clients', 'clients.id=booking.client_id', 'left')
								->join('collaborators_address', 'collaborators_address.id = booking.collaborator_address_id', 'left')
								->join('calendars', 'calendars.id=booking.calendar_id', 'left')
								->join('collaborators', 'collaborators.id=booking.collaborator_id', 'left')
								->get()->result_array();
		$calendar = $this->db->where('id', $id)->get('calendars')->row();
		$step_list = array('Terminal 1', 'Terminal 2');
		
		$this->db->from('seats')->where("calendar_id = ".$id." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
		$seat_com = $this->db->get()->result_array();
		$seat_occupy = 0;
		foreach($seat_com as $data1){
			$seat_occupy += $data1['seats'];
		}
		$seats = $calendar->seats - $seat_occupy;
		
		$this->db->from('seats')->where("calendar_id = ".$id." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
		$seat_com = $this->db->get()->result_array();
		$seat_occupy = 0;
		foreach($seat_com as $data1){
			$seat_occupy += $data1['seats'];
		}
		$return_seats = $calendar->seats - $seat_occupy;
								
        $bcn = $this->db->get_where('tbl_bcnareas', array('is_active'=>1))->result_array();
        foreach ($bcn as $key => $data){
            $bcn[$data['zone']] = 'Zone '.$data['zone'].' ( '. $data['name']. ')';
            unset($bcn[$key]);
        }
        $bcn = array(''=>'Zona XX', 'Terminal 1'=>'Terminal 1', 'Terminal 2'=>'Terminal 2') + $bcn;
        $prepend = array('00', '01','02','03','04','05','06','07','08','09');
        $hours = array_merge(array(''=>'Hours'), $prepend, range(10, 23));
        $minutes = array('00'=>'00','05'=>'05') + array_combine(range(10, 55, 5), range(10, 55, 5));

        $this->layout->set(array('path'=>$this->path, 'routeRefId'=>$routeRefId, 'bcn'=>$bcn, 'hours'=>$hours, 'minutes'=>$minutes, 'readonly'=>false, 'book_info'=>$book_info, 'seats'=>$seats, 'return_seats'=>$return_seats));
        $this->layout->buffer('content', 'routes/calendar_form');
        $this->layout->render();
    }

    /**
     * [calendarView description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function calendarView($id){
        if ($id){
            $this->mdl_calendars->prep_form($id);
        }

        $bcn = $this->db->get_where('tbl_bcnareas', array('is_active'=>1))->result_array();
        foreach ($bcn as $key => $data){
            $bcn[$data['zone']] = $data['name'];
            unset($bcn[$key]);
        }

		$book_info = $this->db->select('collaborators_address.address as mainaddress,collaborators_address.zone as col_zone,booking.start_from,booking.end_at,booking.hour,booking.client_array,clients.name,clients.surname,booking.adults,booking.kids,
									booking.baby,booking.id as book_id,clients.id as client_id,calendars.reference_id,collaborators.name as collaborators_name, booking.book_status, booking.price, collaborators.address as collaborator_address')->from('booking')
								->where(array('booking.is_active'=>1, 'booking.calendar_id'=>$id))
								->join('clients', 'clients.id=booking.client_id', 'left')
								->join('collaborators_address', 'collaborators_address.id = booking.collaborator_address_id', 'left')
								->join('calendars', 'calendars.id=booking.calendar_id', 'left')
								->join('collaborators', 'collaborators.id=booking.collaborator_id', 'left')
                                ->order_by('booking.hour asc')
								->get()->result_array();
                                //echo $this->db->last_query();die;
		$calendar = $this->db->where('id', $id)->get('calendars')->row();
		$step_list = array('Terminal 1', 'Terminal 2');
		
		$this->db->from('seats')->where("calendar_id = ".$id." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
		$seat_com = $this->db->get()->result_array();
		$seat_occupy = 0;
		foreach($seat_com as $data1){
			$seat_occupy += $data1['seats'];
		}
		$seats = $calendar->seats - $seat_occupy;
		
		$this->db->from('seats')->where("calendar_id = ".$id." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
		$seat_com = $this->db->get()->result_array();
		$seat_occupy = 0;
		foreach($seat_com as $data1){
			$seat_occupy += $data1['seats'];
		}
		$return_seats = $calendar->seats - $seat_occupy;		
		
		
		
								
		//echo $this->db->last_query();die;
        $bcn = array(''=>'Zona XX', 'Terminal 1'=>'Terminal 1', 'Terminal 2'=>'Terminal 2') + $bcn;
        $prepend = array('00', '01','02','03','04','05','06','07','08','09');
        $hours = array_merge(array(''=>'Hours'), $prepend, range(10, 23));
        $minutes = array_merge(array(''=>'Minutes'), $prepend, range(10, 59));
		$terminal = array('Barcelona Airport Terminal 1', 'Barcelona Airport Terminal 2');

        $this->layout->set(array('path'=>$this->path, 'bcn'=>$bcn, 'hours'=>$hours, 'minutes'=>$minutes, 'readonly'=>true, 'book_info'=>$book_info, 'terminal'=>$terminal, 'seats'=>$seats, 'return_seats'=>$return_seats));
        $this->layout->buffer('content', 'routes/calendar_form');
        $this->layout->render();
    }

    /**
     * [dmYtoDateFormat description]
     * @param  [type] $str [description]
     * @return [type]      [description]
     */
    function dmYtoDateFormat($str = null){
        $str = str_replace('PNG-', '', $str);
        $str = substr($str, 0, 8);
        $str = substr($str, 0, 2) . '-' . substr($str, 2, 2) . '-' . substr($str, 4, 4);
        return $str;
    }
    /**
     * [carChannel description]
     * @return [type]     [description]
     */
    public function carChannel() {
        $this->session->set_userdata('methodFrom', 'carChannel');
        $car_array = $this->mdl_cars->select('cars.car_name, cars.id,users.email,cars.is_active')->join('users', 'users.car_id=cars.id', 'left')->order_by('cars.created', 'desc')->get()->result();
        
        $this->layout->set(array('cars'=>$car_array, 'path'=>$this->path));
        $this->layout->buffer('content', 'routes/car_channel');
        $this->layout->render();
    }
    public function carForm($id = NULL) {
        $this->session->set_userdata('methodFrom', 'carChannel');
        if ($this->input->post('btn_cancel')) {
            redirect('admin/routes/carChannel');
        }
        $error = array();
        
        $num_rows = 0;
        if(is_null($id) || $id == '') {
           $num_rows = 0;     
        } else {
            $cars_qry = $this->db->where('car_id', $id)->get('users');
            $cars = $cars_qry->row();            
            $num_rows = $cars_qry->num_rows();
        }
        
        if ($this->mdl_cars->run_validation()) {
            if($id == null){
                $email_exists = $this->mdl_users->user_exists($this->input->post('email'));
            } else {
                if($cars->email != $this->input->post('email'))
                    $email_exists = $this->mdl_users->user_exists($this->input->post('email'));
                else
                    $email_exists = false;
            }
            
            if (!$email_exists) {
                $user = array();
                $car_array = array('car_name' => $this->input->post('car_name'));
                $user['role'] = 5;
                /*$user['first_name'] = $this->input->post('name');
                $user['last_name'] = $this->input->post('surname');*/
                $user['email'] = $this->input->post('email');
                $user['password'] = md5($this->input->post('password'));
                $user['secret_key'] = base64_encode($this->input->post('password').'_pickngo');
                $clients = $this->input->post();
                if(is_null($id) || $id == ''){
                    $this->mdl_cars->save(null,$car_array);
                    $user['car_id'] = $this->db->insert_id();
                } else {
                    $user['car_id'] = $id;                    
                    $this->mdl_cars->save($id,$car_array);
                }

                if($num_rows == 0) {
                    $this->mdl_users->save(null, $user);
                } else {
                    $user_array = current($this->db->from('users')->where('car_id',$id)->get()->result_array());
                    $this->mdl_users->save($user_array['id'], $user);
                }
                redirect('admin/routes/carChannel');
            } else {
                $error_flg = true;
                $error[] = lang('exists_username');
                //redirect($this->uri->uri_string());
            }
        }

        if ($id and !$this->input->post('btn_submit')) {
            $this->mdl_cars->prep_form($id);
        }
        $user_array = current($this->db->from('users')->where('car_id',$id)->get()->result_array());
        if($this->input->post('password')){
            $this->mdl_cars->form_values['password'] = $this->input->post('password');
            $this->mdl_cars->form_values['email'] = $this->input->post('email');
        }
        else{
            $this->mdl_cars->form_values['password'] = str_replace('_pickngo', '', base64_decode($user_array['secret_key']));
            $this->mdl_cars->form_values['email'] = $user_array['email'];
        }
        $this->layout->set(
            array(
                'id'           => $id,
                'readonly'=>false,
                'user_array'=>$user_array,
                'error'=>$error
            )
        );
        $this->layout->buffer('content', 'routes/car_form');
        $this->layout->render();
    }
    public function carView($id) {
        $this->session->set_userdata('methodFrom', 'carChannel');
        /*$error_flg = false;
        $error = array();
        if ($this->input->post('btn_cancel')) {
            redirect('admin/routes/carChannel');
        }

        if ($id) {
            $this->mdl_cars->prep_form($id);
        }
        $user_array = current($this->db->from('users')->where('car_id',$id)->get()->result_array());
        if($this->input->post('password')){
            $this->mdl_cars->form_values['password'] = $this->input->post('password');
            $this->mdl_cars->form_values['email'] = $this->input->post('email');
        }
        else{
            $this->mdl_cars->form_values['password'] = str_replace('_pickngo', '', base64_decode($user_array['secret_key']));
            $this->mdl_cars->form_values['email'] = $user_array['email'];
        }
        $user_array = current($this->db->from('users')->where('car_id',$id)->get()->result_array());
        $this->layout->set(array('id'=>$id, 'readonly'=>true, 'user_array'=>$user_array, 'error'=>$error));*/
        if ($id) {
            $this->mdl_cars->prep_form($id);
        }

        $routes = $this->mdl_routes->where('car',$id)->get()->result_array();
        $rid = array();
        $rsteps = array();
        foreach($routes as $route) {
            array_push($rid, $route['id']);
            $steps = json_decode($route['steps'], true);
            foreach($steps['zone'] as $key=>$s) {
                $rsteps[$steps['hours'][$key].':'.$steps['minutes'][$key]] = $s;
            }
            //array_push($rsteps, $steps);
        }
        if(count($rid) == 0) {
            $rid = array(0);
        }
        $bcn = $this->mdl_bcnareas->get()->result_array();
        $bcn_array = array();
        foreach($bcn as $b) {
            $bcn_array[$b['zone']] = $b['name'];
        }
                        
	$booking_array = $this->mdl_shuttles->select('booking.bcnarea_address_id,booking.address as book_address,collaborators.address as collaborator_address,collaborators_address.address as mainaddress,collaborators_address.zone as col_zone,booking.round_trip,booking.price,booking.book_status,booking.payment_method,booking.journey_completed,booking.id,booking.extra_array,booking.collaborator_id,booking.kids,booking.adults,booking.baby,booking.start_from,
											booking.end_at,booking.zone,booking.hour,booking.arrival_time,booking.price,booking.start_journey,
											booking.return_book_id,booking.return_journey,booking.country,booking.flight_no,booking.created,collaborators.name,booking.client_id,booking.client_array,
											clients.name as first_name, clients.surname,calendars.reference_id')
											->join('collaborators', 'collaborators.id=booking.collaborator_id', 'left')
											->join('clients', 'clients.id=booking.client_id', 'left')
											->join('collaborators_address', 'collaborators_address.id = booking.collaborator_address_id', 'left')
											->join('calendars', 'calendars.id=booking.calendar_id', 'left')
											->where("booking.is_active = 1 and tbl_calendars.route_id in (".implode(',', $rid).") and tbl_booking.start_journey = '".Date('Y-m-d')."'")
											->order_by('booking.hour', 'asc')
											->get()->result_array();
		$return_id = $this->db->query("select tbl_booking.id, mm.id as return_book_id 
                                            from tbl_booking 
                                            inner join (select tbl_booking.id from tbl_booking 
                                                        left join tbl_calendars on tbl_calendars.id = tbl_booking.calendar_id
                                                        where tbl_booking.is_active = 1 and tbl_calendars.route_id in (".implode(',', $rid).") and tbl_booking.start_journey = '".Date('Y-m-d')."' and tbl_booking.round_trip = 1) mm
                                            on mm.id = tbl_booking.return_book_id")->result_array();
        
        $res = array();
        array_walk($return_id, function($item) use (&$res) {
            // flatten the array
            $res[$item['return_book_id']] = $item['id'];
        });										
									                        
        $this->layout->set(array('id'=>$id, 'bcn_array'=>$bcn_array, 'routes'=>$routes, 'booking_array' => $booking_array, 'rsteps'=>$rsteps, 'res'=>$res));
        $this->layout->buffer('content', 'routes/car_view');
        $this->layout->render();
    }
    public function carToggle($id, $bool){
        if ($id){
            $bool = ($bool) ? false : true;
            $this->mdl_cars->save($id, array('is_active'=>$bool));
            redirect('admin/routes/carChannel');
        }
    }
    public function carDelete($id) {
        $this->db->where('car_id',$id);
        $this->db->delete('tbl_users');
        $this->mdl_cars->delete($id);
        redirect('admin/routes/carChannel');
    }
	public function bcnareas_address(){
        $places = $this->mdl_bcnareas_address->select('bcnareas_address.is_active, bcnareas_address.id,bcnareas_address.postal_code,bcnareas.zone,bcnareas.name')->join('bcnareas', 'bcnareas.id=bcnareas_address.bcnarea_id', 'left')->get()->result();
		
        $this->layout->set(array('places'=>$places, 'path'=>$this->path));
        $this->layout->buffer('content', 'routes/bcn_area_address');
        $this->layout->render();
    }
	public function bcn_addresstoggle($id, $bool){
        if ($id){
            $bool = ($bool) ? false : true;
            $this->mdl_bcnareas_address->save($id, array('is_active'=>$bool));
            redirect('admin/routes/bcnareas_address');
        }
    }
    public function bcn_address_form($id = null){
        if ($this->input->post('btn_cancel')){
            redirect('admin/routes/bcnareas_address');
        }
		$error = array();
		$bcn_address = $this->mdl_bcnareas_address->where('id', $id)->get()->row();
        if ($this->mdl_bcnareas_address->run_validation()){
			if($id == null){
				$postal_exists = $this->mdl_bcnareas_address->is_exists_postalcode($this->input->post('postal_code'));
			} else {
				if($bcn_address->postal_code != $this->input->post('postal_code'))
					$postal_exists = $this->mdl_bcnareas_address->is_exists_postalcode($this->input->post('postal_code'));
				else
					$postal_exists = false;
			}
			
            unset($_POST['btn_submit']);
			if (!$postal_exists) {
				$id = $this->mdl_bcnareas_address->save($id, $this->input->post());
				redirect('admin/routes/bcnareas_address');
			} else {
				$error[] = lang('exists_postalcode');
				//redirect('admin/routes/bcnareas_address');
			}
            
        }

        if ($id and !$this->input->post('btn_submit')){
            $this->mdl_bcnareas_address->prep_form($id);
        }
		$bcn_areas_old = $this->mdl_bcnareas->get()->result_array();
		$bcn_areas = array();
		foreach($bcn_areas_old as $bcn) {
			$bcn_areas[$bcn['id']] = $bcn['name'];
		}

        $this->layout->set(array('path'=>$this->path, 'bcn_areas' => $bcn_areas, 'error'=>$error));
        $this->layout->buffer('content', 'routes/bcn_address_form');
        $this->layout->render();
    }
}
