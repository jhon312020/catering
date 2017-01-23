<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

	class Collaborators extends Admin_Controller {

	var $bcn = array();

	public function __construct() {
		parent::__construct();
		$this->load->model('routes/mdl_bcnareas');
		$this->load->model('shuttles/mdl_shuttles');
		$this->load->model('users/mdl_users');
		$this->load->model('collaborators/mdl_collaborators');
		$this->load->model('settings/mdl_settings');
		$this->load->model('charts/mdl_charts');

		$bcn = $this->db->get_where('tbl_bcnareas', array('is_active'=>1))->result_array();
		foreach ($bcn as $key => $data){
			$value_name = 'Zone '.$data['zone'].' ( '. $data['name']. ')';
			//$bcn['$data['zone']] = $data['name'];
			$bcn[$data['zone']] = $value_name;
			unset($bcn[$key]);
		}
		$this->bcn = $bcn;

		//$this->load->helper('text');
		$this->path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/collaborators/";
	}

	public function index() {
		$this->layout->set(array('collaborators'=>$this->db->query("select c.*, (select GROUP_CONCAT(concat('zone ', b.zone),' (', b.name, ')'  separator ', ') from tbl_collaborators_address a left join tbl_bcnareas b on a.zone = b.zone where a.collaborator_id = c.id and a.is_active=1) as bcnarea from tbl_collaborators c order by created desc")->result(), 'path'=>$this->path, 'bcn'=>$this->bcn));
		$this->layout->buffer('content', 'collaborators/index');
		$this->layout->render();
	}

	public function form($id = NULL) {
		$error_flg = false;
		$error = array();
		if ($this->input->post('btn_cancel')){
			redirect('admin/collaborators');
		}
		$zone_exists = false;
		$collaborators = $this->db->where('id', $id)->get('collaborators')->row();
		
		$start_date = date('Y-m-d', strtotime('-7 days'));
		$end_date = Date('Y-m-d');
		if($this->input->post('start_date')) {
			$chartStartDate = str_replace('/','-',$this->input->post('start_date'));
			$startDate = date('Y-m-d', strtotime($chartStartDate));
			$chartEndDate = str_replace('/','-',$this->input->post('end_date'));
			$endDate = date('Y-m-d', strtotime($chartEndDate));
			if($startDate <= $endDate) {
				$end_date = $endDate;
				$start_date = $startDate;
			} else {
				$start_date = date('Y-m-d', strtotime('-7 days'));
				$end_date = Date('Y-m-d');
			}
		} else {
			if ($this->mdl_collaborators->run_validation()){
				if($id == null){
					$email_exists = $this->mdl_users->user_exists($this->input->post('email'));
				}
				else{
					if($collaborators->email != $this->input->post('email'))
						$email_exists = $this->mdl_users->user_exists($this->input->post('email'));
					else
						$email_exists = false;
				}
				/*$zone_array = $this->input->post('zone');
				if (count($zone_array) != count(array_unique($zone_array))) {
					$error_flg = true;
					$zone_exists = true;
					$error[] = 'Zone value must be unique';
				}*/
				if(!$email_exists){
					$data = array();
					$user = array();
					$zone = $this->input->post('zone');
					$address = $this->input->post('address');
					$data['name'] = $this->input->post('name');
					//$data['zone'] = $this->input->post('zone');
					//$data['address'] = $this->input->post('address');
					$data['email'] = $this->input->post('email');
					$data['phone'] = $this->input->post('phone');
					$data['website'] = $this->input->post('website');
					$data['available_seats'] = $this->input->post('available_seats');
					if ($this->input->post('available_seats') == 'activate'){
						$data['no_of_available_seats'] = $this->input->post('no_of_available_seats');
					}
					else {
						$data['no_of_available_seats'] = null;
					}
					$data['payment_methods'] = $this->input->post('payment_methods');
					$data['price'] = $this->input->post('price');
					
					$user['role'] = 2;
					$user['first_name'] = $this->input->post('name');
					$user['email'] = $this->input->post('email');
					$user['password'] = md5($this->input->post('password'));
					$user['secret_key'] = base64_encode($this->input->post('password').'_pickngo');
					if(is_null($id) || $id == ''){
						$id = $this->mdl_collaborators->save(null, $data);
						$col_id = $id;
						$user['collaborator_id'] = $this->db->insert_id();
						$this->mdl_users->save(null, $user);
					}
					else{
						$col_id = $id;
						$user_array = current($this->db->from('users')->where('collaborator_id',$id)->get()->result_array());
						$this->mdl_users->save($user_array['id'], $user);
						$this->mdl_collaborators->save($id,$data);
					}
					//$this->db->where('collaborator_id', $col_id)->delete('collaborators_address');
					$address_id = json_decode($this->input->post('address_id'), true);
					//print_r($address_id);die;
					foreach($address_id as $add_id) {
						//echo $id;die;
						if($this->input->post('zone_old_'.$add_id)) {
							if($this->input->post('zone_old_'.$add_id) != '' && $this->input->post('address_old_'.$add_id) != '') {
								$data = array('zone'=>$this->input->post('zone_old_'.$add_id),'address'=>$this->input->post('address_old_'.$add_id));
								$this->db->set($data)->where('id', $add_id)->update('collaborators_address');
							}
						} else {
							$this->db->set(array('is_active'=>'0'))->where('id', $add_id)->update('collaborators_address');
						}
					}
					foreach($zone as $key => $value) {
						if($value != '' && $address[$key] != '') {
							$data = array('zone'=>$value,'address'=>$address[$key],'collaborator_id'=>$col_id);
							$this->db->insert('collaborators_address', $data);
						}
					}
				}
				else{
					//if($email_exists) {
						$error_flg = true;
						$error[] = lang('exists_username');
					//}
					//redirect($this->uri->uri_string());
				}
					if(!$error_flg)
						redirect('admin/collaborators');
			}
		}
		$col_id = $id;
		$address_array = array();
		if($this->input->post('start_date')) {
			$col_data = $this->mdl_collaborators->where('id', $id)->get()->row();
			foreach($col_data as $key=>$value) {
				$this->mdl_collaborators->form_values[$key] = $value;
			}
			$address_array = $this->db->where(array('collaborator_id'=> $id, 'is_active' => 1))->get('collaborators_address')->result_array();
		}
		else if ($id and !$this->input->post('btn_submit')) {
			$this->mdl_collaborators->prep_form($id);
			$address_array = $this->db->where(array('collaborator_id'=> $id, 'is_active' => 1))->get('collaborators_address')->result_array();
		} else if($this->input->post('btn_submit')) {
			$post_address = $this->input->post('address');
			$step = 0;
			if($this->input->post('zone')) {
				$step = count($this->input->post('zone'));
				foreach($this->input->post('zone') as $key=>$value) {
					$address_array[$key]['zone'] = $value;
					$address_array[$key]['address'] = $post_address[$key];
				}
			}
			$address_id = json_decode($this->input->post('address_id'), true);
			//print_r($address_id);die;
			foreach ($address_id as $id) {
				if($this->input->post('zone_old_'.$id)) {
					$address_array[$step]['zone'] = $this->input->post('zone_old_'.$id);
					$address_array[$step]['address'] = $this->input->post('address_old_'.$id);
					$address_array[$step]['id'] = $id;
					$step++;
				}
			}
		}
		$user_array = current($this->db->from('users')->where('collaborator_id',$id)->get()->result_array());
		if($this->input->post('password'))
			$this->mdl_collaborators->form_values['password'] = $this->input->post('password');
		else
			$this->mdl_collaborators->form_values['password'] = str_replace('_pickngo', '', base64_decode($user_array['secret_key']));


		$booking_array = $this->mdl_shuttles->select('booking.bcnarea_address_id,booking.address as book_address,collaborators_address.address as mainaddress,collaborators_address.zone as col_zone,collaborators.address as col_address,booking.round_trip,booking.price,booking.book_status,booking.payment_method,booking.journey_completed,booking.id,booking.extra_array,booking.collaborator_id,booking.kids,booking.adults,booking.baby,booking.start_from,
				booking.end_at,booking.zone,booking.hour,booking.arrival_time,booking.price,booking.start_journey,		booking.return_book_id,booking.return_journey,booking.country,booking.flight_no,booking.created,collaborators.name,booking.client_id,booking.client_array,
				clients.name as first_name, clients.surname,calendars.reference_id')
				->join('collaborators', 'collaborators.id=booking.collaborator_id', 'left')
				->join('clients', 'clients.id=booking.client_id', 'left')
				->join('collaborators_address', 'collaborators_address.id = booking.collaborator_address_id', 'left')
				->join('calendars', 'calendars.id=booking.calendar_id', 'left')
				->where("booking.is_active = 1 and tbl_booking.collaborator_id ='".$id."' and tbl_booking.round_trip = 0 and DATE(tbl_booking.start_journey) between '".$start_date."' and '".$end_date."'")
                                            ->order_by('booking.created', 'desc')
                                            ->get()->result_array();
		
		$bcn = $this->mdl_bcnareas->get()->result_array();
        $bcn_array = array();
        foreach($bcn as $b) {
            $bcn_array[$b['zone']] = $b['name'];
        }
		$this->layout->set(array('path'=>$this->path, 'bcn'=>$this->bcn, 'bcn_array' => $bcn_array, 'readonly'=>false, 'user_array'=>$user_array, 'error'=>$error, 'booking_array' => $booking_array, 'address_array'=>$address_array, 'col_id'=>$col_id,
			'start_date' => $start_date,
			'end_date' => $end_date, 
			'collaborator_book_bill' => $this->mdl_charts->get_bookBillByCollaboratorId($start_date, $end_date, $col_id),
			'collaborator_book_count' => $this->mdl_charts->get_bookCountByCollaboratorId($start_date, $end_date, $col_id), 
		));
		$this->layout->buffer('content', 'collaborators/form');
		$this->layout->render();
	}
	public function view($id) {
		$error_flg = false;
		$error = array();
		if ($this->input->post('btn_cancel')) {
			redirect('admin/collaborators');
		}
		$address_array = array();
		
		
		$end_date = Date('Y-m-d');
		$start_date = date('Y-m-d', strtotime('-7 days'));
		if($this->input->post('start_date')) {
			$chartStartDate = str_replace('/','-',$this->input->post('start_date'));
			$startDate = date('Y-m-d', strtotime($chartStartDate));
			$chartEndDate = str_replace('/','-',$this->input->post('end_date'));
			$endDate = date('Y-m-d', strtotime($chartEndDate));
			if($startDate <= $endDate) {
				$end_date = $endDate;
				$start_date = $startDate;
			} else {
				$error['error'] = 'Start date should be less than the end date';
				$start_date = date('Y-m-d', strtotime('-7 days'));
				$end_date = Date('Y-m-d');
			}
		}
		
		if($this->input->post('start_date')) {
			$col_data = $this->mdl_collaborators->where('id', $id)->get()->row();
			foreach($col_data as $key=>$value) {
				$this->mdl_collaborators->form_values[$key] = $value;
			}
			$address_array = $this->db->where(array('collaborator_id'=> $id, 'is_active' => 1))->get('collaborators_address')->result_array();
		}
		else if ($id) {
			$this->mdl_collaborators->prep_form($id);
			$address_array = $this->db->where('collaborator_id', $id)->get('collaborators_address')->result_array();
		}
		
		$user_array = current($this->db->from('users')->where('id',$this->mdl_collaborators->form_value('user_id'))->get()->result_array());
		$user_array = current($this->db->from('users')->where('collaborator_id',$id)->get()->result_array());
		if($this->input->post('password'))
			$this->mdl_collaborators->form_values['password'] = $this->input->post('password');
		else
			$this->mdl_collaborators->form_values['password'] = str_replace('_pickngo', '', base64_decode($user_array['secret_key']));
		
		$booking_array = $this->mdl_shuttles->select('booking.bcnarea_address_id,booking.address as book_address,collaborators_address.address as mainaddress,collaborators_address.zone as col_zone,collaborators.address as col_address,booking.round_trip,booking.price,booking.book_status,booking.payment_method,booking.journey_completed,booking.id,booking.extra_array,booking.collaborator_id,booking.kids,booking.adults,booking.baby,booking.start_from,
                                            booking.end_at,booking.zone,booking.hour,booking.arrival_time,booking.price,booking.start_journey,
                                            booking.return_book_id,booking.return_journey,booking.country,booking.flight_no,booking.created,collaborators.name,booking.client_id,booking.client_array,
                                            clients.name as first_name, clients.surname,calendars.reference_id')
                                            ->join('collaborators', 'collaborators.id=booking.collaborator_id', 'left')
                                            ->join('clients', 'clients.id=booking.client_id', 'left')
                                            ->join('collaborators_address', 'collaborators_address.id = booking.collaborator_address_id', 'left')
                                            ->join('calendars', 'calendars.id=booking.calendar_id', 'left')
                                            ->where("booking.is_active = 1 and tbl_booking.collaborator_id ='".$id."' and tbl_booking.round_trip = 0 and DATE(tbl_booking.start_journey) between '".$start_date."' and '".$end_date."'")
                                            ->order_by('booking.created', 'desc')
                                            ->get()->result_array();
		$col_id = $id;
		$this->layout->set(array('path'=>$this->path, 'bcn'=>$this->bcn, 'readonly'=>true, 'user_array'=>$user_array, 'error'=>$error, 'booking_array' => $booking_array, 'address_array'=>$address_array, 'col_id'=>$col_id,
			'start_date' => $start_date,
			'end_date' => $end_date, 
			'collaborator_book_bill' => $this->mdl_charts->get_bookBillByCollaboratorId($start_date, $end_date, $col_id),
			'collaborator_book_count' => $this->mdl_charts->get_bookCountByCollaboratorId($start_date, $end_date, $col_id), 
		));
		$this->layout->buffer('content', 'collaborators/form');
		$this->layout->render();
	}
	public function toggle($id, $bool){
		if ($id){
			$bool = ($bool) ? false : true;
			$this->mdl_collaborators->save($id, array('is_active'=>$bool));
			redirect('admin/collaborators/index');
		}
	}
	public function delete($id) {
		$this->db->where('collaborator_id',$id);
		$this->db->delete('tbl_users');
		$this->mdl_collaborators->delete($id);
		redirect('admin/collaborators');
	}
}
