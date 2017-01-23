<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Node extends Anonymous_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('node/mdl_nodes');
    $this->load->model('routes/mdl_calendars');
    $this->load->model('routes/mdl_routes');
    $this->load->model('users/mdl_users');
    $this->load->model('shuttles/mdl_shuttles');
        $this->load->model('routes/mdl_bcnareas');
    $this->load->library('user_agent');
    $this->load->model('booking_extras/mdl_booking_extras');
    if (isset($_SESSION['screen_width'])) {
      log_message("debug", 'User resolution: ' . $_SESSION['screen_width']);
    } else if (isset($_REQUEST['width']) AND isset($_REQUEST['height'])) {
      $_SESSION['screen_width'] = $_REQUEST['width'];
      $_SESSION['screen_height'] = $_REQUEST['height'];
      header('Location: ' . $_SERVER['PHP_SELF']);
    } 
    $this->load->model('collaborators/mdl_collaborators');
    // Registration Popup
    $data = array();
        $data['countries'] = array(''=>'Select country', 'AF'=>'Afghanistan', 'AL'=>'Albania', 'DZ'=>'Algeria', 'AS'=>'American Samoa', 'AD'=>'Andorra', 'AO'=>'Angola', 'AI'=>'Anguilla', 'AQ'=>'Antarctica', 'AG'=>'Antigua And Barbuda', 'AR'=>'Argentina', 'AM'=>'Armenia', 'AW'=>'Aruba', 'AU'=>'Australia', 'AT'=>'Austria', 'AZ'=>'Azerbaijan', 'BS'=>'Bahamas', 'BH'=>'Bahrain', 'BD'=>'Bangladesh', 'BB'=>'Barbados', 'BY'=>'Belarus', 'BE'=>'Belgium', 'BZ'=>'Belize', 'BJ'=>'Benin', 'BM'=>'Bermuda', 'BT'=>'Bhutan', 'BO'=>'Bolivia', 'BA'=>'Bosnia And Herzegovina', 'BW'=>'Botswana', 'BV'=>'Bouvet Island', 'BR'=>'Brazil', 'IO'=>'British Indian Ocean Territory', 'BN'=>'Brunei', 'BG'=>'Bulgaria', 'BF'=>'Burkina Faso', 'BI'=>'Burundi', 'KH'=>'Cambodia', 'CM'=>'Cameroon', 'CA'=>'Canada', 'CV'=>'Cape Verde', 'KY'=>'Cayman Islands', 'CF'=>'Central African Republic', 'TD'=>'Chad', 'CL'=>'Chile', 'CN'=>'China', 'CX'=>'Christmas Island', 'CC'=>'Cocos (Keeling) Islands', 'CO'=>'Columbia', 'KM'=>'Comoros', 'CG'=>'Congo', 'CK'=>'Cook Islands', 'CR'=>'Costa Rica', 'CI'=>'Cote D\'Ivorie (Ivory Coast)', 'HR'=>'Croatia (Hrvatska)', 'CU'=>'Cuba', 'CY'=>'Cyprus', 'CZ'=>'Czech Republic', 'CD'=>'Democratic Republic Of Congo (Zaire)', 'DK'=>'Denmark', 'DJ'=>'Djibouti', 'DM'=>'Dominica', 'DO'=>'Dominican Republic', 'TP'=>'East Timor', 'EC'=>'Ecuador', 'EG'=>'Egypt', 'SV'=>'El Salvador', 'GQ'=>'Equatorial Guinea', 'ER'=>'Eritrea', 'EE'=>'Estonia', 'ET'=>'Ethiopia', 'FK'=>'Falkland Islands (Malvinas)', 'FO'=>'Faroe Islands', 'FJ'=>'Fiji', 'FI'=>'Finland', 'FR'=>'France', 'FX'=>'France, Metropolitan', 'GF'=>'French Guinea', 'PF'=>'French Polynesia', 'TF'=>'French Southern Territories', 'GA'=>'Gabon', 'GM'=>'Gambia', 'GE'=>'Georgia', 'DE'=>'Germany', 'GH'=>'Ghana', 'GI'=>'Gibraltar', 'GR'=>'Greece', 'GL'=>'Greenland', 'GD'=>'Grenada', 'GP'=>'Guadeloupe', 'GU'=>'Guam', 'GT'=>'Guatemala', 'GN'=>'Guinea', 'GW'=>'Guinea-Bissau', 'GY'=>'Guyana', 'HT'=>'Haiti', 'HM'=>'Heard And McDonald Islands', 'HN'=>'Honduras', 'HK'=>'Hong Kong', 'HU'=>'Hungary', 'IS'=>'Iceland', 'IN'=>'India', 'ID'=>'Indonesia', 'IR'=>'Iran', 'IQ'=>'Iraq', 'IE'=>'Ireland', 'IL'=>'Israel', 'IT'=>'Italy', 'JM'=>'Jamaica', 'JP'=>'Japan', 'JO'=>'Jordan', 'KZ'=>'Kazakhstan', 'KE'=>'Kenya', 'KI'=>'Kiribati', 'KW'=>'Kuwait', 'KG'=>'Kyrgyzstan', 'LA'=>'Laos', 'LV'=>'Latvia', 'LB'=>'Lebanon', 'LS'=>'Lesotho', 'LR'=>'Liberia', 'LY'=>'Libya', 'LI'=>'Liechtenstein', 'LT'=>'Lithuania', 'LU'=>'Luxembourg', 'MO'=>'Macau', 'MK'=>'Macedonia', 'MG'=>'Madagascar', 'MW'=>'Malawi', 'MY'=>'Malaysia', 'MV'=>'Maldives', 'ML'=>'Mali', 'MT'=>'Malta', 'MH'=>'Marshall Islands', 'MQ'=>'Martinique', 'MR'=>'Mauritania', 'MU'=>'Mauritius', 'YT'=>'Mayotte', 'MX'=>'Mexico', 'FM'=>'Micronesia', 'MD'=>'Moldova', 'MC'=>'Monaco', 'MN'=>'Mongolia', 'MS'=>'Montserrat', 'MA'=>'Morocco', 'MZ'=>'Mozambique', 'MM'=>'Myanmar (Burma)', 'NA'=>'Namibia', 'NR'=>'Nauru', 'NP'=>'Nepal', 'NL'=>'Netherlands', 'AN'=>'Netherlands Antilles', 'NC'=>'New Caledonia', 'NZ'=>'New Zealand', 'NI'=>'Nicaragua', 'NE'=>'Niger', 'NG'=>'Nigeria', 'NU'=>'Niue', 'NF'=>'Norfolk Island', 'KP'=>'North Korea', 'MP'=>'Northern Mariana Islands', 'NO'=>'Norway', 'OM'=>'Oman', 'PK'=>'Pakistan', 'PW'=>'Palau', 'PA'=>'Panama', 'PG'=>'Papua New Guinea', 'PY'=>'Paraguay', 'PE'=>'Peru', 'PH'=>'Philippines', 'PN'=>'Pitcairn', 'PL'=>'Poland', 'PT'=>'Portugal', 'PR'=>'Puerto Rico', 'QA'=>'Qatar', 'RE'=>'Reunion', 'RO'=>'Romania', 'RU'=>'Russia', 'RW'=>'Rwanda', 'SH'=>'Saint Helena', 'KN'=>'Saint Kitts And Nevis', 'LC'=>'Saint Lucia', 'PM'=>'Saint Pierre And Miquelon', 'VC'=>'Saint Vincent And The Grenadines', 'SM'=>'San Marino', 'ST'=>'Sao Tome And Principe', 'SA'=>'Saudi Arabia', 'SN'=>'Senegal', 'SC'=>'Seychelles', 'SL'=>'Sierra Leone', 'SG'=>'Singapore', 'SK'=>'Slovak Republic', 'SI'=>'Slovenia', 'SB'=>'Solomon Islands', 'SO'=>'Somalia', 'ZA'=>'South Africa', 'GS'=>'South Georgia And South Sandwich Islands', 'KR'=>'South Korea', 'ES'=>'Spain', 'LK'=>'Sri Lanka', 'SD'=>'Sudan', 'SR'=>'Suriname', 'SJ'=>'Svalbard And Jan Mayen', 'SZ'=>'Swaziland', 'SE'=>'Sweden', 'CH'=>'Switzerland', 'SY'=>'Syria', 'TW'=>'Taiwan', 'TJ'=>'Tajikistan', 'TZ'=>'Tanzania', 'TH'=>'Thailand', 'TG'=>'Togo', 'TK'=>'Tokelau', 'TO'=>'Tonga', 'TT'=>'Trinidad And Tobago', 'TN'=>'Tunisia', 'TR'=>'Turkey', 'TM'=>'Turkmenistan', 'TC'=>'Turks And Caicos Islands', 'TV'=>'Tuvalu', 'UG'=>'Uganda', 'UA'=>'Ukraine', 'AE'=>'United Arab Emirates', 'UK'=>'United Kingdom', 'US'=>'United States', 'UM'=>'United States Minor Outlying Islands', 'UY'=>'Uruguay', 'UZ'=>'Uzbekistan', 'VU'=>'Vanuatu', 'VA'=>'Vatican City (Holy See)', 'VE'=>'Venezuela', 'VN'=>'Vietnam', 'VG'=>'Virgin Islands (British)', 'VI'=>'Virgin Islands (US)', 'WF'=>'Wallis And Futuna Islands', 'EH'=>'Western Sahara', 'WS'=>'Western Samoa', 'YE'=>'Yemen', 'YU'=>'Yugoslavia', 'ZM'=>'Zambia', 'ZW'=>'Zimbabwe');
    
    $data['start_from'] = array(''=>lang('from'), 'city'=>'Barcelona City', 'airport'=>'Barcelona Airport');
    $data['airport'] = array(''=>'Select', 't1'=>'Terminal 1', 't2'=>'Terminal 2');
    $prepend = array('00', '01','02','03','04','05','06','07','08','09');
    $data['hours'] = array_merge($prepend, range(10, 23));
    $data['adults'] = array_merge($prepend, range(10, 12));
    $data['kids'] = array_slice($prepend, 0, 7);
    $data['babies'] = array('00', '01','02','03','04','05');
    $data['minutes'] = array('00'=>'00','05'=>'05') + array_combine(range(10, 55, 5), range(10, 55, 5));
    $this->load->vars($data);
    $settings_data = $this->db->select('*')->from('settings')->get()->result();
    $this->set = array();
    foreach ($settings_data as $data) {
      $this->set[$data->setting_key] = $data->setting_value;
    }
    $this->load->vars($this->set);
    $this->details = array();
    $this->details['collaborator_details'] = array();
    $this->details['collaborator_address'] = array();
    if ($this->session->userdata('user_name') && $this->session->userdata('user_type') == 2) {
      $qry = $this->db->select('collaborators.address,collaborators.id,collaborators.name,collaborators.zone, collaborators.no_of_available_seats,collaborators.available_seats,collaborators.payment_methods,collaborators.price')->from('users')->where(array('users.id'=>$this->session->userdata('user_id')))
              ->join('collaborators', 'collaborators.id=users.collaborator_id', 'left');
      $this->details['collaborator_details'] = current($qry->get()->result_array());
      $this->details['collaborator_address'] = $this->db->query("select CONCAT(col.name,' - ',coladd.address) as label,CONCAT(col.name,' - ',coladd.address) as value,coladd.zone,col.id, coladd.id as collaborator_address_id from tbl_collaborators_address coladd left join tbl_collaborators col on coladd.collaborator_id = col.id where col.id = ".$this->details['collaborator_details']['id']." and coladd.is_active=1")->result_array();     
    }
    $this->load->vars($this->details);
    if ($this->session->userdata('user_name') && $this->session->userdata('user_type') == 5) {
      $qry = $this->db->select('cars.id,cars.car_name')->from('users')->where(array('users.id'=>$this->session->userdata('user_id')))
              ->join('cars', 'cars.id=users.car_id', 'left');
      $this->details['car_details'] = current($qry->get()->result_array());
      $this->load->vars($this->details);
    }
  }

  public function index($lang = 'es') {
    $this->display_home($lang);
  }

  public function loaddata_en($page) {
    
    switch(trim($page)) {
      case 'home': $this->display_home("en");
        break;
      case 'projects': $this->display_projects("en");
        break;
      case 'news': $this->display_news("en");
        break;
      case 'study': $this->display_study("en");
        break;
      case 'team': $this->display_team("en");
        break;
      case 'publications': $this->display_publications("en");
        break;
      case 'contacts': $this->display_contacts("en");
        break;
      default: show_404();
    }
  }
  
  public function loaddata_es($page) {
    switch (trim($page)) {
      case 'home': $this->display_home("es");
        break;
      case 'projects': $this->display_projects("es");
        break;
      case 'news': $this->display_news("es");
        break;
      case 'study': $this->display_study("es");
        break;
      case 'team': $this->display_team("es");
        break;
      case 'publications': $this->display_publications("es");
        break;
      case 'contacts': $this->display_contacts("es");
        break;
      default: show_404();
    }
  }
  
  public function loaddata_ca($page) {
    switch (trim($page)) {
      case 'home': $this->display_home("ca"); 
        break;
      case 'projects': $this->display_projects("ca"); 
        break;
      case 'news': $this->display_news("ca");
        break;
      case 'study': $this->display_study("ca");
        break;
      case 'team': $this->display_team("ca");
        break;
      case 'publications': $this->display_publications("ca");
        break;
      case 'contacts': $this->display_contacts("ca");
        break;
      default: show_404();
    }
  }
  
  public function display_home($lang) {
    $res = array();
    $ln = $this->uri->segment(1);
    if ($ln == '')
      redirect("en");
    
    $res['data'] = $this->mdl_nodes->fetchAllSliders();
    $res['banner'] = $this->mdl_nodes->fetchBannerLast();
    $res['boxes'] = $this->mdl_nodes->fetchAllBoxes();
    $this->load->view('layout/templates/home', $res);
  }

  public function partners() {
    $bottom_data = $this->db->select('*')->from('partners')->get()->result();
    $top_data = $this->db->select('*')->from('captions')->where(array('type' => 'partners'))->get()->result();
    $data_array = array(
      'top_data'=>$top_data,
      'bottom_data'=>$bottom_data,
    );
    $this->load->view('layout/templates/partners', $data_array);
  }
  
  public function faq() {
    $bottom_data = $this->db->select('*')->from('faqs')->order_by('category')->get()->result();
    $top_data = $this->db->select('*')->from('captions')->where(array('type' => 'faq'))->get()->result();
    $data_array = array(
      'top_data'=>$top_data,
      'bottom_data'=>$bottom_data,
    );
    $this->load->view('layout/templates/faq', $data_array);
  }
  
  public function franquicias() {
    $bottom_data = $this->db->select('*')->from('captions')->where(array('type' => 'franchises'))->get()->result();
    $data_array = array(
      'bottom_data'=>$bottom_data,
    );
    if ($this->input->post()) {
      $this->load->library('email');
      $subject  = 'More info about user';
      $message  = 'Hi <b></b>,<br/><br/>';
      $message .= '<p>The detailed information is given below</p><br><br>
              <table><tbody>';
      foreach ($this->input->post() as $key=>$value) {
        $message .= '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
      }
      $message .= '</tbody></table>';
      $this->email->set_mailtype("html");
      $this->email->from($this->input->post('Mail'), 'More info');
      $this->email->to($this->set['site_email']); 
      $this->email->subject($subject);
      $this->email->message($message);
      $this->email->send();
    }
    $this->load->view('layout/templates/franquicias', $data_array);
  }
  
  public function concierge() {
    $bottom_data = $this->db->select('*')->from('captions')->where(array('type' => 'concierge'))->get()->result();
    $data_array = array(
      'bottom_data'=>$bottom_data,
    );
    $this->load->view('layout/templates/concierge', $data_array);
  }
  
  public function aboutus() {
    $bottom_data = $this->db->select('*')->from('captions')->where(array('type' => 'aboutus'))->get()->result();
    $data_array = array(
      'bottom_data'=>$bottom_data,
    );
    $this->load->view('layout/templates/aboutus', $data_array);
  }
  
  public function mobile_booking() {
    $this->load->view('layout/templates/mobile_booking');
  }
  
  public function collaborators_login() {
    $error='';
    if ($this->session->userdata('user_name'))
      redirect($this->uri->segment(1));
    if ($this->mdl_users->run_validation('validation_rules_collaborators_login')) {
      $data = $this->mdl_users->check_collaborators($this->input->post());
      if ($data) {
        redirect($this->uri->segment(1));
      } else {
        //$this->session->set_flashdata('alert_error', lang('invalid_credentials'));
        redirect($this->uri->uri_string());
      }
    }
    $this->load->view('layout/templates/collaborators_login', $error);
  }
  public function drivers_login() {
    $error='';
    if ($this->session->userdata('user_name') && $this->session->userdata('user_type') == 5)
      redirect($this->uri->segment(1).'/route_details');
    else if ($this->session->userdata('user_name') && $this->session->userdata('user_type') == 2)
      redirect($this->uri->segment(1));

    if ($this->mdl_users->run_validation('validation_rules_collaborators_login')) {
      $data = $this->mdl_users->check_drivers($this->input->post());
      if ($data) {
        redirect($this->uri->segment(1).'/route_details');
      } else {
        $this->session->set_flashdata('alert_error', lang('invalid_credentials'));
        redirect($this->uri->uri_string());
      }
    }
    $this->load->view('layout/templates/drivers_login', $error);
  }
  public function update_journey() {
    $id = $this->uri->segment(3);
    $this->db->set(array('journey_completed'=>1))->where('id', $id)->update('booking');
    redirect($this->agent->referrer());
  }
  public function calendar_details() {
    $id = $this->uri->segment(3);
    $routes = $this->mdl_routes->where('car',$this->details['car_details']['id'])->get()->result_array();
        $rid = array();
        foreach($routes as $route) {
          array_push($rid, $route['id']);
        }
  
    $cal_data = $this->db->select('booking.id,calendars.route_id,calendars.seats')->from('booking')->where('booking.id', $id)
              ->join('calendars', 'calendars.id=booking.calendar_id', 'left')->get()->row();

    if ($this->session->userdata('user_name') && $this->session->userdata('user_type') == 5 && in_array($cal_data->route_id, $rid)) {
      $book_id = $this->uri->segment(3);
          $check_round = $this->db->from('booking')->where('return_book_id', $book_id)->get();
      if($check_round->num_rows == 0) {
            $this->db->from('booking')->where('id', $book_id);
        $res['bookings'] = current($this->db->get()->result_array());
      } else {
        $book_data = $check_round->row();
        $this->db->from('booking')->where('id', $book_data->id);
        $res['bookings'] = current($this->db->get()->result_array());
      }
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
      
      $res['book_reference'] = $res['start_journey']['reference_id'].' - '.sprintf("%02d", $res['bookings']['id']);
        $this->load->view('layout/templates/calendar_details', $res);
        } else {
      redirect($this->uri->segment(1).'/carchannel');
    }
  }
  public function route_details() {
    if ($this->session->userdata('user_name') && $this->session->userdata('user_type') == 5) {
            $routes = $this->mdl_routes->where('car',$this->details['car_details']['id'])->get()->result_array();

            $bcn = $this->mdl_bcnareas->get()->result_array();
            $bcn_array = array();
            foreach($bcn as $b) {
              $bcn_array[$b['zone']] = $b['name'];
            }
            $rid = array();           
            foreach($routes as $route) {
              array_push($rid, $route['id']);
            }
            if(count($rid) == 0) {
          $rid = array(0);
        }
          $booking_array = $this->mdl_shuttles->select('booking.bcnarea_address_id,booking.address as book_address,collaborators.address,collaborators_address.address as mainaddress,collaborators_address.zone as col_zone,booking.round_trip,booking.price,booking.book_status,booking.payment_method,booking.journey_completed,booking.id,booking.extra_array,booking.collaborator_id,booking.kids,booking.adults,booking.baby,booking.start_from,
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
                    //echo $this->db->last_query();die;
        $return_id = $this->db->query("select tbl_booking.id, mm.id as return_book_id 
                      from tbl_booking 
                      inner join (select tbl_booking.id from tbl_booking 
                            left join tbl_calendars on tbl_calendars.id = tbl_booking.calendar_id
                            where tbl_booking.is_active = 1 and tbl_calendars.route_id in (".implode(',', $rid).") and tbl_booking.start_journey = '".Date('Y-m-d')."' and tbl_booking.round_trip = 1) mm
                      on mm.id = tbl_booking.return_book_id")->result_array();
        //echo "<pre>";
        //print_r($return_id);die;
        $res = array();
        array_walk($return_id, function($item) use (&$res) {
            // flatten the array
            $res[$item['return_book_id']] = $item['id'];
        });
        
            $data_array = array('routes' => $routes, 'bcn' => $bcn, 'bcn_array' => $bcn_array, 'booking_array'=> $booking_array, 'res'=>$res);
        $this->load->view('layout/templates/route_details', $data_array);

    } else {
      redirect($this->uri->segment(1).'/carchannel');
    }
  }
  
  public function change_password($route) {
    $type = $this->uri->segment(3);
    if ($type != 'clients' && $type != 'collaborators' && $type != 'drivers')
      redirect($this->uri->segment(1));
    
    $record_num = end($this->uri->segment_array());
    $error = '';
    $decodedString = base64_decode($record_num);
    if (strpos($decodedString, '_') !== false) {
      $currentTime = date('Y-m-d H:i:s');
      list($userEmail, $requestedTime) = explode('_', $decodedString);
      if (strtotime($currentTime) > strtotime($requestedTime)) {
        redirect($this->uri->segment(1));
      }
      else{
        $_POST['type'] = $type;
        $verifiedUser = current($this->mdl_users->findByEmail($userEmail, $type));
        if (!$verifiedUser)
          redirect($this->uri->segment(1));
        if ($this->input->post('password')) {
          if ($this->mdl_users->run_validation('validation_rules_change_password')) {
            $this->mdl_users->save_change_password($verifiedUser['id'], $this->input->post('password'));
            $this->mdl_users->check_collaborators(array('username'=>$userEmail, 'password'=>$this->input->post('password')));
            $this->load->library('email');
            $subject = 'Password Reset Confirmation';
            $message  = 'Hello ' . $verifiedUser['first_name'] .' <br/><br/>';
            $message .= ' This is to confirm that login password for your account has been successfully changed. <br/><br/>';
            $message .= 'For security reasons, we do not send any account information to your email address. For any support related issues, please email us and one of our customer care executive will get back to you as early as possible. <br/><br/> ';
            $this->email->set_mailtype("html");
            $this->email->from($this->set['site_email'], 'Change password');
            $this->email->to($userEmail); 
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
            redirect($this->uri->segment(1));
          }
        }
      }
    }
    else{
      redirect($this->uri->segment(1));
    }
    $this->load->view('layout/templates/change_password', $error);
  }
  
  public function recovery_password() {
    $error='';
    $type = $this->uri->segment(3);
    if ($type != 'clients' && $type != 'collaborators' && $type != 'drivers')
      redirect($this->uri->segment(1));
      if ($this->mdl_users->run_validation('validation_rules_password_recovery')) {
        $this->load->library('email');
        $_POST['type'] = $type;
        $data = $this->mdl_users->password_recovery($this->input->post());
        if ($data) {
          $subject  = 'Change Password';
          $message  = 'Hi <b>' . ucfirst($data['first_name']) . '</b>,<br/><br/>';
          $message .= 'To change your current password <a href = "' . $data['url'] . '">click here</a>.<br/><br/>';
          $message .= 'If your not able click on it, kindly copy the below link<br/>' . $data['url'] . '<br/> and paste it on the new tab.<br/><br/>';
          $message .= 'For your information the above links will be valid for only 1 hour.';
          $this->email->set_mailtype("html");
          $this->email->from($this->set['site_email'], 'Recovery password');
          $this->email->to($data['email']); 
          $this->email->subject($subject);
          $this->email->message($message);
          $this->email->send();
        } else {
          $this->session->set_flashdata('alert_error', lang('invalid_username'));
          redirect($this->uri->uri_string());
        }
      }
    $this->load->view('layout/templates/recovery_password', $error);
  }
  
  public function collaborators_logout() {
    $this->session->sess_destroy();
    redirect($this->uri->segment(1)."/collaborators_login");
    if($this->uri->segment(3) == 2)
      redirect($this->uri->segment(1)."/collaborators_login");
    else
      redirect($this->uri->segment(1)."/drivers_login");
  }
  public function drivers_logout() {
    $this->session->sess_destroy();
    redirect($this->uri->segment(1)."/carchannel");   
  }
  
  public function contacts($lang = 'es') {
    $this->load->model('node/mdl_contact');
    if ($this->mdl_contact->run_validation()) {
      log_message("debug", "%%%%%%%% FROM NODE CONTACT");
      $node= array(
        'name'    =>$this->input->post('name'),
        'email'   =>$this->input->post('email'),
        'description'   =>$this->input->post('description'),
      );
      $this->mdl_contact->save(NULL, $node);
      $this->load->library('email');
      $this->email->from($this->input->post('email'), $this->input->post('name'));
      $this->email->to($this->set['site_email']); 
      $this->email->subject('Enquiry');
      $this->email->message($this->input->post('description'));
      $this->email->send();
    } else 
      log_message("debug", "%%%%%%%% FROM NODE CONTACT ELSE");
    $top_data = $this->db->select('*')->from('captions')->where(array('type' => 'contacts'))->get()->result();
    $bottom_data = $this->db->select('*')->from('contacts')->get()->result();
    $data_array = array(
      'lang'=>$lang,
      'top_data'=>$top_data,
      'bottom_data'=>$bottom_data,
    );
    $this->load->view('layout/templates/contacts', $data_array);
  }
  public function terms() {
    $bottom_data = $this->db->select('*')->from('captions')->where(array('type' => 'terms_and_conditions'))->get()->result();
    $data_array = array(
      'bottom_data'=>$bottom_data,
    );
    $this->load->view('layout/templates/terms', $data_array);
  }
  
  public function email() {
    $this->load->view('layout/templates/email');
  }
  public function pdf() {
    $this->load->helper('dompdf');
    $data =array();
    $this->load->view('layout/templates/pdf');
  }
  
  public function reserva01() {
    if (!$this->input->post())
      redirect($this->uri->segment(1));
    $this->load->model('routes/mdl_routes');
    $this->load->model('booking_extras/mdl_booking_extras');
    $res['booking'] = $this->mdl_booking_extras->where('is_active', 1)->get()->result_array();
    $res['result'] = $this->mdl_routes->getcar($this->input->post(), $this->details);
    if (!$res['result']) {
      $link = explode('/', $this->agent->referrer());
      if (end($link) == 'reserva01')
        redirect($this->uri->segment(1));
      else
        redirect($this->agent->referrer());
    }
    $this->load->view('layout/templates/reserva01', $res);
  }
  public function success() {
        $transaction_details = array();
        // Checking the paypal token and PayerID on calling the setExpressCheckout
        if ($this->input->get('token') && $this->input->get('PayerID')) {
            include_once(APPPATH . "modules/layout/views/templates/config.php");
            include_once(APPPATH . "modules/layout/views/templates/functions.php");
            include_once(APPPATH . "modules/layout/views/templates/paypal.class.php");
            $paypal= new MyPayPal();
            // On receiving the paypal token and payer calling DoExpressCheckout
            $payerId = $this->input->get('PayerID');
            $do_express_api_response = $paypal->DoExpressCheckoutPayment();
            $transaction_details = $paypal->GetTransactionDetails();
            $book_id = $transaction_details['CUSTOM'];
      if($book_id != '' && is_numeric($book_id)) {
        $book_data = $this->db->from('booking')->where('id', $book_id)->get()->row();
        if($book_data->book_status != 'pending') {
          redirect($this->uri->segment(1));
        }
      } else {
        redirect($this->uri->segment(1));
      }
            if ($do_express_api_response['transaction']) {
                $this->db->set(array('is_active'=>1, 'paypal_token_id'=>$transaction_details['TOKEN'], 'paypal_payer_id'=>$payerId, 'paypal_transaction_response'=>json_encode($do_express_api_response['response'])))->where('id', $book_id)->update('booking');
            } else {
                $this->db->set(array('updated_by' =>'success', 'is_active'=>0, 'book_status'=>'Transaction failed', 'paypal_token_id'=>$transaction_details['TOKEN'], 'paypal_payer_id'=>$payerId, 'paypal_transaction_response'=>json_encode($transaction_details)))->where('id', $book_id)->update('booking');
        
        $this->load->library('email');
        //$this->email->set_mailtype("html");
        $this->email->from($this->set['site_email'], $this->set['site_title']);
        $this->email->to('bright@proisc.com');
        $this->email->subject('Booking Confirmation: '.$book_id.' has been Transaction failed');
        $this->email->message('Transaction failed');
        $this->email->send();
                $this->session->set_flashdata('alert_error', lang('transaction_failed'));
                redirect($this->uri->segment(1));
            }
        } else if ($this->input->get('cm')) {
            $book_id = $this->input->get('cm');
        } else {
            $this->session->set_flashdata('alert_error', lang('transaction_failed'));
            redirect($this->uri->segment(1));
        }
    if($book_id != '' && is_numeric($book_id)) {
      $book_data = $this->db->from('booking')->where('id', $book_id)->get()->row();
      if($book_data->book_status != 'pending') {
        redirect($this->uri->segment(1));
      }
      if((float)$book_data->passenger_price == 0) {
        $this->session->set_flashdata('alert_error', 'Something went wrong');
        redirect($this->uri->segment(1).'/reservation');
      }
      if((float)$book_data->price == 0 && $book_data->promotional_code_id == null) {
        $this->session->set_flashdata('alert_error', 'Something went wrong');
        redirect($this->uri->segment(1).'/reservation');
      }
      /*Test bank payment start*/
      /*if($book_data->payment_method == 'bank') {
        $this->session->set_flashdata('alert_error', 'This is the test payment for bank');
        redirect($this->uri->segment(1));
      }*/
      /*Test bank payment end*/
    } else {
      redirect($this->uri->segment(1));
    }
        /*update payment status*/       
        //$this->db->set(array('is_active'=>1))->where('book_id', $book_id)->update('seats');
        $this->db->from('booking')->where('id', $book_id);
        $bookings = current($this->db->get()->result_array());
        
        if ($bookings['payment_method'] == 'paid')
            $this->db->set(array('updated_by' =>'success', 'book_status'=>'paid'))->where('id', $book_id)->update('booking');
        else if($bookings['payment_method'] == 'cash')
            $this->db->set(array('updated_by' =>'success', 'book_status'=>'cash'))->where('id', $book_id)->update('booking');
        else
            $this->db->set(array('is_active'=>1, 'updated_by' =>'success', 'book_status'=>'completed'))->where('id', $book_id)->update('booking');
        
        $this->db->from('booking')->where('id', $book_id);
        $res['bookings'] = current($this->db->get()->result_array());
        
        if ($res['bookings']['return_book_id']) {
            $this->db->from('booking')->where('id', $res['bookings']['return_book_id']);
            $res['return_bookings'] = current($this->db->get()->result_array());
            if ($res['return_bookings']['payment_method'] == 'paid')
                $this->db->set(array('updated_by' =>'success', 'book_status'=>'paid'))->where('id', $res['bookings']['return_book_id'])->update('booking');
            else if($res['return_bookings']['payment_method'] == 'cash')
                $this->db->set(array('updated_by' =>'success', 'book_status'=>'cash'))->where('id', $res['bookings']['return_book_id'])->update('booking');
            else
                $this->db->set(array('updated_by' =>'success', 'book_status'=>'completed'))->where('id', $res['bookings']['return_book_id'])->update('booking');
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
    $res['bookings']['collaborator_address'] = $this->db->from('collaborators_address')->where('id ', $res['bookings']['collaborator_address_id'])->get()->result_array();      
      
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
        
        $res['price'] = $this->input->get('amt');
        $res['book_reference'] = $res['start_journey']['reference_id'].' - '.sprintf("%02d", $res['bookings']['id']);
        $this->load->view('layout/templates/success', $res);
        /*$this->load->helper('dompdf');
        $html = $this->load->view('layout/templates/pdf', $res, true);
        $output = pdf_create($html, 'booking reference', true);*/
        if ($_SERVER['SERVER_NAME'] != 'localhost' && $_SERVER['SERVER_NAME'] != '192.168.1.12') {
            $this->load->helper('dompdf');  
            $html = $this->load->view('layout/templates/pdf', $res, true);
            $mail_html = $this->load->view('layout/templates/email', $res, true);
            //$output = pdf_create($html, 'booking reference', false);
            $output = pdf_create($html, $res['book_reference'], false);
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($this->set['site_email'], $this->set['site_title']);
            $this->email->to($res['clients']['email']); 
            $cc_array = array('bookings@pickngo.com');
            if($res['bookings']['book_role'] == 2)
                array_push($cc_array, $terminal['email']);

            $this->email->cc($cc_array);
            //$this->email->cc(array('janakiraman@proisc.com', 'xavi@grupovisualiza.com'));
      if($res['bookings']['book_status'] == 'completed')
        $this->email->bcc(array('janakiraman@proisc.com', 'bright@proisc.com'));
      
            $this->email->subject('Booking Confirmation: '.$res['book_reference']);
            $this->email->message($mail_html);
            $this->email->attach($output);
            $this->email->send();
        }
    }
    
    public function error() {
        include_once(APPPATH . "modules/layout/views/templates/config.php");
        include_once(APPPATH . "modules/layout/views/templates/functions.php");
        include_once(APPPATH . "modules/layout/views/templates/paypal.class.php");
        $paypal= new MyPayPal();
        $transaction_details = $paypal->GetTransactionDetails();
        $book_id = $transaction_details['CUSTOM'];
    if($book_id != '' && is_numeric($book_id)) {
      $book_data = $this->db->from('booking')->where('id', $book_id)->get()->row();
      if($book_data->book_status != 'pending') {
        redirect($this->uri->segment(1));
      }
    } else {
      redirect($this->uri->segment(1));
    }
        $this->db->set(array('updated_by' =>'error', 'is_active'=>0, 'book_status'=>'rejected', 'paypal_token_id'=>$transaction_details['TOKEN'], 'paypal_transaction_response'=>json_encode($transaction_details)))->where('id',$book_id)->update('booking');
        
        $this->db->set(array('is_active'=>0))->where('book_id',$book_id)->update('seats');
        /*return journey start*/
        $this->db->from('booking')->where('id', $book_id);
        $res['bookings'] = current($this->db->get()->result_array());
        
        if ($res['bookings']['return_book_id']) {
            $this->db->from('booking')->where('id', $res['bookings']['return_book_id']);
            $res['return_bookings'] = current($this->db->get()->result_array());
            
            $this->db->set(array('updated_by' =>'error', 'is_active'=>0, 'book_status'=>'rejected', 'paypal_token_id'=>$transaction_details['TOKEN'], 'paypal_transaction_response'=>json_encode($transaction_details)))->where('id', $res['bookings']['return_book_id'])->update('booking');
            $this->db->set(array('is_active'=>0))->where('book_id', $res['bookings']['return_book_id'])->update('seats');
        }
    $this->load->library('email');
    //$this->email->set_mailtype("html");
    $this->email->from($this->set['site_email'], $this->set['site_title']);
    $this->email->to('bright@proisc.com'); 
    $this->email->subject('Booking Confirmation: '.$book_id.' has been rejected');
        $this->email->message('rejected');
    $this->email->send();
        /*return journey end*/
        $this->load->view('layout/templates/error');
    }
  public function ajaxreturn1() {
        if ($this->input->post()) {
            $post_params = $this->input->post();
            $mode = $post_params['mode'];
      if ($mode == 'firstStep') {
        $result = $this->mdl_routes->getcar($this->input->post(), $this->details);
        echo json_encode($result);
      }
            else if ($mode == 'login') {
                $this->db->select('clients.id as client_id,clients.name,clients.surname,clients.email,clients.phone,clients.address,clients.cp,clients.country as client_country, clients.city,clients.nationality,clients.dni_passport,clients.doc_no,users.id as user_id');
                $this->db->from('users');
                $this->db->where('users.email', $post_params['login_email']);
                $this->db->where('users.password', md5($post_params['login_password']));
                $this->db->where('users.is_active', '1');
                $this->db->where('users.role', '4');
                $this->db->join('clients', 'clients.id=users.client_id', 'inner');
                $query = $this->db->get();
                if ($query->num_rows()) {
                    $user = current($query->result_array());
                    $user['password'] = $post_params['login_password'];
                    echo json_encode($user);
                } else {
                    echo json_encode(array('error'=>'invalid credentials'));
                }
            } else if ($mode == 'codes') {
                $qry = $this->db->where('code', $post_params['code'])->get('promotional_codes');
                if ($qry->num_rows())
                    echo json_encode(current($qry->result_array()));
                else
                    echo json_encode(array('error'=>'invalid codes'));
            }
            else if($mode == 'seatsAvailable') {

                /*Validation for client email and seats start*/
                $error = array('error'=>false, 'seats_error'=>false, 'return_seats_error'=>false, 'available_seats_error'=>false, 'baby_seats_error'=>false);
                
                $hidden_data = json_decode($post_params['journey_details'], true);
                $book_id = $hidden_data['id'];
                $terminal = array('Barcelona Airport Terminal 1', 'Barcelona Airport Terminal 2');
                $step_list = array('Terminal 1', 'Terminal 2');
                if(in_array($post_params['start_from'],$terminal)){
                    if($post_params['start_from'] == 'Barcelona Airport Terminal 1') {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and (from_zone in ('".implode("','", $step_list)."') or to_zone='Terminal 2')");
                    } else {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
                    }
                }
                else{
                    if($post_params['end_at'] == 'Barcelona Airport Terminal 2') {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and (to_zone in ('".implode("','", $step_list)."') or from_zone='Terminal 1')");
                    } else {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
                    }
                }
                
                $seat_com = $this->db->get()->result_array();

                $seat_occupy = 0;
                foreach($seat_com as $data1){
                    $seat_occupy += $data1['seats'];
                }
                $seats = $hidden_data['seats'] - $seat_occupy;
                $total_seats = $post_params['seats'];
                if($seats < $total_seats){
                    $error['error'] = true;
                    $error['seats_error'] = true;
                }
                else{
                    if(($seats - $total_seats)  == 0){
                        $error['baby_seats_error'] = true;
                    }
                }
                if ($this->input->post('return_journey_details')) {
                    $step_list = array('Terminal 1', 'Terminal 2');
                    $rhidden_data = json_decode($post_params['return_journey_details'], true);
                    $return_id = $rhidden_data['id'];
                    if(in_array($post_params['start_from'],$terminal)) {
                        if($post_params['start_from'] == 'Barcelona Airport Terminal 2') {
                            $this->db->from('seats')->where("calendar_id = ".$return_id." and is_active = 1 and (to_zone in ('".implode("','", $step_list)."') or from_zone='Terminal 1')");
                        } else {
                            $this->db->from('seats')->where("calendar_id = ".$return_id." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
                        }
                    } else {
                        if($post_params['end_at'] == 'Barcelona Airport Terminal 1') {
                            $this->db->from('seats')->where("calendar_id = ".$return_id." and is_active = 1 and (from_zone in ('".implode("','", $step_list)."') or to_zone='Terminal 2')");
                        } else {
                            $this->db->from('seats')->where("calendar_id = ".$return_id." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
                        }
                    }

                    $seat_com = $this->db->get()->result_array();
                    $seat_occupy = 0;
                    foreach($seat_com as $data1){
                        $seat_occupy += $data1['seats'];
                    }
                    $seats = $rhidden_data['seats'] - $seat_occupy;
                    
                    if($seats < $total_seats){
                        $error['error'] = true;
                        $error['return_seats_error'] = true;
                    }
                    else {
                        if(($seats - $total_seats)  == 0){
                            $error['baby_seats_error'] = true;
                        }
                    }
                }
                echo json_encode($error);
            }
            else if ($mode == 'formsubmit') {
                $book_id = $post_params['book_id'];
                //$book_details = json_decode($post_params['booking_details'], true);
                /* $this->db->set(array('seats' => $post_params['seats_'.$book_id] - ($post_params['adults'])))->where('id', $book_id);
                $this->db->update('calendars'); */
                
                /*Validation for client email and seats start*/
                $error = array('error'=>false, 'seats_error'=>false, 'return_seats_error'=>false, 'available_seats_error'=>false, 'baby_seats_error'=>false, 'return_baby_seats_error'=>false, 'start_duplicate' =>  false, 'return_duplicate' => false, 'time_error' => false);
                if($post_params['client_id'] == '') {
                    if ($this->input->post('save_extra')) {
                        $qry = $this->db->where('email', $post_params['email'])->get('users');
                        if($qry->num_rows()){
                            $error['error'] = true;
                            $error['email_error'] = lang('exists_username');
                        }
                    }
                } else {
                    $clients = current($this->db->where('client_id', $post_params['client_id'])->get('users')->result_array());
                    if($clients['email'] != $post_params['email']){
                        $qry = $this->db->where('email', $post_params['email'])->get('users');
                        if($qry->num_rows()){
                            $error['error'] = true;
                            $error['email_error'] = lang('exists_username');
                        }
                    }
                }
                $hidden_data = json_decode($post_params['journey_'.$book_id], true);
                $terminal = array('Barcelona Airport Terminal 1', 'Barcelona Airport Terminal 2');
                $step_list = array('Terminal 1', 'Terminal 2');
                if(in_array($post_params['start_from'],$terminal)){
                    if($post_params['start_from'] == 'Barcelona Airport Terminal 1') {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and (from_zone in ('".implode("','", $step_list)."') or to_zone='Terminal 2')");
                    } else {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
                    }
                }
                else{
                    if($post_params['end_at'] == 'Barcelona Airport Terminal 2') {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and (to_zone in ('".implode("','", $step_list)."') or from_zone='Terminal 1')");
                    } else {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
                    }
                }
                
                $seat_com = $this->db->get()->result_array();
                $seat_occupy = 0;
                foreach($seat_com as $data1){
                    $seat_occupy += $data1['seats'];
                }
                $extras_array = json_decode($post_params['extras_array'], true);
                $totBabySeats = (isset($extras_array[2]['extra_count']))?$extras_array[2]['extra_count']:0;
                $seats = $hidden_data['seats'] - $seat_occupy;
                $total_seats = $post_params['adults'];
                if($seats < $total_seats){
                    $error['error'] = true;
                    $error['seats_error'] = true;
                }
                else{
                    $baby_seats = $seats - $total_seats;
                    if(isset($extras_array[2]['extra_count']) && $extras_array[2]['extra_count'] > $baby_seats) {
                        $error['error'] = true;
                        $error['baby_seats_error'] = true;
                        $error['go_babay_seats'] = $baby_seats;
                    }
                }
                if ($this->input->post('return_book_id')) {
                    $step_list = array('Terminal 1', 'Terminal 2');
                    $rhidden_data = json_decode($post_params['return_journey_'.$post_params['return_book_id']], true);

                    if(in_array($post_params['start_from'],$terminal)) {
                        if($post_params['start_from'] == 'Barcelona Airport Terminal 2') {
                            $this->db->from('seats')->where("calendar_id = ".$post_params['return_book_id']." and is_active = 1 and (to_zone in ('".implode("','", $step_list)."') or from_zone='Terminal 1')");
                        } else {
                            $this->db->from('seats')->where("calendar_id = ".$post_params['return_book_id']." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
                        }
                    } else {
                        if($post_params['end_at'] == 'Barcelona Airport Terminal 1') {
                            $this->db->from('seats')->where("calendar_id = ".$post_params['return_book_id']." and is_active = 1 and (from_zone in ('".implode("','", $step_list)."') or to_zone='Terminal 2')");
                        } else {
                            $this->db->from('seats')->where("calendar_id = ".$post_params['return_book_id']." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
                        }
                    }
                    
                    
                    $seat_com = $this->db->get()->result_array();
                    $seat_occupy = 0;
                    foreach($seat_com as $data1){
                        $seat_occupy += $data1['seats'];
                    }
                    $seats = $rhidden_data['seats'] - $seat_occupy;
                    
                    if($seats < $total_seats){
                        $error['error'] = true;
                        $error['return_seats_error'] = true;
                    }
                    else{
                        $baby_seats = $seats - $total_seats;
                        if(isset($extras_array[2]['extra_count']) && $extras_array[2]['extra_count'] > $baby_seats) {
                            $error['error'] = true;
                            $error['return_baby_seats_error'] = true;
                            $error['return_babay_seats'] = $baby_seats;
                        }
                    }
                }
                if(isset($post_params['paymentmethod']) && $post_params['paymentmethod'] == 'available_seats'){
                    $cl_result = $this->db->from('collaborators')->where('id',$this->details['collaborator_details']['id'])->get()->row();
                    if($cl_result->no_of_available_seats < ($total_seats + $totBabySeats)) {
                        $error['error'] = true;
                        $error['available_seats_error'] = true;
                    }
                }
        
        /*Same booking validation start*/
        $start_from = (in_array($post_params['start_from'], $terminal))?$post_params['start_from']:$post_params['zone'];
        $end_at = (in_array($post_params['end_at'], $terminal))?$post_params['end_at']:$post_params['zone'];
        $babySeats = (isset($extras_array[2]['extra_count']))?$extras_array[2]['extra_count']:0;
        if($post_params['duplicate_bool'] == 0){
          $start_duplicate_qry = "select * from tbl_booking as b left join tbl_clients c on b.client_id = c.id where b.start_from = '".$start_from."' and b.end_at = '".$end_at."' and b.adults ='".$post_params['adults']."' and b.kids ='".$post_params['kids']."' and b.baby ='".$babySeats."' and b.start_journey ='".$hidden_data['service_date']."' and b.hour ='".$hidden_data['journey_start']."' and b.arrival_time ='".$hidden_data['journey_end']."' and (b.client_array like '%".$post_params['email']."%' or c.email = '".$post_params['email']."')";
          $start_duplicate = $this->db->query($start_duplicate_qry);
          if($start_duplicate->num_rows() > 0){
            $error['start_duplicate'] = true;
          }

          if ($this->input->post('return_book_id')) {
            $return_book_id1 = $post_params['return_book_id'];
            $return_hidden_data1 = json_decode($post_params['return_journey_'.$return_book_id1], true);
            $return_duplicate_qry = "select * from tbl_booking as b left join tbl_clients c on b.client_id = c.id where b.start_from = '".$start_from."' and b.end_at = '".$end_at."' and b.adults ='".$post_params['adults']."' and b.kids ='".$post_params['kids']."' and b.baby ='".$babySeats."' and b.start_journey ='".$return_hidden_data1['service_date']."' and b.hour ='".$return_hidden_data1['journey_start']."' and b.arrival_time ='".$return_hidden_data1['journey_end']."' and (b.client_array like '%".$post_params['email']."%' or c.email = '".$post_params['email']."')";
            $return_duplicate = $this->db->query($return_duplicate_qry);
            if($return_duplicate->num_rows() > 0){
              $error['return_duplicate'] = true;
            }
          }
        }
        /*Same booking validation end*/
        
        /*Journey time validation start*/
        $journeyStartDate     = str_replace('/','-',$post_params['start_journey']);
        $journeyStartDate     = date('Y-m-d', strtotime($journeyStartDate));
        $journeyStartTime   = $post_params['hours'].':'.$post_params['minutes'];
        $journeyStartDateTime = $journeyStartDate.' '.$journeyStartTime;
        $tommorrowDateTime = date('Y-m-d H:i', strtotime('+4 hour'));
        if(strtotime($journeyStartDateTime) < strtotime($tommorrowDateTime)) {
          $error['error'] = true;
          $error['time_error'] = true;
        }
        /*Journey time validation end*/
        
                //echo json_encode($error);exit;
                /*Validation for client email and seats end*/
                
                if(!$error['error'] && !$error['start_duplicate'] && !$error['return_duplicate']){
                    $book_role = 4;
                    $babySeats = (isset($extras_array[2]['extra_count']))?$extras_array[2]['extra_count']:0;
                    if ($this->session->userdata('user_name') && $this->session->userdata('user_type') == 2) {
                        $book_role = 2;
                    }
                        
                    
                    $client_array = array('name'=> $post_params['name'], 'surname'=>$post_params['surname'],
                                            'email'=>$post_params['email'], 'phone'=>$post_params['phone']
                                            , 'address'=>$post_params['address'], 'cp'=>$post_params['cp'], 'country'=>$post_params['client_country']
                                            , 'city'=>$post_params['city'], 'nationality'=>$post_params['nationality'], 'dni_passport'=>$post_params['dni_passport']
                                            , 'doc_no'=>$post_params['doc_no']);
                    /*$book_array = array('booking_array' => $this->input->post('booking_details'), 'extra_array'=>$this->input->post('extras_array'), 'client_array' => json_encode($client_array));
                    $this->db->set($book_array);
                    $this->db->insert('bookings');*/
          $address_new = (in_array($post_params['start_from'], $terminal))?$post_params['end_at']:$post_params['start_from'];
                    $start_from = (in_array($post_params['start_from'], $terminal))?$post_params['start_from']:$post_params['zone'];
                    $end_at = (in_array($post_params['end_at'], $terminal))?$post_params['end_at']:$post_params['zone'];
          $address = $address_new;
          
          /*Flight time calculation*/
          $time_go = Date('H:i', strtotime($post_params['hours'].':'.$post_params['minutes']));
          $time_back = Date('H:i', strtotime($post_params['return_hours'].':'.$post_params['return_minutes']));
          
                    $book_array = array('time_go'=>$time_go, 'time_back' => $time_back, 'hour'=>$hidden_data['journey_start'], 'start_from'=>$start_from, 'end_at'=>$end_at, 
                                    'arrival_time'=>$hidden_data['journey_end'],
                                    'price'=>$post_params['amount'], 'start_journey'=>$hidden_data['service_date']
                                    ,'country'=>$post_params['country'], 'flight_no'=>$post_params['flight_no'], 'adults'=>$post_params['adults'], 
                                    'kids'=>$post_params['kids']
                                    ,'extra_array'=>$post_params['extras_array'], 'calendar_id'=>$book_id, 'collaborator_id'=>$post_params['collaborators_id']
                                    ,'book_status'=>'pending', 'passenger_price'=>$post_params['passenger_price'], 'book_role'=>$book_role, 'baby'=>$babySeats, 'collaborator_address_id' => $post_params['collaborator_address_id'], 'address' => $address, 'bcnarea_address_id' => $post_params['bcnarea_address_id']);
                    if ($this->input->post('promotional_codes_id')) {
                        $book_array['promotional_code_id'] = $post_params['promotional_codes_id'];
                        $book_array['reduction_value'] = $post_params['promotional_values'];
                        $book_array['promotional_value'] = $post_params['promotional_code_values'];
                        $book_array['promotional_type'] = $post_params['promotional_type'];
                    }
                    $this->db->set($book_array);
                    $this->db->insert('booking');
                    $bid = $this->db->insert_id();
                    /*Seats entry*/
                    $seats_array = array('calendar_id'=> $book_id, 'reference_id'=> $hidden_data['reference_id'], 'start_time'=> $hidden_data['journey_start'],
                                    'end_time'=> $hidden_data['journey_end'], 'journey_date' => $hidden_data['service_date'], 'steps'=> $hidden_data['steps'],
                                    'from_zone'=>$hidden_data['start_from'], 'to_zone'=> $hidden_data['end_at'], 'seats'=>$post_params['adults'] + $babySeats, 'book_id'=>$bid); 

                    $this->db->set($seats_array)->insert('seats');
                    $str = array();
                    $str['book_id'] = $bid;
                    $str['amt'] = $post_params['amount'];
                    $return_id = 0;
                    if ($this->input->post('return_book_id')) {
                        if ($post_params['return_book_id']) {
                            $return_book_id = $post_params['return_book_id'];
                            $return_hidden_data = json_decode($post_params['return_journey_'.$return_book_id], true);
                            $return_book_array = array('time_go'=>$time_go, 'time_back' => $time_back, 'hour'=>$return_hidden_data['journey_start'], 'start_from'=>$end_at, 'end_at'=>$start_from, 
                                        'arrival_time'=>$return_hidden_data['journey_end'],
                                        'price'=>$post_params['amount'], 'start_journey'=>$return_hidden_data['service_date']
                                        ,'country'=>$post_params['country'], 'flight_no'=>$post_params['flight_no'], 'adults'=>$post_params['adults'], 
                                        'kids'=>$post_params['kids']
                                        ,'extra_array'=>$post_params['extras_array'], 'calendar_id'=>$return_book_id
                                        , 'collaborator_id'=>$post_params['collaborators_id'],'book_status'=>'pending', 
                                        'passenger_price'=>$post_params['passenger_price'], 'book_role'=>$book_role, 'baby'=>$babySeats, 'round_trip'=>1, 'collaborator_address_id' => $post_params['collaborator_address_id'], 'address' => $address, 'bcnarea_address_id' => $post_params['bcnarea_address_id']);
                            if ($this->input->post('promotional_codes_id')) {
                                $return_book_array['promotional_code_id'] = $post_params['promotional_codes_id'];
                                $return_book_array['reduction_value'] = $post_params['promotional_values'];
                                $return_book_array['promotional_value'] = $post_params['promotional_code_values'];
                                $return_book_array['promotional_type'] = $post_params['promotional_type'];
                            }
                            $this->db->set($return_book_array);
                            $this->db->insert('booking');
                            $return_id = $this->db->insert_id();
                            
                            $return_seats_array = array('calendar_id'=> $return_book_id, 'reference_id'=> $return_hidden_data['reference_id'], 'start_time'=> $return_hidden_data['journey_start'],
                                            'end_time'=> $return_hidden_data['journey_end'], 'journey_date' => $return_hidden_data['service_date'], 'steps'=> $return_hidden_data['steps'],
                                            'from_zone'=>$return_hidden_data['start_from'], 'to_zone'=> $return_hidden_data['end_at'], 'seats'=>$post_params['adults'] + $babySeats, 'book_id'=>$return_id); 

                            $this->db->set($return_seats_array)->insert('seats');
                        }
                    }
                    
                    $this->db->select('users.id as user_id, clients.id');
                    $this->db->from('clients');
                    $this->db->where('clients.id', $post_params['client_id']);
                    $this->db->join('users', 'clients.id=users.client_id', 'left');
                    $query = $this->db->get();
                    $cid='';
                    if ($post_params['client_id'] != '') {
                            $data = current($query->result_array());
                            $cid = $data['id'];
                            //$str['url'] .= '^'.$data['id'].'^'.$data['user_id'];
                            $this->db->set($client_array)->where('id', $post_params['client_id']);
                            $this->db->update('clients');
                            $user_data = array('first_name'=> $post_params['name'], 'last_name'=>$post_params['surname'],
                                            'email'=>$post_params['email']);
                            $this->db->set($user_data)->where('id',$data['user_id']);
                            $this->db->update('users');
                    }
                    else if ($this->input->post('save_extra')) {
                            $this->db->set($client_array);
                            $this->db->insert('clients');
                            $client_id = $this->db->insert_id();
                            //$str['url'] .= '^'.$client_id;
                            $cid = $client_id;
                            $user_data = array('role'=>4, 'first_name'=> $post_params['name'], 'last_name'=>$post_params['surname'],
                                            'email'=>$post_params['email'], 'password'=>md5($post_params['password']), 'secret_key'=>base64_encode($post_params['password'].'_pickngo'),
                                            'client_id'=>$client_id);
                            $this->db->set($user_data);
                            $this->db->insert('users');
                            $user_id = $this->db->insert_id();
                            //$str['url'] .= '^'.$user_id;
                    }
                    else{
                        $this->db->set(array('client_array'=>json_encode($client_array)))->where('id', $bid);
                        $this->db->update('booking');
                        if($return_id != 0){
                            $this->db->set(array('client_array'=>json_encode($client_array)))->where('id', $return_id);
                            $this->db->update('booking');
                        }
                        //$str['url'] .= '^0^0';
                    }
                    if ($cid != '') {
                        $this->db->set(array('client_id'=>$cid))->where('id', $bid);
                        $this->db->update('booking');
                        if($return_id != 0){
                            $this->db->set(array('client_id'=>$cid))->where('id', $return_id);
                            $this->db->update('booking');
                        }
                    }
                    //$str['url'] .= '^'.$post_params['collaborators_id'];
                    $str['payment_method'] = 'online';
                    $str['error'] = false;
                    $pay = 'online';
          if($post_params['paymentmethod'] == 'bank') {
            $str['payment_method'] = 'bank';
            $pay = 'bank';
          }
                    if ($this->session->userdata('user_name') && $this->session->userdata('user_type') == 2) {
                        if(isset($post_params['paymentmethod'])){
                            if($post_params['paymentmethod'] == 'available_seats'){
                                $cl_result = current($this->db->from('collaborators')->where('id',$this->details['collaborator_details']['id'])->get()->result_array());
                                $str['payment_method'] = 'seats';
                                $pay = 'paid';
                                $this->db->set(array('no_of_available_seats' => $cl_result['no_of_available_seats'] - $post_params['adults'] - $totBabySeats))->where('id', $this->details['collaborator_details']['id']);
                                $this->db->update('collaborators');
                            }
                            else if($post_params['paymentmethod'] == 'online'){
                                $str['payment_method'] = 'online';
                                $pay = 'online';
                            }
                            else if($post_params['paymentmethod'] == 'cash'){
                                $str['payment_method'] = 'cash';
                                $pay = 'cash';
                            }
                        }
                    }
          
          $this->db->set(array('payment_method'=>$pay, 'return_book_id'=>$return_id))->where('id', $bid)->update('booking');
          //$this->db->set(array('payment_method'=>$pay))->where('id', $return_id)->update('booking');
          
          /*Sabadell payment start*/
          include_once(APPPATH . "modules/layout/views/templates/apiRedsys.php");
          $ln = $this->uri->segment(1);
          $miObj = new RedsysAPI;
          
          //$merchantCode = "336240668";
          $merchantCode = "336240668";
          $terminal = "001";
          $amount = str_replace('.', '', $post_params['amount']);
          $currency = "978";
          $transactionType = "0";
          $merchantURL = "";
          $urlOK = site_url($ln.'/success/?cm='.$bid);
          $urlKO = site_url($ln.'/error/?cm='.$bid);
          $order = time();
          $testurlPago = 'https://sis-t.redsys.es:25443/sis/realizarPago';
          //$realurlPago = 'https://sis.redsys.es/sis/realizarPago';
          $realurlPago = 'https://sis.sermepa.es/sis/realizarPago';
          
          $miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
          $miObj->setParameter("DS_MERCHANT_ORDER",strval($order));
          $miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$merchantCode);
          $miObj->setParameter("DS_MERCHANT_CURRENCY",$currency);
          $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$transactionType);
          $miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
          $miObj->setParameter("DS_MERCHANT_MERCHANTURL",$merchantURL);
          $miObj->setParameter("DS_MERCHANT_URLOK",$urlOK);   
          $miObj->setParameter("DS_MERCHANT_URLKO",$urlKO);
          
          $version="HMAC_SHA256_V1";
          //$key = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
          $key = 'MIwogh31NprCbvsoQY0fvVkHRt8Wcvia';
          
          $request = "";
          $params = $miObj->createMerchantParameters();
          $signature = $miObj->createMerchantSignature($key);
          
          $str['version'] = $version;
          $str['params'] = $params;
          $str['signature'] = $signature;
          $str['banaba_url'] = $realurlPago;
          /*Sabadell payment end*/
          
                    echo json_encode($str);
                } else {
                    echo json_encode($error);
                }
            }
        }
    }
  public function ajaxreturn() {
        if ($this->input->post()) {
            $post_params = $this->input->post();
            $mode = $post_params['mode'];
            if ($mode == 'login') {
                $this->db->select('clients.id as client_id,clients.name,clients.surname,clients.email,clients.phone,clients.address,clients.cp,clients.country as client_country, clients.city,clients.nationality,clients.dni_passport,clients.doc_no,users.id as user_id');
                $this->db->from('users');
                $this->db->where('users.email', $post_params['login_email']);
                $this->db->where('users.password', md5($post_params['login_password']));
                $this->db->where('users.is_active', '1');
                $this->db->where('users.role', '4');
                $this->db->join('clients', 'clients.id=users.client_id', 'inner');
                $query = $this->db->get();
                if ($query->num_rows()) {
                    $user = current($query->result_array());
                    $user['password'] = $post_params['login_password'];
                    echo json_encode($user);
                } else {
                    echo json_encode(array('error'=>'invalid credentials'));
                }
            } else if ($mode == 'codes') {
                $qry = $this->db->where('code', $post_params['code'])->get('promotional_codes');
                if ($qry->num_rows())
                    echo json_encode(current($qry->result_array()));
                else
                    echo json_encode(array('error'=>'invalid codes'));
            }
            else if($mode == 'seatsAvailable') {

                /*Validation for client email and seats start*/
                $error = array('error'=>false, 'seats_error'=>false, 'return_seats_error'=>false, 'available_seats_error'=>false, 'baby_seats_error'=>false);
                
                $hidden_data = json_decode($post_params['journey_details'], true);
                $book_id = $hidden_data['id'];
                $terminal = array('Barcelona Airport Terminal 1', 'Barcelona Airport Terminal 2');
                $step_list = array('Terminal 1', 'Terminal 2');
                if(in_array($post_params['start_from'],$terminal)){
                    if($post_params['start_from'] == 'Barcelona Airport Terminal 1') {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and (from_zone in ('".implode("','", $step_list)."') or to_zone='Terminal 2')");
                    } else {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
                    }
                }
                else{
                    if($post_params['end_at'] == 'Barcelona Airport Terminal 2') {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and (to_zone in ('".implode("','", $step_list)."') or from_zone='Terminal 1')");
                    } else {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
                    }
                }
                
                $seat_com = $this->db->get()->result_array();

                $seat_occupy = 0;
                foreach($seat_com as $data1){
                    $seat_occupy += $data1['seats'];
                }
                $seats = $hidden_data['seats'] - $seat_occupy;
                $total_seats = $post_params['seats'];
                if($seats < $total_seats){
                    $error['error'] = true;
                    $error['seats_error'] = true;
                }
                else{
                    if(($seats - $total_seats)  == 0){
                        $error['baby_seats_error'] = true;
                    }
                }
                if ($this->input->post('return_journey_details')) {
                    $step_list = array('Terminal 1', 'Terminal 2');
                    $rhidden_data = json_decode($post_params['return_journey_details'], true);
                    $return_id = $rhidden_data['id'];
                    if(in_array($post_params['start_from'],$terminal)) {
                        if($post_params['start_from'] == 'Barcelona Airport Terminal 2') {
                            $this->db->from('seats')->where("calendar_id = ".$return_id." and is_active = 1 and (to_zone in ('".implode("','", $step_list)."') or from_zone='Terminal 1')");
                        } else {
                            $this->db->from('seats')->where("calendar_id = ".$return_id." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
                        }
                    } else {
                        if($post_params['end_at'] == 'Barcelona Airport Terminal 1') {
                            $this->db->from('seats')->where("calendar_id = ".$return_id." and is_active = 1 and (from_zone in ('".implode("','", $step_list)."') or to_zone='Terminal 2')");
                        } else {
                            $this->db->from('seats')->where("calendar_id = ".$return_id." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
                        }
                    }

                    $seat_com = $this->db->get()->result_array();
                    $seat_occupy = 0;
                    foreach($seat_com as $data1){
                        $seat_occupy += $data1['seats'];
                    }
                    $seats = $rhidden_data['seats'] - $seat_occupy;
                    
                    if($seats < $total_seats){
                        $error['error'] = true;
                        $error['return_seats_error'] = true;
                    }
                    else {
                        if(($seats - $total_seats)  == 0){
                            $error['baby_seats_error'] = true;
                        }
                    }
                }
                echo json_encode($error);
            }
            else if ($mode == 'formsubmit') {
                $book_id = $post_params['book_id'];
                //$book_details = json_decode($post_params['booking_details'], true);
                /* $this->db->set(array('seats' => $post_params['seats_'.$book_id] - ($post_params['adults'])))->where('id', $book_id);
                $this->db->update('calendars'); */
                
                /*Validation for client email and seats start*/
                $error = array('error'=>false, 'seats_error'=>false, 'return_seats_error'=>false, 'available_seats_error'=>false, 'baby_seats_error'=>false, 'return_baby_seats_error'=>false, 'start_duplicate' =>  false, 'return_duplicate' => false);
                if($post_params['client_id'] == '') {
                    if ($this->input->post('save_extra')) {
                        $qry = $this->db->where('email', $post_params['email'])->get('users');
                        if($qry->num_rows()){
                            $error['error'] = true;
                            $error['email_error'] = lang('exists_username');
                        }
                    }
                } else {
                    $clients = current($this->db->where('client_id', $post_params['client_id'])->get('users')->result_array());
                    if($clients['email'] != $post_params['email']){
                        $qry = $this->db->where('email', $post_params['email'])->get('users');
                        if($qry->num_rows()){
                            $error['error'] = true;
                            $error['email_error'] = lang('exists_username');
                        }
                    }
                }
                $hidden_data = json_decode($post_params['journey_'.$book_id], true);
                $terminal = array('Barcelona Airport Terminal 1', 'Barcelona Airport Terminal 2');
                $step_list = array('Terminal 1', 'Terminal 2');
                if(in_array($post_params['start_from'],$terminal)){
                    if($post_params['start_from'] == 'Barcelona Airport Terminal 1') {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and (from_zone in ('".implode("','", $step_list)."') or to_zone='Terminal 2')");
                    } else {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
                    }
                }
                else{
                    if($post_params['end_at'] == 'Barcelona Airport Terminal 2') {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and (to_zone in ('".implode("','", $step_list)."') or from_zone='Terminal 1')");
                    } else {
                        $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
                    }
                }
                
                $seat_com = $this->db->get()->result_array();
                $seat_occupy = 0;
                foreach($seat_com as $data1){
                    $seat_occupy += $data1['seats'];
                }
                $extras_array = json_decode($post_params['extras_array'], true);
                $totBabySeats = (isset($extras_array[2]['extra_count']))?$extras_array[2]['extra_count']:0;
                $seats = $hidden_data['seats'] - $seat_occupy;
                $total_seats = $post_params['adults'];
                if($seats < $total_seats){
                    $error['error'] = true;
                    $error['seats_error'] = true;
                }
                else{
                    $baby_seats = $seats - $total_seats;
                    if(isset($extras_array[2]['extra_count']) && $extras_array[2]['extra_count'] > $baby_seats) {
                        $error['error'] = true;
                        $error['baby_seats_error'] = true;
                        $error['go_babay_seats'] = $baby_seats;
                    }
                }
                if ($this->input->post('return_book_id')) {
                    $step_list = array('Terminal 1', 'Terminal 2');
                    $rhidden_data = json_decode($post_params['return_journey_'.$post_params['return_book_id']], true);

                    if(in_array($post_params['start_from'],$terminal)) {
                        if($post_params['start_from'] == 'Barcelona Airport Terminal 2') {
                            $this->db->from('seats')->where("calendar_id = ".$post_params['return_book_id']." and is_active = 1 and (to_zone in ('".implode("','", $step_list)."') or from_zone='Terminal 1')");
                        } else {
                            $this->db->from('seats')->where("calendar_id = ".$post_params['return_book_id']." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
                        }
                    } else {
                        if($post_params['end_at'] == 'Barcelona Airport Terminal 1') {
                            $this->db->from('seats')->where("calendar_id = ".$post_params['return_book_id']." and is_active = 1 and (from_zone in ('".implode("','", $step_list)."') or to_zone='Terminal 2')");
                        } else {
                            $this->db->from('seats')->where("calendar_id = ".$post_params['return_book_id']." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
                        }
                    }
                    
                    
                    $seat_com = $this->db->get()->result_array();
                    $seat_occupy = 0;
                    foreach($seat_com as $data1){
                        $seat_occupy += $data1['seats'];
                    }
                    $seats = $rhidden_data['seats'] - $seat_occupy;
                    
                    if($seats < $total_seats){
                        $error['error'] = true;
                        $error['return_seats_error'] = true;
                    }
                    else{
                        $baby_seats = $seats - $total_seats;
                        if(isset($extras_array[2]['extra_count']) && $extras_array[2]['extra_count'] > $baby_seats) {
                            $error['error'] = true;
                            $error['return_baby_seats_error'] = true;
                            $error['return_babay_seats'] = $baby_seats;
                        }
                    }
                }
                if(isset($post_params['paymentmethod']) && $post_params['paymentmethod'] == 'available_seats'){
                    $cl_result = $this->db->from('collaborators')->where('id',$this->details['collaborator_details']['id'])->get()->row();
                    if($cl_result->no_of_available_seats < ($total_seats + $totBabySeats)) {
                        $error['error'] = true;
                        $error['available_seats_error'] = true;
                    }
                }
        
        /*Same booking validation start*/
        $start_from = (in_array($post_params['start_from'], $terminal))?$post_params['start_from']:$post_params['zone'];
        $end_at = (in_array($post_params['end_at'], $terminal))?$post_params['end_at']:$post_params['zone'];
        $babySeats = (isset($extras_array[2]['extra_count']))?$extras_array[2]['extra_count']:0;
        if($post_params['duplicate_bool'] == 0){
          $start_duplicate_qry = "select * from tbl_booking as b left join tbl_clients c on b.client_id = c.id where b.start_from = '".$start_from."' and b.end_at = '".$end_at."' and b.adults ='".$post_params['adults']."' and b.kids ='".$post_params['kids']."' and b.baby ='".$babySeats."' and b.start_journey ='".$hidden_data['service_date']."' and b.hour ='".$hidden_data['journey_start']."' and b.arrival_time ='".$hidden_data['journey_end']."' and (b.client_array like '%".$post_params['email']."%' or c.email = '".$post_params['email']."')";
          $start_duplicate = $this->db->query($start_duplicate_qry);
          if($start_duplicate->num_rows() > 0){
            $error['start_duplicate'] = true;
          }

          if ($this->input->post('return_book_id')) {
            $return_book_id1 = $post_params['return_book_id'];
            $return_hidden_data1 = json_decode($post_params['return_journey_'.$return_book_id1], true);
            $return_duplicate_qry = "select * from tbl_booking as b left join tbl_clients c on b.client_id = c.id where b.start_from = '".$start_from."' and b.end_at = '".$end_at."' and b.adults ='".$post_params['adults']."' and b.kids ='".$post_params['kids']."' and b.baby ='".$babySeats."' and b.start_journey ='".$return_hidden_data1['service_date']."' and b.hour ='".$return_hidden_data1['journey_start']."' and b.arrival_time ='".$return_hidden_data1['journey_end']."' and (b.client_array like '%".$post_params['email']."%' or c.email = '".$post_params['email']."')";
            $return_duplicate = $this->db->query($return_duplicate_qry);
            if($return_duplicate->num_rows() > 0){
              $error['return_duplicate'] = true;
            }
          }
        }
        /*Same booking validation end*/
                //echo json_encode($error);exit;
                /*Validation for client email and seats end*/
                
                if(!$error['error'] && !$error['start_duplicate'] && !$error['return_duplicate']){
                    $book_role = 4;
                    $babySeats = (isset($extras_array[2]['extra_count']))?$extras_array[2]['extra_count']:0;
                    if ($this->session->userdata('user_name') && $this->session->userdata('user_type') == 2) {
                        $book_role = 2;
                    }
                        
                    
                    $client_array = array('name'=> $post_params['name'], 'surname'=>$post_params['surname'],
                                            'email'=>$post_params['email'], 'phone'=>$post_params['phone']
                                            , 'address'=>$post_params['address'], 'cp'=>$post_params['cp'], 'country'=>$post_params['client_country']
                                            , 'city'=>$post_params['city'], 'nationality'=>$post_params['nationality'], 'dni_passport'=>$post_params['dni_passport']
                                            , 'doc_no'=>$post_params['doc_no']);
                    /*$book_array = array('booking_array' => $this->input->post('booking_details'), 'extra_array'=>$this->input->post('extras_array'), 'client_array' => json_encode($client_array));
                    $this->db->set($book_array);
                    $this->db->insert('bookings');*/
                    $start_from = (in_array($post_params['start_from'], $terminal))?$post_params['start_from']:$post_params['zone'];
                    $end_at = (in_array($post_params['end_at'], $terminal))?$post_params['end_at']:$post_params['zone'];
                    $book_array = array('hour'=>$hidden_data['journey_start'], 'start_from'=>$start_from, 'end_at'=>$end_at, 
                                    'arrival_time'=>$hidden_data['journey_end'],
                                    'price'=>$post_params['amount'], 'start_journey'=>$hidden_data['service_date']
                                    ,'country'=>$post_params['country'], 'flight_no'=>$post_params['flight_no'], 'adults'=>$post_params['adults'], 
                                    'kids'=>$post_params['kids']
                                    ,'extra_array'=>$post_params['extras_array'], 'calendar_id'=>$book_id, 'collaborator_id'=>$post_params['collaborators_id']
                                    ,'book_status'=>'pending', 'passenger_price'=>$post_params['seats_price_'.$book_id], 'book_role'=>$book_role, 'baby'=>$babySeats, 'collaborator_address_id' => $post_params['collaborator_address_id']);
                    if ($this->input->post('promotional_codes_id')) {
                        $book_array['promotional_code_id'] = $post_params['promotional_codes_id'];
                        $book_array['reduction_value'] = $post_params['promotional_values'];
                        $book_array['promotional_value'] = $post_params['promotional_code_values'];
                        $book_array['promotional_type'] = $post_params['promotional_type'];
                    }
                    $this->db->set($book_array);
                    $this->db->insert('booking');
                    $bid = $this->db->insert_id();
                    /*Seats entry*/
                    $seats_array = array('calendar_id'=> $book_id, 'reference_id'=> $hidden_data['reference_id'], 'start_time'=> $hidden_data['journey_start'],
                                    'end_time'=> $hidden_data['journey_end'], 'journey_date' => $hidden_data['service_date'], 'steps'=> $hidden_data['steps'],
                                    'from_zone'=>$hidden_data['start_from'], 'to_zone'=> $hidden_data['end_at'], 'seats'=>$post_params['adults'] + $babySeats, 'book_id'=>$bid); 

                    $this->db->set($seats_array)->insert('seats');
                    $str = array();
                    $str['book_id'] = $bid;
                    $str['amt'] = $post_params['amount'];
                    $return_id = 0;
                    if ($this->input->post('return_book_id')) {
                        if ($post_params['return_book_id']) {
                            $return_book_id = $post_params['return_book_id'];
                            $return_hidden_data = json_decode($post_params['return_journey_'.$return_book_id], true);
                            $return_book_array = array('hour'=>$return_hidden_data['journey_start'], 'start_from'=>$end_at, 'end_at'=>$start_from, 
                                        'arrival_time'=>$return_hidden_data['journey_end'],
                                        'price'=>$post_params['amount'], 'start_journey'=>$return_hidden_data['service_date']
                                        ,'country'=>$post_params['country'], 'flight_no'=>$post_params['flight_no'], 'adults'=>$post_params['adults'], 
                                        'kids'=>$post_params['kids']
                                        ,'extra_array'=>$post_params['extras_array'], 'calendar_id'=>$return_book_id
                                        , 'collaborator_id'=>$post_params['collaborators_id'],'book_status'=>'pending', 
                                        'passenger_price'=>$post_params['seats_price_'.$book_id], 'book_role'=>$book_role, 'baby'=>$babySeats, 'round_trip'=>1, 'collaborator_address_id' => $post_params['collaborator_address_id']);
                            if ($this->input->post('promotional_codes_id')) {
                                $return_book_array['promotional_code_id'] = $post_params['promotional_codes_id'];
                                $return_book_array['reduction_value'] = $post_params['promotional_values'];
                                $return_book_array['promotional_value'] = $post_params['promotional_code_values'];
                                $return_book_array['promotional_type'] = $post_params['promotional_type'];
                            }
                            $this->db->set($return_book_array);
                            $this->db->insert('booking');
                            $return_id = $this->db->insert_id();
                            
                            $return_seats_array = array('calendar_id'=> $return_book_id, 'reference_id'=> $return_hidden_data['reference_id'], 'start_time'=> $return_hidden_data['journey_start'],
                                            'end_time'=> $return_hidden_data['journey_end'], 'journey_date' => $return_hidden_data['service_date'], 'steps'=> $return_hidden_data['steps'],
                                            'from_zone'=>$return_hidden_data['start_from'], 'to_zone'=> $return_hidden_data['end_at'], 'seats'=>$post_params['adults'] + $babySeats, 'book_id'=>$return_id); 

                            $this->db->set($return_seats_array)->insert('seats');
                        }
                    }
                    
                    $this->db->select('users.id as user_id, clients.id');
                    $this->db->from('clients');
                    $this->db->where('clients.id', $post_params['client_id']);
                    $this->db->join('users', 'clients.id=users.client_id', 'left');
                    $query = $this->db->get();
                    $cid='';
                    if ($post_params['client_id'] != '') {
                            $data = current($query->result_array());
                            $cid = $data['id'];
                            //$str['url'] .= '^'.$data['id'].'^'.$data['user_id'];
                            $this->db->set($client_array)->where('id', $post_params['client_id']);
                            $this->db->update('clients');
                            $user_data = array('first_name'=> $post_params['name'], 'last_name'=>$post_params['surname'],
                                            'email'=>$post_params['email']);
                            $this->db->set($user_data)->where('id',$data['user_id']);
                            $this->db->update('users');
                    }
                    else if ($this->input->post('save_extra')) {
                            $this->db->set($client_array);
                            $this->db->insert('clients');
                            $client_id = $this->db->insert_id();
                            //$str['url'] .= '^'.$client_id;
                            $cid = $client_id;
                            $user_data = array('role'=>4, 'first_name'=> $post_params['name'], 'last_name'=>$post_params['surname'],
                                            'email'=>$post_params['email'], 'password'=>md5($post_params['password']), 'secret_key'=>base64_encode($post_params['password'].'_pickngo'),
                                            'client_id'=>$client_id);
                            $this->db->set($user_data);
                            $this->db->insert('users');
                            $user_id = $this->db->insert_id();
                            //$str['url'] .= '^'.$user_id;
                    }
                    else{
                        $this->db->set(array('client_array'=>json_encode($client_array)))->where('id', $bid);
                        $this->db->update('booking');
                        if($return_id != 0){
                            $this->db->set(array('client_array'=>json_encode($client_array)))->where('id', $return_id);
                            $this->db->update('booking');
                        }
                        //$str['url'] .= '^0^0';
                    }
                    if ($cid != '') {
                        $this->db->set(array('client_id'=>$cid))->where('id', $bid);
                        $this->db->update('booking');
                        if($return_id != 0){
                            $this->db->set(array('client_id'=>$cid))->where('id', $return_id);
                            $this->db->update('booking');
                        }
                    }
                    //$str['url'] .= '^'.$post_params['collaborators_id'];
                    $str['online'] = true;
                    $str['error'] = false;
                    $pay = 'online';
                    if ($this->session->userdata('user_name') && $this->session->userdata('user_type') == 2) {
                        if(isset($post_params['paymentmethod'])){
                            if($post_params['paymentmethod'] == 'available_seats'){
                                $cl_result = current($this->db->from('collaborators')->where('id',$this->details['collaborator_details']['id'])->get()->result_array());
                                $str['online'] = false;
                                $pay = 'paid';
                                $this->db->set(array('no_of_available_seats' => $cl_result['no_of_available_seats'] - $post_params['adults'] - $totBabySeats))->where('id', $this->details['collaborator_details']['id']);
                                $this->db->update('collaborators');
                            }
                            else if($post_params['paymentmethod'] == 'online'){
                                $str['online'] = true;
                                $pay = 'online';
                            }
                            else if($post_params['paymentmethod'] == 'cash'){
                                $str['online'] = false;
                                $pay = 'cash';
                            }
                        }
                    }
                    $this->db->set(array('payment_method'=>$pay, 'return_book_id'=>$return_id))->where('id', $bid);
                    $this->db->update('booking');
                    echo json_encode($str);
                } else {
                    echo json_encode($error);
                }
            }
        }
    }
  public function ajaxreturncomplete() {
    if ($this->input->post()) {
      $post_params = $this->input->post();
      $mode = $post_params['mode'];
      if ($mode == 'login') {
        $this->db->select('clients.id as client_id,clients.name,clients.surname,clients.email,clients.phone,clients.address,clients.cp,clients.country as client_country, clients.city,clients.nationality,clients.dni_passport,clients.doc_no,users.id as user_id');
        $this->db->from('users');
        $this->db->where('users.email', $post_params['login_email']);
        $this->db->where('users.password', md5($post_params['login_password']));
        $this->db->where('users.is_active', '1');
        $this->db->where('users.role', '4');
        $this->db->join('clients', 'clients.id=users.client_id', 'inner');
        $query = $this->db->get();
        if ($query->num_rows()) {
          $user = current($query->result_array());
          $user['password'] = $post_params['login_password'];
          echo json_encode($user);
        } else {
          echo json_encode(array('error'=>'invalid credentials'));
        }
      } else if ($mode == 'codes') {
        $qry = $this->db->where('code', $post_params['code'])->get('promotional_codes');
        if ($qry->num_rows())
          echo json_encode(current($qry->result_array()));
        else
          echo json_encode(array('error'=>'invalid codes'));
      }
      else if($mode == 'seatsAvailable') {

        /*Validation for client email and seats start*/
        $error = array('error'=>false, 'seats_error'=>false, 'return_seats_error'=>false, 'available_seats_error'=>false, 'baby_seats_error'=>false);
        
        $hidden_data = json_decode($post_params['journey_details'], true);
        $book_id = $hidden_data['id'];
        $terminal = array('Barcelona Airport Terminal 1', 'Barcelona Airport Terminal 2');
        $step_list = array('Terminal 1', 'Terminal 2');
        if(in_array($post_params['start_from'],$terminal)){
          if($post_params['start_from'] == 'Barcelona Airport Terminal 1') {
            $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and (from_zone in ('".implode("','", $step_list)."') or to_zone='Terminal 2')");
          } else {
            $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
          }
        }
        else{
          if($post_params['end_at'] == 'Barcelona Airport Terminal 2') {
            $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and (to_zone in ('".implode("','", $step_list)."') or from_zone='Terminal 1')");
          } else {
            $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
          }
        }
        
        $seat_com = $this->db->get()->result_array();

        $seat_occupy = 0;
        foreach($seat_com as $data1){
          $seat_occupy += $data1['seats'];
        }
        $seats = $hidden_data['seats'] - $seat_occupy;
        $total_seats = $post_params['seats'];
        if($seats < $total_seats){
          $error['error'] = true;
          $error['seats_error'] = true;
        }
        else{
          if(($seats - $total_seats)  == 0){
            $error['baby_seats_error'] = true;
          }
        }
        if ($this->input->post('return_journey_details')) {
          $step_list = array('Terminal 1', 'Terminal 2');
          $rhidden_data = json_decode($post_params['return_journey_details'], true);
          $return_id = $rhidden_data['id'];
          if(in_array($post_params['start_from'],$terminal)) {
            if($post_params['start_from'] == 'Barcelona Airport Terminal 2') {
              $this->db->from('seats')->where("calendar_id = ".$return_id." and is_active = 1 and (to_zone in ('".implode("','", $step_list)."') or from_zone='Terminal 1')");
            } else {
              $this->db->from('seats')->where("calendar_id = ".$return_id." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
            }
          } else {
            if($post_params['end_at'] == 'Barcelona Airport Terminal 1') {
              $this->db->from('seats')->where("calendar_id = ".$return_id." and is_active = 1 and (from_zone in ('".implode("','", $step_list)."') or to_zone='Terminal 2')");
            } else {
              $this->db->from('seats')->where("calendar_id = ".$return_id." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
            }
          }

          $seat_com = $this->db->get()->result_array();
          $seat_occupy = 0;
          foreach($seat_com as $data1){
            $seat_occupy += $data1['seats'];
          }
          $seats = $rhidden_data['seats'] - $seat_occupy;
          
          if($seats < $total_seats){
            $error['error'] = true;
            $error['return_seats_error'] = true;
          }
          else {
            if(($seats - $total_seats)  == 0){
              $error['baby_seats_error'] = true;
            }
          }
        }
        echo json_encode($error);
      }
      else if ($mode == 'formsubmit') {
        $book_id = $post_params['book_id'];
        //$book_details = json_decode($post_params['booking_details'], true);
        /* $this->db->set(array('seats' => $post_params['seats_'.$book_id] - ($post_params['adults'])))->where('id', $book_id);
        $this->db->update('calendars'); */
        
        /*Validation for client email and seats start*/
        $error = array('error'=>false, 'seats_error'=>false, 'return_seats_error'=>false, 'available_seats_error'=>false, 'baby_seats_error'=>false, 'return_baby_seats_error'=>false, 'start_duplicate' =>  false, 'return_duplicate' => false);
        if($post_params['client_id'] == '') {
          if ($this->input->post('save_extra')) {
            $qry = $this->db->where('email', $post_params['email'])->get('users');
            if($qry->num_rows()){
              $error['error'] = true;
              $error['email_error'] = lang('exists_username');
            }
          }
        } else {
          $clients = current($this->db->where('client_id', $post_params['client_id'])->get('users')->result_array());
          if($clients['email'] != $post_params['email']){
            $qry = $this->db->where('email', $post_params['email'])->get('users');
            if($qry->num_rows()){
              $error['error'] = true;
              $error['email_error'] = lang('exists_username');
            }
          }
        }
        $hidden_data = json_decode($post_params['journey_'.$book_id], true);
        $terminal = array('Barcelona Airport Terminal 1', 'Barcelona Airport Terminal 2');
        $step_list = array('Terminal 1', 'Terminal 2');
        if(in_array($post_params['start_from'],$terminal)){
          if($post_params['start_from'] == 'Barcelona Airport Terminal 1') {
            $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and (from_zone in ('".implode("','", $step_list)."') or to_zone='Terminal 2')");
          } else {
            $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
          }
        }
        else{
          if($post_params['end_at'] == 'Barcelona Airport Terminal 2') {
            $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and (to_zone in ('".implode("','", $step_list)."') or from_zone='Terminal 1')");
          } else {
            $this->db->from('seats')->where("calendar_id = ".$book_id." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
          }
        }
        
        $seat_com = $this->db->get()->result_array();
        $seat_occupy = 0;
        foreach($seat_com as $data1){
          $seat_occupy += $data1['seats'];
        }
        $extras_array = json_decode($post_params['extras_array'], true);
        $totBabySeats = (isset($extras_array[2]['extra_count']))?$extras_array[2]['extra_count']:0;
        $seats = $hidden_data['seats'] - $seat_occupy;
        $total_seats = $post_params['adults'];
        if($seats < $total_seats){
          $error['error'] = true;
          $error['seats_error'] = true;
        }
        else{
          $baby_seats = $seats - $total_seats;
          if(isset($extras_array[2]['extra_count']) && $extras_array[2]['extra_count'] > $baby_seats) {
            $error['error'] = true;
            $error['baby_seats_error'] = true;
            $error['go_babay_seats'] = $baby_seats;
          }
        }
        if ($this->input->post('return_book_id')) {
          $step_list = array('Terminal 1', 'Terminal 2');
          $rhidden_data = json_decode($post_params['return_journey_'.$post_params['return_book_id']], true);

          if(in_array($post_params['start_from'],$terminal)) {
            if($post_params['start_from'] == 'Barcelona Airport Terminal 2') {
              $this->db->from('seats')->where("calendar_id = ".$post_params['return_book_id']." and is_active = 1 and (to_zone in ('".implode("','", $step_list)."') or from_zone='Terminal 1')");
            } else {
              $this->db->from('seats')->where("calendar_id = ".$post_params['return_book_id']." and is_active = 1 and to_zone in ('".implode("','", $step_list)."')");
            }
          } else {
            if($post_params['end_at'] == 'Barcelona Airport Terminal 1') {
              $this->db->from('seats')->where("calendar_id = ".$post_params['return_book_id']." and is_active = 1 and (from_zone in ('".implode("','", $step_list)."') or to_zone='Terminal 2')");
            } else {
              $this->db->from('seats')->where("calendar_id = ".$post_params['return_book_id']." and is_active = 1 and from_zone in ('".implode("','", $step_list)."')");
            }
          }
          
          
          $seat_com = $this->db->get()->result_array();
          $seat_occupy = 0;
          foreach($seat_com as $data1){
            $seat_occupy += $data1['seats'];
          }
          $seats = $rhidden_data['seats'] - $seat_occupy;
          
          if($seats < $total_seats){
            $error['error'] = true;
            $error['return_seats_error'] = true;
          }
          else{
            $baby_seats = $seats - $total_seats;
            if(isset($extras_array[2]['extra_count']) && $extras_array[2]['extra_count'] > $baby_seats) {
              $error['error'] = true;
              $error['return_baby_seats_error'] = true;
              $error['return_babay_seats'] = $baby_seats;
            }
          }
        }
        if(isset($post_params['paymentmethod']) && $post_params['paymentmethod'] == 'available_seats'){
          $cl_result = $this->db->from('collaborators')->where('id',$this->details['collaborator_details']['id'])->get()->row();
          if($cl_result->no_of_available_seats < ($total_seats + $totBabySeats)) {
            $error['error'] = true;
            $error['available_seats_error'] = true;
          }
        }

        /*Same booking validation start*/
        $start_from = (in_array($post_params['start_from'], $terminal))?$post_params['start_from']:$post_params['zone'];
        $end_at = (in_array($post_params['end_at'], $terminal))?$post_params['end_at']:$post_params['zone'];
        $babySeats = (isset($extras_array[2]['extra_count']))?$extras_array[2]['extra_count']:0;
        if($post_params['duplicate_bool'] == 0){
          $start_duplicate_qry = "select * from tbl_booking as b left join tbl_clients c on b.client_id = c.id where b.start_from = '".$start_from."' and b.end_at = '".$end_at."' and b.adults ='".$post_params['adults']."' and b.kids ='".$post_params['kids']."' and b.baby ='".$babySeats."' and b.start_journey ='".$hidden_data['service_date']."' and b.hour ='".$hidden_data['journey_start']."' and b.arrival_time ='".$hidden_data['journey_end']."' and (b.client_array like '%".$post_params['email']."%' or c.email = '".$post_params['email']."')";
          $start_duplicate = $this->db->query($start_duplicate_qry);
          if($start_duplicate->num_rows() > 0){
            $error['start_duplicate'] = true;
          }

          if ($this->input->post('return_book_id')) {
            $return_book_id1 = $post_params['return_book_id'];
            $return_hidden_data1 = json_decode($post_params['return_journey_'.$return_book_id1], true);
            $return_duplicate_qry = "select * from tbl_booking as b left join tbl_clients c on b.client_id = c.id where b.start_from = '".$start_from."' and b.end_at = '".$end_at."' and b.adults ='".$post_params['adults']."' and b.kids ='".$post_params['kids']."' and b.baby ='".$babySeats."' and b.start_journey ='".$return_hidden_data1['service_date']."' and b.hour ='".$return_hidden_data1['journey_start']."' and b.arrival_time ='".$return_hidden_data1['journey_end']."' and (b.client_array like '%".$post_params['email']."%' or c.email = '".$post_params['email']."')";
            $return_duplicate = $this->db->query($return_duplicate_qry);
            if($return_duplicate->num_rows() > 0){
              $error['return_duplicate'] = true;
            }
          }
        }
        /*Same booking validation end*/
        //echo json_encode($error);exit;
        /*Validation for client email and seats end*/
        
        if(!$error['error'] && !$error['start_duplicate'] && !$error['return_duplicate']){
          $book_role = 4;
          
          if ($this->session->userdata('user_name') && $this->session->userdata('user_type') == 2) {
            $book_role = 2;
          }
            
          
          $client_array = array('name'=> $post_params['name'], 'surname'=>$post_params['surname'],
                      'email'=>$post_params['email'], 'phone'=>$post_params['phone']
                      , 'address'=>$post_params['address'], 'cp'=>$post_params['cp'], 'country'=>$post_params['client_country']
                      , 'city'=>$post_params['city'], 'nationality'=>$post_params['nationality'], 'dni_passport'=>$post_params['dni_passport']
                      , 'doc_no'=>$post_params['doc_no']);
          /*$book_array = array('booking_array' => $this->input->post('booking_details'), 'extra_array'=>$this->input->post('extras_array'), 'client_array' => json_encode($client_array));
          $this->db->set($book_array);
          $this->db->insert('bookings');*/

          $book_array = array('hour'=>$hidden_data['journey_start'], 'start_from'=>$start_from, 'end_at'=>$end_at, 
                  'arrival_time'=>$hidden_data['journey_end'],
                  'price'=>$post_params['amount'], 'start_journey'=>$hidden_data['service_date']
                  ,'country'=>$post_params['country'], 'flight_no'=>$post_params['flight_no'], 'adults'=>$post_params['adults'], 
                  'kids'=>$post_params['kids']
                  ,'extra_array'=>$post_params['extras_array'], 'calendar_id'=>$book_id, 'collaborator_id'=>$post_params['collaborators_id']
                  ,'book_status'=>'pending', 'passenger_price'=>$post_params['seats_price_'.$book_id], 'book_role'=>$book_role, 'baby'=>$babySeats);
          //echo json_encode($book_array);exit;
          if ($this->input->post('promotional_codes_id')) {
            $book_array['promotional_code_id'] = $post_params['promotional_codes_id'];
            $book_array['reduction_value'] = $post_params['promotional_values'];
            $book_array['promotional_value'] = $post_params['promotional_code_values'];
            $book_array['promotional_type'] = $post_params['promotional_type'];
          }
          $this->db->set($book_array);
          $this->db->insert('booking');
          $bid = $this->db->insert_id();
          /*Seats entry*/
          $seats_array = array('calendar_id'=> $book_id, 'reference_id'=> $hidden_data['reference_id'], 'start_time'=> $hidden_data['journey_start'],
                  'end_time'=> $hidden_data['journey_end'], 'journey_date' => $hidden_data['service_date'], 'steps'=> $hidden_data['steps'],
                  'from_zone'=>$hidden_data['start_from'], 'to_zone'=> $hidden_data['end_at'], 'seats'=>$post_params['adults'] + $babySeats, 'book_id'=>$bid); 

          $this->db->set($seats_array)->insert('seats');
          $str = array();
          $str['book_id'] = $bid;
          $str['amt'] = $post_params['amount'];
          $return_id = 0;
          if ($this->input->post('return_book_id')) {
            if ($post_params['return_book_id']) {
              $return_book_id = $post_params['return_book_id'];
              $return_hidden_data = json_decode($post_params['return_journey_'.$return_book_id], true);
              $return_book_array = array('hour'=>$return_hidden_data['journey_start'], 'start_from'=>$end_at, 'end_at'=>$start_from, 
                    'arrival_time'=>$return_hidden_data['journey_end'],
                    'price'=>$post_params['amount'], 'start_journey'=>$return_hidden_data['service_date']
                    ,'country'=>$post_params['country'], 'flight_no'=>$post_params['flight_no'], 'adults'=>$post_params['adults'], 
                    'kids'=>$post_params['kids']
                    ,'extra_array'=>$post_params['extras_array'], 'calendar_id'=>$return_book_id
                    , 'collaborator_id'=>$post_params['collaborators_id'],'book_status'=>'pending', 
                    'passenger_price'=>$post_params['seats_price_'.$book_id], 'book_role'=>$book_role, 'baby'=>$babySeats, 'round_trip'=>1);
              if ($this->input->post('promotional_codes_id')) {
                $return_book_array['promotional_code_id'] = $post_params['promotional_codes_id'];
                $return_book_array['reduction_value'] = $post_params['promotional_values'];
                $return_book_array['promotional_value'] = $post_params['promotional_code_values'];
                $return_book_array['promotional_type'] = $post_params['promotional_type'];
              }
              $this->db->set($return_book_array);
              $this->db->insert('booking');
              $return_id = $this->db->insert_id();
              
              $return_seats_array = array('calendar_id'=> $return_book_id, 'reference_id'=> $return_hidden_data['reference_id'], 'start_time'=> $return_hidden_data['journey_start'],
                      'end_time'=> $return_hidden_data['journey_end'], 'journey_date' => $return_hidden_data['service_date'], 'steps'=> $return_hidden_data['steps'],
                      'from_zone'=>$return_hidden_data['start_from'], 'to_zone'=> $return_hidden_data['end_at'], 'seats'=>$post_params['adults'] + $babySeats, 'book_id'=>$return_id); 

              $this->db->set($return_seats_array)->insert('seats');
            }
          }
          
          $this->db->select('users.id as user_id, clients.id');
          $this->db->from('clients');
          $this->db->where('clients.id', $post_params['client_id']);
          $this->db->join('users', 'clients.id=users.client_id', 'left');
          $query = $this->db->get();
          $cid='';
          if ($post_params['client_id'] != '') {
              $data = current($query->result_array());
              $cid = $data['id'];
              //$str['url'] .= '^'.$data['id'].'^'.$data['user_id'];
              $this->db->set($client_array)->where('id', $post_params['client_id']);
              $this->db->update('clients');
              $user_data = array('first_name'=> $post_params['name'], 'last_name'=>$post_params['surname'],
                      'email'=>$post_params['email']);
              $this->db->set($user_data)->where('id',$data['user_id']);
              $this->db->update('users');
          }
          else if ($this->input->post('save_extra')) {
              $this->db->set($client_array);
              $this->db->insert('clients');
              $client_id = $this->db->insert_id();
              //$str['url'] .= '^'.$client_id;
              $cid = $client_id;
              $user_data = array('role'=>4, 'first_name'=> $post_params['name'], 'last_name'=>$post_params['surname'],
                      'email'=>$post_params['email'], 'password'=>md5($post_params['password']), 'secret_key'=>base64_encode($post_params['password'].'_pickngo'),
                      'client_id'=>$client_id);
              $this->db->set($user_data);
              $this->db->insert('users');
              $user_id = $this->db->insert_id();
              //$str['url'] .= '^'.$user_id;
          }
          else{
            $this->db->set(array('client_array'=>json_encode($client_array)))->where('id', $bid);
            $this->db->update('booking');
            if($return_id != 0){
              $this->db->set(array('client_array'=>json_encode($client_array)))->where('id', $return_id);
              $this->db->update('booking');
            }
            //$str['url'] .= '^0^0';
          }
          if ($cid != '') {
            $this->db->set(array('client_id'=>$cid))->where('id', $bid);
            $this->db->update('booking');
            if($return_id != 0){
              $this->db->set(array('client_id'=>$cid))->where('id', $return_id);
              $this->db->update('booking');
            }
          }
          //$str['url'] .= '^'.$post_params['collaborators_id'];
          $str['online'] = true;
          $str['error'] = false;
          $pay = 'online';
          if ($this->session->userdata('user_name') && $this->session->userdata('user_type') == 2) {
            if(isset($post_params['paymentmethod'])){
              if($post_params['paymentmethod'] == 'available_seats'){
                $cl_result = current($this->db->from('collaborators')->where('id',$this->details['collaborator_details']['id'])->get()->result_array());
                $str['online'] = false;
                $pay = 'paid';
                $this->db->set(array('no_of_available_seats' => $cl_result['no_of_available_seats'] - $post_params['adults'] - $totBabySeats))->where('id', $this->details['collaborator_details']['id']);
                $this->db->update('collaborators');
              }
              else if($post_params['paymentmethod'] == 'online'){
                $str['online'] = true;
                $pay = 'online';
              }
              else if($post_params['paymentmethod'] == 'cash'){
                $str['online'] = false;
                $pay = 'cash';
              }
            }
          }
          $this->db->set(array('payment_method'=>$pay, 'return_book_id'=>$return_id))->where('id', $bid);
          $this->db->update('booking');
          echo json_encode($str);
        } else {
          echo json_encode($error);
        }
      }
    }
  }
  public function paypal_ec_redirect() {  
    $this->load->view('layout/templates/paypal_ec_redirect');
  }
  public function paypal_ec_mark() {  
    $this->load->view('layout/templates/paypal_ec_mark');
  }
  public function process() { 
    $this->load->view('layout/templates/process');
  }
  public function banaba() {  
    $this->load->view('layout/templates/banaba');
  }
  public function phpversion(){
    echo Date('d-m-Y h:i:s a');
    echo phpinfo();
    /*$qry = "SELECT * from tbl_booking where id > 428";
    $data = $this->db->query($qry)->result_array();
    echo "<pre>";
    print_r($data);
    include_once(APPPATH . "modules/layout/views/templates/config.php");
    include_once(APPPATH . "modules/layout/views/templates/functions.php");
    include_once(APPPATH . "modules/layout/views/templates/paypal.class.php");
    $paypal= new MyPayPal();
    $array = $paypal->GetTransactionDetails('EC%2d9M798542A2595022G');
    $book_id = $array['CUSTOM'];*/
  }
  public function booking_details() {
    if($this->session->userdata('user_name') && $this->session->userdata('user_type') == 2) {
      $this->mdl_shuttles->select('booking.bcnarea_address_id,booking.address as book_address,collaborators.address as col_address,collaborators_address.address as mainaddress,collaborators_address.zone as col_zone,booking.book_status,booking.id,booking.collaborator_id,booking.kids,booking.adults,booking.baby,booking.start_from,
                        booking.end_at,booking.zone,booking.hour,booking.arrival_time,booking.price,booking.start_journey,
                        booking.return_book_id,booking.return_journey,booking.country,booking.flight_no,booking.created,collaborators.name,booking.client_id,booking.client_array,
                        clients.name as first_name, clients.surname,calendars.reference_id')
                        ->join('collaborators', 'collaborators.id=booking.collaborator_id', 'left')
                        ->join('collaborators_address', 'collaborators_address.id = booking.collaborator_address_id', 'left')
                        ->join('clients', 'clients.id=booking.client_id', 'left')
                        ->join('calendars', 'calendars.id=booking.calendar_id', 'left')
                        ->where('booking.is_active = 1  and tbl_booking.book_role=2 and tbl_booking.collaborator_id = '.$this->details['collaborator_details']['id']);
      $res = array();
      if ($this->input->post('from_date')) {
        $fromUnixTime = strtotime(str_replace('/', '-', $this->input->post('from_date')));
        $fromDate = date('d-m-Y', $fromUnixTime);
        $shuttles = $this->mdl_shuttles->where('DATE(tbl_booking.start_journey)', date('Y-m-d', $fromUnixTime))
                        ->order_by('booking.hour', 'asc')->get()->result();
        /*$return_id = $this->db->query("select tbl_booking.id, mm.id as return_book_id from tbl_booking inner join (select id from tbl_booking where tbl_booking.is_active = 1 and tbl_booking.start_journey = '".Date('Y-m-d', $fromUnixTime)."' and tbl_booking.round_trip = 1) mm on mm.id = tbl_booking.return_book_id")->result_array();

        array_walk($return_id, function($item) use (&$res) {
            // flatten the array
            $res[$item['return_book_id']] = $item['id'];
        });*/
      } else {
        $shuttles = $this->mdl_shuttles->where('booking.round_trip', '0')
                        ->order_by('booking.created', 'desc')->get()->result();
      }
      
      $this->load->view('layout/templates/booking_details', array('shuttles'=>$shuttles, 'res' => $res));
    } else {
      redirect($this->uri->segment(1));
    }
  }
  public function view_booking_details() {
    $id = $this->uri->segment(3);
    $this->db->from('booking')->where('id', $id);
    $res['bookings'] = current($this->db->get()->result_array());
    if($this->session->userdata('user_name') && $this->session->userdata('user_type') == 2 && $res['bookings']['collaborator_id'] == $this->details['collaborator_details']['id']) {
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

      $this->load->view('layout/templates/view_booking_details', $res);
    } else {
      redirect($this->uri->segment(1));
    }
  }
  public function changepassword() {
    //echo $this->session->userdata('user_id');die;
    $type = $this->uri->segment(3);
    if($this->session->userdata('user_name') && $this->session->userdata('user_type') == 2) {
      if($this->mdl_users->run_validation('validation_rules_changepassword')){
        //if($this->mdl_users->findByPassword($this->input->post('oldpassword'))) {
          $this->mdl_users->save_changepassword($this->input->post('newpassword'));
          redirect($this->uri->segment(1).'/changepassword');
          
        /*} else {
          redirect($this->uri->segment(1).'/changepassword');
        }*/
      }
    } else {
      redirect($this->uri->segment(1).'/changepassword');
    }
    $this->load->view('layout/templates/changepassword');
  }
  public function paypaldemo () {
    $this->load->view('layout/templates/paypaldemo');
  }
  public function reservation () {
    $res['booking'] = $this->mdl_booking_extras->where('is_active', 1)->get()->result_array();
    $this->load->view('layout/templates/reservation', $res);
  }
  public function testboot () {
    $this->load->view('layout/templates/testboot');
  }
}
?>
