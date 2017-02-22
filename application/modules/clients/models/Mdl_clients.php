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
            /* 'client_code' => array(
                'field' => 'client_code',
                'label' => lang('client_code'),
                'rules' => 'required|min_length[4]|is_unique[clients.client_code]',
                'errors' => array(
                    'required' => lang('business_error'),
                    'min_length' => lang('minlength_business_error'),
                    'is_unique' => lang('unique_business_error')
                )
            ), */
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
            /* 'email' => array(
                'field' => 'email',
                'label' => lang('email'),
                'rules' => 'required|valid_email|is_unique[clients.email]',
                'errors' => array(
                    'required' => lang('invalid_email'),
                    'valid_email' => lang('invalid_email'),
                    'is_unique' => lang('email_exists')
                )
            ), */
            'password' => array(
                'field' => 'password',
                'label' => lang('password'),
                'rules' => 'required'
            ),
            /*'telephone' => array(
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
            ),*/
        );
    }
		/**
   * Function validation_rules_clients_profile_update
   *
   * @return  void
   * 
   */
		public function validation_rules_clients_profile_update() {
        return array(
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
            'client_business_name' => array(
                'field' => 'client_business_name',
                'label' => lang('client_business_name'),
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
  public function validation_rules_forgot_password()
  {
    return array(
        'email'  => array(
            'field' => 'email',
            'label' => 'username',
            'rules' => 'required|valid_email'
        ),
    );
  }
  public function validation_rules_reset_password()
  {
      return array(
        'password'  => array(
            'field' => 'password',
            'label' => lang('password'),
            'rules' => 'required'
        ),
        'confirm_password' => array(
            'field' => 'confirm_password',
            'label' => lang('confirm_password'),
            'rules' => 'required|matches[password]'
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
			//print_r($result);die;
			if(count($result)>0) {
				if($result->is_active == 0) {
                	$this->session->set_flashdata('alert_error', lang('in_active_user'));
                	return false;
                } else {
                    $session_data = array(
                        'client_id'	=> $result->id,
                        'client_name' => ucfirst($result->name)." ".ucfirst($result->surname),
                        'business_id' => $result->business_id,
                        'centre_id' => $result->centre_id
                    );
                    $this->session->set_userdata($session_data);
                }
                return true;
			} else {
				$this->session->set_flashdata('alert_error', lang('invalid_credentials'));
				return false;
			}
		}
		/**
   * Function check if the login clients session.
   *
   * @return  Bool
   * 
   */
    public function is_login_clients() {
			$session = $this->session->get_userdata();
			
			if(isset($session['client_id'])) {
				return true;
			} else {
				return false;
			}
		}
		
		/**
   * Function check if the login clients session.
   *
   * @return  Bool
   * 
   */
    public function get_client_details_by_id($id) {
			
			$client_details_by_id = $this->mdl_clients
																		->select('clients.id, clients.client_code, clients.name, clients.surname, clients.business_id, clients.email, clients.password, clients.telephone, clients.dni, clients.intolerances, clients.iban, clients.bill, clients.billing_data, business.name as business_name, clients.password_key, clients.bill')
																		->join('business', 'business.id = clients.business_id', 'left')
																		->where('clients.id', $id)->get()->row();
			
			return $client_details_by_id;
		}
			/**
   * Function get_pending_clients.
   *
   * @return  Array
   * 
   */
    public function get_pending_clients() {
			
			$pending_clients = $this->mdl_clients
																	->select('clients.id, clients.client_code, clients.name, clients.surname, clients.business_id, clients.email, clients.password, clients.telephone, clients.dni, clients.intolerances, clients.iban, clients.bill, clients.billing_data, clients.is_active, clients.created_at, clients.updated_at, business.name as business')
																	->join('business', 'business.id = clients.business_id', 'left')
																	->where('clients.is_active', 0)
																	->get()->result();
			
			return $pending_clients;
		}
  /**
   * Function get_active_clients.
   *
   * @return  Array
   * 
   */
    public function get_active_clients() {
			
			$active_clients = $this->mdl_clients
															->select('clients.id, clients.client_code, clients.name, clients.surname, clients.business_id, clients.email, clients.password, clients.telephone, clients.dni, clients.intolerances, clients.iban, clients.bill, clients.billing_data, clients.is_active, clients.created_at, clients.updated_at, business.name as business')
															->join('business', 'business.id = clients.business_id', 'left')
															->where('clients.is_active', 1)
															->get()->result();
			
			return $active_clients;
		}
  
  /**
	 * Function resetPasswordCode
	 * Finds the user by email
   * and then generates a hash string
   * 
	 * @return	void
	 */  
  public function resetPasswordCode($email) {
		$query = $this->db->select('*')->from('clients')->where(array('email'=>$email))->get();
		if($query->num_rows()) {
      $result = current($query->result_array());
      $hashString = base64_encode($result['email'] . '_' . date('Y-m-d H:i:s', strtotime('+1 hour')));
			$fullUrl = str_replace('/forgot_password', '/change_password', current_url()).'/'.str_replace('=', '', $hashString);
			$result['url'] = $fullUrl;
      return $result;
		}
		return false;
	}
 
  /**
	 * Function findByEmail
	 * Finds the user by given
   * email address
   * 
	 * @return	void
	 */
  public function findByEmail($email) {
		$query = $this->db->select('*')->from('clients')->where(array('email'=>$email))->get();
		if($query->num_rows()) {
      return $query->result_array();
		}
		return false;
	}
  
  /**
	 * Function resetClientpassword
	 * Resets the client password
   * 
	 * @return	void
	 */
  public function resetClientPassword($user_id, $password) {
      $this->db->where('id', $user_id);
      $this->db->set(array('password'=>md5($password), 'password_key' => base64_encode($password.'_catering')));
      $this->db->update('clients');
  }

  public function getNextIncrementCode(){
    $result = $this->db->select('max(client_code) as client_code')->from('clients')->get()->result_array();
    if ($result) {
      return $result[0]['client_code'];
    }
    return 0;
  }

}
?>
