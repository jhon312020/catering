<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class User_Controller extends Base_Controller {

	public function __construct($required_key)
	{
		parent::__construct();
		$this->load->helper('comman_helper');
		$allowWithLogin = array('getPlaces');
		$allowed_roles = array('1', '6');
		$role = $this->session->userdata($required_key);
		if (!in_array($role, $allowed_roles) && !in_array($this->router->method, $allowWithLogin))
		{
			redirect('sessions/login');
		}
		if($role == 6) {
			$router_method = $this->router->method;
			$router_class = $this->router->class;
			$class = array('dashboard', 'shuttles', 'clients', 'collaborators', 'routes');
			$method = array('calendar', 'calendarForm', 'calendarView', 'calendarToggle', 'calendarDelete', 'carChannel', 'carView', 'carForm', 'carToggle', 'carDelete');
			if(!in_array($router_class, $class))
				redirect('admin/dashboard');
			if($router_class == 'routes') {
				if(!in_array($router_method, $method))
					redirect('admin/dashboard');
			}
		}
	}

}

?>
