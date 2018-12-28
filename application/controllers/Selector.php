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
		$data = array( 'domain_name' => 'Teachers Panel',
			'username' => $this->session->userdata('username'),
			'password' => $this->session->userdata('password'),
		 );
		$this->load->view('header',$data);
		$this->load->view('teachersPanel',$data);
		$this->load->view('footer');
	}

	public function retrieveClasses()
	{	
		$userid = $this->session->userdata('userid');
		$result_th = $this->classes_model->thClassList($userid);
		$result_lb = $this->classes_model->lbClassList($userid);
		$coordinator = $this->classes_model->classCoordinator($userid); 
		
		$branch_list_th = '';		$subject_list_th = '';		$subject_code_th = '';
		$branch_list_lb = '';		$subject_list_lb = '';		$subject_code_lb = '';

		foreach ($result_th as $key => $value) {
			$branch_list_th.='<option value='.$value->id.'>'.$value->course." ".$value->branch." ".$value->year." ".$value->section.'</option>';
         	$subject_list_th.='<option value='.$value->id1.'>'.$value->subject_code." ".$value->subject_name.'</option>';
          	$subject_code_th.='<option value='.$value->id.'>'.$value->id1.'</option>';

		}

		foreach ($result_lb as $key => $value) {
			$branch_list_lb.='<option value='.$value->id.'>'.$value->course." ".$value->branch." ".$value->year." ".$value->section.'</option>';
         	$subject_list_lb.='<option value='.$value->id1.'>'.$value->subject_code." ".$value->subject_name.'</option>';
          	$subject_code_lb.='<option value='.$value->id.'>'.$value->id1.'</option>';

		}

		$data = array('branchListTH' => $branch_list_th,
			'subjectListTH' => $subject_list_th,
			'subjectCodeTH' => $subject_code_th,
			'branchListLB'  => $branch_list_lb,
			'subjectListLB' => $subject_list_lb,
			'subjectCodeLB' => $subject_code_lb,
			'coordinator'	=> $coordinator 	
		);
		$dataHead = array( 'domain_name' => 'Attendance System',);
		
		$this->load->view('header',$dataHead);
		$this->load->view('classes',$data);
		$this->load->view('footer');
		
	}
}
