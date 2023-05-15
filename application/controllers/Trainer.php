<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trainer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Trainer_model');
	$model = $this->admin_model;

		if(!$model->is_logged_in())
		{
			redirect('admin_login');
		}
	}
	
	public function index()
	{
		
		$this->load->view('admin/trainerlist');
	}
	
	
	
	public function ajax_list()
  {
      $list = $this->Trainer_model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $stlist) {
          $no++;
          $row = array();
          $row[] = $stlist->trainer_list_id;
          $row[] = $stlist->trainer_name;
          //add html for action
          $row[] = '<a class="btn btn-info" href="javascript:void()" title="Edit" onclick="editcourse('."'".$stlist->trainer_list_id."'".')"><i class="fa fa-pencil"></i></a>
		  
                <a class="btn btn-danger" href="javascript:void()" title="Delete" onclick="deletecourse('."'".$stlist->trainer_list_id."'".')"><i class="fa fa-trash"></i></a>';
          $data[] = $row;
      }
      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->Trainer_model->count_all(),
                      "recordsFiltered" => $this->Trainer_model->count_filtered(),
                      "data" => $data,
              );
      //output to json format
      echo json_encode($output);
  }
  
  public function ajax_add()
  {
    
      $insert = $this->Trainer_model->save();
      echo json_encode(array("status" => TRUE));
  }
  
  public function ajax_edit($id)
  {
      $data = $this->Trainer_model->get_by_id($id);
      echo json_encode($data);
  }
  public function ajax_update()
  {
      
      $data = array(
				'trainer_list_id' => $this->input->post('trainer_list_id'),
              'trainer_name' => $this->input->post('trainer_name')
          );
      $this->Trainer_model->update(array('trainer_list_id' => $this->input->post('trainer_list_id')), $data);
      echo json_encode(array("status" => TRUE));
  }

  public function ajax_delete($id)
  {
      $this->Trainer_model->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
  }
  
  
  
  
  
	
	
}
