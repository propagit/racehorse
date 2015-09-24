<?php
class Auth extends CI_Controller {
	
	function __construct() {
		parent::__construct();	
			
		$this->load->model('auth_model');
	}
	
	function login() {
		if ($this->session->userdata('adminLoggedIn')) {
			redirect('admin/competition');
		}
		$this->load->view('admin/login');
	}
	
	function validate() {
		if ($this->session->userdata('adminLoggedIn')) {
			redirect('admin');
		}
		
		$input = $this->input->post();
		$admin = $this->auth_model->validate($input['username'],$input['password']);
		
		if($admin){
			$this->session->set_userdata('adminLoggedIn',$admin);
			redirect('admin/competition');
		}else{
			$this->session->set_flashdata('invalidLogin',true);
			redirect('admin/login');	
		}
	}
	
	function logout() {
		$this->session->unset_userdata('adminLoggedIn');
		redirect('admin');
	}
}
?>