<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('all_model');
		if($this->session->userdata('logged_in') == 1) {
			$this->session->sess_destroy();
			redirect(base_url('login'));
		}
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function processLogin(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		$condition = array(
			'username'  => $this->input->post('username'),
			'password'  => md5($this->input->post('password'))
		);

		if($this->form_validation->run() == false){
			$this->load->view('login');
		}else{
			$cek = $this->all_model->getDataByCondition("user", $condition)->num_rows();
			if($cek  <= 0){
				$this->session->set_flashdata('error', 'Username dan password invalid');
				redirect(base_url() . 'login/index');
			}

			$res = $this->all_model->getDataByCondition("user", $condition)->row();
			$data_session = array(
				'username'  => $res->username,
				'id'		=> $res->id,
				'logged_in' => 1,
				'role'		=> (int)$res->role
			);

			$this->session->set_userdata($data_session);
			redirect(base_url() . 'home/index');
		}
	}


	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}