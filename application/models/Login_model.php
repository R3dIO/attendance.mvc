<?php

Class Login_model extends CI_Model {

// Read data using username and password
public function login($id) {
	$this->db->select('*');
	$this->db->where('id',$id);
	//$this->db->where('pass',$data['password']);
	$this->db->limit(1);
	$query = $this->db->get('faculty_login_table');
	
		if ($query->num_rows() >= 1) 
			{ return $query->result(); } 
		else 
			{ return false; }
}

public function setToken($id,$tk) {
	$token=base64_encode(base64_encode(base64_encode($tk)));
	$result2=$this->db->query("update faculty_login_table set password='$token' where id=$id;");
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