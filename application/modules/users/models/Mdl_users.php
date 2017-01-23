<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mdl_Users extends Response_Model {

    public $table               = 'users';
    public $primary_key         = 'users.id';
    public $date_created_field  = 'created';
    //public $date_modified_field = 'user_date_modified';

    public function user_types()
    {
        // Dont change the order of user types
        return array(
            '1' => lang('administrator'),
            '2' => lang('collaborator'),
            '3' => lang('guest_read_only'),
            '4' => lang('client'),
            '5' => lang('driver'),
			'6' => lang('editor')
        );
    }

    public function default_order_by()
    {
        $this->db->order_by('users.id');
    }

    public function validation_rules()
    {
        return array(
            'role'      => array(
                'field' => 'role',
                'label' => lang('user_type'),
                'rules' => 'required'
            ),
            'email'     => array(
                'field' => 'email',
                'label' => lang('email'),
                'rules' => 'required|valid_email'
            ),
            'first_name'      => array(
                'field' => 'first_name',
                'label' => lang('first_name'),
                'rules' => 'required'
            ),
            'last_name'      => array(
                'field' => 'last_name',
                'label' => lang('last_name'),
                'rules' => 'required'
            ),
            'password'  => array(
                'field' => 'password',
                'label' => lang('password'),
                'rules' => 'required'
            ),
            'user_passwordv' => array(
                'field' => 'user_passwordv',
                'label' => lang('verify_password'),
                'rules' => 'required|matches[password]'
            ),
            /*'user_address_1' => array(
                'field' => 'user_address_1'
            ),
            'user_address_2' => array(
                'field' => 'user_address_2'
            ),
            'user_city'      => array(
                'field' => 'user_city'
            ),
            'user_state'     => array(
                'field' => 'user_state'
            ),
            'user_zip'       => array(
                'field' => 'user_zip'
            ),
            'user_country'   => array(
                'field' => 'user_country'
            ),
            'user_phone'     => array(
                'field' => 'user_phone'
            ),
            'user_fax'       => array(
                'field' => 'user_fax'
            ),
            'user_mobile'    => array(
                'field' => 'user_mobile'
            ),
            'user_web'       => array(
                'field' => 'user_web'
            )*/
        );
    }

    public function validation_rules_existing()
    {
        return array(
            'role'      => array(
                'field' => 'role',
                'label' => lang('user_type'),
                'rules' => 'required'
            ),
            'email'     => array(
                'field' => 'email',
                'label' => lang('email'),
                'rules' => 'required|valid_email'
            ),
            'first_name'      => array(
                'field' => 'first_name',
                'label' => lang('first_name'),
                'rules' => 'required'
            ),
            'last_name'      => array(
                'field' => 'last_name',
                'label' => lang('last_name'),
                'rules' => 'required'
            ),
            /*'user_address_1' => array(
                'field' => 'user_address_1'
            ),
            'user_address_2' => array(
                'field' => 'user_address_2'
            ),
            'user_city'      => array(
                'field' => 'user_city'
            ),
            'user_state'     => array(
                'field' => 'user_state'
            ),
            'user_zip'       => array(
                'field' => 'user_zip'
            ),
            'user_country'   => array(
                'field' => 'user_country'
            ),
            'user_phone'     => array(
                'field' => 'user_phone'
            ),
            'user_fax'       => array(
                'field' => 'user_fax'
            ),
            'user_mobile'    => array(
                'field' => 'user_mobile'
            ),
            'user_web'       => array(
                'field' => 'user_web'
            )*/
        );
    }

    public function validation_rules_change_password()
    {
        return array(
            'password'  => array(
                'field' => 'password',
                'label' => lang('password'),
                'rules' => 'required'
            ),
            'user_passwordv' => array(
                'field' => 'user_passwordv',
                'label' => lang('verify_password'),
                'rules' => 'required|matches[password]'
            )
        );
    }
	public function validation_rules_change_password_setting()
    {
        return array(
            'user_password' => array(
                'field' => 'user_password',
                'label' => lang('verify_password'),
                'rules' => 'required'
            )
        );
    }
	public function validation_rules_collaborators_login()
    {
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
	public function validation_rules_password_recovery()
    {
        return array(
            'username'  => array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'required'
            ),
        );
    }
    public function validation_rules_changepassword()
    {
        return array(
            /*'oldpassword'  => array(
                'field' => 'oldpassword',
                'label' => 'oldpassword',
                'rules' => 'required'
            ),*/
            'newpassword'  => array(
                'field' => 'newpassword',
                'label' => 'newpassword',
                'rules' => 'required'
            ),
            'user_passwordv' => array(
                'field' => 'user_passwordv',
                'label' => lang('verify_password'),
                'rules' => 'required|matches[newpassword]'
            )
        );
    }
	public function check_collaborators($data){
		$result = $this->db->select('users.role,users.id,users.first_name,users.last_name,collaborators.is_active')
                            ->join('collaborators', 'collaborators.id=users.collaborator_id', 'left')
                            ->from('users')                            
                            ->where(array('users.role'=>2, 'users.email'=>$data['username'], 'users.password' => md5($data['password'])))->get()->result();
		if(count($result)>0){
			foreach($result as $res){
                if($res->is_active == 0) {
                    $this->session->set_flashdata('alert_error', 'The given user is inactive. Please check with administrator');
                    return false;
                } else {
    				$session_data = array(
    					'user_type'	 => $res->role,
    					'user_id'	 => $res->id,
    					'user_name' => $res->first_name." ".$res->last_name,
    				);
    				$this->session->set_userdata($session_data);
                }
                return true;
			}
		} else {
            $this->session->set_flashdata('alert_error', lang('invalid_credentials'));
            return false;
        }
	}
    public function check_drivers($data){
        /*$result = $this->db->select('users.role,users.id,users.first_name,users.last_name,cars.is_active')
                            ->join('cars', 'cars.id=users.car_id', 'left')
                            ->from('users')                            
                            ->where(array('users.role'=>5, 'users.email'=>$data['username'], 'users.password' => md5($data['password'])))->get()->result();*/
        $result = $this->db->select('*')->from('users')->where(array('role'=>5, 'email'=>$data['username'], 'password' => md5($data['password']),'is_active'=>1))->get()->result();
        if(count($result)>0){
            foreach($result as $res){
                $session_data = array(
                    'user_type'  => $res->role,
                    'user_id'    => $res->id,
                    'user_name' => $res->first_name." ".$res->last_name,
                );
                $this->session->set_userdata($session_data);
            }
            return true;
        }
        return false;
    }
	public function password_recovery($data){
		$role = array('clients'=>4, 'collaborators'=>2, 'drivers'=>5);
		$query = $this->db->select('*')->from('users')->where(array('role'=>$role[$data['type']],'email'=>$data['username'], 'is_active'=>1))
						->get();
		if($query->num_rows()){
			$result = current($query->result_array());
			$hashString = base64_encode($result['email'] . '_' . date('Y-m-d H:i:s', strtotime('+1 hour')));
			$fullUrl = str_replace('/recovery_password', '/change_password', current_url()).'/'.str_replace('=', '', $hashString);
			$result['url'] = $fullUrl;
			$this->session->set_flashdata('alert_success', 'You have received the mail for the given mail id');
			return $result;
		}
		return false;
	}
	public function findByEmail($email, $type){
		$role = array('clients'=>4, 'collaborators'=>2, 'drivers'=>5);
		$query = $this->db->select('*')->from('users')->where(array('role'=>$role[$type], 'email'=>$email, 'is_active'=>1))->get();
		if($query->num_rows())
			return $query->result_array();
		
		return false;
	}
    public function findByPassword($password){
        $query = $this->db->select('*')->from('users')->where(array('id'=>$this->session->userdata('user_id'), 'password'=>md5($password)))->get();
        if($query->num_rows()){
            return true;
        } else {
            $this->session->set_flashdata('alert_error', 'You have entered the wrong password');
            return false;
        }
        

    }
    public function db_array()
    {
        $db_array = parent::db_array();

        if (isset($db_array['user_password']))
        {
            unset($db_array['user_passwordv']);
            $db_array['user_password'] = md5($db_array['user_password']);
        }

        return $db_array;
    }

    public function save_change_password($user_id, $password)
    {
        $this->db->where('id', $user_id);
        $this->db->set(array('password'=>md5($password), 'secret_key' => base64_encode($password.'_pickngo')));
        $this->db->update('users');

        $this->session->set_flashdata('alert_success', 'Password Successfully Changed');
    }
    public function save_changepassword($password)
    {
        $this->db->where('id', $this->session->userdata('user_id'));
        $this->db->set(array('password'=>md5($password), 'secret_key' => base64_encode($password.'_pickngo')));
        $this->db->update('users');

        $this->session->set_flashdata('alert_success', 'Password Successfully Changed');
    }
    
    public function save($id = NULL, $db_array = NULL)
    {
        $id = parent::save($id, $db_array);
        return $id;
    }
	public function user_exists($username) {
		$qry = $this->db->where('email', $username)->get('users');
		if($qry->num_rows())
			return true;
		else
			return false;
	}
	public function getEditorDetails() {
		$users = $this->mdl_users->where('role', '6')->get()->row();
		return $users;
	}
	public function save_editor_details($email, $password) {
		$editor = $this->mdl_users->where('role', '6')->get()->row();
		$this->db->where('id', $editor->id);
        $this->db->set(array('email' => $email, 'password'=>md5($password), 'secret_key' => base64_encode($password.'_pickngo')));
        $this->db->update('users');
		
		$this->session->set_flashdata('alert_success', 'Editor details successfully saved');
	}
	public function validation_rules_editors() {
		return array(
            'editor_email'  => array(
                'field' => 'editor_email',
                'label' => 'editor_email',
                'rules' => 'required'
            ),
            'editor_password' => array(
                'field' => 'editor_password',
                'label' => 'editor_password',
                'rules' => 'required'
            )
        );
	}
}

?>
