<?php

Class View_attendance_model extends CI_Model {

public function scheduleTable($data){
	$this->db->select('*');
	$this->db->from('schedule_table');
	$this->db->where('class_id =',$data['ClassId']);
	$this->db->where('subject_id =',$data['SubjectId']);
	$this->db->where('batch =',$data['Batch']);
	$query = $this->db->get();

		if ($query->num_rows() > 0) 
			{ return $query->result(); } 
		else 
			{ return false; }	
}

public function studentCount($key,$scheduleId){
	$this->db->select('COUNT('.$key.') as presentNo', FALSE);
	$this->db->from('attendance_table');
	$this->db->where($key.'=',1);
	$this->db->where('schedule_id =',$scheduleId);
	$query = $this->db->get();

		if ($query->num_rows() == 1) 
			{ return $query->result(); } 
		else 
			{ return false; }	
}

public function studentList($data,$col) {

	if($data['Batch'] > 0){
		$this->db->select($col.',schedule_id,student_id,present_no');
		$this->db->from('attendance_table');
		$this->db->select('student_table.roll_no,student_table.name');
		$this->db->form('schedule_table');
		$this->db->join('attendance_table', 'schedule_table.id=attendance_table.schedule_id ', 'inner');
		$this->db->join('student_table', 'student_table.id=attendance_table.student_id', 'inner');
		$this->db->where('schedule_table.class_id = ', $data['ClassId']);
		$this->db->where('schedule_table.subject_id = ', $data['SubjectId']);
		$this->db->where('schedule_table.batch = ', $data['Batch']);
		$this->db->where('student_table.batch = ', $data['Batch']);
		$query = $this->db->get();
	}

	else {
		$this->db->select($col.',schedule_id,student_id,present_no,student_table.roll_no,student_table.name');
		$this->db->from('schedule_table');
		$this->db->join('attendance_table', 'schedule_table.id=attendance_table.schedule_id ', 'inner');
		$this->db->join('student_table', 'student_table.id=attendance_table.student_id', 'inner');
		$this->db->where('schedule_table.class_id = ', $data['ClassId']);
		$this->db->where('schedule_table.subject_id = ', $data['SubjectId']);
		$this->db->where('schedule_table.batch = ', $data['Batch']);
		$this->db->where('student_table.batch = ', $data['Batch']);	
		$query = $this->db->get();
		//echo "<pre>";print_r($query);exit;
	}

	if ($query->num_rows() > 0) 
		{ return $query->result(); } 
	else 
		{ return false; }
}
}

?>