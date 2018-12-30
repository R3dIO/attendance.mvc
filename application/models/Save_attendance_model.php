<?php

Class Save_attendance_model extends CI_Model {

public function scheduleId($data){
	$this->db->select('id');
	$this->db->from('schedule_table');
	$this->db->where('class_id =',$data['ClassId']);
	$this->db->where('subject_id =',$data['SubjectId']);
	$this->db->where('batch =', $data['Batch']);
	$query = $this->db->get();
		if ($query->num_rows() > 0) 
			{ return $query->result(); } 
		else 
			{ return false; }
}

public function className($data) {

	$this->db->select('id');
	$this->db->from('schedule_table');
	$this->db->where('class_id =',$data['ClassId']);
	$this->db->where('subject_id =',$data['SubjectId']);
	$this->db->where('batch =', $data['Batch']);
	$query = $this->db->get();

		if ($query->num_rows() > 0) 
			{ return $query->result(); } 
		else 
			{ return false; }
}

public function studentList($data) {
	
	$this->db->select('*');
	$this->db->from('student_table');
	$this->db->where('class_id =',$data['ClassId']);
	$query = $this->db->get();

		if ($query->num_rows() > 0) 
			{ return $query->result(); } 
		else 
			{ return false; }
}

public function studentListLb($data) {
	
	$this->db->select('*');
	$this->db->from('student_table');
	$this->db->where('class_id =',$data['ClassId']);
	$this->db->where('batch =', $data['Batch']);
	$query = $this->db->get();

		if ($query->num_rows() > 0) 
			{ return $query->result(); } 
		else 
			{ return false; }
}

public function lastLectureNo($data){
		
	$this->db->select('last_lecture_no');
	$this->db->from('schedule_table');
	$this->db->where('id =',$data);
	$query = $this->db->get();

		if ($query->num_rows() > 0) 
			{ return $query->result(); } 
		else 
			{ return false; }	
}

public function updateLLN($scheduleId , $last_lecture_no){
		
	$this->db->set('last_lecture_no', $last_lecture_no);
	$this->db->where('id', $scheduleId);
	$this->db->update('schedule_table');
	$query = $this->db->get();

		if ($query->num_rows() > 0) 
			{ return $query->result(); } 
		else 
			{ return false; }	
}
}
?>