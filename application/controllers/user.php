<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('all_model');
		if($this->session->userdata('logged_in') != 1) {
			redirect(base_url('login/index'));
		}
	}

	public function index()
	{
		$data['user'] = $this->all_model->getAllData('user')->result();
		$this->load->view('users/index', $data);
	}

	public function add(){
		$this->load->view('users/add');
	}

	public function processAdd(){
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('team', 'Team', 'required');
		$this->form_validation->set_rules('position', 'Position', 'required');

		if($this->form_validation->run() == false){
			$this->load->view('users/add');
		}else{
			if($this->input->post('position') == "Supervisor"){
				$role = 2;
			}else{
				$role = 3;
			}

			$data = array(
				'nama'  	 	=> $this->input->post('nama'),
				'email'  	 	=> $this->input->post('email'),
				'username'   	=> $this->input->post('username'),
				'password'   	=> md5($this->input->post('password')),
				'team'   	 	=> $this->input->post('team'),
				'position'   	=> $this->input->post('position'),
				'role'		 	=> $role,
				'created_date' 	=> date('Y-m-d')
			);

			$res = $this->all_model->insertData('user', $data);
			if($res == false){
				$this->session->set_flashdata('error', 'Data user not saved');
				redirect(base_url() . 'user/add');
			}

			$this->session->set_flashdata('success', 'Data user saved');
			redirect(base_url() . 'user/index');
		}
	}

	public function edit($id){
		$condition = array("id" => $id);
		$data['user'] = $this->all_model->getDataByCondition('user', $condition)->row();
		$this->load->view('users/edit', $data);
	}

	public function processEdit(){
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('team', 'Team', 'required');
		$this->form_validation->set_rules('position', 'Position', 'required');

		if($this->form_validation->run() == false){
			$this->load->view('users/edit');
		}else{
			$condition = array("id" => $this->input->post('id'));
			$user = $this->all_model->getDataByCondition('user', $condition)->row();

			if($this->input->post('position') == "Supervisor"){
				$role = 2;
			}else{
				$role = 3;
			}

			$data = array(
				'id'			=> $this->input->post('id'),
				'nama'  	 	=> $this->input->post('nama'),
				'email'  	 	=> $this->input->post('email'),
				'username'   	=> $this->input->post('username'),
				'password'   	=> ($this->input->post('password') == "") ? $user->password : md5($this->input->post('password')),
				'team'   	 	=> $this->input->post('team'),
				'position'   	=> $this->input->post('position'),
				'role'		 	=> $role,
				'updated_date' 	=> date('Y-m-d')
			);
			$res = $this->all_model->updateData('user', $condition, $data);
			if($res == false){
				$this->session->set_flashdata('error', 'Data user not updated');
				redirect(base_url() . 'user/edit');
			}

			$this->session->set_flashdata('success', 'Data user updated');
			redirect(base_url() . 'user/index');
		}
	}

	public function delete($id){
		$condition = array("id" => $id);
		$res  = $this->all_model->deleteData("user", $condition);
		if($res == false){
			$this->session->set_flashdata('error', 'Data user not deleted');
			redirect(base_url() . "user/index");
		}

		$this->session->set_flashdata('success', 'Data user deleted');
		redirect(base_url() . "user/index");
	}
}