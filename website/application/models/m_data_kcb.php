<?php

class M_data_kcb extends CI_Model{

	private $tbname = "website_user_kcb";

	// imamsrifkan : query mengambil semua data mahasiswa kcb
	public function getAllData()
	{
		$get = $this->db->order_by("praktikan_nim","asc")
                                ->join("website_kelas_kcb","website_kelas_kcb.kelas_id = ".$this->tbname.".kelas_id")
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

	// imamsrifkan : query mengambil data mahasiswa kcb berdasarkan id
	public function getDataById($id="")
	{
		$get = $this->db->where("praktikan_id",$id)
						->join("website_kelas_kcb","website_kelas_kcb.kelas_id = ".$this->tbname.".kelas_id")
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

	// imamsrifkan : query mengambil data mahasiswa berdasarkan nim
	public function getDataByNim($nim="")
	{
		$get = $this->db->join("website_kelas_kcb","website_kelas_kcb.kelas_id = ".$this->tbname.".kelas_id")
                                ->get_where($this->tbname,array("praktikan_nim"=>$nim));
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
        
        public function getDataByNimByAttr($nim="",$data)
	{
		$get = $this->db->join("website_kelas_kcb","website_kelas_kcb.kelas_id = ".$this->tbname.".kelas_id")
                                ->where($data)
                                ->where(array("praktikan_nim"=>$nim))
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

	// imamsrifkan : query mangambil data mahasiswa berdasarkan kelas
	public function getDataByKelas($kelas)
	{
		$get = $this->db->order_by("praktikan_nim","asc")
						->where("website_kelas_kcb.kelas_nama",$kelas)
						->join("website_kelas_kcb","website_kelas_kcb.kelas_id = ".$this->tbname.".kelas_id")
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
        
        public function getDataByAttr($data)
        {
            $get = $this->db->order_by("praktikan_nim","asc")
                            ->where($data)
                            ->join("website_kelas_kcb","website_kelas_kcb.kelas_id = ".$this->tbname.".kelas_id")
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

	// imamsrifkan : query mengambil data mahasiswa berdasarkan atribut
	public function getDataByAtribut($options = array())
	{
		$get = $this->db->order_by("praktikan_nim","asc")
						->like("praktikan_nim",$option["keyword"])
						->or_like("praktikan_nama",$option["keyword"])
						->get($this->tbname);
		if($get->num_rows() > 0)
		{
			return $get->result_array();
		}
		else
		{
			return FALSE;
		}
	}

	// imamsrifkan : query menghitung jumlah data mahasiswa 
	public function getCountDataKcbById($id="")
	{
		$get = $this->db->where("kelas_id",$id)
						->select("count(*) as jumlah")
						->get($this->tbname);
		if($get->num_rows() > 0)
		{
			return $get->row_array();
		}
		else
		{
			return false;
		}
	}

	// imamsrifkan : query menambahkan data mahasiswa kcb
	public function insertData($data)
	{
		$insert = $this->db->insert($this->tbname,$data);
		return $insert;
	}

	// imamsrifkan : query update data mahasiswa kcb
	public function updateData($data)
	{
		$update = $this->db->where("praktikan_id",$data["praktikan_id"])
							->update($this->tbname,$data);
		return $update;
	}

	// imamsrifkan : query menghapus data mahasiswa kcb
	public function deleteData($id="")
	{
		$delete = $this->db->where("praktikan_id",$id)
                                    ->delete($this->tbname);
		return $delete;
	}

	// imamsrifkan : query menghitung data mahasiswa kcb
	public function countAllData()
	{
		$get = $this->db->get($this->tbname);
		return $get->num_rows();
	}
        
        public function countDataByAttr($data)
        {
            $get = $this->db->where($data)
                            ->join("website_kelas_kcb","website_kelas_kcb.kelas_id = ".$this->tbname.".kelas_id")
                            ->get($this->tbname);
            return $get->num_rows();
        }
}