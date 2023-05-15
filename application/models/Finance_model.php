<?php
class Finance_model extends CI_Model{
	
	var $table = 'student_payment';
    var $column = array('student_info.std_name','student_course.course_name','student_batch.batch_name','student_payment.due_payment','student_payment.total_paid,student_payment.less_payment,student_payment.less_due,student_payment.course_fee'); //set column field database for order and search
    var $order = array('student_id' => 'desc'); // default order


	public function __construct()
	{
		parent::__construct();
	}

	
	

	private function _get_datatables_query()
    {
        $this->db->select('payment_id,student_payment.std_name, student_info.std_name, student_payment.due_payment,student_batch.batch_name, student_payment.total_paid,student_payment.less_payment,student_payment.less_due,student_payment.course_fee,student_course.course_name');
        $this->db->from($this->table);
		$this->db->join('student_info', 'student_info.std_name = student_payment.std_name', 'left');
		$this->db->join('student_course', 'student_info.student_course_id = student_course.student_course_id', 'left');
		$this->db->join('student_batch', 'student_info.student_batch_id = student_batch.student_batch_id', 'left');
        $i = 0;
        foreach ($this->column as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $column[$i] = $item; // set column array variable to order processing
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


	function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
	
	
	public function get_rows()

    {

        $this->db->from('student_info');

        $this->db->order_by('std_name', 'ASC');

        $query = $this->db->get();



        return $query->result();

	}
	
	public function save(){
		
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
		$this->db->insert($this->table, $data);
        return $this->db->insert_id();
	}
	
	public function get_by_id($id)

    {

        $this->db->from($this->table);

        $this->db->where('payment_id',$id);

        $query = $this->db->get();

		return $query->row();

    }
	
	public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('payment_id', $id);
        $this->db->delete($this->table);
    }
	
}
?>