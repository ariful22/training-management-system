<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batch extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Batch_model');
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
  
  public function ajax_add()
  {
    
      $insert = $this->Batch_model->save();
      echo json_encode(array("status" => TRUE));
  }
  
  public function ajax_edit($id)
  {
      $data = $this->Batch_model->get_by_id($id);
      echo json_encode($data);
  }
  public function ajax_update()
  {
      
      $data = array(
				'batch_id' => $this->input->post('batch_id'),
              'batch_name' => $this->input->post('batch_name')
          );
      $this->Batch_model->update(array('student_batch_id' => $this->input->post('student_batch_id')), $data);
      echo json_encode(array("status" => TRUE));
  }

  public function ajax_delete($id)
  {
      $this->Batch_model->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
  }
  
  
  
  
  
	
	
}
