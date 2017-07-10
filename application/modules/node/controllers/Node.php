<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Node Controller for frontend pages
 *
 * @return  void
 * 
 */
class Node extends Anonymous_Controller {
  var $site_contact = '';

  public $menu_types = [0=>'Basic',-1=>'Diet'];
	
	/**
   * class constructor
   *
   * @return  void
   * 
   */
  
  public function __construct() {
    parent::__construct();
    $this->load->model('clients/mdl_clients');
		$this->load->model('business/mdl_business');
		$this->load->model('menus/mdl_menus');
		$this->load->model('orders/mdl_orders');
		$this->load->model('drinks/mdl_drinks');
		$this->load->model('menu_types/mdl_menu_types');
		$this->load->model('temporary_orders/mdl_temporary_orders');
    $this->load->model('contacts/mdl_contacts');
    $this->load->model('plats/mdl_plats');
    $this->load->model('order_reports/mdl_order_reports');
    $this->load->model('centres/mdl_centres');
    $this->load->model('invoices/mdl_invoices');

    $this->load->helper("order_helper");
    
		$this->site_contact = $this->mdl_contacts->where(array('is_active' => 1))->get()->row();
		
		$todaySelectedMenus = $this->mdl_temporary_orders->get_client_today_menus();
		
		
		
		$totalCartItems = count($todaySelectedMenus);
		
		/* echo "<pre>";
		print_r($todaySelectedMenus);die; */

		$this->login_client_profile = $this->mdl_clients->get_client_details_by_id($this->session->userdata('client_id'));
		
		$cool_drinks_data = $this->mdl_drinks->get_cool_drinks();
		$cool_drinks = [];
		foreach($cool_drinks_data as $cool_drink) {
			$cool_drinks[$cool_drink->id] = $cool_drink;
		}
		//print_r($login_client_profile);die;
		
		//echo "<pre>";
		//print_r($cool_drinks);//die; 
		
		$this->today_menus_removed = [];
		
		/*Check and remove the expired data from the temperory order table*/
		$centre_id = $this->session->userdata('centre_id');
		
		$centreInfo = $this->mdl_centres->centreInfo($centre_id);
    
		
		$left_time = 0;
		
    if ($centreInfo) {
      $time1 = strtotime($centreInfo->time_limit);
			
      $time2 = time();

			if($time1 > $time2) {
				$left_time = ($time1 - $time2);
			}
    }

		if($left_time == 0) {
			$menus = $this->mdl_menus->select('id')->where('menu_date', date('Y-m-d'))->get()->result_array();
			$menus_id = array_column($menus, 'id');
			
			$selectedMenusIds = array_column($todaySelectedMenus, 'menu_id');
			
			$menusExists = array_intersect($menus_id, $selectedMenusIds);
			
			if(count($menusExists) > 0) {
				$this->today_menus_removed = $menusExists;
				$this->mdl_temporary_orders->order_delete($menusExists);
				
				$todaySelectedMenus = $this->mdl_temporary_orders->get_client_today_menus();
		
				$totalCartItems = count($todaySelectedMenus);
			}
		}

		$this->load->vars(array('todaySelectedMenus'=> $todaySelectedMenus, 'login_client_profile' => $this->login_client_profile, 'totalCartItems'=>$totalCartItems, 'cool_drinks' => $cool_drinks, 'user_info'=>$this->session->get_userdata(), 'today_menus_removed' => $this->today_menus_removed, 'contact'=>$this->site_contact));
  }
  
  /**
   * Function index
   *
   * @return  void
   * 
   */
  public function index($lang = 'es') {
		$this->display_home($lang);
  }
  
  /**
   * Function display_home
   *
   * @return  void
   * 
   */
  public function display_home($lang) {
		
		if ($this->mdl_clients->run_validation('validation_rules_clients_login')) {
      $data = $this->mdl_clients->check_clients($this->input->post());
			if ($data) {
				redirect(PAGE_LANGUAGE.'/menus');
			} else {
				$business_login_details = $this->mdl_business->check_credetials($this->input->post());
				if ($business_login_details) {
					redirect(PAGE_LANGUAGE.'/business-invoice');
				} else {
					redirect(PAGE_LANGUAGE);
				}
			}
		}
    $res = array();
    
    $this->load->view('layout/templates/login', $res);
  }

