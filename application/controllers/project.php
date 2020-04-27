<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {	
	// public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->load->model('all_model');
	// 	if($this->session->userdata('logged_in') != 1) {
	// 		redirect(base_url('login/index'));
	// 	}
	// }
	// extends CI_Controller for CI 2.x users
 
	public $data = array();
	 
	public function __construct() {
	 
		//parent::Controller();
		parent::__construct();
		 
		$this->load->helper('ckeditor_helper');
		 
		 
		//Ckeditor's configuration
		$this->data['ckeditor'] = array(
		 
		 	//ID of the textarea that will be replaced
		 	'id' => 'content',
			'path' => 'js/ckeditor',
		 
			 //Optionnal values
			 'config' => array(
			 'toolbar' => "Full", //Using the Full toolbar
			 'width' => "550px", //Setting a custom width
			 'height' => '100px', //Setting a custom height		 
		),
		 
		 //Replacing styles from the "Styles tool"
		 'styles' => array(
		 
		 //Creating a new style named "style 1"
		 'style 1' => array (
		 'name' => 'Blue Title',
		 'element' => 'h2',
		 'styles' => array(
		 'color' => 'Blue',
		 'font-weight' => 'bold'
		 )
		 ),
		 
		 //Creating a new style named "style 2"
		 'style 2' => array (
		 'name' => 'Red Title',
		 'element' => 'h2',
		 'styles' => array(
		 'color' => 'Red',
		 'font-weight' => 'bold',
		 'text-decoration' => 'underline'
		 )
		 ) 
		 )
		 );
		 
		 $this->data['ckeditor_2'] = array(
		 
		 //ID of the textarea that will be replaced
		 'id' => 'content_2',
		 'path' => 'js/ckeditor',
		 
		 //Optionnal values
		 'config' => array(
		 'width' => "100%", //Setting a custom width
		 'height' => '100px', //Setting a custom height
		 'toolbar' => array( //Setting a custom toolbar
		 array('Bold', 'Italic'),
		 array('Underline', 'Strike', 'FontSize'),
		 array('Smiley'),
		 '/'
		 )
		 ),
		 
		 //Replacing styles from the "Styles tool"
		 'styles' => array(
		 
		 //Creating a new style named "style 1"
		 'style 3' => array (
		 'name' => 'Green Title',
		 'element' => 'h3',
		 'styles' => array(
		 'color' => 'Green',
		 'font-weight' => 'bold'
		 )
		 )
		 
		 )
		 ); 
		$this->load->model('all_model');
		if($this->session->userdata('logged_in') != 1) {
			$this->session->sess_destroy();
			redirect(base_url('login'));
		}
	}

	public function index()
	{
		$data['project'] = $this->all_model->getAllData('project')->result();
		$this->load->view('project/index', $data);
	}

	public function add()
	{
		$this->load->library('CKEditor');
 		$this->load->library('CKFinder');
 
 		//Add Ckfinder to Ckeditor
		$this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/');
		$data['product'] = $this->all_model->getAllData('product')->result();  
		$this->load->view('project/add', $data);
	}

	public function processAdd(){
		$this->form_validation->set_rules('id_product', 'Product', 'required');
		$this->form_validation->set_rules('title', 'Judul', 'required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'required');
		$this->form_validation->set_rules('start_date', 'Dari Tanggal', 'required');
		$this->form_validation->set_rules('end_date', 'Sampai Tanggal', 'required');

		if($this->form_validation->run() == false){
			$this->load->view('project/add');
		}else{
			if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) != date('Y-m-d')){
				$status = 0;
			}else if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) == date('Y-m-d')){
				$status = 1;
			}else if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) != date('Y-m-d')){
				$status = 2;
			}

			$data = array(
				'id_product' => $this->input->post('id_product'),
				'nama_project' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'start_date' => date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))),
				'end_date' => date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))),
				'status'   => $status,
				'created_date' => date('Y-m-d')
			);

			$res = $this->all_model->insertData('project', $data);
			if($res == false){
				$this->session->set_flashdata('error', 'Data project not saved');
				redirect(base_url() . 'product/add');
			}

			$this->session->set_flashdata('success', 'Data project saved');
			redirect(base_url() . 'project/index');
		}
	}

	public function edit($id)
	{
		$this->load->library('CKEditor');
 		$this->load->library('CKFinder');
 
 		//Add Ckfinder to Ckeditor
		$this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/');
		$data['product'] = $this->all_model->getAllData('product')->result();  
		$data['project'] = $this->all_model->getProjectById($id)->row();
		$this->load->view('project/edit', $data);
	}


	public function processEdit(){
		$condition = array('id_project' => $this->input->post('id'));
		$this->form_validation->set_rules('id_product', 'Product', 'required');
		$this->form_validation->set_rules('title', 'Judul', 'required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'required');
		$this->form_validation->set_rules('start_date', 'Dari Tanggal', 'required');
		$this->form_validation->set_rules('end_date', 'Sampai Tanggal', 'required');

		if($this->form_validation->run() == false){
			$this->load->view('project/edit');
		}else{
			$data = array(
				'id_product' => $this->input->post('id_product'),
				'nama_project' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'start_date' => date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))),
				'end_date' => date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))),
				'status'   => 0,
				'created_date' => date('Y-m-d')
			);

			$res = $this->all_model->updateData('project', $condition, $data);
			if($res == false){
				$this->session->set_flashdata('error', 'Data project not saved');
				redirect(base_url() . 'product/edit');
			}

			$this->session->set_flashdata('success', 'Data project saved');
			redirect(base_url() . 'project/index');
		}
	}

	public function delete($id){
		$condition = array("id_project" => $id);
		$res  = $this->all_model->deleteData("project", $condition);
		if($res == false){
			$this->session->set_flashdata('error', 'Data project not deleted');
			redirect(base_url() . "project/index");
		}

		$this->session->set_flashdata('success', 'Data project deleted');
		redirect(base_url() . "project/index");
	}

	public function detail($id){
		$condition = array("id_product" => $id);
		$data['product'] = $this->all_model->getDataByCondition('product', $condition)->row();
		$data['project'] = $this->all_model->getProductById($id)->result();
		$this->load->view('project/detail', $data);
	}

	public function detailProject($id){
		$data['count'] = $this->all_model->getCommentByProject($id)->num_rows();
		$data['comment'] = $this->all_model->getCommentByProject($id)->result();
		$data['project'] = $this->all_model->getProject($id)->row();
		$this->load->view('project/detailProject', $data);
	}


	public function insertComment(){
		$data = array(
			'comment' => $this->input->post('comment'),
			'id_project' => $this->input->post('idProject'),
			'id_user' => $this->input->post('idUser'),
			'created_date' => date('Y-m-d')
		);

		$res = $this->all_model->insertData('comment', $data);
		if($res == true){
			$data = 20;
			echo json_encode($data);
		}else{
			$data = 10;
			echo json_encode($data);
		}
	}
}