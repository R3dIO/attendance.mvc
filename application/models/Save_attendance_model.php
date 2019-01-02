<?php

Class Save_attendance_model extends CI_Model {


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
	$query = $this->db->update('schedule_table');
		
		if ($query) 
			{ return true; } 
		else 
			{ return false; }	
}

public function saveAttendance($data){
	if($data['batch']==0 || $data['batch']==null){
		$scheduleId = $data['scheduleId'];	$classId = $data['classId'];	$batch = $data['batch'];
		$query = $this->db->query("insert ignore into attendance_table (schedule_id,student_id) select $scheduleId,id from student_table where class_id=$classId");
	}
	else{
		$query = $this->db->query("insert ignore into attendance_table (schedule_id,student_id) select $scheduleId,id from student_table where class_id=$classId and batch = $batch");
	}
	return $query;
}


public function attendanceTable($scheduleId){
		
	$this->db->select('*');
	$this->db->from('attendance_table');
	$this->db->where('schedule_id =',$scheduleId);
	$query = $this->db->get();

		if ($query->num_rows() == 0) 
			{ return true; } 
		else 
			{ return false; }	
}

public function updateAttendance($data){
		$lectureColumn = $data['lectureColumn'];	$studentRecords = $data['studentRecords'];	$scheduleId = $data['scheduleId'];
		$query = $this->db->query("update attendance_table set $lectureColumn=1,present_no=present_no+1 where student_id =$studentRecords and schedule_id=$scheduleId");
}

public function updateLLDate($date,$scheduleId,$lectureColumn){
		$currentLectureDate = $this->db->query("update schedule_table set $lectureColumn=$date where id='$scheduleId'");
		$lastLectureDate = $this->db->query("update schedule_table set last_lecture_date='$date' where id='$scheduleId' and (last_lecture_date<'$date' or last_lecture_date is null)");
		if ($currentLectureDate and $lastLectureDate)
			return true;
		else
			return false;
}

public function retrieveAttendance($lectureNo,$scheduleId){
	$this->db->select($lectureNo.',roll_no,present_no');
	$this->db->from('attendance_table');
	$this->db->join('student_table','attendance_table.student_id=student_table.id','inner');
	$this->db->where('schedule_id = ', $scheduleId);
	$query = $this->db->get();
		if ($query->num_rows() > 0) 
			{ return $query->result(); } 
		else 
			{ return false; }
}

public function updateTotalAbsent($scheduleId,$rollNo){
	$query = $this->db->query("update attendance_table set present_no=present_no-1 where schedule_id=$scheduleId and attendance_table.student_id=(SELECT id from student_table where roll_no='$rollNo')");
	return $query;
}

public function updateAbsent($scheduleId,$attendance,$lectureNo){
	$query = $this->db->query("update attendance_table set $lectureNo=0 where schedule_id=$scheduleId and attendance_table.student_id=(select id from student_table where roll_no='$attendance')");
	return $query;
}

public function updatePresent($scheduleId,$attendance,$lectureNo){
	$query = $this->db->query("update attendance_table set $lectureNo=1 where schedule_id=$scheduleId and attendance_table.student_id=(select id from student_table where roll_no='$attendance')");
	return $query;
}

public function retrieveTotalNo($scheduleId,$attendance){
	$query = $this->db->query("select present_no from attendance_table where schedule_id=$scheduleId and attendance_table.student_id=(select id from student_table where roll_no='$attendance')");
	return $query->result();
}


public function updateTotalPresent($scheduleId,$rollNo){
	$query = $this->db->query("update attendance_table set present_no=present_no+1 where schedule_id=$scheduleId and attendance_table.student_id=(select id from student_table where roll_no='$rollNo')");
	return $query;
}

public function updateLastLecNum($lectureColumn,$date,$scheduleId){
	$query = $this->db->query("update schedule_table set $lectureColumn='$date' where id=$scheduleId");
	return $query;
}

public function updateLastLecDate($scheduleId,$date){
	$query = $this->db->query("update schedule_table set last_lecture_date='$date' where id=$scheduleId and (last_lecture_date<'$date' or last_lecture_date is null)");
	return $query;
}

}

?>