<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_menus extends Response_Model {
    public $table               = 'menus';
    public $primary_key         = 'menus.id';
    public function default_order_by() {
        $this->db->order_by('menus.id');
    }
    public function validation_rules() {
        return array(
            'Guarnicio' => array(
                'field' => 'Guarnicio',
                'label' => lang('complement'),
                'rules' => 'required'
            ),
            'Primer' => array(
                'field' => 'Primer',
                'label' => lang('primary_plate'),
                'rules' => 'required'
            ),
						
						/* 'primary_image' => array(
                'field' => 'primary_image',
                'label' => lang('primary_image'),
                'rules' => 'required'
            ), */
            'Segon' => array(
                'field' => 'Segon',
                'label' => lang('secondary_plate'),
                'rules' => 'required'
            ),
						/* 'secondary_image' => array(
                'field' => 'secondary_image',
                'label' => lang('secondary_image'),
                'rules' => 'required'
            ), */
						'Postre' => array(
                'field' => 'Postre',
                'label' => lang('postre'),
                'rules' => 'required'
            ),
						'half_price' => array(
                'field' => 'half_price',
                'label' => lang('half_price'),
                'rules' => 'required|numeric'
            ),
						'full_price' => array(
                'field' => 'full_price',
                'label' => lang('full_price'),
                'rules' => 'required|numeric'
            ),
        );
    }
		/**
   * Function get_menus_by_date
   *
   * @return  Array
   * 
  */
		public function get_menus_by_date($date) {
			$menus_by_date = $this->mdl_menus->where(array('menu_date' => $date, 'disabled' => 0))->order_by("id", "desc")->get()->result_array();
			
			return $menus_by_date;
		}
		/**
   * Function get_menu_by_id
   *
   * @return  Array
   * 
  */
		public function get_menu_by_id($id) {
			$menu_by_id = $this->mdl_menus->where(array('id' => $id))->get()->row();
			
			return $menu_by_id;
		}
  /**
   * Function getClientOrders
   * 
   * 
   * 
   */
  public function getClientOrders() {
    $clientId = $this->session->userdata('client_id');
    $this->mdl_menus->select('SUM(total) AS price');
    $this->mdl_menus->where('`id` NOT IN (SELECT `menu_id` FROM `tbl_temporary_orders` WHERE `client_id` ='.$clientId.')', NULL, FALSE);
    echo $this->mdl_menus->get();
    echo $this->db->last_query();
    exit;											
    return $today_menus;
  }


  /**
   * Function get_available_dates
   *
   * @return  Array
   * 
  */
    public function get_available_dates() {
      $menus_by_date = $this->mdl_menus->select('menu_date')->where(array('menu_date >= ' => date('Y-m-d'), 'disabled' => 0))->get()->result_array();
      $dates = [];
      foreach ($menus_by_date as $menu_date) {
        $dates[] = $menu_date['menu_date'];
      }
      return $dates;
    }

	/**
   * Function getClientOrders
   * 
   * 
   * 
   */
  public function clone_menus($selected_menu_date, $update_clone_date) {
		$today = date('Y-m-d');
		$where = "menu_date = '$selected_menu_date'";
		$this->db->query("DROP TABLE IF EXISTS tbl_tmp;");
    $this->db->query("CREATE TABLE tbl_tmp SELECT * from tbl_menus WHERE ( " . $where . " );");
    $this->db->query("ALTER TABLE tbl_tmp drop id;");
    $this->db->query("UPDATE tbl_tmp SET menu_date = '$update_clone_date', created_at='$today';");
    $this->db->query("INSERT INTO tbl_menus SELECT 0,tbl_tmp.* FROM tbl_tmp; ");
    $this->db->query("DROP TABLE tbl_tmp;");
	}

  /**
   * Function update_all_records
   *
   * @return  Bool
   * 
  */
  public function update_all_records($records) {
    if ($records) {
      foreach ($records as $record) {
        $this->mdl_menus->save($record['id'],$record);
      }
    }
    return true;
  }

}
?>
