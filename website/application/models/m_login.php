<?php

class M_login extends CI_Model{
    
    private $tb_name = "website_user";
    
    function login($data)
    {
        $get = $this->db->where($data)
                        ->join("website_jabatan"," website_user.jabatan_id = website_jabatan.jabatan_id")
                        ->get($this->tb_name);
        
        if($get->num_rows() > 0)
        {
            $result = $get->row_array();
            return $result;
        }
        else
        {
            return false;
        }
    }
    
}