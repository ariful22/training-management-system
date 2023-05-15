<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activities extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Activity_model');
	$model = $this->admin_model;

		if(!$model->is_logged_in())
		{
			redirect('admin_login');
		}
	}
	
	public function index()
	{
		$data['list'] = $this->Activity_model->get_rows();
		$this->load->view('admin/activitylist',$data);
	}
	
	
	
	public function ajax_list()
  {
      $list = $this->Activity_model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $stlist) {
          $no++;
          $row = array();
          $row[] = $stlist->std_id;
          $row[] = $stlist->total_cls;
          $row[] = $stlist->result;
          //add html for action
          $row[] = '<a class="btn btn-info" href="javascript:void()" title="Edit" onclick="editactivity('."'".$stlist->student_activty_id."'".')"><i class="fa fa-pencil"></i></a>
		  
                <a class="btn btn-danger" href="javascript:void()" title="Delete" onclick="deleteactivity('."'".$stlist->student_activty_id."'".')"><i class="fa fa-trash"></i></a>';
          $data[] = $row;
      }
      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->Activity_model->count_all(),
                      "recordsFiltered" => $this->Activity_model->count_filtered(),
                      "data" => $data,
              );
      //output to json format
      echo json_encode($output);
  }
  
  public function ajax_add()
  {
    
      $insert = $this->Activity_model->save();
      echo json_encode(array("status" => TRUE));
  }
  
  public function ajax_edit($id)
  {
      $data = $this->Activity_model->get_by_id($id);
      echo json_encode($data);
  }
  
  
  public function ajax_update()
  {
      
      $data = array(
				'std_id' => $this->input->post('std_id'),
              'total_cls' => $this->input->post('total_cls'),
              'start_cls' => $this->input->post('start_cls'),
              'end_cls' => $this->input->post('end_cls'),
              'attendance' => $this->input->post('attendance'),
              'absence' => $this->input->post('absence'),
              'xm_date' => $this->input->post('xm_date'),
              'xm_attend' => $this->input->post('xm_attend'),
              'result' => $this->input->post('result'),
              'grade' => $this->input->post('grade'),
              'certificate_no' => $this->input->post('certificate_no'),
              'delivery_date' => $this->input->post('delivery_date'),
              'comment' => $this->input->post('comment')
          );
      $this->Activity_model->update(array('student_activty_id' => $this->input->post('student_activty_id')), $data);
      echo json_encode(array("status" => TRUE));
  }

  public function ajax_delete($id)
  {
      $this->Activity_model->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
  }
  
  
	
	
}
