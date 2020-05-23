<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {	
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
		$data['product'] = $this->all_model->getAllData('product')->result();
		$this->load->view('product/index', $data);
	}

	public function add()
	{
		$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
		$this->load->view('product/add', $data);
	}

	public function processAdd(){
		$this->form_validation->set_rules('nama', 'Nama', 'required');

		if($this->form_validation->run() == false){
			$this->load->view('product/add');
		}else{
			$data = array(
				'nama_product'  	 	=> $this->input->post('nama'),
				'created_date' 			=> date('Y-m-d'),
				'description'			=> $this->input->post('description')
			);

			$res = $this->all_model->insertData('product', $data);
			if($res == false){
				$this->session->set_flashdata('error', 'Data product not saved');
				redirect(base_url() . 'product/add');
			}

			$this->session->set_flashdata('success', 'Data product saved');
			redirect(base_url() . 'product/index');
		}
	}

	public function edit($id){
		$condition = array("id_product" => $id);
		$data['product'] = $this->all_model->getDataByCondition('product', $condition)->row();
		$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
		$this->load->view('product/edit', $data);
	}

	public function detail($id){
		$condition = array("id_product" => $id);
		$data['product'] = $this->all_model->getDataByCondition('product', $condition)->row();
		$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
		$this->load->view('product/detail', $data);
	}

	public function processEdit(){
		$this->form_validation->set_rules('nama', 'Nama', 'required');

		if($this->form_validation->run() == false){
			$this->load->view('product/edit');
		}else{
			$condition = array("id_product" => $this->input->post('id'));
			$data = array(
				'id_product'			=> $this->input->post('id'),
				'nama_product'  	 	=> $this->input->post('nama'),
				'updated_date' 			=> date('Y-m-d'),
				'description'			=> $this->input->post('description')
			);
			$res = $this->all_model->updateData('product', $condition, $data);
			if($res == false){
				$this->session->set_flashdata('error', 'Data product not updated');
				redirect(base_url() . 'product/edit');
			}

			$this->session->set_flashdata('success', 'Data product updated');
			redirect(base_url() . 'product/index');
		}
	}

	public function delete($id){
		$condition = array("id_product" => $id);
		$res  = $this->all_model->deleteData("product", $condition);
		if($res == false){
			$this->session->set_flashdata('error', 'Data product not deleted');
			redirect(base_url() . "product/index");
		}

		$this->session->set_flashdata('success', 'Data product deleted');
		redirect(base_url() . "product/index");
	}
}