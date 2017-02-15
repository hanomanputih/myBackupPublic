<?php

class M_data extends CI_Model{
    
    private $tb_name = "website_user_kcb";
    
//    imamsrifkan : query untuk mengambil semua data praktikan AI
    public function getAllData()
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
    
//    imamsrifkan : query untuk mengambil data praktikan berdasarkan id
    public function getDataById($id="")
    {
        $get = $this->db->get_where($this->tb_name,array("praktikan_id"=>$id));
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
    
//    imamsrifkan : query untuk mengambil data pratikan berdasarkan nim
    public function getDataByNim($nim="")
    {
        $get = $this->db->get_where($this->tb_name,array("praktikan_nim"=>$nim));
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
    
//    imamsrifkan : query untuk mengambil data praktikan berdasarkan atribut
    public function getDataByAtribut($data)
    {
        $get = $this->db->like("praktikan_nim",$data["praktikan_nim"])
                        ->or_like("praktikan_nama",$data["praktikan_nama"])
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
    
//    imamsrifkan : query untuk menambahkan data praktikan
    public function insertdata($data)
    {
        $insert = $this->db->insert($this->tb_name,$data);
        
        return $insert;
    }
    
//    imamsrifkan : query untuk update data praktikan
    public function updateData($data)
    {
        $update = $this->db->where("praktikan_id",$data["praktikan_id"])
                           ->update($this->tb_name,$data);
        return $update;
    }
    
//    imamsrifkan : query untuk menghapus data praktikan
    public function deleteData($id="")
    {
        $delete = $this->db->where("praktikan_id",$id)
                           ->delete($this->tb_name);
        return $delete;
    }
}