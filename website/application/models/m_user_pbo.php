<?php

class M_user_pbo extends CI_Model{
    
    private $tbname = "website_user_pbo";
    
    public function getAllUserPbo()
    {
        $get = $this->db->order_by("pbo_nim","asc")
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
    
    public function getUserPboById($id="")
    {
        $get = $this->db->join("website_kelas_tugas","website_kelas_tugas.kelas_id = ".$this->tbname.".kelas_id")
                        ->get_where($this->tbname,array("pbo_id"=>$id));
        if($get->num_rows() > 0)
        {
            return $get->row_array();
        }
        else
        {
            return false;
        }
    }
    
    public function getUserPboByAttr($data)
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
    
    public function countUserPboByAttr($data)
    {
        $get = $this->db->join("website_kelas_tugas","website_kelas_tugas.kelas_id = ".$this->tbname.".kelas_id")
                        ->get_where($this->tbname,$data);
        return $get->num_rows();
    }
    
    public function insertUserPbo($data)
    {
        $insert = $this->db->insert($this->tbname,$data);
        return $insert;
    }
    
    public function updateUserPbo($data)
    {
        $update = $this->db->where("pbo_id",$data["pbo_id"])
                           ->update($this->tbname,$data);
        return $update;
    }
    
    public function deleteUserPbo($id="")
    {
        $delete = $this->db->where("pbo_id",$id)
                           ->delete($this->tbname);
        return $delete;
    }
}