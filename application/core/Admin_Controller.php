<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Admin_Controller extends User_Controller {

	public function __construct()
	{
		parent::__construct('user_type');
		if ($this->router->class !== 'routes' && $this->session->userdata('methodFrom')){
			$this->session->unset_userdata('methodFrom');
		}
		elseif ($this->router->class == 'routes' && !in_array($this->router->method, array('view','delete','form'))) {
			$this->session->unset_userdata('methodFrom');
		}
	}

}

?>
