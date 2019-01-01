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

	public function attendancePanel()
	{
		$data = array(
		'ClassId' => $this->input->post('classdetail'),
		'SubjectId' => $this->input->post('subjectdetail'),	
		'Batch' => $this->input->post('batch'),
		'FacultyId' => $this->session->userdata('userid')
		);
		$this->session->set_userdata($data);
		//print_r($data);

		$scheduleId = $this->Save_attendance_model->scheduleId($data);
		$this->session->set_userdata('scheduleId',$scheduleId[0]->id);

		if ($data['Batch'] == 0) {
			$studentList = $this->Save_attendance_model->studentList($data);
		}
		else{
			$studentList = $this->Save_attendance_model->studentListLb($data);	
		}
		//print_r($studentList);
		$list_in="";	$i=0; 	$list_out="";

		foreach ($studentList as $key => $value) {
			$list_in.='<td data-title="'.$value->name.'"><span class="button-checkbox">
        	<button type="button" class="btn btnchk" data-color="success" title="'.$value->name.'">'.$value->roll_no.'</button>
        	<input type="checkbox" class="hidden-sm-up hidden-sm-right" name="attendanceRecords[]" id="present" value="'.$value->id.'" />
    		</span></td>';
    		$i++;

    		if($i==6){ 
                $list_in='<tr>'.$list_in.'</tr>';
                $list_out.=$list_in;
                $list_in="";
                $i=0;
            }        
		}

		if($i>0) {
          	$list_in='<tr>'.$list_in.'</tr>';
           	$list_out.=$list_in;
        }

		$data= array('student_list' => $list_out, );
		$this->index($data);
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
			echo "alert(".$success.");";
			echo "window.location.href = ' ".base_url()."index.php/class_selector';";
			echo "</script></head></html>";
	}		
}
