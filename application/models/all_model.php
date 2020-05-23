<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class All_model extends CI_Model {
	public function getAllData($table)
	{
		return $this->db->get($table);
	}

	public function getDataByCondition($table,$condition)
	{
		$this->db->where($condition);
		return $this->db->get($table);
	}

	public function insertData($table,$data){
		return $this->db->insert($table, $data);
	}

	public function updateData($table, $condition, $data){
		$this->db->where($condition);
		return $this->db->update($table, $data);
	}

	public function deleteData($table, $condition){
		$this->db->where($condition);
		return $this->db->delete($table, $data);
	}

	public function getProjectById($id, $user)
	{
		$query = "SELECT p.*, pr.nama_product, pr.id_product, u.* FROM project p LEFT join product pr on p.id_product = pr.id_product left join user u on p.created_by = u.id where p.id_project = " . $id . " and u.id = " . $user;
		return $this->db->query($query); 
	}

	public function getProductById($id)
	{
		$query = "SELECT p.*, pr.nama_product, pr.id_product FROM product pr LEFT join project p on p.id_product = pr.id_product where pr.id_product = " . $id . " order by end_date desc";
		return $this->db->query($query); 
	}

	public function getCommentByProject($id)
	{
		$query = "SELECT c.*, p.*, u.*, pr.* FROM comment c LEFT join project p on p.id_project = c.id_project 
		left join user u on u.id = c.id_user left join product pr on pr.id_product = p.id_product 
		where c.id_project = " . $id . " order by id_comment asc";
		return $this->db->query($query); 
	}

	public function getProject($id)
	{
		$query = "SELECT p.*, pr.nama_product, pr.id_product, u.* FROM project p LEFT join product pr on p.id_product = pr.id_product left join user u on p.created_by = u.id where p.id_project = " . $id ;
		return $this->db->query($query); 
	}

	// public function updateRelease($date, $updated_date){
	// 	$query = "update project  p set p.status = 2, p.updated_date = '" . $updated_date . "' where p.end_date = '" . $date . "' and p.start_date != '" . $date . "'";
	// 	$this->db->query($query);
	// 	return true;
	// }

	// public function updateOngoing($date, $updated_date){
	// 	$query = "update project  p set p.status = 1, p.updated_date = '" . $updated_date . "' where '" . $date . "' between p.start_date and p.end_date and p.status != 2";
	// 	$this->db->query($query);
	// 	return true;
	// }

	// public function updateUpcoming($date, $updated_date){
	// 	$query = "update project  p set p.status = 0, p.updated_date = '" . $updated_date . "' where '" . $date . "' not between p.start_date and p.end_date";
	// 	$this->db->query($query);
	// 	return true;
	// }

	// public function getReleaseByNotUpdate($date){
	// 	$query = "select p.* from project p where p.updated_date != '" . $date . "' and status = 2 order by p.updated_date desc limit 1";
	// 	return $this->db->query($query);
	// }

	// public function getReleaseByUpdate($date){
	// 	$query = "select p.* from project p where p.updated_date = '" . $date . "' and status = 2";
	// 	return $this->db->query($query);
	// }

	public function getListProjectByRelease(){
		$query = "select p.* from project p where status = 2";
		return $this->db->query($query);
	}

	public function getDetailProjectById($id)
	{
		$query = "SELECT p.*, pr.nama_product, pr.id_product, u.* FROM project p LEFT join product pr on p.id_product = pr.id_product left join user u on p.created_by = u.id where p.id_project = " . $id;
		return $this->db->query($query); 
	}

	public function getCommentByDesc($id)
	{
		$query = "SELECT c.*, p.*, u.* FROM comment c LEFT join project p on p.id_project = c.id_project 
		left join user u on u.id = c.id_user where c.id_project = " . $id . " order by id_comment desc limit 1 ";
		return $this->db->query($query); 
	}

	public function getSearchNama($table, $nama){
		$this->db->like('nama_project', $nama , 'both');
        $this->db->order_by('nama_project', 'ASC');
        return $this->db->get($table);
	}

	public function getProjectIdByLimit()
	{
		$query = "SELECT * FROM project order by id_project desc limit 1";
		return $this->db->query($query); 
	}

	public function getListProject(){
		$query = "select * from project order by nama_project asc";
		return $this->db->query($query);
	}

	public function getListProduct(){
		$query = "select * from product order by nama_product asc";
		return $this->db->query($query);
	}

	public function updateUpcoming($date){
		$query = "update project  p set p.status = 0, p.updated_date = '" . $date . "' where p.end_date > '" . $date . "' and p.start_date > '" . $date . "'";
		$this->db->query($query);
		return true;
	}

	public function updateOngoing($date){
		$query = "update project  p set p.status = 1, p.updated_date = '" . $date . "' where p.end_date > '" . $date . "' and p.start_date <= '" . $date . "'";
		$this->db->query($query);
		return true;
	}

	public function updateRelease($date){
		$query = "update project  p set p.status = 2, p.updated_date = '" . $date . "' where p.end_date <= '" . $date . "' and p.start_date < '" . $date . "'";
		$this->db->query($query);
		return true;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */