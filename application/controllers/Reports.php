<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Report_model');
	$model = $this->admin_model;

		if(!$model->is_logged_in())
		{
			redirect('admin_login');
		}
	}
	
	public function index()
	{
		
		$this->load->view('admin/batchlist');
	}
	
	
	
	public function ajax_list()
  {
      $list = $this->Batch_model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $stlist) {
          $no++;
          $row = array();
          $row[] = $stlist->batch_id;
          $row[] = $stlist->batch_name;
          //add html for action
          $row[] = '<a class="btn btn-info" href="javascript:void()" title="Edit" onclick="editcourse('."'".$stlist->student_batch_id."'".')"><i class="fa fa-pencil"></i></a>
		  
                <a class="btn btn-danger" href="javascript:void()" title="Delete" onclick="deletecourse('."'".$stlist->student_batch_id."'".')"><i class="fa fa-trash"></i></a>';
          $data[] = $row;
      }
      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->Batch_model->count_all(),
                      "recordsFiltered" => $this->Batch_model->count_filtered(),
                      "data" => $data,
              );
      //output to json format
      echo json_encode($output);
  }
  
  
  
  
  
  
	
	
}
