<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

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
	// Load form validation library
	$this->load->library('form_validation');
	// Load database
	$this->load->model('login_model');

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

	public function verify()
	{
		$data = array(
		'username' => $this->input->post('username'),
		'password' => $this->input->post('password')
		);
		$result = $this->login_model->login($data); //print_r($result);
		
		if( is_array($result) ){
			$data = array('id' => $result[0]->id);
			$this->session->set_userdata('username', $result[0]->username);
			$this->session->set_userdata('userid', $result[0]->id);
			
			$result=$this->login_model->sessionData($data);
			$this->session->set_userdata('user', $result[0]->name);
			echo 'success';
		}
		else{
			echo 'failed';
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		$this->load->view('index');
		$this->load->view('footer');
	}

	public function about() {
		$this->load->view('about');
	}
}
