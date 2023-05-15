   <?php
class Login_model extends CI_Model{

	/*
	Gets information about a particular employee
	*/
	public function get_info($employee_id)
	{
		$this->db->from('admin');	
		$this->db->where('admin.person_id', $employee_id);
		$query = $this->db->get();

		if($query->num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $employee_id is NOT an employee
			$person_obj = parent::get_info(-1);

			//Get all the fields from employee table
			//append those fields to base parent object, we we have a complete empty object
			foreach($this->db->list_fields('admin') as $field)
			{
				$person_obj->$field = '';
			}

			return $person_obj;
		}
	}
   public function login($username, $password)
	{
		$query = $this->db->get_where('admin', array('username' => $username), 1);

		if($query->num_rows() == 1)
		{
			$row = $query->row();

			// compare passwords depending on the hash version
			if($row->hash_version == 1 && $row->password == md5($password))
			{
				$this->db->where('person_id', $row->person_id);
				$this->session->set_userdata('person_id', $row->person_id);
				$password_hash = password_hash($password, PASSWORD_DEFAULT);

				return $this->db->update('admin', array('hash_version' => 2, 'password' => $password_hash));
			}
			elseif($row->hash_version == 2 && password_verify($password, $row->password))
			{
				$this->session->set_userdata('person_id', $row->person_id);

				return TRUE;
			}

		}

		return FALSE;
	}
	
	/*
	Logs out a user by destorying all session data and redirect to login
	*/
	public function logout()
	{
		$this->session->sess_destroy();

		redirect('login');
	}
	
	/*
	Determins if a employee is logged in
	
	public function is_logged_in()
	{
		return ($this->session->userdata('person_id') != FALSE);
	}*/
}
?>