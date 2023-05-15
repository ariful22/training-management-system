<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Std_Reg extends CI_Controller {

	public function index()
	{
		$this->load->view('front/std_register');
	}
}
