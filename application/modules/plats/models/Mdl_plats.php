<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_plats extends Response_Model {
    public $table               = 'plats';
    public $primary_key         = 'plats.Id';
    public function default_order_by() {
        $this->db->order_by('plats.Id');
    }
    public function validation_rules() {
        return array(
            'Plat' => array(
                'field' => 'Plat',
                'label' => lang('name'),
                'rules' => 'required'
            ),
            'OrdrePlat' => array(
                'field' => 'OrdrePlat',
                'label' => lang('internal_code'),
                'rules' => 'required'
            ),
			'Ingredients' => array(
                'field' => 'Ingredients',
                'label' => lang('description'),
                'rules' => 'required'
            ),
			/*'image' => array(
                'field' => 'image',
                'label' => lang('image'),
                'rules' => 'required'
            ),*/
           
        );
    }
    /**
    * Function get_menus_by_date
    *
    * @return  Array
    * 
    */
    public function get_all_plats() {
        $plates = $this->mdl_plats->limit(10, 1)->get()->result();
        return $plates;
    }
    
    /**
    * Function get_by_id
    *
    * @return  Array
    * 
    */
    public function get_by_id($id = NULL) {
        $plate = $this->mdl_plats->select('image')->where('id', $id)->get()->row();
        return $plate;
    }    

    /**
    * Function get_by_id
    *
    * @return  Array
    * 
    */
	public function get_by_id1($id = NULL) {
		$plate = $this->mdl_plats->select('image')->where('id', $id)->get()->row();
		return $plate;
	}

    /**
    * Function get_plat_list
    *
    * @return  Array
    * 
    */
    public function get_plat_list() {
        $plates = $this->mdl_plats->select("select Id, Plat")->get()->result_array();
        $allPlates = [];
        foreach ($plates as $plate) {
            $allPlates[$plate['Id']] = $plate['Plat'];
        }
        return $allPlates;
    }

}
?>
