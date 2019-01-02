<?php

Class Attendance_panel_model extends CI_Model {

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

public function lectureDetail($lectureId,$scheduleId){

	$this->db->select($lectureId);
	$this->db->from('schedule_table');
	$this->db->where('id =',$scheduleId);
	$query = $this->db->get();

		if ($query->num_rows() > 0) 
			{ return $query->result(); } 
		else 
			{ return false; }
}

public function attendanceRecords($scheduleId,$batch){
	if ($batch==0){
		$this->db->select('*');
		$this->db->from('attendance_table');
		$this->db->join('student_table', 'student_table.id = attendance_table.student_id', 'inner');
		$this->db->where('schedule_id =',$scheduleId);
		$query = $this->db->get();
	}
	else{
		$this->db->select('*');
		$this->db->from('attendance_table');
		$this->db->join('student_table' ,'student_table.id = attendance_table.student_id', 'inner');
		$this->db->where('schedule_id =',$scheduleId);
		$this->db->where('student_table.batch =',$batch);
		$query = $this->db->get();

	}

	if ($query->num_rows() > 0) 
		{ return $query->result(); } 
	else 
		{ return false; }
}


}
?>