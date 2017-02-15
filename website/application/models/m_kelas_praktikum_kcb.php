<?php

class M_kelas_praktikum_kcb extends CI_Model{

	private $tbname = "website_kelas_praktikum";

	// imamsrifkan : query mengambil semua data kelas praktikum kcb
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

	// imamsrifkan : query mengambil data kelas praktikum berdasarkan id
	public function getKelasKcbById($id="")
	{
		$get = $this->db->get_where($this->tbname,array("kelas_id"=>$id));
		if($get->num_rows > 0)
		{
			return $get->row_array();
		}
		else
		{
			return false;
		}
	}

	// imamsrifkan : query mengambil data kelas praktikum kcb berdasarkan atribut
	public function getKelasKcbByAtribut($data)
	{
		$get = $this->db->where_not_in(array("kelas_id"=>$data["kelas_id"]))
						->like(array("kelas_hari"=>$data["kelas_hari"],"kelas_tanggal"=>$data["kelas_tanggal"],"kelas_jam"=>$data["kelas_tanggal"]))
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

	// imamsrifkan : query mengambil data kelas praktikum kcb berdasarkan nama kelas
	public function getKelasByNama($data)
	{
		$get = $this->db->where($data)
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

	// imamsrifkan : query mengambil data kelas praktikum kcb berdasarkan atribut kecuali berdasarkan id
	public function getKelasKcbByAtributNotId($data)
	{
		$get = $this->db->where($data)
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

	// imamsrifkan : query mengambil data kelas praktikum kcb berdasarkan atribut atau nama kelas
	public function getKelasKcbByAtributOrNama($nama,$data2)
	{
		$get = $this->db->where($data2)
                                ->or_where("kelas_nama",$nama)
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

	// imamsrifkan : query mengambil data kelas praktikum kcb kecuali berdasarkan id
	public function getKelasKcbExceptById($id="")
	{
		$get = $this->db->order_by("kelas_nama","asc")
						->get_where($this->tbname,array("kelas_id !="=>$id));
		if($get->num_rows() > 0)
		{
			return $get->result_array();
		}
		else
		{
			return false;
		}
	}

	// imamsrifkan : query mengambil data hari kelas praktikum kcb kecuali berdasarkan id
	public function getKelasKcbHariExceptId($id="")
	{
		$get = $this->db->get_where($this->tbname,array("kelas_id !="=>$id));
		if($get->num_rows() > 0)
		{
			return $get->result_array();
		}
		else
		{
			return false;
		}
	}

	//    imamsrifkan : query mengambil status kelas praktikum ai
    public function getStatusKelasKcb()
    {
        $get = $this->db->query("select distinct kelas_status from ".$this->tbname);
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

    public function countKelasKcbByAttr($data)
    {
        $get = $this->db->get_where($this->tbname,$data);
        return $get->num_rows();
    }
	// imamsrifkan : query menambahkan data kelas praktikum kcb
	public function insertKelasKcb($data)
	{
		$insert = $this->db->insert($this->tbname,$data);
		return $insert;
	}

	// imamsrifkan : query update kelas kcb
	public function updateKelasKcb($data)
	{
		$update = $this->db->where("kelas_id",$data["kelas_id"])
							->update($this->tbname,$data);
		return $update;
	}

	// imamsrifkan : query update kelas praktikum kcb
	public function updateAllStatusKelasKcb($data)
	{
		$update = $this->db->update($this->tbname,$data);
		return $update;
	}
        
        public function updateStatusKelasKcb($data, $id = '')
        {
            $update = $this->db->where(array('ta_id'=>$id))
                                ->update($this->tbname,$data);
            return $update;
        }
	// imamsrifkan : query menghapus kelas praktikum kcb
	public function deleteKelasKcb($id="")
	{
		$delete = $this->db->where("kelas_id",$id)
							->delete($this->tbname);
		$delete_user = $this->db->where("kelas_id",$id)
								->delete("website_user_daftar");
		return $delete;
	}

	// imamsrifkan : query menghapus semua kelas praktikum kcb
	public function deleteAllKelasKcb($data)
	{
            $get = $this->db->get_where($this->tbname,array("ta_id"=>$data));
            if($get->num_rows() > 0)
            {
                foreach($get->result_array() as $result)
                {
                    $this->deleteKelasKcb($result["kelas_id"]);
                }
                return true;
            }
            else
            {
                return false;
            }
	}
}