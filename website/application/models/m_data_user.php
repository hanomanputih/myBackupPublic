<?php

class M_data_user extends CI_Model{

	private $tb_name = "website_kelas_kcb";

	// imamsrifkan : query mengambil semua data praktikan
	public function getAllDataUser()
	{
		$get = $this->db->order_by("praktikan_nim","ASC")
						->get($this->tb_name);
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

	// imamsrifkan : query untuk mengambil data pratikum berdasarkan
	public function getDataUserById($id="")
	{
		$get = $this->db->get_where($this->tb_name,array("praktikan_id",$id));

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

	// imamsrifkan : query untuk mengambil data praktikum
	public function getdataUserByNim($nim="")
	{
		$get = $this->db->where("praktikan_nim",$nim)
						->get($this->tb_name);
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

	}