	/**
   * Function register
   *
   * @return  void
   * 
   */
  public function register() {
		$message = '';
    $method = strtolower($this->input->method(TRUE));
    if ($method == 'post') {
      if ($this->mdl_clients->run_validation('validation_rules_on_register_page')) {
        $data = $this->input->post();
        if (isset($data['terms'])){
          unset($data['terms']);
        }
        $data['name'] = strtoupper($data['name']);
        $data['surname'] = strtoupper($data['surname']);
				$password = $data['password'];
        $data['password'] = md5($password);
				$data['password_key'] = base64_encode($password.'_catering');
        $data['is_active'] = 0;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['client_code'] = $this->mdl_clients->getNextIncrementCode()+1;
        $id = $this->mdl_clients->save(null, $data);
        if ($id) {
          $this->load->library('email');
          $subject  = 'Cuenta pendiente de confirmación';
          $message  = 'Hola <b>' . ucfirst($data['name']) . '</b>,<br/><br/>';
          $message .= 'Hemos recibido tu solicitud de registro y se encuentra en proceso de validación. Muy pronto recibirás noticias nuestras.<br/><br/>';
          $emailBody['body'] = $message;
          $this->email->set_mailtype("html");
          //Need to change admin email dynamically
          $this->email->from($this->site_contact->email, 'Gumen-Catering');
          $this->email->to($data['email']); 
          $this->email->subject($subject);
          $body = $this->load->view('layout/emails/password_functions.php',$emailBody, TRUE);
          $this->email->message($body);
          $this->email->send();
        }
        $this->session->set_flashdata('alert_success', lang('register_success'));
        //redirect(PAGE_LANGUAGE);
      } else {
        $this->session->set_flashdata('alert_error', validation_errors());
        redirect(PAGE_LANGUAGE.'/register');
      }
    }
    $data_array = array(
      'list_of_business' => $this->mdl_business->select(['id','name'])->where('is_active', 1)->get()->result_array()
    );
    $this->load->view('layout/templates/register', $data_array);
  }
  
