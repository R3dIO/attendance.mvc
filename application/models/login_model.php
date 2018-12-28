<?php

Class login_model extends CI_Model {

// Read data using username and password
public function login($data) {
	$this->db->select('*');
	$this->db->where('username',$data['username']);
	$this->db->where('pass',$data['password']);
	$this->db->limit(1);
	$query = $this->db->get('faculty_login_table');
	
		if ($query->num_rows() >= 1) 
			{ return $query->result(); } 
		else 
			{ return false; }
}

public function sessionData($data) {
	$this->db->select('*');
	$this->db->where('id',$data['id']);
	$query = $this->db->get('faculty_table');

		if ($query->num_rows() == 1) 
			{ return $query->result(); } 
		else 
			{ return false; }
}
}

?>