<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Selector extends CI_Controller {

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
	$this->load->model('classes_model');
	}

	public function index()
	{	
		if($this->session->userdata('userid')) {
			$data = array( 'domain_name' => 'Faculty Panel',
				'username' => $this->session->userdata('username'),
				'password' => $this->session->userdata('password'),
				'user' => $this->session->userdata('user'),
		 	);
			$this->load->view('header',$data);
			$this->load->view('teachersPanel',$data);
		} else
			$this->load->view('index');
		$this->load->view('footer');
	}

	public function retrieveClasses()
	{	
		$userid = $this->session->userdata('userid');
		if (!$userid) 
			$this->load->view('index');
		else {
			$result_th = $this->classes_model->thClassList($userid);
			$result_lb = $this->classes_model->lbClassList($userid);
			$coordinator = $this->classes_model->classCoordinator($userid); 
			
			$branch_list_th = '';
			$branch_list_lb = '';

			if($result_th != null)
			foreach ($result_th as $key => $value) {
				$branch_list_th.='<option value='.$value->id.'>'.$value->course." ".$value->branch." ".$value->year." ".$value->section.'</option>';
			}

			if($result_lb != null)
			foreach ($result_lb as $key => $value) {
				$branch_list_lb.='<option value='.$value->id.'>'.$value->course." ".$value->branch." ".$value->year." ".$value->section.'</option>';
			}

			$data = array('branchListTH' => $branch_list_th,
				'branchListLB'  => $branch_list_lb,
				'coordinator'	=> $coordinator,
				'id' => $userid 	
			);

			$dataHead = array( 'domain_name' => 'Attendance System',);

			$this->load->view('header',$dataHead);
			$this->load->view('classes',$data);
		}
		$this->load->view('footer');
		
	}

	public function getSubjects() {
		$result = $this->classes_model->fetchFacultySubjects($_POST['faculty_id'],$_POST['class_id']);
		foreach ($result as $key => $value) {
			$subject = $this->classes_model->fetchSubject($value->subject_id,$_POST['type']);
			foreach($subject as $k=>$v) {
				$array[$v->id] = $v->subject_name;
			}
		}
		echo json_encode($array);
	}

	public function date_select() {
		if($this->session->userdata('userid')) {
			$userid = $this->session->userdata('userid');
			$coordinator = $this->classes_model->classCoordinator($userid); 
			$data = array('class_id' => $coordinator[0]->id,
						'course' => $coordinator[0]->course,
						'branch' => $coordinator[0]->branch,
						'year' => $coordinator[0]->year,
						'section' => $coordinator[0]->section);

			$dataHead = array( 'domain_name' => 'Attendance System',);
			$this->load->view('header',$dataHead);
			$this->load->view('date_select',$data);
		} else
			$this->load->view('index');
		$this->load->view('footer');
	}

	public function full_report_pdf() {
		$class_id = $this->input->post('class_id');
		$from = $this->input->post('from');
		$to = $this->input->post('to');
		$class = $this->View_attendance_model->getClass($class_id);
		$schedule = $this->classes_model->getSchedule($class_id,0);
		$name = $this->session->userdata('user');

		$cls = (array)$class[0];
		$course=$cls['course'];
		$branch=$cls['branch'];
		$yr=$cls['year'];
		$section=$cls['section'];
		$col='';
		$n=0;
		foreach ($schedule as $key => $value) {
			$sub_id=$value->subject_id;
			$sch_id=$value->id;
			$subject = $this->View_attendance_model->getSubject($sub_id);
			$col.="$n,";
			$lec=[];
			$l=1;
			while($l<=$value->last_lecture_no) {
				$month=substr($value->last_lecture_date,5,2);
				$year=substr($value->last_lecture_date,0,4);
				$str = 'l'.$l;
				if($value->$str>=$from && $value->$str<=$to)
					$lec[]=$l;
				$l++;
			}
			$lec_no=sizeof($lec);
			$cols[]=$subject[0]->subject_code.'('.$lec_no.')';
			$attendance = $this->classes_model->getAttendance($value->id,$class_id);
			foreach ($attendance as $ky => $val) {
				$pr=0;
				for($k=0;$k<sizeof($lec);$k++) {
					$tmp = 'l'.$lec[$k];
					if($val->$tmp==1)
						$pr++;
				}
			$p[]=$pr;
			}
			$present[]=$p;
			$p=null;
			$n++;
		}

		$col=substr($col,0,strlen($col)-1);
		$sem='';
		if($month<='06') {
			$sem='e';
		}
		else {
			$sem='o';
		}
		switch($yr) {
			case 1:
			if($sem == 'o')
				$s=1;
			else $s=2;
			break;
			case 2:
			if($sem == 'o')
				$s=3;
			else $s=4;
			break;
			case 3:
			if($sem == 'o')
				$s=5;
			else $s=6;
			break;
			case 4:
			if($sem == 'o')
				$s=7;
			else $s=8;
			break;
		}
		
		$student = $this->Classes_model->getStudents($col,$class_id);
		$sub_class = $this->Classes_model->getclassSubject($course,$branch,$s);

		$data = array('class' => (array)$class[0],
					'schedule' => $schedule,
					'name' => $name,
					'student' => $student,
					'sub_class' => $sub_class,
					'month' => $month,
					'year' => $year,
					'cols' => $cols,
					'present' => $present);
		$this->load->helper('full_report');
		$pdf = new PDF;
		$output = $pdf->getPdf($data);

		$nm = $course.$branch.$yr.'-Year'.$section.'All.pdf';
		$loc = '/var/www/html/attendance.mvc/reports/'.$nm;
		$file = fopen($loc, 'w');
		fwrite($file, $output);
		fclose($file);

		echo $nm;
	}
}
