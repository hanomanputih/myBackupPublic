<?php 
Class General extends CI_Model{

	private $tbname = '';
	public function set_table($tbname){

		if($this->db->table_exists($tbname)){
			$this->tbname = $tbname;
		}else{
			return false;
		}
	}

	public function get_table(){
		return $this->tbname;
	}

	public function insert($data){

		$insert = $this->db->insert($this->tbname,$data);
		return $insert;
	}

	public function where($condition){
		$this->db->where($condition);
	}

	public function update($data){
		$update = $this->db->update($this->tbname, $data);
		return $update;
	}

	public function delete(){
		$delete = $this->db->delete($this->tbname);
		return $delete;
	}

	public function get_result_array(){
		$get = $this->db->get($this->tbname);
		if($get->num_rows() > 0){
			return $get->result_array();
		}else{
			return false;
		}
	}

	public function get_row_array(){
		$get = $this->db->get($this->tbname);
		if($get->num_rows > 0){
			return $get->row_array();
		}else{
			return false;
		}
	}

}

 ?>