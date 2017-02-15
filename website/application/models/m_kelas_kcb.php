<?php

class M_kelas_kcb extends CI_Model{

	private $tbname = "website_kelas_kcb";

	// imamsrifkan : query mengambil semua data kelas kcb
	public function getAllKelasKcb()
	{
		$get = $this->db->order_by("kelas_nama","asc")
			        ->get($this->tbname);
		if($get->num_rows() > 0)
		{
			$result = $get->result_array();
			return $result;
		}
		else
		{
			return FALSE;
		}
	}

	// imamsrifkan : query mengambil data kelas kcb berdasarkan atribut
	public function getKelasKcbByAttr($data)
	{
		$get = $this->db->order_by("kelas_nama","asc")
                                ->get_where($this->tbname,$data);
		if($get->num_rows() > 0)
		{
			return $get->result_array();
		}
		else
		{
			return false;
		}
	}

	// imamsrifkan : query mengambil data kelas kcb berdasarkan id
	public function getKelasKcbById($id="")
	{
		$get = $this->db->get_where($this->tbname,array("kelas_id"=>$id));
		if($get->num_rows() > 0)
		{
			$result = $get->row_array();
			return $result;
		}
		else
		{
			return FALSE;
		}
	}

	// imamsrifkan : query mengambil semua data kelas kecuali berdasarkan id
	public function getKelasKcbExceptId($id="")
	{
		$get = $this->db->order_by("kelas_nama","asc")
						->where("kelas_id !=",$id)
						->get($this->tbname);
		if($get->num_rows() > 0)
		{
			$result = $get->result_array();
			return $result;
		}
		else
		{
			return FALSE;
		}
	}

	// imamsrifkan : query untuk menambahkan data kelas kcb
	public function insertKelasKcb($data)
	{
		$insert = $this->db->insert($this->tbname,$data);
		return $insert;
	}

	// imamsrifkan : query untuk update data kelas kcb
	public function updateKelasKcb($data)
	{
		$update = $this->db->where("kelas_id",$data["kelas_id"])
							->update($this->tbname,$data);
		return $update;
	}

	// imamsrifkan : query untuk menghapus data kelas kcb
	public function deleteKelasKcb($id="")
	{
		$deleteKelas = $this->db->where("kelas_id",$id)
								->delete($this->tbname);
		if($deleteKelas > 0)
		{
			$deleteData = $this->db->where("kelas_id",$id)
									->delete("website_user_kcb");
			return $deleteData;
		}
		else
		{
			return false;
		}
	}
}