  public function listmenu() {
		
    $data_array = array();
    $this->load->view('layout/templates/listmenu', $data_array);
  }
  /**
   * Function menus
   *
   * @return  void
   * 
  */
  public function menus() {
    $this->load->model('preus/mdl_preus');
		$price_list = $this->mdl_preus->get_price_list($this->session->userdata('Tarifa_id'));
    $menuDate = date('Y-m-d');
    $data_array = array();

		
		$data_array['left_time'] = 0;
		if($this->input->post()) {
			$postParams = $this->input->post();
			$menuDate = date('Y-m-d', strtotime($postParams['menu_date']));
		}

		
    $centre_id = $this->session->userdata('centre_id');
    $centreInfo = $this->mdl_centres->centreInfo($centre_id);
    $menu_list = $this->mdl_menus->get_menus_by_date($menuDate);

    if ($centreInfo && $menuDate == date('Y-m-d') && count($menu_list) > 0) {
    //if ($centreInfo && $menuDate == date('Y-m-d')) {
      $time1 = strtotime($centreInfo->time_limit);
      $time2 = time();
			if($time1 > $time2) {
				$data_array['left_time'] = ($time1 - $time2);
			}
    }
		
		//$data_array['menu_types'] = $this->mdl_menu_types->get()->result_array();
    $data_array['menu_types'] = $this->menu_types;
		
		$data_menu = [];
		
    $show_menus = true;
		$data_array['today_menu_expired'] = false;
		if($data_array['left_time'] == 0 && $menuDate == date('Y-m-d')) {
      //$menuDate == date('Y-m-d')
      //changing to tomorrow day
      //$menuDate = date("Y-m-d", strtotime("+ 1 day"));
      $show_menus = false;
			$data_array['today_menu_expired'] = true;
		}
    

    //No es posible solicitar un menú para el día de hoy debido a haber expirado la hora límite

    $platesId = [];
    $plateIdFields = ['Primer','Segon','Guarnicio','Postre'];
    //Set Regim as key in all menus list.
    foreach($menu_list as $menus) {
      $data_menu[$menus['Regim']][] = $menus;
      foreach ($plateIdFields as $field) {
        $platesId[$menus[$field]] = $menus[$field];
      }
    }
    //echo '<pre>';print_r($menu_list);echo '</pre>';
    if (!$platesId) {
      $data_array['plates'] = [];
    } else {
      $data_array['plates'] = $this->mdl_plats->get_all_plats_by_ids($platesId);  
    }

    
    $data_array['available_dates'] = $this->mdl_menus->get_available_dates();
		$data_array['show_menus'] = $show_menus;
    $data_array['menu_lists'] = $data_menu;
		$data_array['price_list'] = $price_list;
		$data_array['menu_date'] = date('d-m-Y', strtotime($menuDate));


    $this->load->view('layout/templates/menus', $data_array);
  }
	/**
   * Function addMenu
   *
   * @return  void
   * 
  */
  public function addMenu() {
		$post_params = $this->input->post();
    //echo '<pre>'; print_r($post_params); echo '</pre>';
    //exit;
		if($post_params['select_food']) {
			$this->mdl_temporary_orders->insert_temporary_orders($this->input->post());
		}
		if($post_params['is_reload']) {
			redirect(PAGE_LANGUAGE.'/menus');
		}
		redirect(PAGE_LANGUAGE.'/payment');
	}


  public function payment() {
		
		$data_array = array();

    $data_array['business'] = $this->db->where('id', $this->login_client_profile->business_id)->get('business')->row();
    $data_array['menu_titles'] = $this->menu_types;
    $data_array['plates'] = $this->mdl_plats->get_plat_list();
    $data_array['cool_drink_list'] = $this->mdl_drinks->get_cool_drink_list();

    $this->load->view('layout/templates/payment', $data_array);
  }
  /**
   * Function profile
   *
   * @return  void
   * 
   */
  public function profile() {
		
		$client_id = $this->login_client_profile->id;
		if($this->input->post()) {
      $this->load->helper('security');
			if($this->input->post('bill') == 1) {
				$this->mdl_clients->form_validation->set_rules('billing_data', lang('billing_data'), 'required');
			} 
      /*$this->mdl_clients->form_validation->set_rules('dni', lang('dni'), 'required|dni_check');*/
			$this->mdl_clients->form_validation->set_rules('iban', lang('iban'), 'iban_check');
      $this->mdl_clients->form_validation->set_rules('email', lang('email'), 'required|valid_email|edit_unique[clients.email.'.$client_id.']');
			if ($this->mdl_clients->run_validation('validation_rules_clients_profile_update')) {
				$data = $this->input->post();
				$password = $this->input->post('password');
				$data['password'] = md5($password);
				$data['password_key'] = base64_encode($password.'_catering');
				$this->mdl_clients->save($this->login_client_profile->id, $data);
				
				$this->session->set_flashdata('alert_success', lang('success_profile_update'));
				
				redirect(PAGE_LANGUAGE.'/profile');
			}
		}
    $data_array['client'] = $this->mdl_clients->get_client_details_by_id($client_id);
    //print_r($client_details);
		$this->mdl_clients->prep_form($client_id);
    //$data_array = '';
    $this->load->view('layout/templates/profile', $data_array);
		
  }
  /**
   * Function contact
   *
   * @return  void
   * 
   */
  public function contact() {
    $method = strtolower($this->input->method(TRUE));
    if ($method == 'post') {
        $this->load->library('email');
        $this->email->set_mailtype("html");
        $this->email->from($this->input->post('email'), $this->input->post('name'));
        $this->email->to($this->site_contact->email);
        $this->email->subject('Enquiry');
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['message'] = $this->input->post('message');
        $body = $this->load->view('layout/emails/contact_us.php',$data, TRUE);
        $this->email->message($body);
        if ($this->email->send()) {
          $this->session->set_flashdata('alert_success', lang('contact_success'));
        } else {
          $this->session->set_flashdata('alert_fail', lang('server_error'));
        }
        redirect(PAGE_LANGUAGE.'/contact');
    }
		$data_array = '';
    $this->load->view('layout/templates/contact', $data_array);
  }
	/**
   * Function clientPayment
   *
   * @return  void
   * 
   */
  public function clientPayment() {
		
		$disabledMenus = $this->mdl_menus->check_disabled_menus_selected_orders();
		if($disabledMenus) {
			
		}
		
		$this->load->view('layout/templates/orders', $data_array);
  }
	/**
   * Function orders
   *
   * @return  void
   * 
   */
  public function orders() {
    $condition = array('is_active' => 1, 'client_id' => $this->session->userdata('client_id'));
    $config = array(
              'base_url'=>site_url($this->uri->segment(1).'/'.$this->uri->segment(2)),
              'total_rows'=>$this->mdl_orders->get_count_of_orders_pagination($condition),
              'uri_segment'=>3,
              'per_page' => 10
            );
    $data_array["pagination"] = $this->_setAndGetPaginationLinks($config);

    if ($this->uri->segment(3)) {
      $page = $this->uri->segment(3);
    } else {
      $page = 1;
    }

		$data_array['orders'] = $this->mdl_orders->get_orders_by_pagination($page,10,$condition);
		$this->load->view('layout/templates/orders', $data_array);
  }
	/**
   * Function removeOrder
   *
   * @return  Bool
   * 
   */
  public function removeOrder() {
		
		$post_params = $this->input->post();
		
		$this->mdl_temporary_orders->delete($post_params['order_id']);
		
		echo json_encode(array('success' => true, 'message' => 'The order has been succesfully removed.'));exit;
  }
	
