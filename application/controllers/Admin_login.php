<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_login extends CI_Controller {

	
	public function index()
	{
		if($this->admin_model->is_logged_in())
		{
			redirect('Dashboard');
		}
		else
		{
			$this->form_validation->set_rules('username', 'Username', 'callback_login_check');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/admin_login');
			}
			else
			{
				
				redirect('Dashboard');
			}
		}
	}

	public function login_check($username)
	{
		$password = $this->input->post('password');

		if($this->_security_check($username, $password))
		{
			$this->form_validation->set_message('login_check', 'Security check failure');

			return FALSE;
		}

		if(!$this->admin_model->login($username, $password))
		{
			$this->form_validation->set_message('login_check', 'Invalid username/password');

			return FALSE;
		}

		return TRUE;		
	}
	
	private function _security_check($username, $password)
	{
		
	}
	
}
