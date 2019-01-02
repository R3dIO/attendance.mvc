<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SaveAttendance extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
	parent::__construct();
	}
	public function index($data)
	{	
		$dataHead = array( 'domain_name' => 'Attendance System',);
		$this->load->view('header',$dataHead);
		$this->load->view('attendancePanel',$data);
		$this->load->view('footer');
	}

	
	public function saveAttendanceRecords(){
		$attendanceRecords = $_POST['attendanceRecords'];
		$data = array('classId' => $this->session->userdata('ClassId'),
					'scheduleId' => $this->session->userdata('scheduleId'),
					'batch' => $this->session->userdata('Batch'),
		 );			
		$date = date('Ymd', strtotime($_POST['date-input']));
		//echo $classId.'*'.$batch.'*'.$date;print_r($attendanceRecords);
		$lastLectureNo = $this->Save_attendance_model->lastLectureNo($data['scheduleId']);
		$lastLectureNo = ($lastLectureNo[0]->last_lecture_no) + 1;	
		$updateResult = $this->Save_attendance_model->updateLLN($data['scheduleId'],$lastLectureNo);
		
		$lectureColumn = 'l'.$lastLectureNo;
		if (sizeof($attendanceRecords) == 0 )
				$this->Save_attendance_model->saveAttendance($data);
				 	
		foreach ($attendanceRecords as  $studentRecords) {

			$attendanceTableStat = $this->Save_attendance_model->attendancetable($data['scheduleId']);

			if ($attendanceTableStat)
				$this->Save_attendance_model->saveAttendance($data);

		}

		$attendancedata = array('scheduleId' =>$this->session->userdata('scheduleId'),
								'studentRecords' =>$studentRecords,
								'lectureColumn' =>$lectureColumn,
			);	

		$recordUpdate = $this->Save_attendance_model->updateAttendance($attendancedata);
		$llDateUpdate = $this->Save_attendance_model->updateLLDate($date,$attendancedata['scheduleId'],$attendancedata['lectureColumn']);
			
			if ($llDateUpdate)
				$success = 'Records saved Successfully';
			else
				$success = 'Unable to save records';
			echo "<html><head><script>";
			echo "window.onload = function() {";
			echo "alert(' ".$success." ');";
			echo "window.location.href = ' ".base_url()."index.php/class_selector';";
			echo "};";
			echo "</script></head></html>";
	}	

	public function editAttendanceRecords(){
		$scheduleId = $this->session->userdata('scheduleId');
		$attendanceRecords = $_POST['attendanceRecords'];
		$lectureId = $this->session->userdata('lectureNo');
		$date = $this->input->post('date');
		$lastLectureNo = $this->Save_attendance_model->lastLectureNo($scheduleId);
		$lastLectureNo = $lastLectureNo[0]->last_lecture_no;

		$rollNumbers = $this->Save_attendance_model->retrieveAttendance($lectureId,$scheduleId);
		//print_r($rollNumbers);
		foreach ($rollNumbers as $key => $value) {
			$rollNo = $value->roll_no;	
			if ($value->$lectureId == 1){
				$this->Save_attendance_model->updateTotalAbsent($scheduleId,$rollNo);
			}
			$this->Save_attendance_model->updateAbsent($scheduleId,$rollNo,$lectureId);
		}

		foreach ($attendanceRecords as $key => $attendance) {
			$this->Save_attendance_model->updatePresent($scheduleId,$rollNo,$lectureId);
			$this->Save_attendance_model->retrieveTotalNo($scheduleId,$attendance);
			$this->Save_attendance_model->updateTotalPresent($scheduleId,$rollNo);
		}

		$updateLLN = $this->Save_attendance_model->updateLastLecNum($lectureId,$date,$scheduleId);
		$updateLLd = $this->Save_attendance_model->updateLastLecDate($scheduleId,$date);

		if($updateLLN and $updateLLd)
			$success = "Attendance update Successfully";
		
			echo "<html><head><script>";
		//	echo "window.onload = function() {";
			echo "alert(' ".$success." ');";
			echo "window.location.href = ' ".base_url()."index.php/class_selector';";
			echo "};";
			echo "</script></head></html>"; 	
	}	
}
