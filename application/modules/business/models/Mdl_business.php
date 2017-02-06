<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_business extends Response_Model {
    public $table               = 'business';
    public $primary_key         = 'business.id';
    public function default_order_by() {
        $this->db->order_by('business.id');
    }
    public function validation_rules() {
        return array(
            'name' => array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ),
            'email' => array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ),
						'direction' => array(
                'field' => 'direction',
                'label' => 'Direction',
                'rules' => 'required'
            ),
            'telephone' => array(
                'field' => 'telephone',
                'label' => 'Telephone',
                'rules' => 'required|is_numeric'
            ),
						'contact_person' => array(
                'field' => 'contact_person',
                'label' => 'Contact person',
                'rules' => 'required'
            ),
						'hours' => array(
                'field' => 'hours',
                'label' => 'Hours',
                'rules' => 'required'
            ),
						'minutes' => array(
                'field' => 'minutes',
                'label' => 'Minutes',
                'rules' => 'required'
            ),
        );
    }
		public function email_exists($email) {
			$qry = $this->db->where('email', $email)->get('business');
			if($qry->num_rows())
				return true;
			else
				return false;
		}
    
    
		public function businessInfo($businessId) {
			$qry = $this->db->where('id', $businessId)->get('business');
			if($qry->num_rows())
				return $qry->row();
			else
				return false;
		}
}
?>
