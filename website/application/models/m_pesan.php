<?php

class M_pesan extends CI_Model{
    
    private $tbname = "website_saran";
    
    public function getAllPesan()
    {
        $get = $this->db->order_by("saran_tanggal","desc")
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
    
    public function getPesanById($id="")
    {
        $get = $this->db->get_where($this->tbname,array("saran_id"=>$id));
        if($get->num_rows() > 0)
        {
            return $get->row_array();
        }
        else
        {
            return false;
        }
    }
    
    public function getPesanByAttr($data)
    {
        $get = $this->db->order_by("saran_tanggal","desc")
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
    
    public function getCountAllPesan()
    {
        $get = $this->db->get($this->tbname);
        return $get->num_rows();
    }
    
    public function countPesanByAttr($data)
    {
        $get = $this->db->get_where($this->tbname,$data);
        return $get->num_rows();
    }
    
    public function getPesanByPage($config="",$uri="")
    {
        $get = $this->db->order_by("saran_tanggal","desc")
                        ->get($this->tbname,$config,$uri);
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
    }
    
    public function getPesanByPageByAttr($data,$config='',$uri='')
    {
        $get = $this->db->order_by("saran_tanggal","desc")
                        ->get_where($this->tbname,$data,$config,$uri);
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
    }
    
    public function insertPesan($data)
    {
        $insert = $this->db->insert($this->tbname,$data);
        return $insert;
    }
    
    public function updatePesan($data)
    {
        $update = $this->db->where("saran_id",$data["saran_id"])
                            ->update($this->tbname,$data);
        return $update;
    }
    
    public function deletePesan($id="")
    {
        $delete = $this->db->where("saran_id",$id)
                            ->delete($this->tbname);
        return $delete;
    }
}