	/**
   * Function removeOrder
   *
   * @return  Bool
   * 
   */
  public function orderDetails($reference_no) {
    $data_array = array();

		$data_array['orders'] = $this->mdl_orders->get_orders_by_ref_no($reference_no);

    // Get the discount value.
    /*$qry = $this->db->where('reference_no', $reference_no)->get('discount_applied');
    if($qry->num_rows()){
      $data_array['discount'] = current($qry->result_array());
    }*/
    $this->load->model('discount_applied/mdl_discount_applied');
    $discount = $this->mdl_discount_applied->getDiscountDetailByReferenceNo($reference_no);
    if ($discount) {
      $data_array['discount'] = $discount;
    }

    $data_array['menu_titles'] = $this->menu_types;
    $data_array['plates'] = $this->mdl_plats->get_plat_list();
    $data_array['cool_drink_list'] = $this->mdl_drinks->get_cool_drink_list();
    
		$data_array['reference_no'] = $reference_no;
		
		$this->load->view('layout/templates/order-details', $data_array);
  }
	/**
   * Function Logout
   *
   * @return  void
   * 
   */
  public function checkTodayMenusAndInsert(){
    if(count($this->today_menus_removed) > 0) {
			echo json_encode(array('success' => false, 'msg' => 'Today menus expired', 'menu_ids' => $this->today_menus_removed));
		} else {
			$data = $this->mdl_orders->insert_from_temperory();
			echo json_encode(array('success' => true, 'msg' => 'Order successfully placed', 'data' => $data));
		}
  }
  /**
   * Function Logout
   *
   * @return  void
   * 
   */
  public function logout(){
  	$this->session->sess_destroy();
    redirect(PAGE_LANGUAGE);
  }
  
