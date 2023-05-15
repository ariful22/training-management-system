<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Stsearch extends CI_Controller {



	public function __construct()

	{

		parent::__construct();

	$this->load->model('Student_model');

	}

	

	public function index()

	{

		

		
		$data['list'] = $this->Student_model->get_course();
		$this->load->view('front/stsearch',$data);

	}

	public function search()

	{

		$data = array();

		if($this->input->post('submit')){


        $data['results']    =   $this->Student_model->search();
		


		}

		

	$this->load->view('front/std_info', $data);

	}

	

	

}

