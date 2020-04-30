<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('all_model');
		if($this->session->userdata('logged_in') != 1) {
			$this->session->sess_destroy();
			redirect(base_url('login'));
		}
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
            $data = $this->all_model->getCommentByDesc($this->input->post('idProject'))->row();
            echo json_encode($data);
        }else{
            $data = 10;
            echo json_encode($data);
        }
    }
}