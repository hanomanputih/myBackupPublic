<?php

class M_tugas extends CI_Model{
    
    private $tb_name = "website_tugas";
    
//    imamsrifkan : mengambil semua data tugas
    public function getAllTugas()
    {
        $get = $this->db->order_by($this->tb_name.".kelas_id","ASC")
                        ->order_by("tugas_nim","ASC")
                        ->join("website_kelas_modul","website_kelas_modul.modul_id = ".$this->tb_name.".modul_id")
                        ->join("website_user","website_user.user_id = ".$this->tb_name.".user_id")
                        ->join("website_kelas_tugas","website_kelas_tugas.kelas_id = ".$this->tb_name.".kelas_id")
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
    
    public function getTugasByAttr($data)
    {
        $get = $this->db->order_by($this->tb_name.".kelas_id","ASC")
                        ->order_by("tugas_nim","ASC")
                        ->join("website_kelas_modul","website_kelas_modul.modul_id = ".$this->tb_name.".modul_id")
                        ->join("website_user","website_user.user_id = ".$this->tb_name.".user_id")
                        ->join("website_kelas_tugas","website_kelas_tugas.kelas_id = ".$this->tb_name.".kelas_id")
                        ->get_where($this->tb_name,$data);
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
    
//    imamsrifkan : query mengambil data tugas berdasarkan kelas
    public function getTugasByKelas($kelas,$data)
    {
        $get = $this->db->order_by("tugas_nim","ASC")
                        ->where("website_kelas_tugas.kelas_nama",$kelas)
                        ->where($data)
                        ->join("website_kelas_modul","website_kelas_modul.modul_id = ".$this->tb_name.".modul_id")
                        ->join("website_kelas_tugas","website_kelas_tugas.kelas_id = ".$this->tb_name.".kelas_id")
                        ->join("website_user","website_user.user_id = ".$this->tb_name.".user_id")
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
    
//    imamsrifkan : query mengambil data tugas berdasarkan atribut
    public function getTugasByAtribut($data)
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
    
//    imamsrifkan : menambahkan data tugas
    public function insertTugas($data)
    {
        $insert = $this->db->insert($this->tb_name,$data);
        if($insert > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
//    imamsrifkan : update data tugas
    public function updateTugas($data)
    {
        $update = $this->db->where("tugas_id",$data["tugas_id"])
                           ->update($this->tb_name,$data);
        if($update > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
//    imamsrifkan : menghapus data tugas
    public function deleteTugas($id="")
    {
        $get = $this->db->get_where($this->tb_name,array("tugas_id"=>$id));
        if($get->num_rows() > 0)
        {
            $result = $get->row_array();
            
            $delete = $this->db->where("tugas_id",$id)
                           ->delete($this->tb_name);
            if($delete > 0)
            {
                if($result["tugas_file"])
                {
                    @unlink(realpath("_data".DIRECTORY_SEPARATOR."filetugas").DIRECTORY_SEPARATOR.$result["tugas_file"]);
                }
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
        
    }
}