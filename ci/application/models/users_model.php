<?php
class Users_model extends CI_Model
{

    function Users_model()
    {
        // Call the Model constructor
        //parent::Model();
		parent::__construct();
		//get the unique ID of the insert.
		//$userid = $this->db->insert_id();
    }

    function getData()
	{
		//Query the data table for every record and row
		$query = $this->db->get('users');

		if ($query->num_rows() == 0)
		{
			show_error('Database is empty!');
			return false;
		}
		else
		{
			return $query->result();
		}
	}
	
	function getUser($data)
	{
		$where = $this->db->where('username', $data['username']);
		//$query = $this->db->query("SELECT * FROM `users` " . $where);
		$query = $this->db->get('users');
		
		if ($query->num_rows() == 0)
		{
			//return "Error: User not found.";
			return false;
		}
		else
		{
			return $query->row_array();
		}
	}
	
	function checkUsername($username)
	{
		$where = $this->db->where('username', $username);
		$query = $this->db->get('users');
		
		if ($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function checkPassword($username, $password)
	{
		$where = $this->db->where('username', $username);
		$query = $this->db->get('users');
		
		if ($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			$query = $query->row_array();
			if ($query['password'] == $password)
				return true;
			else
				return false;
		}
	}
	
	function checkEmail($email)
	{
		$where = $this->db->where('email', $email);
		//$query = $this->db->query("SELECT * FROM `users` " . $where);
		$query = $this->db->get('users');
		
		if ($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function AddUser($data)
	{
		$where = $this->db->where('username', $data['username']);
		$where2 = $this->db->or_where('email', $data['email']);
		$query = $this->db->get('users');
		
		if ($query->num_rows == 0)
			$this->db->insert('users', $data);
		else
			//return false;
			return "Error: Username already exists.";
	}
	
	function UpdateUser($data)
	{
		//$this->db->where('id', $data['id']);
		$this->db->where('username', $data['username']);
		$data['password'] = sha1($data['password']);
		$query = $this->db->update('users', $data);
		
		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	}
	
	function DeleteUser()
	{
		$this->db->where('id', $this->uri->segment(3));
		$query = $this->db->delete('users');
		
		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	}
}
?>