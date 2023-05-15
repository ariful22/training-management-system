<?php

class Student_model extends CI_Model{

	

	var $table = 'student_info';





	public function __construct()

	{

		parent::__construct();

	}
	public function get_course()
	
    {

        $this->db->from('student_course');

        $this->db->order_by('course_name', 'ASC');

        $query = $this->db->get();



        return $query->result();

	}
	
	public function get_batch()
	
    {

        $this->db->from('student_batch');

        $this->db->order_by('batch_name', 'ASC');

        $query = $this->db->get();



        return $query->result();

	}
	
	public function get_data()
    {
        
		
		$this->db->select('student_info.*,student_course.course_name,student_batch.batch_name');
		//$this->db->from('student_info');
		$this->db->join('student_course','student_course.student_course_id=student_info.student_course_id', 'LEFT');
		$this->db->join('student_batch','student_batch.student_batch_id=student_info.student_batch_id', 'LEFT');
		$query = $this->db->get('student_info');

        return $query->result();
	}

	

	public function save($img_url){
		if($img_url == '') {
			$img_url = 'public/images/noimage.jpg';
		}
		$data = array(

              
			'std_name' => $this->input->post('std_name'),

              'fname' => $this->input->post('fname'),

              'location' => $this->input->post('location'),

              'phone' => $this->input->post('phone'),

              'edu_qualification' => $this->input->post('edu_qualification'),

              'student_course_id' => $this->input->post('course_name'), 
              'student_batch_id' => $this->input->post('batch_name'), 

              'admit_date' => $this->input->post('admit_date'),

              'student_image' => $img_url

          );
		  $this->db->insert($this->table,$data);

        return $this->db->insert_id();

	}
	
	/*public function save($data = array()){
		$this->db->insert($this->table,$data);

        return $this->db->insert_id();

	}*/

	

	public function get_by_id($id)



    {

        $sql="SELECT * 
  FROM student_info, student_course 
  WHERE student_course.student_course_id = student_info.student_course_id
  AND student_info.student_id ='$id'";
           $query=$this->db->query($sql);
            $result = $query->row_array();
            return $result;

  //       $this->db->from($this->table);



  //       $this->db->where('student_id',$id);



  //       $query = $this->db->get();



		// return $query->row();



    }
	
	public function update($id,$imgUrl)
    {
		if($imgUrl == "") {
        $data = array(
              'std_name' => $this->input->post('std_name'),
              'fname' => $this->input->post('fname'),
              'location' => $this->input->post('location'),
              'phone' => $this->input->post('phone'),
              'edu_qualification' => $this->input->post('edu_qualification'),
              'student_course_id' => $this->input->post('student_course_id'),
              'student_batch_id' => $this->input->post('student_batch_id'),
              'admit_date' => $this->input->post('admit_date')
          );
		}else{
			$data = array(
              'std_name' => $this->input->post('std_name'),
              'fname' => $this->input->post('fname'),
              'location' => $this->input->post('location'),
              'phone' => $this->input->post('phone'),
              'edu_qualification' => $this->input->post('edu_qualification'),
              'student_course_id' => $this->input->post('student_course_id'),
              'student_batch_id' => $this->input->post('student_batch_id'),
              'admit_date' => $this->input->post('admit_date'),
              'student_image' => $imgUrl
          );
		}
		$this->db->where('student_id',$id);
		return $this->db->update($this->table, $data);
        //return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('student_id', $id);
        $this->db->delete($this->table);
    }
	
	function view_single_info($id) {
        
        $sql = "SELECT * FROM student_info, student_activty, student_payment, student_course WHERE student_info.std_id=student_activty.std_id AND student_course.student_course_id = student_info.student_course_id AND student_payment.std_id=student_info.std_id AND student_info.student_id=$id";
        $query=$this->db->query($sql);
        $result = $query->row_array();
        return $result;
        
    }
	

	public function search()

    {


	$studentid    =   $this->input->post('std_id');

        $studentreg    =   $this->input->post('std_reg');
		$studentcourse    =   $this->input->post('course_name');


	
	$sql='';
	$sql = "SELECT * 
	FROM student_info, student_activty, student_course 
	WHERE student_activty.std_id=student_info.std_id  AND student_course.student_course_id = student_info.student_course_id
	AND student_info.std_id ='$studentid' " .$sql."";

                  if($studentreg) {
                    $sql .= "AND student_info.std_reg='$studentreg' ";
                  }
				  
				  if($studentcourse) {
                    $sql .= "AND student_info.student_course_id='$studentcourse' ";
                  }
				  

        $query=$this->db->query($sql);

        $result = $query->result_array();

        return $result;
		
		
    }

} 

?>