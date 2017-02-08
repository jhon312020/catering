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
		
		/* echo "<pre>";
		print_r($cool_drinks);die; */
		
		$this->today_menus_removed = [];
		
		/*Check and remove the expired data from the temperory order table*/
		$business_id = $this->session->userdata('business_id');
		
		$businessInfo = $this->mdl_business->businessInfo($business_id);
		
		$left_time = 0;
		
    if ($businessInfo) {
      $time1 = strtotime($businessInfo->time_limit);
			
      $time2 = time();
			
			if($time1 > $time2) {
				$left_time = ($time1 - $time2);
			}
    }
		if($left_time == 0) {
			$menus = $this->mdl_menus->select('id')->where('menu_date', date('Y-m-d'))->get()->result_array();
			$menus_id = array_column($menus, 'id');
			
			$selectedMenusIds = array_keys($todaySelectedMenus);
			
			$menusExists = array_intersect($menus_id, $selectedMenusIds);
			
			if(count($menusExists) > 0) {
				$this->today_menus_removed = $menusExists;
				$this->mdl_temporary_orders->order_delete($menusExists);
			}
		}

		$this->load->vars(array('todaySelectedMenus'=> $todaySelectedMenus, 'login_client_profile' => $this->login_client_profile, 'totalCartItems'=>$totalCartItems, 'cool_drinks' => $cool_drinks, 'user_info'=>$this->session->get_userdata(), 'today_menus_removed' => $this->today_menus_removed));
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
				redirect(PAGE_LANGUAGE.'/profile');
			} else {
				redirect(PAGE_LANGUAGE);
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
				$password = $data['password'];
        $data['password'] = md5($password);
				$data['password_key'] = base64_encode($password.'_catering');
        $data['is_active'] = 0;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $id = $this->mdl_clients->save(null, $data);
        $this->session->set_flashdata('alert_success', lang('record_successfully_created'));
        redirect(PAGE_LANGUAGE);
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
		
		$menuDate = date('Y-m-d');
    $data_array = array();
		$business_id = $this->session->userdata('business_id');
    $businessInfo = $this->mdl_business->businessInfo($business_id);
		//echo $businessInfo->time_limit;die;
		//echo time();die;
		$data_array['left_time'] = 0;
		if($this->input->post()) {
			$postParams = $this->input->post();
			
			$menuDate = date('Y-m-d', strtotime($postParams['menu_date']));
		}
		$menu_list = $this->mdl_menus->get_menus_by_date($menuDate);
		//print_r($menu_list);die;
    //print_r($businessInfo);die;
    if ($businessInfo && $menuDate == date('Y-m-d') && count($menu_list) > 0) {
      $time1 = strtotime($businessInfo->time_limit);
      //echo date('d/m/Y H:i', $time1 );
      //echo '<br/>';
      $time2 = time();
      //echo date('d/m/Y H:i', $time2 );
      //echo '<br/>';
			if($time1 > $time2) {
				$data_array['left_time'] = ($time1 - $time2);
			}
       //echo date('d/m/Y H:M:S', $data_array['left_time'] );
    }
		//echo $data_array['left_time'];die;
		
		$data_array['menu_types'] = $this->mdl_menu_types->get()->result_array();
		
		$data_menu = [];
		
		$show_menus = true;
		if($data_array['left_time'] == 0 && $menuDate == date('Y-m-d')) {
			$show_menus = false;
		}
		//echo $data_array['left_time'];die;
		if($show_menus) {
			//Set menu_type_id as key in all menus list.
			foreach($menu_list as $menus) {
				$data_menu[$menus['menu_type_id']][] = $menus;
			}
		}
		
		
		$data_array['menu_lists'] = $data_menu;
		//print_r($data_array['menu_lists']);die;
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
		
		/* echo "<pre>";
		print_r($this->input->post());die; */
		
		$post_params = $this->input->post();
		
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
			if($this->input->post('bill') == 1) {
				$this->mdl_clients->form_validation->set_rules('billing_data', lang('billing_data'), 'required');
			} 
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
		$this->mdl_clients->prep_form($client_id);
    $data_array = '';
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
        $this->email->from($this->input->post('email'), $this->input->post('name'));
        $this->email->to($this->settings['site_email']); 
        $this->email->subject('Enquiry');
        $this->email->message($this->input->post('description'));
        if ($this->email->send()) {
          $this->session->set_flashdata('alert_success', lang('email_send'));
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
		$data_array['orders'] = $this->mdl_orders->get_orders_by_client_date();
		//print_r($data_array['orders']);die;
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

		$data_array['orders'] = $this->mdl_orders->get_orders_by_ref_no($reference_no);
		
		//print_r($data_array['orders']);die;
		
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
          $subject  = 'Change Password';
          $message  = 'Hi <b>' . ucfirst($data['name']) . '</b>,<br/><br/>';
          $message .= 'To change your current password <a href = "' . $data['url'] . '">click here</a>.<br/><br/>';
          $message .= 'If your not able click on it, kindly copy the below link<br/>' . $data['url'] . '<br/> and paste it on the new tab.<br/><br/>';
          echo $message .= 'For your information the above links will be valid for only 1 hour.';
          $this->email->set_mailtype("html");
          //Need to change admin email dynamically
          $this->email->from('admin@catering.com', 'Reset password');
          $this->email->to($data['email']); 
          $this->email->subject($subject);
          $this->email->message($message);
          $this->email->send();
          $this->session->set_flashdata('alert_success', lang('recover_email_success_message'));
          //redirect($this->uri->uri_string());
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
            $message  = 'Hello ' . $verifiedUser['first_name'] .' <br/><br/>';
            $message .= ' This is to confirm that login password for your account has been successfully changed. <br/><br/>';
            $message .= 'For security reasons, we do not send any account information to your email address. For any support related issues, please email us and one of our customer care executive will get back to you as early as possible. <br/><br/> ';
            $this->email->set_mailtype("html");
            $this->email->from($this->set['site_email'], 'Change password');
            $this->email->to($userEmail); 
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
            //redirect($this->uri->segment(1));
            $this->session->set_flashdata('alert_success', lang('change_password_success_message'));
            redirect($this->uri->uri_string());
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
    //~ $this->load->library('email');
    //~ //$this->email->set_mailtype("html");
    //~ $this->email->from($this->set['site_email'], $this->set['site_title']);
    //~ $this->email->to('bright@proisc.com'); 
    //~ $this->email->subject('Order Confirmation: '.$book_id.' has been rejected');
    //~ $this->email->message('rejected');
    //~ $this->email->send();
    /*return journey end*/
    $this->load->view('layout/templates/success');
  }
}
?>
