<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_clients extends Response_Model {
    public $table               = 'clients';
    public $primary_key         = 'clients.id';
    public function default_order_by() {
        $this->db->order_by('clients.id');
    }
    public function validation_rules() {
        return array(
            'client_code' => array(
                'field' => 'client_code',
                'label' => lang('client_code'),
                'rules' => 'required'
            ),
            'name' => array(
                'field' => 'name',
                'label' => lang('name'),
                'rules' => 'required'
            ),
						'surname' => array(
                'field' => 'surname',
                'label' => lang('surname'),
                'rules' => 'required'
            ),
            'business_id' => array(
                'field' => 'business_id',
                'label' => lang('business'),
                'rules' => 'required'
            ),
						'email' => array(
                'field' => 'email',
                'label' => lang('email'),
                'rules' => 'required'
            ),
						'password' => array(
                'field' => 'password',
                'label' => lang('password'),
                'rules' => 'required'
            ),
						'telephone' => array(
                'field' => 'telephone',
                'label' => lang('telephone'),
                'rules' => 'required|numeric'
            ),
						'dni' => array(
                'field' => 'dni',
                'label' => lang('dni'),
                'rules' => 'required'
            ),
						'intolerances' => array(
                'field' => 'intolerances',
                'label' => lang('intolerances'),
                'rules' => 'required'
            ),
						'iban' => array(
                'field' => 'iban',
                'label' => lang('iban'),
                'rules' => 'required'
            ),
						'bill' => array(
                'field' => 'bill',
                'label' => lang('bill'),
                'rules' => 'required'
            ),
						'billing_data' => array(
                'field' => 'billing_data',
                'label' => lang('billing_data'),
                'rules' => 'required'
            ),
        );
    }
}
?>