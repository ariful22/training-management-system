<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Course_model');
	$model = $this->admin_model;

		if(!$model->is_logged_in())
		{
			redirect('admin_login');
		}
	}
	
	public function index()
	{
		
		$this->load->view('admin/courselist');
	}
	
	
	
	public function ajax_list()
  {
      $list = $this->Course_model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $stlist) {
          $no++;
          $row = array();
          $row[] = $stlist->course_id;
          $row[] = $stlist->course_name;
          //add html for action
          $row[] = '<a class="btn btn-info" href="javascript:void()" title="Edit" onclick="editcourse('."'".$stlist->student_course_id."'".')"><i class="fa fa-pencil"></i></a>
		  
                <a class="btn btn-danger" href="javascript:void()" title="Delete" onclick="deletecourse('."'".$stlist->student_course_id."'".')"><i class="fa fa-trash"></i></a>';
          $data[] = $row;
      }
      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->Course_model->count_all(),
                      "recordsFiltered" => $this->Course_model->count_filtered(),
                      "data" => $data,
              );
      //output to json format
      echo json_encode($output);
  }
  
  public function ajax_add()
  {
    
      $insert = $this->Course_model->save();
      echo json_encode(array("status" => TRUE));
  }
  
  public function ajax_edit($id)
  {
      $data = $this->Course_model->get_by_id($id);
      echo json_encode($data);
  }
  public function ajax_update()
  {
      
      $data = array(
				'course_id' => $this->input->post('course_id'),
              'course_name' => $this->input->post('course_name')
          );
      $this->Course_model->update(array('student_course_id' => $this->input->post('student_course_id')), $data);
      echo json_encode(array("status" => TRUE));
  }

  public function ajax_delete($id)
  {
      $this->Course_model->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
  }
  
  
  
  
  
	
	
}
