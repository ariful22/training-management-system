<?php
class Admin_model extends CI_Model{
	
	public function login($username, $password)
	{
		$query = $this->db->get_where('admin', array('username' => $username, 'deleted' => 0), 1);

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

		redirect('admin_login');
	}
	
	/*
	Determins if a employee is logged in
	*/
	public function is_logged_in()
	{
		return ($this->session->userdata('person_id') != FALSE);
	}
   
	
	
}
?>