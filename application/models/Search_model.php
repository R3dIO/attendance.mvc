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
		$query = $this->db->query("SELECT id ,enroll_no as 'Enroll no',roll_no as 'Roll no',name as 'Name',batch as'Batch' from student_table where enroll_no =  '$enroll' ;");
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