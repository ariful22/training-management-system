<?php
class Activity_model extends CI_Model{
	
	var $table = 'student_activty';
    var $column = array('std_id','total_cls','result'); //set column field database for order and search
    var $order = array('student_activty_id' => 'desc'); // default order


	public function __construct()
	{
		parent::__construct();
	}

	
	

	private function _get_datatables_query()
    {
        $this->db->select('student_activty_id,student_activty.std_id, student_info.std_name, total_cls, result');
        $this->db->from($this->table);
		$this->db->join('student_info', 'student_info.std_id = student_activty.std_id', 'left');
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
		$this->db->insert($this->table, $data);
        return $this->db->insert_id();
	}
	
	public function get_by_id($id)

    {

        $this->db->from($this->table);

        $this->db->where('student_activty_id',$id);

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
        $this->db->where('student_activty_id', $id);
        $this->db->delete($this->table);
    }
	
	
}
?>