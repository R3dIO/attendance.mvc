<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Search extends CI_Controller {

	public function __construct() {
	parent::__construct();


	}
	public function index()
	{	
		if($this->session->userdata('userid')) {
			$dataHead = array( 'domain_name' => 'Attendance System');
			$this->load->view('header',$dataHead);
			$this->load->view('searchPanel');
		} else
			$this->load->view('index');
		$this->load->view('footer');
	}

	public function searchStudent()
	{	
		$studentId = $this->input->post("search");
		$result = $this->Search_model->studentList($studentId);
		$response = "No result Found";
		if($result){
			$response = '<ul class="list-group list-group-flush">';
			foreach ($result as $key => $value) {
				$response.= '<li onclick="get_detail( \''.$value->enroll_no.'\' )" class="list-group-item">';
				$response.= '<a href="javascript:void(0);"><b>'.$value->name.'</b></a></li>';
			}
			$response .= "</ul>";
		}
		echo  $response;
	}

	public function studentDetails(){
		$enroll = $this->input->post('enroll');
		$studentDetails = $this->Search_model->studentDetailsDB($enroll);
		if($studentDetails)
			$personalDetails = $this->Search_model->studentDetailsApp($studentDetails[0]->id);
		$enroll= strtolower((string)$enroll);
		$file_path= base_url()."res/student_photos/".$enroll.".jpg";
		if(file_exists($file_path) == 1)
		   echo '<img src=" '.base_url().'res/student_photos/'.$enroll.'.jpg" width="20%">';
		else
		   echo '<img src=" '.base_url().'res/student_photos/no_image.png" width="20%">';
		
		echo "<table>";
		if($studentDetails)
		foreach ($studentDetails[0] as $key => $value) {
			if($key == 'id')
				continue;
			if($key == 'Batch' && $value == 0)
				$value = "NA";
			echo '<tr><td>'. $key.' : </td><td> '.$value.'</td></tr>';
		}
		if($personalDetails)
		foreach ($personalDetails[0] as $key => $value) {
			echo '<tr><td>'. $key.' : </td><td> '.$value.'</td></tr>';
		}     
		echo "</table>";
	}
}
