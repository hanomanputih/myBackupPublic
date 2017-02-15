<?php

class M_user extends CI_Model{
    
    private $tbname = "website_user";
    
//    imamsrifkan : fungsi get all data
    public function getAllUser()
    {
        $get = $this->db->order_by('user_username','asc')
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
    
//    imamsrifkan : fungsi get data berdasarkan id
    public function getUserById($id="")
    {
        $get = $this->db->join("website_jabatan","website_jabatan.jabatan_id = ".$this->tbname.".jabatan_id")
                        ->get_where($this->tbname,array("user_id"=>$id));
        if($get->num_rows() > 0)
        {
            return $get->row_array();
        }
        else
        {
            return false;
        }
    }
    
//    imamsrifkan : fungsi get data berdasarkan atribut
    public function getUserByAttr($data)
    {
        $get = $this->db->order_by("user_username","asc")
                        ->where($data)
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
    
//    imamsrifkan : fungsi get data limit
    public function getUserLimit($limit="")
    {
        $get = $this->db->limit($limit)
                        ->order_by("user_login","desc")
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
    
    public function countUserByAttr($data)
    {
        $get = $this->db->get_where($this->tbname,$data);
        return $get->num_rows();
    }
    
//    imamsrifkan : fungsi insert data
    public function insertUser($data)
    {
        $insert = $this->db->insert($data);
        return $result;
    }
    
//    imamsrifkan : fungsi update data
    public function updateUser($data)
    {
        $update = $this->db->where("user_id",$data["user_id"])
                           ->update($this->tbname,$data);
        return $update;
    }
    
//    imamsrifkan : fungsi delete data
    public function deleteUser($id="")
    {
        $delete = $this->db->where("user_id",$id)
                           ->delet($this->tbname);
        return $delete;
    }
}