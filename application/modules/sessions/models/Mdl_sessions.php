<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * FusionInvoice
 * 
 * A free and open source web based invoicing system
 *
 * @package		FusionInvoice
 * @author		Jesse Terry
 * @copyright	Copyright (c) 2012 - 2013, Jesse Terry
 * @license		http://www.fusioninvoice.com/license.txt
 * @link		http://www.fusioninvoice.
 * 
 */

class Mdl_Sessions extends CI_Model {

	public function auth($email, $password)
	{
            
		$this->db->where('email', $email);
		$this->db->where('password', md5($password));

		$query = $this->db->get('users');

		if ($query->num_rows())
		{
			$user = $query->row();
			
			$session_data = array(
				'user_type'	 => $user->role,
				'user_id'	 => $user->id,
				'user_name'	 => $user->first_name . " " . $user->last_name,
			);
			$_SESSION['IsAuthorized'] = 1;
			$this->session->set_userdata($session_data);

			return TRUE;
		}

		return FALSE;
	}
	public function getdetails($data){
		$this->db->select('clients.id,clients.name,clients.surname,clients.email,clients.phone,clients.address,clients.cp,clients.country,
							clients.city,clients.nationality,clients.dni_passport,clients.doc_no');
		$this->db->from('users');
		$this->db->where('users.email', $data['email']);
		$this->db->where('users.password', md5($data['password']));
		$this->db->where('users.is_active', '1');
		$this->db->where('users.role', '4');
		$this->db->join('clients', 'clients.id=users.client_id', 'inner');
		$query = $this->db->get();
		if ($query->num_rows()){
			$user = $query->result_array();
			return $user;
		}
		return false;
	}

}

?>
