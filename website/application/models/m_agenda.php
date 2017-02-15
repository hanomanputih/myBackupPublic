<?php

class M_agenda extends CI_Model{
    
    private $tb_name =  "website_berita";
    
//    imamsrifkan : query untuk mengambil semua agenda
    public function getAllAgenda()
    {
        $get = $this->db->order_by("berita_tanggal","DESC")
                        ->get_where($this->tb_name,array("berita_kategori"=>"agenda"));
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
    
//    imamsrifkan : query mengambil data agenda limit
    public function getAgendaLimit($count)
    {
        $get = $this->db->limit($count,0)
                        ->where("berita_kategori","agenda")
                        ->order_by("berita_tanggal","DESC")
                        ->join("website_user","website_user.user_username = ".$this->tb_name.".user_username")
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
    
    public function getAgendaLimitByAttr($count,$data)
    {
        $get = $this->db->limit($count,0)
                        ->where('berita_kategori','agenda')
                        ->where($data)
                        ->order_by('berita_tanggal','desc')
                        ->join('website_user','website_user.user_username = '.$this->tb_name.'.user_username')
                        ->get($this->tb_name);
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
    }
}