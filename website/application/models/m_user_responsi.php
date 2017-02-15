<?php

class M_user_responsi extends CI_Model{

	private $tbname = "website_user_responsi";

	public function getAllDataResponsi()
	{
		$get = $this->db->order_by("praktikan_nim","ASC")
						->join("website_user_kcb","website_user_kcb.praktikan_nim = ".$this->tbname.".praktikan_nim")
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
	// imamsrifkan : query mengambil data praktikan responsi berdasarkan id
	public function getDataResponsiById($id="")
	{
		$get = $this->db->where("praktikan_responsi_id",$id)
						->join("website_user_kcb","website_user_kcb.praktikan_nim = ".$this->tbname.".praktikan_nim")
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

	// imamsrifkan : query mengambil data praktikan responsi 
	public function getDataNotResponsi($data)
	{
		$get = $this->db->query("select * from website_user_kcb join website_kelas_kcb on website_kelas_kcb.kelas_id = website_user_kcb.kelas_id where website_kelas_kcb.ta_id = ".$data["ta_id"]." and not exists (select * from ".$this->tbname." where ".$this->tbname.".praktikan_nim = website_user_kcb.praktikan_nim) order by website_user_kcb.praktikan_nim asc");
		if($get->num_rows() > 0)
		{
			return $get->result_array();
		}
		else
		{
			return false;
		}
	}

	// imamsrifkan : query mengambil data praktikan responsi berdasarkan nim
	public function getDataResponsiByNim($nim="")
	{
		$get = $this->db->where($this->tbname.".praktikan_nim",$nim)
						->join("website_kelas_responsi","website_kelas_responsi.responsi_id = ".$this->tbname.".responsi_id")
						->join("website_user_kcb","website_user_kcb.praktikan_nim = ".$this->tbname.".praktikan_nim")
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

	// imamsrifkan : query mengambil data praktikan berdasarkan jadwal responsi
	public function getDataResponsiByJadwal($id="")
	{
		$get = $this->db->order_by($this->tbname.".praktikan_nim","asc")
						->where("responsi_id",$id)
						->join("website_user_kcb","website_user_kcb.praktikan_nim = ".$this->tbname.".praktikan_nim")
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
	// imamsrifkan : query mengambil data kelas yang sudah terdaftar berdasarkan id kelas responsi
	public function getKelasDataResponsiById($id="")
	{
		$get = $this->db->get_where($this->tbname,array("responsi_id"=>$id));
		if($get->num_rows() > 0)
		{
			return $get->row_array();
		}
		else
		{
			return false;
		}
	}

	// imamsrifkan : query menghitung data praktikan responsi berdasarkan jadwal
	public function countDataResponsiByKelas($id="")
	{
		$get = $this->db->get_where($this->tbname,array("responsi_id"=>$id));
		return $get->num_rows();
	}

	// imamsrifkan : query untuk menghitung jumlah data praktikan responsi
	public function countAllDataResponsi()
	{
		$get = $this->db->get($this->tbname);
		return $get->num_rows();
	}
        
        public function countDataResponsiByAttr($data)
        {
            $get = $this->db->join("website_kelas_responsi","website_kelas_responsi.responsi_id = ".$this->tbname.".responsi_id")
                            ->get_where($this->tbname,$data);
            return $get->num_rows();
        }

	// imamsrifkan : query untuk menambahkan data praktikan responsi
	public function insertDataResponsi($data)
	{
		$insert = $this->db->insert($this->tbname,$data);
		if($insert > 0)
		{
			$update = $this->db->where("responsi_id",$data["responsi_id"])
								->update("website_kelas_responsi",array("responsi_status"=>"ya"));
			return $update;
		}
		else
		{
			return false;
		}
	}

	// imamsrifkan : query update data praktikan responsi
	public function updateDataResponsi($data)
	{
		$update = $this->db->where("praktikan_responsi_id",$data["praktikan_responsi_id"])
							->update($this->tbname,$data);
		return $update;
	}

	// imamsrifkan : query untuk menghapus data praktikan responsi berdasarkan id
	public function deleteDataResponsi($id="")
	{
		$delete = $this->db->where("praktikan_responsi_id",$id)
							->delete($this->tbname);
		return $delete;
	}

	// imamsrifkan : query untuk menghapus data praktikan berdasarkan id jadwal responsi
	public function deleteDataResponsiByJadwal($id="")
	{
		$delete = $this->db->where("responsi_id",$id)
							->delete($this->tbname);
		return $delete;
	}
	
}