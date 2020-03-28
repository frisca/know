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

	public function getProjectById($id)
	{
		$query = "SELECT p.*, pr.nama_product, pr.id_product FROM project p LEFT join product pr on p.id_product = pr.id_product where p.id_project = " .$id;
		return $this->db->query($query); 
	}

	public function getProductById($id)
	{
		$query = "SELECT p.*, pr.nama_product, pr.id_product FROM product pr LEFT join project p on p.id_product = pr.id_product where pr.id_product = " . $id . " order by end_date desc";
		return $this->db->query($query); 
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */