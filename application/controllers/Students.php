<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Student_model');
	$model = $this->admin_model;

		if(!$model->is_logged_in())
		{
			redirect('admin_login');
		}
	}
	
	public function index()
	{
		$data['list'] = $this->Student_model->get_data();
		$this->load->view('admin/admin_panel',$data);
	}
	
	
	
	/*public function ajax_list()
  {
      $list = $this->Student_model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $stlist) {
          $no++;
          $row = array();
          $row[] = $stlist->std_name;
          $row[] = $stlist->phone;
          $row[] = $stlist->student_course_id;
          $row[] = $stlist->location;
          //add html for action
          $row[] = '<a class="btn btn-info" href="javascript:void()" title="Edit" onclick="editstudent('."'".$stlist->student_id."'".')"><i class="fa fa-pencil"></i></a>
		  
                <a class="btn btn-danger" href="javascript:void()" title="Delete" onclick="deletestudent('."'".$stlist->student_id."'".')"><i class="fa fa-trash"></i></a>';
          $data[] = $row;
      }
      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->Student_model->count_all(),
                      "recordsFiltered" => $this->Student_model->count_filtered(),
                      "data" => $data,
              );
      //output to json format
      echo json_encode($output);
  }*/
  
  public function studentlists(){
		$data['list'] = $this->Student_model->get_data();
		$this->load->view('admin/admin_panel',$data);
	}
  
  /*public function ajax_add()
  {
   if(isset($_FILES['student_image']['name'])){
                $config['upload_path'] = 'public/images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['student_image']['name'];
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('student_image')){
                    $uploadData = $this->upload->data();
                    $image = $uploadData['file_name'];
                }else{
                    $image = '';
                }
            }else{
                $image = '';
            }



	       $data = array(

              'std_id' => $this->input->post('std_id'),

              'std_name' => $this->input->post('std_name'),

              'std_reg' => $this->input->post('std_reg'),

              'fname' => $this->input->post('fname'),

              'location' => $this->input->post('location'),

              'phone' => $this->input->post('phone'),

              'edu_qualification' => $this->input->post('edu_qualification'),

              'blood' => $this->input->post('blood'),

              'student_course_id' => $this->input->post('course_name'), 

              'admit_date' => $this->input->post('admit_date'),

              'student_image' => $image

          );
	        
	        $insert = $this->Student_model->save($data);
	       echo json_encode(array("status" => TRUE));
        
  } */
  public function add_student()
  {
	 $data['list'] = $this->Student_model->get_course();
	 $data['batchlist'] = $this->Student_model->get_batch();
	 $this->load->view('admin/student_add',$data); 
  }
  public function ajax_add()
  {
	  $this->form_validation->set_rules('std_name', "Name", 'required');
	  if($this->form_validation->run() === FALSE){
				$this->load->view('admin/admin_panel');
			} else {
	$imgUrl = $this->uploadImage();	
	$this->Student_model->save($imgUrl);
      $this->session->set_flashdata('item', array('message' => 'Student Registration successfully'));
			redirect('Students');
	  
  } 
  }
  
  public function ajax_edit($id)
  {
      $data=array();
	  $data['list'] = $this->Student_model->get_course();
	  $data['batchlist'] = $this->Student_model->get_batch();
	  $data['student'] = $this->Student_model->get_by_id($id);
      $this->load->view('admin/student_edit',$data);
  }
  
  public function ajax_update($id)
  {
	  
      $imgUrl = $this->updateImage();
      
      $this->Student_model->update($id,$imgUrl);
	  redirect('students');
      
  }
  
  
  public function uploadImage() 
	{
		$type = explode('.', $_FILES['student_image']['name']);				
		$type = $type[count($type)-1];		
		$url = 'public/images/'.uniqid(rand()).'.'.$type;
		if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
			if(is_uploaded_file($_FILES['student_image']['tmp_name'])) {			
				if(move_uploaded_file($_FILES['student_image']['tmp_name'], $url)) {
					return $url;
				}	else {
					return false;
				}			
			}
		} 
	}
	
	public function updateImage() 
	{
		//if(!empty($_FILES['student_image']['name'])){
		$type = explode('.', $_FILES['student_image']['name']);				
		$type = $type[count($type)-1];		
		$url = 'public/images/'.uniqid(rand()).'.'.$type;
		if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
			if(is_uploaded_file($_FILES['student_image']['tmp_name'])) {			
				if(move_uploaded_file($_FILES['student_image']['tmp_name'], $url)) {
					return $url;
				}	else {
					return false;
				}			
			}
		} 
	//}
	}
	
	

  public function delete($id)

   {

       $this->db->delete('student_info', array('student_id' => $id));
	   redirect('students');
	   

   }

   public function view()

   {
	 $id = $this->uri->segment(3);
        $data['result'] = $this->Student_model->view_single_info($id);   
    $this->load->view('admin/std_view',$data);
	   

   }
  
	
	
}