  /**
	 * Function Password 
	 * Displays the password recovery page
   * 
	 * @return	void
	 */
  public function forgotPassword() {
    $error='';
    $method = strtolower($this->input->method(TRUE));
    if ($method == 'post') {
      if ($this->mdl_clients->run_validation('validation_rules_forgot_password')) {
        $this->load->library('email');
        $data = $this->mdl_clients->resetPasswordCode($this->input->post('email'));
        if ($data) {
          $subject  = 'Reset Password';
          $message  = 'Hola <b>' . ucfirst($data['name']) . '</b>,<br/><br/>';
          $message .= 'Para restablecer su contraseña por favor haga <a href = "' . $data['url'] . '">click aquí.</a>.<br/><br/>';
          $message .= 'Si no puede hacer click, por favor copie y pegue este link en su navegador:<br/>' . $data['url'];
          $message .= '<br/><br/>Le informamos de que estos links estarán disponibles durante 1 hora.';
          $emailBody['body'] = $message;
          $this->email->set_mailtype("html");
          //Need to change admin email dynamically
          $this->email->from($this->site_contact->email, 'Gumen-Catering');
          $this->email->to($data['email']); 
          $this->email->subject($subject);
          $body = $this->load->view('layout/emails/password_functions.php',$emailBody, TRUE);
          $this->email->message($body);
          $this->email->send();
          $this->session->set_flashdata('alert_success', lang('recover_email_success_message'));
          redirect($this->uri->uri_string());
        } else {
          $this->session->set_flashdata('alert_error', lang('invalid_username'));
          redirect($this->uri->uri_string());
        }
      }
    }
    $this->load->view('layout/templates/forgot_password');
  }
  
  /**
	 * Function change password
	 * Displays the password recovery page
   * 
	 * @return	void
	 */
  public function changePassword() {
    $record_num = $this->uri->segment_array();
    $record_num = end($record_num);
    $error = '';
    $decodedString = base64_decode($record_num);
    if (strpos($decodedString, '_') !== false) {
      $currentTime = date('Y-m-d H:i:s');
      list($userEmail, $requestedTime) = explode('_', $decodedString);
      if (strtotime($currentTime) > strtotime($requestedTime)) {
        redirect($this->uri->segment(1));
      }
      else {
        $verifiedUser = current($this->mdl_clients->findByEmail($userEmail));
        if (!$verifiedUser)
          redirect($this->uri->segment(1));
        if ($this->input->post('password')) {
          if ($this->mdl_clients->run_validation('validation_rules_reset_password')) {
            $this->mdl_clients->resetClientPassword($verifiedUser['id'], $this->input->post('password'));
            $this->load->library('email');
            $subject = 'Password Reset Confirmation';
            $message  = 'Hola ' . $verifiedUser['name'] .', <br/><br/>';
            $message .= ' Te confirmamos que tu contraseña ha sido actualizada con éxito. Ya puedes acceder y disfrutar de nuestros menús.<br/><br/>';
            $message .= 'Para cualquier otro problema, por favor, contacte con nosotros vía email a: <a href="mailto:info@gumen-catering.com" target="_blank">info@gumen-catering.com</a>. <br/><br/> ';
             $emailBody['body'] = $message;
            $this->email->set_mailtype("html");
            //Need to change admin email dynamically
            $this->email->from($this->site_contact->email, 'Gumen-Catering');
            $this->email->to($userEmail); 
            $this->email->subject($subject);
            $body = $this->load->view('layout/emails/password_functions.php',$emailBody, TRUE);
            $this->email->message($body);
            $this->email->send();
            $this->session->set_flashdata('alert_success', lang('change_password_success_message'));
            redirect($this->uri->segment(1));
            //redirect($this->uri->uri_string());
          }
        }
      }
    }
    else{
      redirect($this->uri->segment(1));
    }
    $this->load->view('layout/templates/change_password');
  }
  
  /**
	 * Function error
	 * Displays the error page
   * for payment cancellation
   * 
	 * @return	void
	 */
  public function paymentError() {
    //~ $this->load->library('email');
    //~ //$this->email->set_mailtype("html");
    //~ $this->email->from($this->set['site_email'], $this->set['site_title']);
    //~ $this->email->to('bright@proisc.com'); 
    //~ $this->email->subject('Order Confirmation: '.$book_id.' has been rejected');
    //~ $this->email->message('rejected');
    //~ $this->email->send();
    /*return journey end*/
    $reference_no = $this->input->get('cm');
    $this->db->query('delete from tbl_discount_applied where reference_no='.$reference_no);
    $this->load->view('layout/templates/error');
  }
  
