<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Finance_model');
	$model = $this->admin_model;

		if(!$model->is_logged_in())
		{
			redirect('admin_login');
		}
	}
	
	public function index()
	{
		$data['list'] = $this->Finance_model->get_rows();
		$this->load->view('admin/paymentlist',$data);
	}
	
	
	
	public function ajax_list()
  {
      $list = $this->Finance_model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $stlist) {
          $no++;
          $row = array();
          $row[] = $stlist->std_name;
          $row[] = $stlist->course_name;
          $row[] = $stlist->batch_name;
          $row[] = $stlist->course_fee;
		  $row[] = $stlist->total_paid;
		  $row[] = $stlist->less_payment;
          $row[] = $stlist->due_payment;
          $row[] = $stlist->less_due;
          //add html for action
          $row[] = '<a class="btn btn-info" href="javascript:void()" title="Edit" onclick="editfinance('."'".$stlist->payment_id."'".')"><i class="fa fa-pencil"></i></a>
		  
                <a class="btn btn-danger" href="javascript:void()" title="Delete" onclick="deletefinance('."'".$stlist->payment_id."'".')"><i class="fa fa-trash"></i></a>';
          $data[] = $row;
      }
      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->Finance_model->count_all(),
                      "recordsFiltered" => $this->Finance_model->count_filtered(),
                      "data" => $data,
              );
      //output to json format
      echo json_encode($output);
  }
  
  public function ajax_add()
  {
    
      $insert = $this->Finance_model->save();
      echo json_encode(array("status" => TRUE));
  }
  
  public function ajax_edit($id)
  {
      $data = $this->Finance_model->get_by_id($id);
      echo json_encode($data);
  }
  
  public function ajax_update()
  {
      
      $data = array(
				'std_name' => $this->input->post('std_name'),
              'course_fee' => $this->input->post('course_fee'),
              'first_installment' => $this->input->post('first_installment'),
              'first_ins_date' => $this->input->post('first_ins_date'),
              'second_installment' => $this->input->post('second_installment'),
              'second_ins_date' => $this->input->post('second_ins_date'),
              'third_installment' => $this->input->post('third_installment'),
              'third_ins_date' => $this->input->post('third_ins_date'),
              'total_paid' => $this->input->post('total_paid'),
              'due_payment' => $this->input->post('due_payment'),
              'less_payment' => $this->input->post('less_payment'),
              'less_due' => $this->input->post('less_due'),
              'total_amount' => $this->input->post('total_amount')
          );
      $this->Finance_model->update(array('payment_id' => $this->input->post('payment_id')), $data);
      echo json_encode(array("status" => TRUE));
  }

  public function ajax_delete($id)
  {
      $this->Finance_model->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
  }
  
  
  
	
	
}
