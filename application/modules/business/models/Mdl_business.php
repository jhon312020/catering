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

    public function getList() {
        $result = $this->db->select('id,name')->get('business')->result();
        $list = array();
        foreach ($result as $record) {
            $list[$record->id] = $record->name;
        }
        return $list;
    }

    /**
   * Function register
   *
   * @return  void
   * 
   */
    public function check_credetials ($data){
			$result = $this->mdl_business->where(array('email'=>$data['email'], 'password'=>md5($data['password'])))->get()->row();
			//print_r($result);die;
			if(count($result)>0) {
				if($result->is_active == 0) {
        	$this->session->set_flashdata('alert_error', lang('in_active_user'));
        	return false;
        } else {
            $session_data = array(
                'business_id'	=> $result->id,
                'business_name' => $result->name,
                'business_email'=>$result->email
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
