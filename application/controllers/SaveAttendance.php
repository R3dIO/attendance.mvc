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
	public function index()
	{	
		
	}

	
	public function saveAttendanceRecords(){
		if (isset($_POST['attendanceRecords'])) 
			$attendanceRecords = $_POST['attendanceRecords'];
		else $attendanceRecords = null;
		$data = array('classId' => $this->session->userdata('ClassId'),
					'scheduleId' => $this->session->userdata('scheduleId'),
					'batch' => $this->session->userdata('Batch'),
		 );			
		$date = date('Ymd', strtotime($_POST['date']));
		//echo $classId.'*'.$batch.'*'.$date;print_r($attendanceRecords);
		$lastLectureNo = $this->Save_attendance_model->lastLectureNo($data['scheduleId']);
		$lastLectureNo = ($lastLectureNo[0]->last_lecture_no) + 1;	
		$updateResult = $this->Save_attendance_model->updateLLN($data['scheduleId'],$lastLectureNo);
		if (!$updateResult) {
			echo "not saved";
			return;
		}
		
		$lectureColumn = 'l'.$lastLectureNo;
		$attendanceTableStat = $this->Save_attendance_model->checkAttendanceTable($data['scheduleId']);
		if ($attendanceTableStat)
			$this->Save_attendance_model->initAttendance($data);
		$attendancedata = array('scheduleId' =>$this->session->userdata('scheduleId'),
								'studentRecords' =>$attendanceRecords,
								'lectureColumn' =>$lectureColumn,
			);	
		$recordUpdate = $this->Save_attendance_model->updateAttendance($attendancedata);
		if (!$recordUpdate) {
			echo "not saved";
			return;
		}

		$llDateUpdate = $this->Save_attendance_model->updateLLDate($date,$attendancedata['scheduleId'],$attendancedata['lectureColumn']);
		if (!$llDateUpdate){
			echo "not saved";
			return;
		}
		
		echo "saved";	
	}	

	public function editAttendanceRecords(){
		$scheduleId = $this->session->userdata('scheduleId');
		$attendanceRecords = isset($_POST['attendanceRecords'])?$_POST['attendanceRecords']:-1;
		$lectureId = $this->session->userdata('lectureNo');
		$date = $this->input->post('date');
		$lastLectureNo = $this->Save_attendance_model->lastLectureNo($scheduleId);
		$lastLectureNo = $lastLectureNo[0]->last_lecture_no;

		$rollNumbers = $this->Save_attendance_model->retrieveAttendance($lectureId,$scheduleId);
		//print_r($rollNumbers);
		foreach ($rollNumbers as $key => $value) {
			$curr[$value->roll_no] = $value->$lectureId;
		}

		if($attendanceRecords != -1) {
			foreach ($attendanceRecords as $key => $value) {
				if($curr[$value] == 0) {
					$this->Save_attendance_model->updatePresent($scheduleId,$value,$lectureId);
					$this->Save_attendance_model->updateTotalPresent($scheduleId,$value);
				}
				$curr[$value] = 2;
			}
		}

		foreach ($curr as $key => $value) {
			if($value == 1) {
				$this->Save_attendance_model->updateAbsent($scheduleId,$key,$lectureId);
				$this->Save_attendance_model->updateTotalAbsent($scheduleId,$key);
			}
		}

		$updateLLN = $this->Save_attendance_model->updateLastLecNum($lectureId,$date,$scheduleId);
		$updateLLd = $this->Save_attendance_model->updateLastLecDate($scheduleId,$date);

		if($updateLLN and $updateLLd)
			$success = "Attendance update Successfully";
		
			echo "<html><head><script src=\"".base_url()."js/jquery-3.3.1.min.js\"></script><script>";
		//	echo "window.onload = function() {";
			echo "$(document).ready(function() { alert(' ".$success." ');$('#form').submit(); } );";
			echo "</script></head><body><form action=\"view_attendance\" method=\"post\" id=\"form\"><input type=\"hidden\" name=\"classdetail\" value=\"".$_POST['classdetail']."\"><input type=\"hidden\" name=\"subjectdetail\" value=\"".$_POST['subjectdetail']."\"><input type=\"hidden\" name=\"batch\" value=\"".$_POST['batch']."\"></form></body></html>"; 	
	}	
}
