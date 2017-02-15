<?php

class M_jabatan extends CI_Model{
    
    private $tb_name = "website_jabatan";
    
//    imamsrifkan : query mengambil semua data jabatan
    public function getAllJabatan()
    {
        $get = $this->db->order_by("jabatan_nama","ASC")
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
    
//    imamsrifkan : query mengambil data jabatan berdasarkan id
    public function getJabatanById($id)
    {
        $get = $this->db->get_where($this->tb_name,array("jabatan_id"=>$id));
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
    
//    imamsrifkan : query mengambil data jabatan berdasarkan atribut
    public function getJabatanByAtribut($data)
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
    
//    imamsrifkan : query mengambil data jabatan berdasarkan atribut kecuali id
    public function getJabatanExceptByAtribut($data)
    {
        $condition = array(
            "jabatan_id !="=>$data["jabatan_id"],
            "jabatan_nama"=>$data["jabatan_nama"],
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
    
//    imamsrifkan : query mengambil data jabatan kecuali berdasarkan id
    public function getJabatanExceptId($id)
    {
        $get = $this->db->get_where($this->tb_name,array("jabatan_id != "=>$id));
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
    
//    imamsrifkan : query menambahkan data jabatan
    public function insertJabatan($data)
    {
        $get = $this->db->get_where($this->tb_name,$data);
        
        if($get->num_rows() > 0)
        {
            return FALSE;
        }
        else
        {
            $insert = $this->db->insert($this->tb_name,$data);

            return $insert;
        }
    }

//    imamsrifkan : query update data jabatan
    public function updateJabatan($data)
    {
        $update = $this->db->where("jabatan_id",$data["jabatan_id"])
                           ->update($this->tb_name,$data);
        return $update;
    }
    
//    imamsrifkan : query menghapus data jabatan
    public function deleteJabatan($id)
    {
        $delete = $this->db->where("jabatan_id",$id)
                           ->delete($this->tb_name);
        return $delete;
    }
}