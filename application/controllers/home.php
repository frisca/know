<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {	
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
		$data['product'] = $this->all_model->getListProduct()->result();
		$data['nama'] = $profile->nama;
		$this->load->view('index', $data);
	}
}