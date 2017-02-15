<?php

class M_user_kcb extends CI_Model{
    
    private $tbname = "website_user_kcb";
    
    public function getAllUserKcb()
    {
        $get = $this->db->order_by("praktikan_nim","asc")
                        ->join("websiste_kelas_kcb","website_kelas_kcb.kelas_id = ".$this->tbname.".kelas_id")
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
    
    public function countUserKcbByAttr($data)
    {
        $get = $this->db->join("website_kelas_kcb","website_kelas_kcb.kelas_id = ".$this->tbname.".kelas_id")
                        ->get_where($this->tbname,$data);
        return $get->num_rows();
    }
}