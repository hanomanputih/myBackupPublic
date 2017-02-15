<?php

class M_data_pbo extends CI_Model{

	private $tbname = "website_user_pbo";

	// imamsrifkan : query untuk mengambil semua data user pbo
	public function getAllDataPbo()
	{
		$get = $this->db->order_by("pbo_nim","ASC")
						->join("website_kelas_tugas","website_kelas_tugas.kelas_id = ".$this->tbname.".kelas_id")
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
        
        public function getDataPboByAttr($data)
        {
            $get = $this->db->order_by("pbo_nim","asc")
                            ->join("website_kelas_tugas","website_kelas_tugas.kelas_id = ".$this->tbname.".kelas_id")
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

	// imamsrifkan : query untuk mengambil data user pbo berdasarkan id
	public function getDataPboById($id="")
	{
		$get = $this->db->where(array("pbo_id"=>$id))
						->join("website_kelas_tugas","website_kelas_tugas.kelas_id = ".$this->tbname.".kelas_id")
						->get($this->tbname);
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

	// imamsrifkan : query untuk mengambil data user pbo berdasarkan nim
	public function getDataPboByNim($nim="")
	{
		$get = $this->db->where("pbo_nim",$nim)
						->Join("website_kelas_tugas","website_kelas_tugas.kelas_id = ".$this->tbname.".kelas_id")
						->get($this->tbname);
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

	// imamsrifkan : query mengambil data user pbo berdasarkan kelas
	public function getDataPboByKelas($kelas="")
	{
		$get = $this->db->where("kelas_nama",$kelas)
                                ->join("website_kelas_tugas","website_kelas_tugas.kelas_id = ".$this->tbname.".kelas_id")
                                ->get($this->tbname);
		if($get->num_rows() > 0)
		{
			return $get->result_array();
		}
		else
		{
			return false;
		}
	}

	// imamsrifkan : query mengambil total data user pbo
	public function countAllDataPbo()
	{
		$get = $this->db->get($this->tbname);
		if($get->num_rows > 0)
		{
			return $get->num_rows();
		}
		else
		{
			return false;
		}
	}
        
        public function countDataPboByAttr($data)
        {
            $get = $this->db->join("website_kelas_tugas","website_kelas_tugas.kelas_id = ".$this->tbname.".kelas_id")
                            ->get_where($this->tbname,$data);
            return $get->num_rows();
        }

	// imamsrifkan :query untuk menambahkan data user pbo
	public function insertDataPbo($data)
	{
		$insert = $this->db->insert($this->tbname,$data);
		return $insert;
	}

	// imamsrifkan : query untuk update data user pbo
	public function updateDataPbo($data)
	{
		$update = $this->db->where("pbo_id",$data["pbo_id"])
							->update($this->tbname,$data);
		return $update;
	}

	// imamsrifkan : query untuk menghapus data user pbo
	public function deleteDataPbo($id="")
	{
		$delete = $this->db->where("pbo_id",$id)
							->delete($this->tbname);
		return $delete;
	}
}