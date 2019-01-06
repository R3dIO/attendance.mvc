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
	$batch = $data['Batch'];
	$class = $data['ClassId'];
	$subject = $data['SubjectId'];
	if($batch > 0)
		$query = $this->db->query("SELECT $col,schedule_id,student_id,present_no,student_table.roll_no,student_table.name FROM schedule_table INNER JOIN attendance_table ON schedule_table.id=attendance_table.schedule_id INNER JOIN student_table ON student_table.id=attendance_table.student_id WHERE schedule_table.class_id=$class AND schedule_table.subject_id=$subject AND schedule_table.batch=$batch AND student_table.batch=$batch;");
	else 
		$query = $this->db->query("SELECT $col,schedule_id,student_id,present_no,student_table.roll_no,student_table.name FROM schedule_table INNER JOIN attendance_table ON schedule_table.id=attendance_table.schedule_id INNER JOIN student_table ON student_table.id=attendance_table.student_id WHERE schedule_table.class_id=$class AND schedule_table.subject_id=$subject AND schedule_table.batch=$batch;");

	if ($query->num_rows() > 0) 
		{ return $query->result(); } 
	else 
		{ return false; }
}

public function getSchedule($id) {
	$this->db->select('*');
	$this->db->from('schedule_table');
	$this->db->where('id =',$id);
	$query = $this->db->get();
	return $query->result();
}

public function getClass($id) {
	$this->db->select('*');
	$this->db->from('class_table');
	$this->db->where('id =',$id);
	$query = $this->db->get();
	return $query->result();
}

public function getFaculty($class_id,$sub_id) {
	$this->db->select('name');
	$this->db->from('faculty_table');
	$this->db->join('faculty_subject_table','faculty_table.id=faculty_subject_table.faculty_id','inner');
	$this->db->where('class_id =',$class_id);
	$this->db->where('subject_id =',$sub_id);
	$query = $this->db->get();
	return $query->result();
}

public function getSubject($id) {
	$this->db->select('*');
	$this->db->from('subject_table');
	$this->db->where('id =',$id);
	$query = $this->db->get();
	return $query->result();
}

public function getAttendance($schedule_id,$class_id,$cols) {
	$query = $this->db->query("select roll_no,name,".$cols."present_no,0 from student_table s,attendance_table a where a.schedule_id=$schedule_id and class_id=$class_id and s.id=a.student_id order by s.roll_no");
	return $query->result();
}
}

?>