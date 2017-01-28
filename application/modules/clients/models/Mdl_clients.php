<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_clients extends Response_Model {
    public $table               = 'clients';
    public $primary_key         = 'clients.id';
    public function default_order_by() {
        $this->db->order_by('clients.id');
    }
  /**
   * Function register
   *
   * @return  void
   * 
   */
    public function validation_rules() {
        return array(
            'client_code' => array(
                'field' => 'client_code',
                'label' => lang('client_code'),
                'rules' => 'required|min_length[4]|is_unique[clients.client_code]'
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
                'rules' => 'required|valid_email'
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
  /**
   * Function validation_rules_clients_login
   *
   * @return  void
   * 
   */
    public function validation_rules_clients_login() {
        return array(
            'username'  => array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'required'
            ),
            'password' => array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required'
            )
        );
    }
  /**
   * Function validation_rules_clients_register
   *
   * @return  void
   * 
   */
		public function validation_rules_client_register() {
        return array(
            'name'  => array(
                'field' => 'name',
                'label' => lang('name'),
                'rules' => 'required'
            ),
            'email'  => array(
                'field' => 'email',
                'label' => lang('email'),
                'rules' => 'required|valid_email'
            ),
            'password' => array(
                'field' => 'password',
                'label' => lang('password'),
                'rules' => 'required'
            ),
            'business' => array(
                'field' => 'client_code',
                'label' => lang('business'),
                'rules' => 'required'
            )
        );
    }
  /**
   * Function register
   *
   * @return  void
   * 
   */
    public function check_clients($data){
			$result = $this->mdl_clients->where(array('email'=>$data['username'], 'password'=>md5($data['password'])))->get()->row();
			if(count($result)>0) {
				foreach($result as $res){
					if($res->is_active == 0) {
							$this->session->set_flashdata('alert_error', 'The given user is inactive. Please check with administrator');
							return false;
					} else {
    				$session_data = array('user_type'	 => $res->role, 'user_id'	 => $res->id, 'user_name' => $res->first_name." ".$res->last_name);
    				$this->session->set_userdata($session_data);
          }
          return true;
				}
			} else {
				$this->session->set_flashdata('alert_error', lang('invalid_credentials'));
				return false;
			}
		}
}
?>
