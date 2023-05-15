<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->Login_model->is_logged_in())
		{
			redirect('dashboard');
		}
		else
		{
			$this->form_validation->set_rules('username', 'Username', 'callback_login_check');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/login');
			}
			else
			{
				
				redirect('dashboard');
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

		if(!$this->Login_model->login($username, $password))
		{
			$this->form_validation->set_message('login_check', 'Invalid username/password');

			return FALSE;
		}

		return TRUE;		
	}
	
	private function _security_check($username, $password)
	{
		
	}
	/*
	Loads the change password form
	*/
	public function change_password($employee_id = -1)
	{
		$person_info = $this->Login_model->get_info($employee_id);
		foreach(get_object_vars($person_info) as $property => $value)
		{
			$person_info->$property = $this->xss_clean($value);
		}
		$data['person_info'] = $person_info;

		$this->load->view('employees/form_change_password', $data);
	}
}
?>
