<?php

class M_asisten extends CI_Model{
    
    private $tb_name = "website_user";
    
//    imamsrifkan: mengambil semua data user kecuali superadmin
    public function getAllAsisten()
    {
        $get = $this->db->order_by("user_username","ASC")
                        ->where(array("user_username !="=>"superadmin"))
                        ->join("website_jabatan","website_jabatan.jabatan_id = website_user.jabatan_id")
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
    
//    imamsrifkan : query mengambil data user berdasarkan id
    public function getAsistenById($id="")
    {
        $get = $this->db->where("website_user.user_id",$id)
                        ->join("website_jabatan","website_jabatan.jabatan_id = website_user.jabatan_id")
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
    
    public function getAsistenByAttr($data)
    {
        $get = $this->db->order_by("user_username","asc")
                        ->join("website_jabatan","website_jabatan.jabatan_id = website_user.jabatan_id")
                        ->get_where($this->tb_name,$data);
        if($get->result_array() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
    }
    
//    imamsrifkan : menambahkan data user
    public function insertAsisten($data)
    {
        $get = $this->db->get_where($this->tb_name,array("user_username"=>$data["user_username"]));
        if($get->num_rows() > 0)
        {
            return FALSE;;
        }
        else
        {
            $insert = $this->db->insert($this->tb_name,$data);
            return $insert;
        }
    }
//    imamsrifkan : update data user
    public function updateAsisten($data)
    {
        $update = $this->db->where("user_id",$data["user_id"])
                           ->update($this->tb_name,$data);
        return $update;
    }
    
//    imamsrifkan : hapus data user
    public function deleteAsisten($id)
    {
        $delete = $this->db->where("user_id",$id)
                       ->delete($this->tb_name);
        return $delete;
    }
    
//    imamsrifkan : query menghitung jumlah asisten
    public function countAsisten()
    {
        $count = $this->db->select("count(*) as jumlah")
                          ->where("user_id !=","1")
                          ->get($this->tb_name);
        if($count->num_rows() > 0)
        {
            $result = $count->row_array();
            return $result;
        }
        else
        {
            return FALSE;
        }
    }
    
}