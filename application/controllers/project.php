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
			if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) > date('Y-m-d')){
				$status = 0;
			}else if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d')
			&& date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) > date('Y-m-d')){
				$status = 1;
			}else{
				$status = 2;
			}

			$data = array(
				'id_product' => $this->input->post('id_product'),
				'nama_project' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'start_date' => date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))),
				'end_date' => date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))),
				'status'   => $status,
				'created_date' => date('Y-m-d'),
				'created_by' => $this->session->userdata('id')
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
		$condition = array('id_project' => $id);
		$data['product'] = $this->all_model->getAllData('product')->result();  
		$data['project'] = $this->all_model->getDataByCondition('project', $condition)->row();
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
			if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) > date('Y-m-d')){
				$status = 0;
			}else if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d')
			&& date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) < date('Y-m-d')){
				$status = 1;
			}else{
				$status = 2;
			}

			$data = array(
				'id_product' => $this->input->post('id_product'),
				'nama_project' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'start_date' => date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))),
				'end_date' => date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))),
				'status'   => $status,
				'updated_date' => date('Y-m-d')
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

	public function lists($id){
		$condition = array("id_product" => $id);
		$data['product'] = $this->all_model->getDataByCondition('product', $condition)->row();
		$data['project'] = $this->all_model->getProductById($id)->result();
		// var_dump($data['project']);exit();
		$this->load->view('project/list', $data);
	}

	public function updateRelease(){
		$condition = array('id_project' => $this->input->post('id_project'));
		$data = array('release' => $this->input->post('release'));
		$res = $this->all_model->updateData('project', $condition, $data);
		if($res == true){
			$this->session->set_flashdata('success', 'Data project released');
			redirect(base_url() . "project/index");
		}
		$this->session->set_flashdata('error', 'Data project not released');
		redirect(base_url() . "project/index");
	}

	// public function release($id){
	// 	$condition = array('release' => $id);
	// 	$data['project'] = $this->all_model->getDataByCondition('project', $condition)->result();
	// 	$this->load->view('project/release', $data);
	// }

	// public function comment($id){
	// 	$data['project'] = $this->all_model->getDetailProjectById($id)->row();
	// 	$data['count'] = $this->all_model->getCommentByProject($id)->num_rows();
	// 	$data['comment'] = $this->all_model->getCommentByProject($id)->result();
	// 	$this->load->view('project/comment', $data);
	// }


	// public function insertComment(){
	// 	$data = array(
	// 		'comment' => $this->input->post('comment'),
	// 		'id_project' => $this->input->post('idProject'),
	// 		'id_user' => $this->input->post('idUser'),
	// 		'created_date' => date('Y-m-d')
	// 	);

	// 	$res = $this->all_model->insertData('comment', $data);
	// 	if($res == true){
	// 		$data = $this->all_model->getCommentByDesc($this->input->post('idProject'))->row();
	// 		echo json_encode($data);
	// 	}else{
	// 		$data = 10;
	// 		echo json_encode($data);
	// 	}
	// }


	// public function statusOngoing(){
	// 	$res = $this->all_model->updateOngoing(date('Y-m-d'), date('Y-m-d')) ;
	// 	if($res == true){
	// 		$data = 'Berhasil';
	// 		echo json_encode($data);
	// 	}else{
	// 		$data = 'Gagal';
	// 		echo json_encode($data);
	// 	}
	// }

	// public function statusUpcoming(){
	// 	$res = $this->all_model->updateUpcoming(date('Y-m-d'), date('Y-m-d'));
	// 	if($res == true){
	// 		$data = 'Berhasil';
	// 		echo json_encode($data);
	// 	}else{
	// 		$data = 'Gagal';
	// 		echo json_encode($data);
	// 	}
	// }

	// public function statusRelease(){
	// 	$res = $this->all_model->updateRelease(date('Y-m-d'), date('Y-m-d'));
	// 	if($res == true){
	// 		$condition = array('status' => 2, 'updated_date' => date('Y-m-d'));
	// 		$release = $this->all_model->getDataByCondition('project', $condition)->result();
	// 		if(empty($release)){
				
	// 		}else{
	// 			$res_release = $this->all_model->getReleaseByNotUpdate(date('Y-m-d'))->row();
	// 			$no_release = (int)$res_release->release + 1;
	// 			foreach($release as $key=>$value){
	// 				$condition = array('id_project' => $value->id_project);
	// 				$data = array(
	// 					'release' => (int) $no_release
	// 				);
	// 				$update_release = $this->all_model->updateData('project', $condition, $data);
	// 				if($update_release == "true"){
	// 					$datas = 'Berhasil';
	// 					echo json_encode($datas);
	// 				}else{
	// 					$datas = 'Gagal';
	// 					echo json_encode($datas);
	// 				}
	// 			}
	// 		}
	// 	}else{
	// 		$data = 'Gagal';
	// 		echo json_encode($data);
	// 	}
	// 	// $res = $this->all_model->updateRelease(date('Y-m-d'));
	// 	// if($res == true){
	// 	// 	$data = 'Berhasil';
	// 	// 	echo json_encode($data);
	// 	// }else{
	// 	// 	$data = 'Gagal';
	// 	// 	echo json_encode($data);
	// 	// }
	// }

	// public function updateRelease(){
	// 	$condition = array('id_project' => $this->input->post('id_project'));
	// 	$data = array('release' => $this->input->post('release'));
	// 	$res = $this->all_model->updateData('project', $condition, $data);
	// 	if($res == true){
	// 		$this->session->set_flashdata('success', 'Data project released');
	// 		redirect(base_url() . "project/index");
	// 	}
	// 	$this->session->set_flashdata('error', 'Data project not released');
	// 	redirect(base_url() . "project/index");
	// }

	// public function release($id){
	// 	$condition = array('release' => $id);
	// 	$data['project'] = $this->all_model->getDataByCondition('project', $condition)->result();
	// 	$this->load->view('project/release', $data);
	// }

	// public function editComment($id)
	// {
	// 	$this->load->library('CKEditor');
 	// 	$this->load->library('CKFinder');
 
 	// 	//Add Ckfinder to Ckeditor
	// 	$this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/');
	// 	$condition = array('id_project' => $id);
	// 	$data['product'] = $this->all_model->getAllData('product')->result();  
	// 	$data['project'] = $this->all_model->getDataByCondition('project', $condition)->row();
	// 	$this->load->view('project/editComment', $data);
	// }

	// public function processEditComment(){
	// 	$condition = array('id_project' => $this->input->post('id'));
	// 	$this->form_validation->set_rules('id_product', 'Product', 'required');
	// 	$this->form_validation->set_rules('title', 'Judul', 'required');
	// 	$this->form_validation->set_rules('description', 'Deskripsi', 'required');
	// 	$this->form_validation->set_rules('start_date', 'Dari Tanggal', 'required');
	// 	$this->form_validation->set_rules('end_date', 'Sampai Tanggal', 'required');

	// 	if($this->form_validation->run() == false){
	// 		$this->load->view('project/editComment');
	// 	}else{
	// 		if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) > date('Y-m-d')){
	// 			$status = 0;
	// 		}else if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d')
	// 		&& date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) < date('Y-m-d')){
	// 			$status = 1;
	// 		}else{
	// 			$status = 2;
	// 		}

	// 		$data = array(
	// 			'id_product' => $this->input->post('id_product'),
	// 			'nama_project' => $this->input->post('title'),
	// 			'description' => $this->input->post('description'),
	// 			'start_date' => date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))),
	// 			'end_date' => date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))),
	// 			'status'   => $status,
	// 			'updated_date' => date('Y-m-d')
	// 		);

	// 		$res = $this->all_model->updateData('project', $condition, $data);
	// 		if($res == false){
	// 			$this->session->set_flashdata('error', 'Data project not saved');
	// 			redirect(base_url() . 'product/editComment/' . $this->input->post('id'));
	// 		}

	// 		$this->session->set_flashdata('success', 'Data project saved');
	// 		redirect(base_url() . 'project/comment/' . $this->input->post('id'));
	// 	}
	// }

	// public function deleteComment($id){
	// 	$condition = array('id_project' => $id);
	// 	$project = $this->all_model->getDataByCondition('project', $condition)->row();
	// 	$release = $project->release;

	// 	$comment = $this->all_model->deleteData('comment', $condition);
	// 	if($comment == false){
	// 		$this->session->set_flashdata('error', 'Data project not deleted');
	// 		redirect(base_url() . 'project/comment/' . $id);
	// 	}

	// 	$res = $this->all_model->deleteData('project', $condition);
	// 	$this->session->set_flashdata('success', 'Data project deleted');
	// 	redirect(base_url() . 'project/release/' . $release);
	// }
}