  /**
	 * Function success
	 * Displays the success page
   * for payment success
   * 
	 * @return	void
	 */
  public function paymentSuccess() {
    
    $reference_no = $this->input->get('cm');

    if ($this->mdl_orders->referenceNoExists($reference_no,$this->session->userdata('client_id')) == false) {
    	redirect($this->uri->segment(1));
    	exit;
    }

    $this->mdl_orders->setActive($reference_no);

    // Get the to email address based on the payment done by who.
    $emailToAddress = $this->session->userdata('email');
    $businessInfo = $this->mdl_business->businessInfo($this->session->userdata('business_id'));
    $data_array['businessInfo'] = $businessInfo;

    $data_array['client'] = $this->mdl_clients->where('id',$this->session->userdata('client_id'))->get()->result_array();

    $this->load->model('discount_applied/mdl_discount_applied');
    $discount = $this->mdl_discount_applied->getDiscountDetailByReferenceNo($reference_no);
    //print_r($discount); exit;
    if ($discount) {
      $data_array['discount'] = $discount;
    }

    $data_array['orders'] = $this->mdl_orders->get_orders_by_ref_no($reference_no);
    $company_invoice = ($data_array['orders'][0]['payment_method'] == 'Empresa');
    $data_array['menu_titles'] = $this->menu_types;
    $data_array['plates'] = $this->mdl_plats->get_plat_list();
    $data_array['cool_drink_list'] = $this->mdl_drinks->get_cool_drink_list();
    $data_array['reference_no'] = $reference_no;
    $data_array['user_name'] = $this->session->userdata('client_name');
    $this->load->library('email');
    $subject  = 'Pedido Online - '.$reference_no;

    // Generate the invoie pdf
    //$this->load->view('layout/pdf/invoice.php',$data_array); 
    
    /*$pdf = $this->load->view('layout/pdf/invoice.php',$data_array, TRUE);
    $this->load->helper(array('dompdf', 'file'));
    $invoice = pdf_create($pdf, $reference_no, false);*/


    $this->email->set_mailtype("html");
    //Need to change admin email dynamically
    $this->email->from($this->site_contact->email, 'Gumen-Catering');
    $this->email->to($emailToAddress);
    //$this->email->to('jeeva@proisc.com');
    $this->email->subject($subject);
    $body = $this->load->view('layout/emails/payment_success.php',$data_array, TRUE);
    $this->email->message($body);
    if (!$company_invoice) {
      //Commented by JR.
      //$this->email->attach($invoice);
    }
    //$this->email->attach($invoice);
    $this->email->send();
    if (0 && $company_invoice) {
        $invoice_email = $this->load->view('layout/emails/invoice_company.php',$data_array, TRUE);
        $this->email->set_mailtype("html");
        $this->email->from($this->site_contact->email, 'Gumen-Catering');
        $this->email->to($businessInfo->email);
        $this->email->subject($subject);
        //$this->email->attach($invoice);
        $this->email->message($invoice_email);
        $this->email->send();
    }
    $this->load->view('layout/templates/success');
    //$this->load->view('layout/emails/payment_success.php',$data_array);
  }
  
  /**
	 * Function terms
	 * Displays the success page
   * for payment success
   * 
	 * @return	void
	 */
  public function terms() {
    $this->load->model('conditions/mdl_conditions');
    $template_vars['conditions'] = $this->mdl_conditions->get_terms_and_condtions();
    $this->load->view('layout/templates/terms', $template_vars);
  }

