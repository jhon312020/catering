<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_centres extends Response_Model {
    public $table               = 'centres';
    public $primary_key         = 'centres.id';
    public function default_order_by() {
        $this->db->order_by('centres.id');
    }
    public function validation_rules() {
        return array(
            'name' => array(
                'field' => 'name',
                'label' => lang('name'),
                'rules' => 'required'
            ),
            /*'email' => array(
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
            ),*/
        );
    }
		
    
    
    public function getByBusinessId($businessId = null) {
        $centres = $this->mdl_centres
                                ->select('centres.id, centres.Centre, centres.Ruta, centres.NomRuta, centres.Domicili, centres.CPostal, centres.Poblacio, centres.time_limit')
                                ->where('centres.bussiness_id', $businessId)->get()->result();
        if($centres)
        	return $centres;
        else
        	return false;
    }
}
?>
