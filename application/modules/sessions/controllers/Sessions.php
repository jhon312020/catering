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

class Sessions extends Base_Controller {

    public function index()
    {
        redirect('sessions/login');
    }

    public function login()
    {
		
        if ($this->input->post('btn_login'))
        {
            if ($this->authenticate($this->input->post('email'), $this->input->post('password')))
            {
                if ($this->session->userdata('user_type') == 1 || $this->session->userdata('user_type') == 6)
                {
					if ($this->input->is_ajax_request()) {
					   echo json_encode(array('login_status'=>'success','redirect_url'=>site_url('admin/dashboard')));
					   die();
					}else{
						redirect('admin/dashboard');
					}
                }
                elseif ($this->session->userdata('user_type') == 2)
                {
                    redirect('guest');
                }
            }else{
				if ($this->input->is_ajax_request()) {
					echo json_encode(array('login_status'=>'invalid'));
					die();
				}
			}
        }

        $this->load->view('session_login');
    }

    public function logout()
    {
        $this->session->sess_destroy();

        redirect('sessions/login');
    }

    public function authenticate($email_address, $password)
    {
        $this->load->model('mdl_sessions');

        if ($this->mdl_sessions->auth($email_address, $password))
        {
            return TRUE;
        }

        return FALSE;
    }
	public function getauthdetails()
    {
        $this->load->model('mdl_sessions');
		$result = $this->mdl_sessions->getdetails($this->input->post());
        if($result)
			echo json_encode(current($result));
		else
			echo json_encode(array('error'=>'invalid credentials'));
    }
}

?>