  /**
	 * @Function invoiceUsers
	 * Create the pdf for users with in month
   * for payment success
   * @params
   *  	$month                   - Month which is going to generate the pdf for users
   *  	$year                    - Year which is going to generate the pdf for users
   *  	$user_id                 - Unique id for the users.
	 *
	 * @return
	 * 		The generated pdf url.
   * 
	*/
  public function invoiceUsers ($month, $year) {
  	$user_id = $this->session->userdata('client_id');
  	$data_array = [];
    $invoice_no = '';
  	$date = '01-'.$month.'-'.$year;
  	$month_text = date('F', strtotime($date));
  	
  	/*echo "<pre>";
  	print_r($data_array);die;*/
  	$users = $this->mdl_clients->where('id', $user_id)->get()->row();
    $emailToAddress = $users->email;
    $data_array['dni'] = $users->dni;
    //$emailToAddress = 'bright@proisc.com';

    $invoice_date = date("Y-m-d", strtotime($date));
    $invoice = $this->mdl_invoices->getInvoiceUsingDate($invoice_date, 'client');
    $is_create = true;
    $clients_path = 'clients/'.$user_id.'/'.$year.'/'.$month;

    if ($invoice) {
    	$invoice_file_lists = json_decode($invoice->file_name, true);
    	$file_path = 'uploads/temp/'.$clients_path.'/'.$invoice_file_lists[0];
    	if (file_exists($file_path)) {
    		$is_create = true;
    	}
    }


    if ($is_create) {
    	$data_array['orders'] = $this->mdl_orders->get_orders_by_user_month($user_id, $month, $year);
    	$pdf = $this->load->view('layout/pdf/invoice_users.php',$data_array, TRUE);
			$this->load->helper(array('dompdf', 'file'));
			$file_name = $clients_path.'/user_invoice_'.$users->id.'_'.$month.'_'.$year;
			$file_path = pdf_create($pdf, $file_name, false);

      $invoice_no = $this->mdl_invoices->getNewInvoiceNo();
      $data_array['invoice_no'] = $invoice_no;
      $pdf = $this->load->view('layout/pdf/invoice_users.php',$data_array, TRUE);
      $this->load->helper(array('dompdf', 'file'));
      $file_path = pdf_create($pdf, $file_name, false);

			
	    $invoice_data = [ "date_of_invoice" => $invoice_date, "category" => "client", "file_name" => json_encode([ basename($file_path) ]) ];
	    $invoice_no = $this->mdl_invoices->newInvoice($invoice_data);

    }

    $this->load->helper('download');
    force_download($file_path, null);

    /*Email*/
    /*$this->load->library('email');
		$subject  = 'Pedido online orders for the month  '.$month_text.' '.$year;
		$body = "Please find the attached pdf for orders in the month of ".$month_text.' '.$year;
    $this->email->set_mailtype("html");
    //Need to change admin email dynamically
    $this->email->from($this->site_contact->email, 'Gumen-Catering');
    $this->email->to($emailToAddress);
    //$this->email->to('jeeva@proisc.com');
    $this->email->subject($subject);
    $this->email->message($body);
    $this->email->attach($output);
		$this->email->send();*/

		return true;
  }

