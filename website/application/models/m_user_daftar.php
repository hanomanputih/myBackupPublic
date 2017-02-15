<?php

class M_user_daftar extends CI_model{
    
    private $tb_name = "website_user_daftar";
    
//    imamsrifkan : query mengambil data user pendaftar praktikum
    public function getAllUserDaftar()
    {
        $get = $this->db->order_by("daftar_nim","ASC")
                        ->join("website_user_kcb","website_user_kcb.praktikan_nim = ".$this->tb_name.".daftar_nim")
                        ->join("website_kelas_praktikum","website_kelas_praktikum.kelas_id = ".$this->tb_name.".kelas_id")
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
    
    public function getUserDaftarByAttr($data)
    {
        $get = $this->db->order_by("daftar_nim","ASC")
                        ->join("website_user_kcb","website_user_kcb.praktikan_nim = ".$this->tb_name.".daftar_nim")
                        ->join("website_kelas_praktikum","website_kelas_praktikum.kelas_id = ".$this->tb_name.".kelas_id")
                        ->where($data)
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

    // imamsrifkan : query mengambil data user yang belum melakukan pendaftaran
    public function getUserNotDaftar($data)
    {
        $get = $this->db
                         
                        // ->join("website_user_kcb","website_user_kcb.praktikan_nim = ".$this->tb_name.".daftar_nim")
                        // ->join("website_kelas_praktikum","website_kelas_praktikum.kelas_id = ".$this->tb_name.".kelas_id")
                        ->query("select * from website_user_kcb join website_kelas_kcb on website_kelas_kcb.kelas_id = website_user_kcb.kelas_id where website_kelas_kcb.ta_id = '".$data["ta_id"]."' and not exists (select * from ".$this->tb_name." where website_user_kcb.praktikan_nim = ".$this->tb_name.".daftar_nim) order by praktikan_nim ASC");
                        
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
    }
    
//    imamsrifkan : query mengambil data user pendaftaran berdasarkan nim
    public function getuserDaftarByNim($nim="")
    {
        $get = $this->db->where("daftar_nim",$nim)
                        ->join("website_user_kcb","website_user_kcb.praktikan_nim = ".$this->tb_name.".daftar_nim")
                        ->join("website_kelas_praktikum","website_kelas_praktikum.kelas_id = ".$this->tb_name.".kelas_id")
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
    
//    imamsrifkan : query mengambil data user pendaftar berdasarkan id
    public function getUserDaftarById($id="")
    {
        $get = $this->db->where("daftar_id",$id)
                        ->join("website_user_kcb","website_user_kcb.praktikan_nim = ".$this->tb_name.".daftar_nim")
                        ->join("website_kelas_praktikum","website_kelas_praktikum.kelas_id = ".$this->tb_name.".kelas_id")
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
    
//    imamsrifkan : query mengambil data user pendaftar berdasarkan kelas
    public function getUserDaftarByKelas($data)
    {
        $get = $this->db->order_by("daftar_nim","ASC")
                        ->where("website_kelas_praktikum.kelas_nama",$data)
                        ->join("website_user_kcb","website_user_kcb.praktikan_nim = ".$this->tb_name.".daftar_nim")
                        ->join("website_kelas_praktikum","website_kelas_praktikum.kelas_id = ".$this->tb_name.".kelas_id")
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
    
//    imamsrifkan : query untuk mengambil data user pendaftar berdasarkan atribut
    public function getUserDaftarByAtribut($data)
    {
        $get = $this->db->order_by("daftar_nim","ASC")
                        ->join("website_user_kcb","website_user_kcb.praktikan_nim = ".$this->tb_name.".daftar_nim")
                        ->join("website_kelas_praktikum","website_kelas_praktikum.kelas_id = ".$this->tb_name.".kelas_id")
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

    // imamsrifkan : query mengambil data user pendaftar berdasarkan id kelas
    public function getUserDaftarByKelasId($id="")
    {
        $get = $this->db->order_by("daftar_nim","ASC")
                        ->where("website_user_daftar.kelas_id",$id)
                        ->join("website_user_kcb","website_user_kcb.praktikan_nim = ".$this->tb_name.".daftar_nim")
                        ->join("website_kelas_praktikum","website_kelas_praktikum.kelas_id = ".$this->tb_name.".kelas_id")
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
    
//    imamsrifkan : query mengambil jumlah data user pendaftar berdasarkan id kelas
    public function getCountUserDaftarById($id="")
    {
        $get = $this->db->select("count(*) as jumlah")
                        ->where($this->tb_name.".kelas_id",$id)
                        ->join("website_kelas_praktikum","website_kelas_praktikum.kelas_id = ".$this->tb_name.".kelas_id")
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

    // imamsrifkan : query mengambil jumlah data user pendaftar berdasarkan kelas
    public function getCountUserDaftarByKelas($id="")
    {
        $get = $this->db->select("count(*) as total")
                        ->where("kelas_id",$id)
                        // ->join("website_user_kcb","website_user_kcb.praktikan_nim = ".$this->tb_name.".daftar_nim")
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
    
    
    
//    imamsrifkan : query menambahkan data user pendaftar
    public function insertUserDaftar($data)
    {
        $insert = $this->db->insert($this->tb_name,$data);
        
        return $insert;
    }
    
//    imamsrifkan : query update data user pendaftar
    public function updateUserDaftar($data)
    {
        $update = $this->db->where("daftar_id",$data["daftar_id"])
                           ->update($this->tb_name,$data);
        return $update;
    }
    
//    imamsrifkan : query hapus data user pendaftar
    public function deleteUserDaftar($id="")
    {
        $delete = $this->db->where("daftar_id",$id)
                           ->delete($this->tb_name);
        return $delete;
    }

    // imamsrifkan : query menghitung jumlah praktikan 
    public function countAlluserDaftar()
    {
        $get = $this->db->get($this->tb_name);
        return $get->num_rows();
    }
    
    public function countUserDaftarByAttr($data)
    {
        $get = $this->db->where($data)
                        ->join("website_kelas_praktikum","website_kelas_praktikum.kelas_id = ".$this->tb_name.".kelas_id")
                        ->get($this->tb_name);
        return $get->num_rows();
    }
    
}