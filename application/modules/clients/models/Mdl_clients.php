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
                'rules' => 'required|min_length[4]|is_unique[clients.client_code]',
                'errors' => array(
                    'required' => lang('business_error'),
                    'min_length' => lang('minlength_business_error'),
                    'is_unique' => lang('unique_business_error')
                )
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
                'rules' => 'required|valid_email|is_unique[clients.email]',
                'errors' => array(
                    'required' => lang('invalid_email'),
                    'valid_email' => lang('invalid_email'),
                    'is_unique' => lang('email_exists')
                )
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
            'email'  => array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'required'
            ),
            'password' => array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required'
            )
        );
    }

    public function validation_rules_on_register_page() {
        return array(
            'client_code' => array(
                'field' => 'client_code',
                'label' => lang('client_code'),
                'rules' => 'required',
                'errors' => array(
                    'required' => lang('business_error'),
                )
            ),
            'name'  => array(
                'field' => 'name',
                'label' => lang('name'),
                'rules' => 'required'
            ),
            'surname' => array(
                'field' => 'surname',
                'label' => lang('surname'),
                'rules' => 'required'
            ),
            'email' => array(
                'field' => 'email',
                'label' => lang('email'),
                'rules' => 'required|valid_email|is_unique[clients.email]',
                'errors' => array(
                    'required' => lang('invalid_email'),
                    'valid_email' => lang('invalid_email'),
                    'is_unique' => lang('email_exists')
                )
            ),
            'password' => array(
                'field' => 'password',
                'label' => lang('password'),
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
			$result = $this->mdl_clients->where(array('email'=>$data['email'], 'password'=>md5($data['password'])))->get()->row();
			if(count($result)>0) {
				if($result->is_active == 0) {
                	$this->session->set_flashdata('alert_error', lang('in_active_user'));
                	return false;
                } else {
                    $session_data = array(
                        'user_type'	=> $result->role,
                        'user_id'	=> $result->id,
                        'user_name' => ucfirst($result->name)." ".ucfirst($result->surname)
                    );
                    $this->session->set_userdata($session_data);
                }
                return true;
			} else {
				$this->session->set_flashdata('alert_error', lang('invalid_credentials'));
				return false;
			}
		}
}
?>
