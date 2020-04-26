<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('all_model');
		if($this->session->userdata('logged_in') != 1) {
			$this->session->sess_destroy();
			redirect(base_url('login'));
		}
	}

	public function index()
	{
		$condition = array('id' => $this->session->userdata('id'));
		$data['profile'] = $this->all_model->getDataByCondition('user', $condition)->row();
		$this->load->view('profile/index', $data);
	}

	public function edit()
	{
		$condition = array('id' => $this->session->userdata('id'));
		$data['profile'] = $this->all_model->getDataByCondition('user', $condition)->row();
		$this->load->view('profile/edit', $data);
	}

	public function processEdit()
	{
		$condition = array('id' => $this->session->userdata('id'));
		$profile = $this->all_model->getDataByCondition('user', $condition)->row();

		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('team', 'Team', 'required');
		$this->form_validation->set_rules('position', 'Position', '');

		if($this->form_validation->run() == false){
			$this->load->view('users/edit');
		}else{
			if($this->input->post('position') == "Supervisor"){
				$role = 2;
			}else{
				$role = 3;
			}

			$data = array(
				'id'			=> $this->session->userdata('id'),
				'nama'  	 	=> $this->input->post('nama'),
				'email'  	 	=> $this->input->post('email'),
				'username'   	=> $this->input->post('username'),
				'password'   	=> ($this->input->post('password') == "") ? $profile->password : md5($this->input->post('password')),
				'team'   	 	=> $this->input->post('team'),
				'position'   	=> ($this->session->userdata('role') == 1) ? 'Admin' : $this->input->post('position'),
				'role'		 	=> ($this->session->userdata('role') == 1) ? 1 : $role,
				'updated_date' 	=> date('Y-m-d')
			);

			$res = $this->all_model->updateData('user', $condition, $data);
			if($res == false){
				$this->session->set_flashdata('error', 'Data profile not updated');
				redirect(base_url() . 'profile/edit');
			}

			$this->session->set_flashdata('success', 'Data profile updated. Please logout and login again.');
			redirect(base_url() . 'profile/edit');
		}
	}
}