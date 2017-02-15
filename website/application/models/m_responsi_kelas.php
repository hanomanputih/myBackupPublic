<?php

class M_responsi_kelas extends CI_Model{
    
    private $tb_name = "website_kelas_responsi";
    
//    imamsrifkan : query mengambil semua data kelas responsi
    public function getAllResponsi()
    {
        $get = $this->db->order_by("responsi_tanggal","ASC")
                        ->order_by("responsi_jam","asc")
                        ->order_by("responsi_ruang","asc")
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

    // imamsrifkan : query mengambil data kelas responsi berdasarkan page
    public function getAllResponsiByPage($config="",$url="")
    {
        $get = $this->db->order_by("responsi_tanggal","ASC")
                        ->order_by("responsi_jam","asc")
                        ->order_by("responsi_ruang","asc")
                        ->get($this->tb_name,$config,$url);
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
    }
    
//    imamsrifkan : query mengambil data kelas responsi berdasarkan id
    public function getResponsiById($id="")
    {
        $get = $this->db->get_where($this->tb_name,array("responsi_id"=>$id));
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
    
    public function getMaxResponsi($column,$data)
    {
        $get = $this->db->select_max($column)
                        ->get_where($this->tb_name,$data);
        return $get->row_array();
    }
    
//    imamsrifkan : query mengambil data kelas responsi berdasarkan atribut
    public function getResponsiByAttr($data)
    {
        $get = $this->db->get_where($this->tb_name,$data);
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
    
    public function getResponsiByAtribut($data)
    {
        $get = $this->db->order_by("responsi_tanggal","ASC")
                        ->order_by("responsi_jam","asc")
                        ->order_by("responsi_ruang","asc")
                        ->get_where($this->tb_name,$data);
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
    }
    
//    imamsrifkan : query mengambil data kelas responsi berdasarkan atribut kecuali id
    public function getResponsiExceptByAtribut($data)
    {
        $condition = array(
            "responsi_id !="=>$data["responsi_id"],
            "responsi_hari"=>$data["responsi_hari"],
            "responsi_tanggal"=>$data["responsi_tanggal"],
            "responsi_jam"=>$data["responsi_jam"],
            "responsi_ruang"=>$data["responsi_ruang"],
        );
        $get = $this->db->get_where($this->tb_name,$condition);
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
    
//    imamsrifkan : query mengambil data jadwal responsi berdasarkan hari
    public function getResponsiByDay($day="")
    {
        $get = $this->db->order_by("responsi_tanggal","ASC")
                        ->order_by("responsi_jam","asc")
                        ->order_by("responsi_ruang","asc")
                        ->get_where($this->tb_name,array("responsi_hari"=>$day));
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

    // imamsrifkan : query mengambil status jadwal responsi
    public function getStatusResponsi($data)
    {
        $get = $this->db->select("responsi_status_aktif")
                        ->where($data)
                        ->distinct()
                        ->get($this->tb_name);
        if($get->num_rows() > 0)
        {
            return $get->row_array();
        }
        else
        {
            return false;
        }
    }

//    imamsrifkan : query mengambil hari responsi
    public function getHariResponsi()
    {
        $get = $this->db->query("select DISTINCT  responsi_hari from ".$this->tb_name." order by responsi_tanggal ASC");
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
    
//    imamsrifkan : query menambahkan data kelas responsi
    public function insertResponsi($data)
    {
        $insert = $this->db->insert($this->tb_name,$data);
        return $insert;
    }
    
//    imamsrifkan : query update data kelas responsi
    public function updateResponsi($data)
    {
        $update = $this->db->where("responsi_id",$data["responsi_id"])
                           ->update($this->tb_name,$data);
        return $update;
    }

    // imamsrifkan : query untuk update semua status jadwal responsi
    public function updateAllStatusResponsi($data)
    {
        $update = $this->db->where("ta_id",$data["ta_id"])
                            ->update($this->tb_name,$data);
        return $update;
    }

    // imamsrifkan : query untuk update status jadwal responsi berdasarkan id
    public function updateStatusResponsi($data)
    {
        $update = $this->db->where("responsi_id",$data["responsi_id"])
                            ->update($this->tb_name,$data);
        return $update;
    }
    
//    imamsrifkan : query menghapus kelas responsi
    public function deleteResponsi($id="")
    {
        $delete = $this->db->where("responsi_id",$id)
                           ->delete($this->tb_name);
        $deleteuser = $this->db->where("responsi_id",$id)
                            ->delete("website_user_responsi");
        return $delete;
    }

    // imamsrifkan : query menghapus semua kelas responsi
    public function deleteAllResponsi($id="")
    {
        $get = $this->db->get_where($this->tb_name,array("ta_id"=>$id));
        if($get->num_rows() > 0)
        {
            foreach($get->result_array() as $result)
            {
                $this->deleteResponsi($result["responsi_id"]);
            }
            return true;
        }
        else
        {
            return false;
        }
    }


    // imamsrifkan : menghitung total jadwal repsonsi
    public function countAllResponsi()
    {
        $get = $this->db->get($this->tb_name);
        return $get->num_rows();
    }
    
    public function countResponsiByAttr($data)
    {
        $get = $this->db->get_where($this->tb_name,$data);
        return $get->num_rows();
    }

    public function countAllRowResponsi()
    {
        $get = $this->db->get($this->tb_name);
        return $get->num_rows();    
    }

    // imamsrifkan : menghitung jadwal responsi berstatus responsi_status_aktif
    public function countActiveResponsi()
    {
        $get = $this->db->get_where($this->tb_name,array("responsi_status_aktif"=>"aktif"));
        return $get->num_rows();
    }
}