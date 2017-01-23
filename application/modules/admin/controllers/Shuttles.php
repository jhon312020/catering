<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Shuttles extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('users/mdl_users');
		$this->load->model('users/mdl_clients');
		$this->load->model('shuttles/mdl_shuttles');
		$this->load->model('settings/mdl_settings');
		$this->load->model('collaborators/mdl_collaborators');
		$this->path = $this->mdl_settings->setting('site_url').$this->mdl_settings->setting('upload_folder')."images/fleet/";
		$this->set = array();
		$this->set['countries'] = array('AF'=>'Afghanistan', 'AL'=>'Albania', 'DZ'=>'Algeria', 'AS'=>'American Samoa', 'AD'=>'Andorra', 'AO'=>'Angola', 'AI'=>'Anguilla', 'AQ'=>'Antarctica', 'AG'=>'Antigua And Barbuda', 'AR'=>'Argentina', 'AM'=>'Armenia', 'AW'=>'Aruba', 'AU'=>'Australia', 'AT'=>'Austria', 'AZ'=>'Azerbaijan', 'BS'=>'Bahamas', 'BH'=>'Bahrain', 'BD'=>'Bangladesh', 'BB'=>'Barbados', 'BY'=>'Belarus', 'BE'=>'Belgium', 'BZ'=>'Belize', 'BJ'=>'Benin', 'BM'=>'Bermuda', 'BT'=>'Bhutan', 'BO'=>'Bolivia', 'BA'=>'Bosnia And Herzegovina', 'BW'=>'Botswana', 'BV'=>'Bouvet Island', 'BR'=>'Brazil', 'IO'=>'British Indian Ocean Territory', 'BN'=>'Brunei', 'BG'=>'Bulgaria', 'BF'=>'Burkina Faso', 'BI'=>'Burundi', 'KH'=>'Cambodia', 'CM'=>'Cameroon', 'CA'=>'Canada', 'CV'=>'Cape Verde', 'KY'=>'Cayman Islands', 'CF'=>'Central African Republic', 'TD'=>'Chad', 'CL'=>'Chile', 'CN'=>'China', 'CX'=>'Christmas Island', 'CC'=>'Cocos (Keeling) Islands', 'CO'=>'Columbia', 'KM'=>'Comoros', 'CG'=>'Congo', 'CK'=>'Cook Islands', 'CR'=>'Costa Rica', 'CI'=>'Cote D\'Ivorie (Ivory Coast)', 'HR'=>'Croatia (Hrvatska)', 'CU'=>'Cuba', 'CY'=>'Cyprus', 'CZ'=>'Czech Republic', 'CD'=>'Democratic Republic Of Congo (Zaire)', 'DK'=>'Denmark', 'DJ'=>'Djibouti', 'DM'=>'Dominica', 'DO'=>'Dominican Republic', 'TP'=>'East Timor', 'EC'=>'Ecuador', 'EG'=>'Egypt', 'SV'=>'El Salvador', 'GQ'=>'Equatorial Guinea', 'ER'=>'Eritrea', 'EE'=>'Estonia', 'ET'=>'Ethiopia', 'FK'=>'Falkland Islands (Malvinas)', 'FO'=>'Faroe Islands', 'FJ'=>'Fiji', 'FI'=>'Finland', 'FR'=>'France', 'FX'=>'France, Metropolitan', 'GF'=>'French Guinea', 'PF'=>'French Polynesia', 'TF'=>'French Southern Territories', 'GA'=>'Gabon', 'GM'=>'Gambia', 'GE'=>'Georgia', 'DE'=>'Germany', 'GH'=>'Ghana', 'GI'=>'Gibraltar', 'GR'=>'Greece', 'GL'=>'Greenland', 'GD'=>'Grenada', 'GP'=>'Guadeloupe', 'GU'=>'Guam', 'GT'=>'Guatemala', 'GN'=>'Guinea', 'GW'=>'Guinea-Bissau', 'GY'=>'Guyana', 'HT'=>'Haiti', 'HM'=>'Heard And McDonald Islands', 'HN'=>'Honduras', 'HK'=>'Hong Kong', 'HU'=>'Hungary', 'IS'=>'Iceland', 'IN'=>'India', 'ID'=>'Indonesia', 'IR'=>'Iran', 'IQ'=>'Iraq', 'IE'=>'Ireland', 'IL'=>'Israel', 'IT'=>'Italy', 'JM'=>'Jamaica', 'JP'=>'Japan', 'JO'=>'Jordan', 'KZ'=>'Kazakhstan', 'KE'=>'Kenya', 'KI'=>'Kiribati', 'KW'=>'Kuwait', 'KG'=>'Kyrgyzstan', 'LA'=>'Laos', 'LV'=>'Latvia', 'LB'=>'Lebanon', 'LS'=>'Lesotho', 'LR'=>'Liberia', 'LY'=>'Libya', 'LI'=>'Liechtenstein', 'LT'=>'Lithuania', 'LU'=>'Luxembourg', 'MO'=>'Macau', 'MK'=>'Macedonia', 'MG'=>'Madagascar', 'MW'=>'Malawi', 'MY'=>'Malaysia', 'MV'=>'Maldives', 'ML'=>'Mali', 'MT'=>'Malta', 'MH'=>'Marshall Islands', 'MQ'=>'Martinique', 'MR'=>'Mauritania', 'MU'=>'Mauritius', 'YT'=>'Mayotte', 'MX'=>'Mexico', 'FM'=>'Micronesia', 'MD'=>'Moldova', 'MC'=>'Monaco', 'MN'=>'Mongolia', 'MS'=>'Montserrat', 'MA'=>'Morocco', 'MZ'=>'Mozambique', 'MM'=>'Myanmar (Burma)', 'NA'=>'Namibia', 'NR'=>'Nauru', 'NP'=>'Nepal', 'NL'=>'Netherlands', 'AN'=>'Netherlands Antilles', 'NC'=>'New Caledonia', 'NZ'=>'New Zealand', 'NI'=>'Nicaragua', 'NE'=>'Niger', 'NG'=>'Nigeria', 'NU'=>'Niue', 'NF'=>'Norfolk Island', 'KP'=>'North Korea', 'MP'=>'Northern Mariana Islands', 'NO'=>'Norway', 'OM'=>'Oman', 'PK'=>'Pakistan', 'PW'=>'Palau', 'PA'=>'Panama', 'PG'=>'Papua New Guinea', 'PY'=>'Paraguay', 'PE'=>'Peru', 'PH'=>'Philippines', 'PN'=>'Pitcairn', 'PL'=>'Poland', 'PT'=>'Portugal', 'PR'=>'Puerto Rico', 'QA'=>'Qatar', 'RE'=>'Reunion', 'RO'=>'Romania', 'RU'=>'Russia', 'RW'=>'Rwanda', 'SH'=>'Saint Helena', 'KN'=>'Saint Kitts And Nevis', 'LC'=>'Saint Lucia', 'PM'=>'Saint Pierre And Miquelon', 'VC'=>'Saint Vincent And The Grenadines', 'SM'=>'San Marino', 'ST'=>'Sao Tome And Principe', 'SA'=>'Saudi Arabia', 'SN'=>'Senegal', 'SC'=>'Seychelles', 'SL'=>'Sierra Leone', 'SG'=>'Singapore', 'SK'=>'Slovak Republic', 'SI'=>'Slovenia', 'SB'=>'Solomon Islands', 'SO'=>'Somalia', 'ZA'=>'South Africa', 'GS'=>'South Georgia And South Sandwich Islands', 'KR'=>'South Korea', 'ES'=>'Spain', 'LK'=>'Sri Lanka', 'SD'=>'Sudan', 'SR'=>'Suriname', 'SJ'=>'Svalbard And Jan Mayen', 'SZ'=>'Swaziland', 'SE'=>'Sweden', 'CH'=>'Switzerland', 'SY'=>'Syria', 'TW'=>'Taiwan', 'TJ'=>'Tajikistan', 'TZ'=>'Tanzania', 'TH'=>'Thailand', 'TG'=>'Togo', 'TK'=>'Tokelau', 'TO'=>'Tonga', 'TT'=>'Trinidad And Tobago', 'TN'=>'Tunisia', 'TR'=>'Turkey', 'TM'=>'Turkmenistan', 'TC'=>'Turks And Caicos Islands', 'TV'=>'Tuvalu', 'UG'=>'Uganda', 'UA'=>'Ukraine', 'AE'=>'United Arab Emirates', 'UK'=>'United Kingdom', 'US'=>'United States', 'UM'=>'United States Minor Outlying Islands', 'UY'=>'Uruguay', 'UZ'=>'Uzbekistan', 'VU'=>'Vanuatu', 'VA'=>'Vatican City (Holy See)', 'VE'=>'Venezuela', 'VN'=>'Vietnam', 'VG'=>'Virgin Islands (British)', 'VI'=>'Virgin Islands (US)', 'WF'=>'Wallis And Futuna Islands', 'EH'=>'Western Sahara', 'WS'=>'Western Samoa', 'YE'=>'Yemen', 'YU'=>'Yugoslavia', 'ZM'=>'Zambia', 'ZW'=>'Zimbabwe');
		$this->load->vars($this->set);
		
		$settings_data = $this->db->select('*')->from('settings')->get()->result();
		$this->sett = array();
		foreach ($settings_data as $data) {
			$this->sett[$data->setting_key] = $data->setting_value;
		}
		$this->load->vars($this->sett);

	}

	public function index() {
		$fromDate = '';
		$this->mdl_shuttles->select('booking.bcnarea_address_id,booking.address as book_address,collaborators_address.address as mainaddress,collaborators_address.zone as col_zone,collaborators.phone,booking.book_status,collaborators.name,collaborators.address as col_address,booking.return_book_id,booking.round_trip,booking.created,booking.journey_completed,booking.id,booking.extra_array,booking.collaborator_id,booking.kids,booking.adults,booking.baby,booking.start_from,
											booking.end_at,booking.zone,booking.hour,booking.arrival_time,booking.price,booking.start_journey,booking.return_journey,booking.country,booking.flight_no,booking.created,booking.client_id,booking.client_array,
											clients.name as first_name, clients.surname,clients.address,clients.city,clients.country,clients.cp,calendars.reference_id')
											->join('collaborators', 'collaborators.id=booking.collaborator_id', 'left')
											->join('collaborators_address', 'collaborators_address.id = booking.collaborator_address_id', 'left')
											->join('clients', 'clients.id=booking.client_id', 'left')
											->join('calendars', 'calendars.id=booking.calendar_id', 'left')
											->where('booking.is_active = 1');
											

		if ($this->input->post('from_date')) {
			$fromUnixTime = strtotime(str_replace('/', '-', $this->input->post('from_date')));
			$fromDate = date('d-m-Y', $fromUnixTime);
			$shuttles = $this->mdl_shuttles->where('DATE(tbl_booking.start_journey)', date('Y-m-d', $fromUnixTime))
											->order_by('booking.hour', 'asc')->get()->result();

			$return_id = $this->db->query("select tbl_booking.id, mm.id as return_book_id from tbl_booking inner join (select id from tbl_booking where tbl_booking.is_active = 1 and tbl_booking.start_journey = '".Date('Y-m-d', $fromUnixTime)."' and tbl_booking.round_trip = 1) mm on mm.id = tbl_booking.return_book_id")->result_array();

			array_walk($return_id, function($item) use (&$res) {
			    // flatten the array
			    $res[$item['return_book_id']] = $item['id'];
			});
			//print_r(array_combine($res['id'], $res['hour']));die;
			//echo "<pre>";
			//print_r($res);die;
		} else {
			$shuttles = $this->mdl_shuttles->where("DATE(tbl_booking.start_journey) >= '".date('Y-m-d')."'")
											->order_by('booking.created', 'desc')->get()->result();
			//echo $this->db->last_query();die;
			$return_id = $this->db->query("select tbl_booking.id, mm.id as return_book_id from tbl_booking inner join (select id from tbl_booking where tbl_booking.is_active = 1 and tbl_booking.start_journey >= '".Date('Y-m-d')."' and tbl_booking.round_trip = 1) mm on mm.id = tbl_booking.return_book_id")->result_array();

			array_walk($return_id, function($item) use (&$res) {
			    // flatten the array
			    $res[$item['return_book_id']] = $item['id'];
			});
		}
		
		$extras = $this->db->get('booking_extras')->result_array();									
		
		$this->layout->set(array('shuttles'=>$shuttles, 'path'=>$this->path, 'fromDate'=>$fromDate, 'extras' => $extras, 'res' => $res));
		$this->layout->buffer('content', 'shuttles/index');
		$this->layout->render();
	}
	public function transactionFailed() {
		
		$shuttles = $this->mdl_shuttles->select('booking.bcnarea_address_id,booking.address as book_address,collaborators_address.address as mainaddress,collaborators_address.zone as col_zone,collaborators.phone,booking.book_status,collaborators.name,collaborators.address as col_address,booking.return_book_id,booking.round_trip,booking.created,booking.journey_completed,booking.id,booking.extra_array,booking.collaborator_id,booking.kids,booking.adults,booking.baby,booking.start_from,
											booking.end_at,booking.zone,booking.hour,booking.arrival_time,booking.price,booking.start_journey,booking.return_journey,booking.country,booking.flight_no,booking.created,booking.client_id,booking.client_array,
											clients.name as first_name, clients.surname,clients.address,clients.city,clients.country,clients.cp,calendars.reference_id')
											->join('collaborators', 'collaborators.id=booking.collaborator_id', 'left')
											->join('collaborators_address', 'collaborators_address.id = booking.collaborator_address_id', 'left')
											->join('clients', 'clients.id=booking.client_id', 'left')
											->join('calendars', 'calendars.id=booking.calendar_id', 'left')
											->where("booking.book_status = 'Transaction failed'")->order_by('booking.created', 'desc')->get()->result();;
											

		
		$extras = $this->db->get('booking_extras')->result_array();									
		
		$this->layout->set(array('shuttles'=>$shuttles, 'path'=>$this->path,  'extras' => $extras));
		$this->layout->buffer('content', 'shuttles/status_failed');
		$this->layout->render();
	}

	public function form($id = NULL) {
		if ($this->input->post('btn_cancel')) {
			redirect('admin/shuttles');
		}
		/* // Date Validation for out of range
		if($this->input->post('start_journey')) {
			$fromUnixTime = strtotime($this->input->post('start_journey'));
			$toUnixTime = $this->input->post('return_journey') ? strtotime($this->input->post('return_journey')) : time();
			if ($toUnixTime < $fromUnixTime) {
				$this->session->set_flashdata('alert_error', 'Journey Dates are out of range.');
				redirect('/admin/routes/calendar');
			}
			/*$fromDate = date('d-m-Y', $fromUnixTime);
			$toDate = date('d-m-Y', $toUnixTime);
		}

		if ($this->mdl_shuttles->run_validation() && $this->mdl_clients->run_validation()) {
			$shuttles = array(
				'zone'          => $this->input->post('zone'),
				'start_from'    => $this->input->post('start_from'),
				'end_at'        => $this->input->post('end_at'),
				/*'start_journey' => $this->input->post('start_journey'),
				'return_journey'=> $this->input->post('return_journey'),
				'country'       => $this->input->post('country'),
				'flight_no'     => $this->input->post('flight_no'),
				'hour'          => $this->input->post('hour'),
				'arrival_time'  => $this->input->post('hour'),
				'adults'        => $this->input->post('adults'),
				'kids'          => $this->input->post('kids'),
				/*'baby'          => $this->input->post('baby'),
				'ex_luggage'    => $this->input->post('ex_luggage'),
				'concierge'     => $this->input->post('concierge'),
				'dentist'       => $this->input->post('dentist'),
				'price'         => $this->input->post('price')
			);
			// Client ID is needed
			//$id = $this->mdl_shuttles->save($id, $shuttles);
			redirect('admin/shuttles');
		}
 */
		if ($id and !$this->input->post('btn_submit')) {
			$this->mdl_shuttles->prep_form($id);
		}
		
		$this->db->from('booking')->where('id', $id);
		$res['bookings'] = current($this->db->get()->result_array());
		$res['error'] = array();
		$client_id = $res['bookings']['client_id']?$res['bookings']['client_id']:0;
		$clients = $this->db->where('id', $client_id)->get('clients')->row();
		if($this->input->post('mode') == 'client') {
			unset($_POST['mode']);
			$valid = $this->mdl_clients->run_validation('shuttle_validation_rules');
		/*if($client_id == 0)
			$valid = $this->mdl_clients->run_validation('shuttle_validation_rules_array');
		else
			$valid = $this->mdl_clients->run_validation('shuttle_validation_rules');*/
		
			if ($valid){
				$email_exists = false;
				if($client_id != 0 && $clients->email != $this->input->post('email')){
					$email_exists = $this->mdl_users->user_exists($this->input->post('email'));
				}
				
				if(!$email_exists) {
					if($client_id == 0 || $client_id == null){
						//unset($_POST['password']);
						unset($_POST['fakeusernameremembered']);
						unset($_POST['btn_submit']);
						$data = json_encode($this->input->post());
						$this->db->set(array('client_array'=>$data))->where('id', $id)->update('booking');
						
						//redirect('admin/shuttles/form/'.$id);
						redirect('admin/shuttles/index');
					}
					else{
						$user = array();
						$user['first_name'] = $this->input->post('name');
						$user['last_name'] = $this->input->post('surname');
						$user['email'] = $this->input->post('email');
						//$user['password'] = md5($this->input->post('password'));
						//$user['secret_key'] = base64_encode($this->input->post('password').'_pickngo');
						$clients = $this->input->post();
						//unset($clients['password']);
						unset($clients['fakeusernameremembered']);
						unset($clients['btn_submit']);
						
						$user_array = current($this->db->from('users')->where('client_id',$client_id)->get()->result_array());
						$this->mdl_users->save($user_array['id'], $user);
						$this->mdl_clients->save($client_id,$clients);
						redirect('admin/shuttles/index');
					}
				} else {
					$res['error'][] = lang('exists_username');
				}
			}
		}
		
		$this->db->from('booking')->where('id', $id);
		$res['bookings'] = current($this->db->get()->result_array());
		if ($res['bookings']['return_book_id']) {
			$this->db->from('booking')->where('id', $res['bookings']['return_book_id']);
			$res['return_bookings'] = current($this->db->get()->result_array());
		}
		$arr = array('Barcelona Airport Terminal 1', 'Barcelona Airport Terminal 2');
		
		if (in_array($res['bookings']['start_from'], $arr)) {
			$zone = $res['bookings']['end_at'];
			$str = 'end_at';
		} else {
			$zone = $res['bookings']['start_from'];
			$str = 'start_from';
		}
		/*Address details*/
		$res['bookings']['collaborator_address'] = $this->db->from('collaborators_address')->where('id', $res['bookings']['collaborator_address_id'])->get()->result_array();

		$this->db->from('collaborators')->where('id',$res['bookings']['collaborator_id']);
		$terminal = current($this->db->get()->result_array());
		$res['bookings'][$str] = $terminal['name'].' - '.(count($res['bookings']['collaborator_address']) > 0 ?$res['bookings']['collaborator_address'][0]['address'] : $terminal['address']);
		if($res['bookings']['bcnarea_address_id'] != '' && $res['bookings']['bcnarea_address_id'] != '0') {
			$res['bookings'][$str] = $res['bookings']['address'];
		}
			
		$res['bookings']['collaborator_name'] = $terminal['name'];
		$this->db->from('calendars')->where('id', $res['bookings']['calendar_id']);
		$res['start_journey'] = current($this->db->get()->result_array());
		$client_qry = $this->db->from('clients')->select('name,surname,email,phone,address,cp,country, city,nationality,dni_passport,doc_no')->where('id',$res['bookings']['client_id'])->get();
		if ($client_qry->num_rows())
			$res['clients'] = current($client_qry->result_array());
		else
			$res['clients'] = json_decode($res['bookings']['client_array'], true);


		if ($client_id and !$this->input->post('btn_submit')) {
			$this->mdl_clients->prep_form($client_id);
		}
		$res['book_reference'] = $res['start_journey']['reference_id'].' - '.sprintf("%02d", $res['bookings']['id']);
		
		$this->load->helper('dompdf');	
		$html = $this->load->view('layout/templates/pdf', $res, true);
		$mail_html = $this->load->view('layout/templates/email', $res, true);
		//$output = pdf_create($html, 'booking reference', false);
		$output = pdf_create($html, $res['book_reference'], false);
		$this->load->library('email');
		$this->email->set_mailtype("html");
		$this->email->from($this->sett['site_email'], $this->sett['site_title']);
		/*$cc_array = array('bookings@pickngo.com');
		if($res['bookings']['book_role'] == 2)
			array_push($cc_array, $terminal['email']);*/

		//$this->email->cc($cc_array);
		//$this->email->cc(array('janakiraman@proisc.com', 'xavi@grupovisualiza.com'));
		$this->email->subject('Booking Confirmation: '.$res['book_reference']);
		if($this->input->post('mode') == 'share') {
			$this->email->to(explode(', ', $this->input->post('email_list')));
			$this->email->message($mail_html);
			$this->email->attach($output);
			$this->email->send();
			$this->session->set_flashdata('alert_success', lang('email_send'));
			redirect($_SERVER['HTTP_REFERER']);
		}
		
		$res['user_array'] = current($this->db->from('users')->where('client_id',$client_id)->get()->result_array());
		if($client_id == 0 && !$_POST) {
			$client = current($this->db->select('client_array')->from('booking')->where('id', $id)->get()->result_array());
			$data = json_decode($client['client_array'], true);
			foreach($data as $key=>$value) {
				$this->mdl_clients->form_values[$key] = $value;
			}
		}
		if($client_id !=  0){
			if($this->input->post('password'))
				$this->mdl_clients->form_values['password'] = $this->input->post('password');
			else
				$this->mdl_clients->form_values['password'] = str_replace('_pickngo', '', base64_decode($res['user_array']['secret_key']));
		}
		else
			$this->mdl_clients->form_values['password'] = '';
		
		//$data['res'] = $res;
		$this->layout->set($res);
		$this->layout->buffer('content', 'shuttles/form');
		$this->layout->render();
	}
	public function view($id) {
		$this->db->from('booking')->where('id', $id);
		$res['bookings'] = current($this->db->get()->result_array());
		if ($res['bookings']['return_book_id']) {
			$this->db->from('booking')->where('id', $res['bookings']['return_book_id']);
			$res['return_bookings'] = current($this->db->get()->result_array());
		}
		$res['error'] = array();
		$arr = array('Barcelona Airport Terminal 1', 'Barcelona Airport Terminal 2');
		
		if (in_array($res['bookings']['start_from'], $arr)) {
			$zone = $res['bookings']['end_at'];
			$str = 'end_at';
		} else {
			$zone = $res['bookings']['start_from'];
			$str = 'start_from';
		}
		/*Address details*/
		$res['bookings']['collaborator_address'] = $this->db->from('collaborators_address')->where('id', $res['bookings']['collaborator_address_id'])->get()->result_array();
		//echo $res['bookings']['address'];
		//print_r($res['bookings']['collaborator_address']);die;
		$this->db->from('collaborators')->where('id',$res['bookings']['collaborator_id']);
		$terminal = current($this->db->get()->result_array());
		$res['bookings'][$str] = $terminal['name'].' - '.(count($res['bookings']['collaborator_address']) > 0 ?$res['bookings']['collaborator_address'][0]['address'] : $terminal['address']);
		if($res['bookings']['bcnarea_address_id'] != '' && $res['bookings']['bcnarea_address_id'] != '0') {
			$res['bookings'][$str] = $res['bookings']['address'];
		}
		
		$res['bookings']['collaborator_name'] = $terminal['name'];
		$this->db->from('calendars')->where('id', $res['bookings']['calendar_id']);
		$res['start_journey'] = current($this->db->get()->result_array());
		$client_qry = $this->db->from('clients')->select('name,surname,email,phone,address,cp,country, city,nationality,dni_passport,doc_no')->where('id',$res['bookings']['client_id'])->get();
		
		$res['book_reference'] = $res['start_journey']['reference_id'].' - '.sprintf("%02d", $res['bookings']['id']);
		if ($client_qry->num_rows())
			$res['clients'] = current($client_qry->result_array());
		else
			$res['clients'] = json_decode($res['bookings']['client_array'], true);
		
		$res['edit'] = false;

		$this->layout->set($res);
		$this->layout->buffer('content', 'shuttles/form');
		$this->layout->render();
	}
	public function delete($id) {
		$this->db->from('booking')->where('id', $id);
		$bookings = current($this->db->get()->result_array());
		$this->db->set(array('is_active'=>0))->where('book_id', $id)->update('seats');
		if ($bookings['return_book_id'] > 0) {
			$this->db->from('booking')->where('id', $bookings['return_book_id']);
			$res['return_bookings'] = current($this->db->get()->result_array());
			
			$this->db->set(array('updated_by' =>'shuttle delete', 'is_active'=>0))->where('id', $bookings['return_book_id'])->update('booking');
			$this->db->set(array('is_active'=>0))->where('book_id', $bookings['return_book_id'])->update('seats');
		}
		$this->db->set(array('updated_by' =>'shuttle delete', 'is_active'=>0))->where('id', $id)->update('booking');
		//$this->mdl_shuttles->delete($id);
		redirect('admin/shuttles');
	}
	public function updateTransaction($id) {
		$this->db->from('booking')->where('id', $id);
		$bookings = current($this->db->get()->result_array());
		$this->db->set(array('is_active'=>1))->where('book_id', $id)->update('seats');
		if ($bookings['return_book_id'] > 0) {
			$this->db->from('booking')->where('id', $bookings['return_book_id']);
			$res['return_bookings'] = current($this->db->get()->result_array());
			
			$this->db->set(array('is_active'=>1,'book_status'=>'completed'))->where('id', $bookings['return_book_id'])->update('booking');
			$this->db->set(array('is_active'=>1))->where('book_id', $bookings['return_book_id'])->update('seats');
		}
		$this->db->set(array('is_active'=>1,'book_status'=>'completed'))->where('id', $id)->update('booking');
		//$this->mdl_shuttles->delete($id);
		redirect('admin/shuttles/transactionFailed');
	}
	/**
	 * Function getPlaces()
	 * Used for AJAX request to get the list of hotes and terminals
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getPlaces($selected = null, $isEnableCity = true) {
		$results = array();
		switch($selected){
			case 'city':
				$results = $this->db->query("select CONCAT(col.name,' - ',col.address) as label,CONCAT(col.name,' - ',col.address) as value,col.zone,col.id, 0 as collaborator_address_id  from tbl_collaborators col where col.id not in (select collaborator_id from tbl_collaborators_address) and CONCAT(col.name,' - ',col.address) like '%".$this->input->get('term')."%' and col.is_active=1 union select CONCAT(col.name,' - ',coladd.address) as label,CONCAT(col.name,' - ',coladd.address) as value,coladd.zone,col.id, coladd.id as collaborator_address_id from tbl_collaborators_address coladd left join tbl_collaborators col on coladd.collaborator_id = col.id where  CONCAT(col.name,' - ',coladd.address) like '%".$this->input->get('term')."%' and col.is_active=1")->result_array();

				/*$this->mdl_collaborators->select('name as label,name as value,zone,id');
				$this->mdl_collaborators->where('is_active', 1);
				$this->mdl_collaborators->like('name', $this->input->get('term'));
				$results = $this->mdl_collaborators->get()->result_array();*/
				/*if ($isEnableCity){
					$results = array_merge($results, array(
						array('label' => 'BARCELONA CITY END', 'value' => 'BARCELONA CITY END', 'zone' => '4.0', 'id'=>'000')
					));
				}*/
			break;
			case 'airport':
				$results[0]['name'] = 'Barcelona Airport Terminal 1';
				$results[1]['name'] = 'Barcelona Airport Terminal 2';
			break;
		}
		echo json_encode($results);
	}
}
?>
