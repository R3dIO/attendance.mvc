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
		$this->load->view('footer');
	}
}