	/**
	 * @Function invoiceBussiness
	 * Create the pdf for bussiness with in month
   * for payment success
   * @params
   *  	$month                   - Month which is going to generate the pdf for users
   *  	$year                    - Year which is going to generate the pdf for users
   *  	$business_id            - Unique id for the bussiness.
	 *
	 * @return
	 * 		The generated pdf url.
   * 
	*/
  public function invoiceBusiness ($month, $year) {
  	$business_id = $this->session->userdata('business_id');
  	$this->load->library('email');
  	$this->load->helper('download');
  	$this->load->library('zip');
    $invoice_no = $this->mdl_invoices->getNewInvoiceNo();
  	$data_array = [];

  	$business = $this->mdl_business->where('id', $business_id)->get()->row();
    $emailToAddress = $business->email;
    $data_array['nif'] = $business->nif;
    //$emailToAddress = 'bright@proisc.com';

  	//echo "<pre>";
  	$date = '01-'.$month.'-'.$year;
  	$month_text = date('F', strtotime($date));
  	$length = $this->mdl_orders->get_orders_by_business_month_count($business_id, $month, $year);
  	//echo $length;die;
  	$this->load->helper(array('dompdf', 'file'));
  	$file_lists = [];
  	$i = 0;
  	$pdf_limit = PDF_LIMIT;

  	$invoice_date = date("Y-m-d", strtotime($date));
    $invoice = $this->mdl_invoices->getInvoiceUsingDate($invoice_date, 'business');
    $is_create = false;
    $business_path = 'business/'.$business_id.'/'.$year.'/'.$month;

    if ($invoice) {
    	$invoice_file_lists = json_decode($invoice->file_name, true);

    	foreach ($invoice_file_lists as $key => $file) {
    		$file_path = 'uploads/temp/'.$business_path.'/'.$file;
    		if (!file_exists($file_path)) {
	    		$is_create = true;
	    	}
    	}
    } else {
    	$is_create = true;
    }

    if (!$is_create) {
    	foreach ($invoice_file_lists as $key => $file) {
    		$file_path = 'uploads/temp/'.$business_path.'/'.$file;
    		if (file_exists($file_path)) {
    			$file_lists[] = $file_path;
    			$this->zip->read_file($file_path);
	    		//force_download($file_path, null);
	    	}
    	}
    }

    $data_array['invoice_no'] = $invoice_no;

  	if ($is_create) {
	  	if ($length >= $pdf_limit) {
	  		$count = ceil($length/$pdf_limit);
	  		//echo $count;die;
	  		while ($count >= 1) {
	  			$limit = $i + $pdf_limit;
	  			if ($count == 1) {
	  				$limit = $length;
	  			}

	  			/*PDF creation*/
	  			$data_array['orders'] = $this->mdl_orders->get_orders_by_business_month($business_id, $month, $year, $i);
	  			/*echo "<pre>";
	  			print_r($data_array['orders']);die;*/
	  			$pdf = $this->load->view('layout/pdf/invoice_business.php',$data_array, TRUE);		
	  			$file_name = $business_path.'/business_'.$business_id.'_'.$month.'_'.$year.'_'.($i + 1).'_to_'.$limit;
	  			$file_path = pdf_create($pdf, $file_name, false);
	  			$file_lists[] = basename($file_path);

	  			$this->zip->read_file($file_path);

	  			$count--;
	  			$i+=$pdf_limit;
	  		}
	  	} else {

	  		/*PDF creation*/
	  		$data_array['orders'] = $this->mdl_orders->get_orders_by_business_month($business_id, $month, $year, $i);
	  		/*echo "<pre>";
				print_r($data_array['orders']);die;*/
				$pdf = $this->load->view('layout/pdf/invoice_business.php',$data_array, TRUE);		
				$file_name = $business_path.'/business_'.$business_id.'_'.$month.'_'.$year;
				$file_path = pdf_create($pdf, $file_name, false);
				$file_lists[] = basename($file_path);

				$this->zip->read_file($file_path);
				//force_download($file_path, null);
	  	}

	  	$invoice_data = [ "date_of_invoice" => $invoice_date, "category" => "business", "file_name" => json_encode($file_lists) ];
	    $this->mdl_invoices->newInvoice($invoice_data);
	  }

	  // Write the zip file to a folder on your server. Name it "invoice.zip"
		$this->zip->archive('invoice.zip');

		// Download the file to your desktop. Name it "invoice.zip"
		$this->zip->download('invoice.zip');

  	return true;
  }

  /**
   * Function businessInvoice
   *
   * @return  void
   * 
   */
  public function businessInvoice () {
		$data_array['invoice_list'] = $this->mdl_orders->get_business_invoice_monthwise();
    $this->load->view('layout/templates/business-invoice', $data_array);
  }

  /**
   * Function userInvoice
   *
   * @return  void
   * 
   */
  public function userInvoice () {
		$data_array['invoice_list'] = $this->mdl_orders->get_user_invoice_monthwise();
    $this->load->view('layout/templates/user-invoice', $data_array);
  }
}
?>
