<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller {	
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
        $profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
        $data['faq'] = $this->all_model->getAllData('faq')->result();
		$this->load->view('faq/index', $data);
    }
    
    public function add()
	{
		$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
		$this->load->view('faq/add', $data);
    }
    
    public function processAdd(){
        $this->form_validation->set_rules('answer', 'Answer', 'required');
        $this->form_validation->set_rules('question', 'Question', 'required');

		if($this->form_validation->run() == false){
			$this->load->view('faq/add');
		}else{
			$data = array(
                'question'  	 	    => $this->input->post('question'),
                'answer'                => $this->input->post('answer'),
				'created_date' 			=> date('Y-m-d'),
				'created_by'			=> $this->session->userdata('id')
			);

			$res = $this->all_model->insertData('faq', $data);
			if($res == false){
				$this->session->set_flashdata('error', 'Data faq not saved');
				redirect(base_url() . 'faq/add');
			}

			$this->session->set_flashdata('success', 'Data faq saved');
			redirect(base_url() . 'faq/index');
		}
    }
    
    public function edit($id){
		$condition = array("id_faq" => $id);
		$data['faq'] = $this->all_model->getDataByCondition('faq', $condition)->row();
		$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
		$this->load->view('faq/edit', $data);
	}

	public function detail($id){
		$condition = array("id_faq" => $id);
		$data['faq'] = $this->all_model->getDataByCondition('faq', $condition)->row();
		$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
		$this->load->view('faq/detail', $data);
	}

	public function processEdit(){
        $this->form_validation->set_rules('question', 'Question', 'required');
        $this->form_validation->set_rules('answer', 'Answer', 'required');

		if($this->form_validation->run() == false){
			$this->load->view('faq/edit');
		}else{
			$condition = array("id_faq" => $this->input->post('id'));
			$data = array(
				'id_faq'			=> $this->input->post('id'),
				'question'  	 	=> $this->input->post('question'),
				'answer'			=> $this->input->post('answer')
			);
			$res = $this->all_model->updateData('faq', $condition, $data);
			if($res == false){
				$this->session->set_flashdata('error', 'Data faq not updated');
				redirect(base_url() . 'faq/edit');
			}

			$this->session->set_flashdata('success', 'Data faq updated');
			redirect(base_url() . 'faq/index');
		}
	}

	public function delete($id){
		$condition = array("id_faq" => $id);
		$res  = $this->all_model->deleteData("faq", $condition);
		if($res == false){
			$this->session->set_flashdata('error', 'Data faq not deleted');
			redirect(base_url() . "faq/index");
		}

		$this->session->set_flashdata('success', 'Data faq deleted');
		redirect(base_url() . "faq/index");
	}

	public function lists()
	{
        $profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
        $data['faq'] = $this->all_model->getAllData('faq')->result();
		$this->load->view('faq/lists', $data);
    }
}