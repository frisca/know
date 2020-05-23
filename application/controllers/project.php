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
		$this->load->helper(array('url','download'));
		if($this->session->userdata('logged_in') != 1) {
			$this->session->sess_destroy();
			redirect(base_url('login'));
		}
	}

	public function index()
	{
		$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
		$data['project'] = $this->all_model->getAllData('project')->result();
		$this->load->view('project/index', $data);
	}

	public function add()
	{
		$this->load->library('CKEditor');
 		$this->load->library('CKFinder');
 
 		//Add Ckfinder to Ckeditor
		$this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/');
		$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
		$data['product'] = $this->all_model->getListProduct()->result();  
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
			// if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) > date('Y-m-d')){
			// 	$status = 0;
			// }else if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d')
			// && date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) > date('Y-m-d')){
			// 	$status = 1;
			// }else{
			// 	$status = 2;
			// }
			// if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) > date('Y-m-d')){
			// 	$status = 0;
			// }else if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d')
			// && date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) < date('Y-m-d')){
			// 	$status = 1;
			// }else if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) <= date('Y-m-d')){
			// 	$status = 2;
			// }

			date_default_timezone_set("Asia/Jakarta");
			if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) > date('Y-m-d') && date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) > date('Y-m-d'))
			{
				$status = 0;
			}

			else if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) > date('Y-m-d') && date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) < date('Y-m-d'))
			{
				$status = 1;
			}

			else if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) <= date('Y-m-d') && date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) < date('Y-m-d'))
			{
				$status = 2;
			}
			
			if(!$_FILES['files']['name']){
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
			}else{
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

				$res_project = $this->all_model->getProjectIdByLimit()->row();
				if (!is_dir('./upload/'.$res_project->id_project)) {
				    mkdir('./upload/' . $res_project->id_project, 0777, TRUE);
				}

				$config['upload_path']  = './upload/' . $res_project->id_project;
				$config['allowed_types']    = 'pdf|docs|doc|xlsx|jpg|jpeg|png|gif|docx';

				$this->load->library('upload', $config);
 
				if ( ! $this->upload->do_upload('files')){
					$this->session->set_flashdata('error', 'Data project not saved');
					redirect(base_url() . 'project/add');
				}else{
					$con = array('id_project' => $res_project->id_project);
					$datas = array('files' => $_FILES['files']['name']);
					$res_upload = $this->all_model->updateData('project', $con, $datas);
					if($res == false){
						$this->session->set_flashdata('error', 'Data project not saved');
						redirect(base_url() . 'project/add');
					}
					$this->session->set_flashdata('success', 'Data project saved');
					redirect(base_url() . 'project/index');
				}
			}
		}
	}

	public function edit($id)
	{
		$this->load->library('CKEditor');
 		$this->load->library('CKFinder');
 
 		//Add Ckfinder to Ckeditor
		$this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/');
		$condition = array('id_project' => $id);
		$data['product'] = $this->all_model->getListProduct()->result();   
		$data['project'] = $this->all_model->getDataByCondition('project', $condition)->row();
		$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
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
			if(!$_FILES['files']['name']){
				// var_dump(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))));exit();
				// var_dump(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))));exit();
				// if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) > date('Y-m-d')){
				// 	$status = 0;
				// }else if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d')
				// && date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) < date('Y-m-d')){
				// 	$status = 1;
				// }else if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) <= date('Y-m-d')){
				// 	$status = 2;
				// }
				date_default_timezone_set("Asia/Jakarta");
				if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) <= date('Y-m-d') && date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) < date('Y-m-d'))
				{
					$status = 2;
				}

				if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) > date('Y-m-d'))
				{
					$status = 1;
				}

				if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) > date('Y-m-d') && date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) > date('Y-m-d'))
				{
					$status = 0;
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
			}else{
				// var_dump(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))));exit();
				// if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) > date('Y-m-d')){
				// 	$status = 0;
				// 	var_dump($status);exit();
				// }else if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d')
				// && date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) < date('Y-m-d')){
				// 	$status = 1;
				// 	var_dump($status);exit();
				// }else{
				// 	$status = 2;
				// 	var_dump($status);exit();
				// }

				// if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) > date('Y-m-d')){
				// 	$status = 0;
				// }else if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d')
				// && date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) < date('Y-m-d')){
				// 	$status = 1;
				// }else if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) <= date('Y-m-d')){
				// 	$status = 2;
				// }
				date_default_timezone_set("Asia/Jakarta");
				if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) <= date('Y-m-d') && date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) < date('Y-m-d'))
				{
					$status = 2;
				}

				if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) > date('Y-m-d'))
				{
					$status = 1;
				}

				if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) > date('Y-m-d') && date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) > date('Y-m-d'))
				{
					$status = 0;
				}

				$project = $this->all_model->getDataByCondition('project', array('id_project'=>$this->input->post('id')))->row();

				unlink(FCPATH."upload/".$this->input->post('id').'/'.$project->files);

				if (!is_dir('./upload/'.$this->input->post('id'))) {
				    mkdir('./upload/' . $this->input->post('id'), 0777, TRUE);
				}

				$config['upload_path']  = './upload/' . $this->input->post('id');
				$config['allowed_types']    = 'pdf|docs|doc|xlsx|jpg|jpeg|png|gif|docx';

				$this->load->library('upload', $config);

				$data = array(
					'id_product' => $this->input->post('id_product'),
					'nama_project' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'start_date' => date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))),
					'end_date' => date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))),
					'status'   => $status,
					'updated_date' => date('Y-m-d'),
					'files' => $_FILES['files']['name']
				);
				if ( ! $this->upload->do_upload('files')){
					$this->session->set_flashdata('error', 'Data project not updated');
					redirect(base_url() . 'project/edit/' . $this->input->post('id'));
				}else{
					$con = array('id_project' => $this->input->post('id'));
					$res_upload = $this->all_model->updateData('project', $con, $data);
					if($res_upload == false){
						$this->session->set_flashdata('error', 'Data project not updated');
						redirect(base_url() . 'project/edit/' . $this->input->post('id'));
					}
					$this->session->set_flashdata('success', 'Data project updated');
					redirect(base_url() . 'project/index');
				}
			}
		}
	}

	public function delete($id){
		$condition = array("id_project" => $id);

		$project = $this->all_model->getDataByCondition('project', $condition)->row();

		unlink(FCPATH."upload/".$id.'/'.$project->files);

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
		$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
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

	public function statusOngoing(){
		date_default_timezone_set("Asia/Jakarta");
		$res = $this->all_model->updateOngoing(date('Y-m-d')) ;
		if($res == true){
			$data = 'Berhasil';
			echo json_encode($data);
		}else{
			$data = 'Gagal';
			echo json_encode($data);
		}
	}

	public function statusUpcoming(){
		date_default_timezone_set("Asia/Jakarta");
		$res = $this->all_model->updateUpcoming(date('Y-m-d'));
		if($res == true){
			$data = 'Berhasil';
			echo json_encode($data);
		}else{
			$data = 'Gagal';
			echo json_encode($data);
		}
	}

	public function statusRelease(){
		date_default_timezone_set("Asia/Jakarta");
		$res = $this->all_model->updateRelease(date('Y-m-d'));
		if($res == true){
			$data = 'Berhasil';
			echo json_encode($data);
		}else{
			$data = 'Gagal';
			echo json_encode($data);
		}
	}

	function get_autocomplete(){
        if (isset($_GET['term'])) {
            // $result = $this->blog_model->search_blog($_GET['term']);
            // if (count($result) > 0) {
            // foreach ($result as $row)
            //     $arr_result[] = $row->blog_title;
            //     echo json_encode($arr_result);
			// }
			// $condition = array('nama_project' => $_GET['term']);
			// $result = $this->all_model->getDataByCondition('project', $condition)->result();
			// if(count($result) > 0){
			// 	foreach($result as $row){
			// 		$arr_result[] = $row->nama_project;
			// 		echo json_encode($arr_result);
			// 	}
			// }
			// var_dump($_GET['term']);exit();
			
			$result = $this->all_model->getSearchNama('project', $this->input->get('term'))->result();
			if (count($result) > 0) {
			foreach ($result as $row)
				$arr_result[] = array('label' => $row->nama_project, 'value' => $row->id_project);
				echo json_encode($arr_result);
			}
        }
    }

    public function views($id)
	{
		$this->load->library('CKEditor');
 		$this->load->library('CKFinder');
 
 		//Add Ckfinder to Ckeditor
		$this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/');
		$condition = array('id_project' => $id);
		$data['product'] = $this->all_model->getAllData('product')->result();  
		$data['project'] = $this->all_model->getDataByCondition('project', $condition)->row();
		$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
		$this->load->view('project/view', $data);
	}

	function download($id = NULL) {
	    $condition = array("id_project" => $id);
		$project = $this->all_model->getDataByCondition('project', $condition)->row();
	    $data = file_get_contents(base_url('/upload/'.$id.'/'.str_replace(' ', '_', $project->files)));
	    force_download(str_replace(' ', '_', $project->files), $data);
	}
}