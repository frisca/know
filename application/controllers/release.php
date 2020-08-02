<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Release extends CI_Controller {	
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

	public function lists($id){
		if($id != 'x.x'){
			$condition = array('release' => $id);
			$data['project'] = $this->all_model->getDataByCondition('project', $condition)->result();
			$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
			$data['nama'] = $profile->nama;
			$this->load->view('release/list', $data);
		}else{
			$condition = array('release' => null);
			$data['project'] = $this->all_model->getDataByCondition('project', $condition)->result();
			$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
			$data['nama'] = $profile->nama;
			$this->load->view('release/list', $data);
		}
	}

	public function nonrelease($id){
		$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
		$data['project'] = $this->all_model->getDetailProjectById($id)->row();
        $data['count'] = $this->all_model->getCommentByProject($id)->num_rows();
        $data['comment'] = $this->all_model->getCommentByProject($id)->result();
		$this->load->view('release/nonrelease', $data);
	}

	public function detail($id){
		$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
        $data['project'] = $this->all_model->getDetailProjectById($id)->row();
        $data['count'] = $this->all_model->getCommentByProject($id)->num_rows();
		$data['comment'] = $this->all_model->getCommentByProject($id)->result();
		$data['projects'] = $this->all_model->getAllProjectByNonId($id)->result();
        $this->load->view('release/detail', $data);
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
		$profile = $this->all_model->getDataByCondition('user', array('id' => $this->session->userdata('id')))->row();
		$data['nama'] = $profile->nama;
		$this->load->view('release/edit', $data);
    }

    public function nonreleaseedit($id)
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
		$this->load->view('release/nonreleaseedit', $data);
    }

    public function processNonreleaseedit(){
        $condition = array('id_project' => $this->input->post('id'));
        $this->form_validation->set_rules('id_product', 'Product', 'required');
        $this->form_validation->set_rules('title', 'Judul', 'required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');
        $this->form_validation->set_rules('start_date', 'Dari Tanggal', 'required');
        $this->form_validation->set_rules('end_date', 'Sampai Tanggal', 'required');

        if($this->form_validation->run() == false){
            $this->load->view('release/nonreleaseedit/'.$this->input->post('id'));
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
				if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) <= date('Y-m-d') && date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d'))
				{
					$status = 2;
				}

				if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) > date('Y-m-d') && date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d'))
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
					redirect(base_url() . 'release/nonreleaseedit/' . $this->input->post('id'));
				}

				$this->session->set_flashdata('success', 'Data project saved');
				redirect(base_url() . 'release/nonrelease/' . $this->input->post('id'));
			}else{
				date_default_timezone_set("Asia/Jakarta");
				if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) <= date('Y-m-d') && date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d'))
				{
					$status = 2;
				}

				if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) > date('Y-m-d') && date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d'))
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
					redirect(base_url() . 'release/nonreleaseedit/' . $this->input->post('id'));
				}else{
					$con = array('id_project' => $this->input->post('id'));
					$res_upload = $this->all_model->updateData('project', $con, $data);
					if($res_upload == false){
						$this->session->set_flashdata('error', 'Data project not updated');
						redirect(base_url() . 'release/nonreleaseedit/' . $this->input->post('id'));
					}
					$this->session->set_flashdata('success', 'Data project updated');
					redirect(base_url() . 'release/nonrelease/' . $this->input->post('id'));
				}
			}
            // if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) > date('Y-m-d')){
            //     $status = 0;
            // }else if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d')
            // && date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) < date('Y-m-d')){
            //     $status = 1;
            // }else{
            //     $status = 2;
            // }

            // $data = array(
            //     'id_product' => $this->input->post('id_product'),
            //     'nama_project' => $this->input->post('title'),
            //     'description' => $this->input->post('description'),
            //     'start_date' => date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))),
            //     'end_date' => date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))),
            //     'status'   => $status,
            //     'updated_date' => date('Y-m-d')
            // );

            // $res = $this->all_model->updateData('project', $condition, $data);
            // if($res == false){
            //     $this->session->set_flashdata('error', 'Data project not updated');
            //     redirect(base_url() . 'release/nonreleaseedit/' . $this->input->post('id'));
            // }

            // $this->session->set_flashdata('success', 'Data project updated');
            // redirect(base_url() . 'release/nonrelease/' . $this->input->post('id'));
        }
    }
    
    public function processEdit(){
        $condition = array('id_project' => $this->input->post('id'));
        $this->form_validation->set_rules('id_product', 'Product', 'required');
        $this->form_validation->set_rules('title', 'Judul', 'required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');
        $this->form_validation->set_rules('start_date', 'Dari Tanggal', 'required');
        $this->form_validation->set_rules('end_date', 'Sampai Tanggal', 'required');

        if($this->form_validation->run() == false){
            $this->load->view('release/edit/' . $this->input->post('id'));
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
				if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) <= date('Y-m-d') && date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d'))
				{
					$status = 2;
				}

				if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) > date('Y-m-d') && date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d'))
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
					redirect(base_url() . 'release/edit/' . $this->input->post('id'));
				}

				$this->session->set_flashdata('success', 'Data project saved');
				redirect(base_url() . 'release/detail/' . $this->input->post('id'));
			}else{
				date_default_timezone_set("Asia/Jakarta");
				if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) <= date('Y-m-d') && date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d'))
				{
					$status = 2;
				}

				if(date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) > date('Y-m-d') && date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d'))
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
						redirect(base_url() . 'release/edit/' . $this->input->post('id'));
					}
					$this->session->set_flashdata('success', 'Data project updated');
					redirect(base_url() . 'release/detail/' . $this->input->post('id'));
				}
			}
            //     $status = 0;
            // }else if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d')
            // && date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) < date('Y-m-d')){
            //     $status = 1;
            // }else{
            //     $status = 2;
            // }

            // $data = array(
            //     'id_product' => $this->input->post('id_product'),
            //     'nama_project' => $this->input->post('title'),
            //     'description' => $this->input->post('description'),
            //     'start_date' => date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))),
            //     'end_date' => date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))),
            //     'status'   => $status,
            //     'updated_date' => date('Y-m-d')
            // );

            // $res = $this->all_model->updateData('project', $condition, $data);
            // if($res == false){
            //     $this->session->set_flashdata('error', 'Data project not saved');
            //     redirect(base_url() . 'release/edit/' . $this->input->post('id'));
            // }

            // $this->session->set_flashdata('success', 'Data project saved');
            // redirect(base_url() . 'release/detail/' . $this->input->post('id'));
            // if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) > date('Y-m-d')){
            //     $status = 0;
            // }else if(date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))) <= date('Y-m-d')
            // && date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))) < date('Y-m-d')){
            //     $status = 1;
            // }else{
            //     $status = 2;
            // }

            // $data = array(
            //     'id_product' => $this->input->post('id_product'),
            //     'nama_project' => $this->input->post('title'),
            //     'description' => $this->input->post('description'),
            //     'start_date' => date('Y-m-d', strtotime(strtr($this->input->post('start_date'), '/', '-'))),
            //     'end_date' => date('Y-m-d', strtotime(strtr($this->input->post('end_date'), '/', '-'))),
            //     'status'   => $status,
            //     'updated_date' => date('Y-m-d')
            // );

            // $res = $this->all_model->updateData('project', $condition, $data);
            // if($res == false){
            //     $this->session->set_flashdata('error', 'Data project not saved');
            //     redirect(base_url() . 'release/edit/' . $this->input->post('id'));
            // }

            // $this->session->set_flashdata('success', 'Data project saved');
            // redirect(base_url() . 'release/detail/' . $this->input->post('id'));
        }
    }

    public function delete($id){
    	$condition = array('id_project' => $id);
    	$project = $this->all_model->getDataByCondition('project', $condition)->row();
    	$release = $project->release;

    	$comment = $this->all_model->deleteData('comment', $condition);
    	if($comment == false){
    		$this->session->set_flashdata('error', 'Data project not deleted');
    		redirect(base_url() . 'release/detail/' . $id);
    	}

    	$res = $this->all_model->deleteData('project', $condition);
    	$this->session->set_flashdata('success', 'Data project deleted');
    	redirect(base_url() . 'release/lists/' . $release);
    }

    public function nonreleasedelete($id){
    	$condition = array('id_project' => $id);
    	$project = $this->all_model->getDataByCondition('project', $condition)->row();
    	$release = $project->release;

    	$comment = $this->all_model->deleteData('comment', $condition);
    	if($comment == false){
    		$this->session->set_flashdata('error', 'Data project not deleted');
    		redirect(base_url() . 'release/nonrelease/' . $id);
    	}

    	$res = $this->all_model->deleteData('project', $condition);
    	$this->session->set_flashdata('success', 'Data project deleted');
    	redirect(base_url() . 'project/lists/' . $project->id_product);
    }
}