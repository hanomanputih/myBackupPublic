<?php

class M_modul extends CI_Model{
    
    private $tb_name = "website_kelas_modul";
    
//    imamsrifkan : query mengambil semua data modul 
    public function getAllModul()
    {
        $get = $this->db->order_by("modul_pertemuan","ASC")
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
    
//    imamsrifkan : query mengambil data modul berdasarkan id
    public function getModulById($id="")
    {
        $get = $this->db->get_where($this->tb_name,array("modul_id"=>$id));
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
    
//    imamsrifkan : query mengambil data modul berdasarkan atribut
    public function getModulByAtribut($data)
    {
        $get = $this->db->where($data)
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
    
    public function getLatestModulByAttr($data, $variable = "")
    {
        $get = $this->db->select_max($variable)
                        ->get_where($this->tb_name,$data);
        if($get->num_rows() > 0)
        {
            return $get->row_array();
        }
        else
        {
            return false;
        }
                        
    }
    
//    imamsrifkan : query mengambil data modul berdasarkan atribut kecuali id
    public function getModulExceptByAtribut($data)
    {
        $get = $this->db->where("modul_id !=",$data["modul_id"])
                        ->like("modul_nama",$data["modul_nama"])
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
    
//    imamsrifkan : query mengambil data modul yang aktif
    public function getActiveModul()
    {
        $get = $this->db->get_where($this->tb_name,array("modul_status"=>"aktif"));
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
    
    public function countModulByAttr($data)
    {
        $get = $this->db->get_where($this->tb_name,$data);
        return $get->num_rows();
    }
//    imamsrifkan : query menambahkan data modul pertemuan
    public function insertModul($data)
    {
        $insert = $this->db->insert($this->tb_name,$data);
        return $insert;
    }
    
//    imamsrifkan : query update data modul pertemuan
    public function updateModul($data)
    {
        $update = $this->db->where("modul_id",$data["modul_id"])
                           ->update($this->tb_name,$data);
        return $update;
    }
    
//    imamsrifkan : query update data status modul pertemuan
    public function updateStatusModul($data)
    {
        $edit_first = $this->db->update($this->tb_name,array("modul_status"=>"non-aktif"));
        
        $edit_last = $this->db->where("modul_id",$data["modul_id"])
                              ->update($this->tb_name,$data);
        return $edit_last;
    }
    
//    imamsrifkan : query untuk update semua status modul
    public function updateAllStatusModul($data)
    {
        $update = $this->db->update($this->tb_name,$data);
        return $update;
    }
    
//    imamsrifkan : query menghapus data modul pertemuan
    public function deleteModul($id="")
    {
        $delete = $this->db->where("modul_id",$id)
                           ->delete($this->tb_name);
        return $delete;
    }
}