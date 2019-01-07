<?php

Class Classes_model extends CI_Model {

public function classCoordinator($data){
	$this->db->select('*');
	$this->db->from('class_table');
	$this->db->where('coordinator_id =', $data);
	$query = $this->db->get();

		if ($query->num_rows() > 0) 
			{ return $query->result(); } 
		else 
			{ return false; }
}

public function thClassList($data) {
	$range = array(0,1,2);
	$this->db->select('class_table.id,class_table.course,class_table.section,class_table.branch,class_table.year,class_table.section,subject_table.subject_code,subject_table.subject_name,subject_table.id AS id1 ');
	$this->db->from('faculty_subject_table');
	$this->db->join('subject_table', 'subject_table.id = faculty_subject_table.subject_id', 'inner');
	$this->db->join('class_table', 'class_table.id = faculty_subject_table.class_id', 'inner');
	$this->db->where('faculty_subject_table.faculty_id =', $data);
	$this->db->where_in('subject_table.type', $range);
	$query = $this->db->get();

		if ($query->num_rows() > 0) 
			{ return $query->result(); } 
		else 
			{ return false; }
}

public function lbClassList($data) {
	$range = array(1,2);
	$this->db->select('class_table.id,class_table.course,class_table.section,class_table.branch,class_table.year,class_table.section,subject_table.subject_code,subject_table.subject_name,subject_table.id AS id1 ');
	$this->db->from('faculty_subject_table');
	$this->db->join('subject_table', 'subject_table.id = faculty_subject_table.subject_id', 'inner');
	$this->db->join('class_table', 'class_table.id = faculty_subject_table.class_id', 'inner');
	$this->db->where('faculty_subject_table.faculty_id =', $data);
	$this->db->where_in('subject_table.type', $range);
	$query = $this->db->get();

		if ($query->num_rows() > 0) 
			{ return $query->result(); } 
		else 
			{ return false; }
}

public function fetchFacultySubjects($faculty_id,$class_id) {
	$this->db->select('subject_id');
	$this->db->from('faculty_subject_table');
	$this->db->where('class_id =', $class_id);
	$this->db->where('faculty_id =', $faculty_id);	
	$query = $this->db->get();
	return $query->result();
}

public function fetchSubject($id,$type) {
	if($type == 'theory')
		$query = $this->db->query("SELECT id,subject_name from subject_table where id='$id' and (type=0 or type=2)");
	else if($type == 'lab')
		$query = $this->db->query("SELECT id,subject_name from subject_table where id='$id' and (type=1 or type=2)");
	return $query->result();
}

public function getSchedule($class_id,$batch) {
	$this->db->select('*');
	$this->db->from('schedule_table');
	$this->db->where('class_id =', $class_id);
	$this->db->where('batch =', $batch);	
	$query = $this->db->get();
	return $query->result();
}

public function getAttendance($sch_id,$class_id) {
	$query = $this->db->query("select * from attendance_table,student_table where schedule_id=$sch_id and student_id=id and class_id=$class_id order by roll_no");
	return $query->result();
}

public function getStudents($col,$class_id) {
	$query = $this->db->query("select roll_no,name,'$col' from student_table where class_id=$class_id order by roll_no");
	return $query->result();
}

public function getclassSubject($course,$branch,$sem) {
	$this->db->select('subject_code,subject_name');
	$this->db->from('subject_table');
	$this->db->where('course =', $course);
	$this->db->where('branch =', $branch);	
	$this->db->where('semester =', $sem);	
	$query = $this->db->get();
	return $query->result();
}

}
?>