<?php

Class Search_model extends CI_Model {

	public function studentList($studentId){ 
		$query = $this->db->query("SELECT name,enroll_no FROM student_table WHERE Name LIKE '%$studentId%' OR roll_no LIKE '%$studentId%' OR enroll_no LIKE '%$studentId%' LIMIT 18");

			if ($query->num_rows() > 0) 
				{ return $query->result(); } 
			else 
				{ return false; }
	}

	public function studentDetailsDB($enroll){
		
		$this->db->select("id,enroll_no as 'Enroll no',roll_no as 'Roll no',name as 'Name',batch as'Batch'");
		$this->db->from('student_table');
		$this->db->where('enroll_no =',$enroll);
		$query = $this->db->get();
		if ($query->num_rows() > 0) 
			{ return $query->result(); } 
		else 
			{ return false; }

	}

	public function studentDetailsApp($id){
		$query = $this->db->query("SELECT mobile_no as 'Mobile no.',email_id as 'Email ID' from student_profile where student_id='$id';");
		if ($query->num_rows() > 0) 
			{ return $query->result(); } 
		else 
			{ return false; }

	}

}
?>