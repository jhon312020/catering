<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_bcnareas_address extends Response_Model {

    public $table               = 'bcnareas_address';
    public $primary_key         = 'bcnareas_address.id';
    //public $date_created_field  = 'date_created';
    //public $date_modified_field = 'date_modified';

    

    public function default_order_by() {
        $this->db->order_by('bcnareas_address.id');
    }

    public function validation_rules() {
        return array(
            'postal_code' => array(
                'field' => 'postal_code',
                'label' => 'Area Name',
                'rules' => 'required'
            ),
            'bcnarea_id' => array(
                'field' => 'bcnarea_id',
                'label' => 'Bcnarea id',
                'rules' => 'required'
            )
        );
    }
	public function is_exists_postalcode($code) {
		$qry = $this->db->where('postal_code', $code)->get('bcnareas_address');
		if($qry->num_rows())
			return true;
		else
			return false;
	}

}

?>
