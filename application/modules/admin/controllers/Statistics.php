<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Statistics extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('menus/mdl_menus');
		$this->load->model('menu_types/mdl_menu_types');
	}
	public function index() {
		$menu_types = $this->mdl_menu_types->get()->result();
		$menus = array();
		foreach($menu_types as $menu_type) {
			$total = $this->mdl_menus->where('menu_type_id', $menu_type->id)->get()->num_rows();
			$menus[$menu_type->id] = array('name' => $menu_type->menu_name, 'total' => $total);
		}
		$overall_total_menus = $this->mdl_menus->get()->num_rows();
		$this->layout->set(array('menus' => $menus, 'overall_total_menus' => $overall_total_menus));
		$this->layout->buffer('content', 'statistics/index');
		$this->layout->render();
	}
}