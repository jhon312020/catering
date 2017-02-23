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

	public function _findMenuType($order_code) {
		$order_code = explode(',',$order_code);
		$menu_type = '';
		switch (count($order_code)) {
			case 0:
				break;
			case 1:
				switch ($order_code[0]) {
					case 'N':
						$menu_type = lang('basic_menu');
						break;
					case 'R':
						$menu_type = lang('diet_menu');
						break;
					default:
						$menu_type = lang('medio_menu');
				}
				break;
			default:
				$order_code = array_unique($order_code);
				if (!in_array('N1', $order_code) && !in_array('N2', $order_code)) {
					$menu_type = lang('diet_menu');
				} elseif (!in_array('R1', $order_code) && !in_array('R2', $order_code)) {
					$menu_type = lang('basic_menu');
				} else {
					$menu_type = lang('combine_menu');
				}
		}
		return $menu_type;
	}

}

?>
