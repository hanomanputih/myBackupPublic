<?php

class M_tahun_ajaran extends CI_Model{
    
    private $tb_name = "website_tahun_ajaran";
    
//    imamsrifkan : query mengambil semua data tahun ajaran
    public function getAllTahunAjaran()
    {
        $get = $this->db->order_by("ta_nama","DESC")
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
    
//    imamsrifkan : query mengambil data tahun ajaran berdasarkan id
    public function getTahunAjaranById($id="")
    {
        $get = $this->db->get_where($this->tb_name,array("ta_id"=>$id));
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
    
//    imamsrifkan : query mengambil data tahun ajaran berdasarkan atribut
    public function getTahunAjaranByAttr($data)
    {
        $get = $this->db->get_where($this->tb_name,$data);
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
    }
    
//    imamsrifkan : query mengambil data tahun ajaran berdasarkan atribut
    public function getTahunAjaranByAtribut($data)
    {
        $get = $this->db->order_by("ta_nama","desc")
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
    
//    imamsrifkan : query mengambil data tahun ajaran berdasarkan artibut kecuali id
    public function getTahunAjaranExceptByAtribut($data)
    {
        $condition = array(
            "ta_id !="=>$data["ta_id"],
            "ta_nama"=>$data["ta_nama"],
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
    
//    imamsrifkan : query menambahkan data tahun ajaran
    public function insertTahunAjaran($data)
    {
        $insert = $this->db->insert($this->tb_name,$data);
        
        return $insert;
    }
    
    // imamsrifkan : query update semua tahun ajaran
    public function updateAllTahunAjaran($data)
    {
        $update = $this->db->update($this->tb_name,$data);
        return $update;
    }

//    imamsrifkan : query update data tahun ajaran
    public function updateTahunAjaran($data)
    {
        $update = $this->db->where("ta_id",$data["ta_id"])
                           ->update($this->tb_name,$data);
        return $update;
    }
    
//    imamsrifkan : query menghapus data tahun ajaran
    public function deleteTahunAjaran($id="")
    {
        $delete = $this->db->where("ta_id",$id)
                           ->delete($this->tb_name);
        return $delete;
    }
}