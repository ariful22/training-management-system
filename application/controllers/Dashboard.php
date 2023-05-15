<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	$model = $this->admin_model;

		if(!$model->is_logged_in())
		{
			redirect('Admin_login');
		}
	}
	
	public function index()
	{
		
		
		$this->load->view('admin/dashboard');
	}
	public function logout()
	{

		$this->admin_model->logout();
	}
	
}
