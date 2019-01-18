<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AttendancePanel extends CI_Controller {

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

		$scheduleId = $this->Attendance_panel_model->scheduleId($data);//print_r($scheduleId);
		$this->session->set_userdata('scheduleId',$scheduleId[0]->id);

		if ($data['Batch'] == 0) {
			$studentList = $this->Attendance_panel_model->studentList($data);
		}
		else{
			$studentList = $this->Attendance_panel_model->studentListLb($data);	
		}
		//print_r($studentList);
		$list_in="";	$i=0; 	$list_out="";

		if($studentList) {
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
		}

		if($i>0) {
          	$list_in='<tr>'.$list_in.'</tr>';
           	$list_out.=$list_in;
        } else $list_out = '<br><br><h4>Batch not assigned!! Contact Admin.</h4><br><br>';

		$data= array('student_list' => $list_out, 'count' => $i);
		$dataHead = array( 'domain_name' => 'Attendance System',);
		$this->load->view('header',$dataHead);
		$this->load->view('attendancePanel',$data);
		$this->load->view('footer');
	}

	public function editPanel(){

		$facultyId = $this->session->userdata('$FacultyId');
		$batch = $this->session->userdata('Batch');
		$scheduleId = $this->session->userdata('scheduleId');
		$lectureNo = $this->input->post('dateEdit');
		$this->session->set_userdata('lectureNo',$lectureNo);

		$lectureData = $this->Attendance_panel_model->lectureDetail($lectureNo,$scheduleId);//print_r($lectureData);
		$lectureData = $lectureData[0]->$lectureNo;

		$attendanceRecords = $this->Attendance_panel_model->attendanceRecords($scheduleId,$batch);

		$list = ""; $listAll = ""; $i=0;
		foreach ($attendanceRecords as $key => $attendance) {
		 	if($attendance->$lectureNo == 1){
		 		$list.='<td data-title="'.$attendance->name.'"style="width:10%"> <span class="button-checkbox">
				<button type="button" class="btn btn-success" data-color="success">'.$attendance->roll_no.'</button>
        		<input type="checkbox" class="hidden-sm-up" name="attendanceRecords[]" id="present" value="'.$attendance->roll_no.'" checked />
    			</span></td>';
		 	}
		 	else{
		 		$list.='<td data-title="'.$attendance->name.'"style="width:10%"> <span class="button-checkbox">
				<button type="button" class="btn btn-danger" data-color="success">'.$attendance->roll_no.'</button>
        		<input type="checkbox" class="hidden-sm-up" name="attendanceRecords[]" id="present" value="'.$attendance->roll_no.'" />
    			</span></td>';
		 	}
		 	$i++;
            if($i==6){
                 $list='<tr>'.$list.'</tr>';
                 $listAll.=$list;
                 $list="";
                 $i=0;
             }    
		 }
		 if($i>0) {
          	$list='<tr>'.$list.'</tr>';
            $listAll.=$list;
        } 

        $data = array('list' => $listAll,
        			  'date' => $lectureData,
        			  'classdetail'	=> $this->input->post('classdetail'),
        			  'subjectdetail' => $this->input->post('subjectdetail'),
        			  'batch' => $this->input->post('batch'),
         );
        $dataHead = array( 'domain_name' => 'Attendance System',);
		$this->load->view('header',$dataHead);
		$this->load->view('editPanel',$data);
		$this->load->view('footer');
	}
}
