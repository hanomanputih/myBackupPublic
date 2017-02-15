<?php

class M_berita extends CI_Model{
    
    private $tb_name = "website_berita";
    
//    imamsrifkan : query untuk mengambil semua berita dan agenda
    public function getBeritaAndAgendaLimit($count)
    {
        $get = $this->db->limit($count,0)
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
    
    public function getBeritaAndAgendaLimitByAttr($count,$data)
    {
        $get = $this->db->limit($count,0)
                        ->order_by('berita_tanggal','desc')
                        ->join('website_user','website_user.user_username = '.$this->tb_name.'.user_username')
                        ->get_where($this->tb_name,$data);
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
    }
//    imamsrifkan : query untuk mengambil semua data berita
    public function getAllBerita()
    {
        $get = $this->db->order_by("berita_tanggal","DESC")
                        ->join("website_user","website_user.user_username = ".$this->tb_name.".user_username")
                        ->get_where($this->tb_name);
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

    // imamsrifkan : query untuk mengambik semua data berdasarkan page
    public function getAllBeritaByPage($config="",$url="")
    {
        $get = $this->db->order_by("berita_tanggal","DESC")
                        ->join("website_user","website_user.user_username = ".$this->tb_name.".user_username")
                        ->get($this->tb_name,$config,$url);
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
    }
    
      public function getBeritaByPageByAttr($data,$config="",$url="")
    {
        $get = $this->db->order_by("berita_tanggal","DESC")
                        ->join("website_user","website_user.user_username = ".$this->tb_name.".user_username")
                        ->where($data)
                        ->get($this->tb_name,$config,$url);
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
    }
    
//    imamsrifkan : query untuk mengambil data berita berdasarkan id
    public function getBeritaById($id="")
    {
        $get = $this->db->join("website_user","website_user.user_username = ".$this->tb_name.".user_username")
                        ->get_where($this->tb_name,array("berita_id"=>$id));
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

    // imamsrifkan : query untuk mengambil berita berdasarkan atribut
    public function getBeritaByAtribut($data)
    {
        $get = $this->db->order_by("berita_tanggal","desc")
                        ->where($data)
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

//    imamsrifkan : query untuk mengambil data berita berdasarkan keyword
    public function getBeritaByKey($key="")
    {
        $get = $this->db->like("berita_judul",$key)
                        ->or_like("berita_isi",$key)
                        ->join("website_user","website_user.user_username = ".$this->tb_name.".user_username")
                        ->order_by("berita_tanggal","DESC")
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
    
//    imamsrifkan : query untuk mengambil berita berdasarkan judul
    public function getBeritaByTitle($title="")
    {
        $get = $this->db->join("website_user","website_user.user_username = ".$this->tb_name.".user_username")
                        ->get_where($this->tb_name,array("berita_title"=>$title));
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
    
//    imamsrifkan : query untuk mengambil berita berdasarkan kategori
    public function getBeritaByKategori($kategori="")
    {
        $get = $this->db->order_by("berita_tanggal","DESC")
                        ->join("website_user","website_user.user_username = ".$this->tb_name.".user_username")
                        ->get_where($this->tb_name,array("berita_kategori"=>$kategori));
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
    
//    imamsrifkan : query untuk mangambil berita berdasarkan kategori
    public function getBeritaByAgenda($kategori="")
    {
        $get = $this->db->order_by("berita_tanggal","DESC")
                        ->join("website_user","website_user.user_username = ".$this->tb_name.".user_username")
                        ->get_where($this->tb_name,array("berita_praktikum"=>$kategori,"berita_kategori"=>"agenda"));
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
    
    //    imamsrifkan : query untuk mengambil berita berdasarkan kategori
    public function getBeritaByPraktikum($praktikum="")
    {
        $get = $this->db->order_by("berita_tanggal","DESC")
                        ->join("website_user","website_user.user_username = ".$this->tb_name.".user_username")
                        ->get_where($this->tb_name,array("berita_praktikum"=>$praktikum,"berita_kategori"=>"pengumuman"));
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
    
//    imamsrifkan : query mengambil data berita limit
    public function getBeritaLimit($count)
    {
        $get = $this->db->limit($count,0)
                        ->where("berita_kategori","pengumuman")
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
    
    public function getBeritaLimitByAttr($count,$data)
    {
        $get = $this->db->limit($count,0)
                        ->where($data)
                        ->where("berita_kategori","pengumuman")
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
    
    // imamsrifkan : query mengambil jumlah total berita
    public function countAllBerita()
    {
        $get = $this->db->get($this->tb_name);
        return $get->num_rows();
    }
    
    public function countBeritaByAttr($data)
    {
        $get = $this->db->get_where($this->tb_name,$data);
        return $get->num_rows();
    }

//    imamsrifkan : query untuk menambahkan data berita
    public function insertBerita($data)
    {
        $insert = $this->db->insert($this->tb_name,$data);
        return $insert;
    }
    
//    imamsrifkan : query untuk update data berita
    public function updateBerita($data)
    {
        $get = $this->db->get_where($this->tb_name,array("berita_id"=>$data["berita_id"]));
        if($get->num_rows() > 0)
        {
            $result = $get->row_array();
//            imamsrifkan : data yang akan diubah
            $dataToChange = array(
                "berita_id"=>$data["berita_id"],
                "berita_judul"=>$data["berita_judul"],
                "berita_title"=>$data["berita_title"],
                "berita_praktikum"=>$data["berita_praktikum"],
                "berita_kategori"=>$data["berita_kategori"],
                "berita_isi"=>$data["berita_isi"],
                "berita_judul_file"=>$data["berita_judul_file"],
                "berita_tanggal"=>$data["berita_tanggal"],
            );
            if($data["berita_file"] != "")
            {
                $dataToChange["berita_file"] = $data["berita_file"];
                $dataToChange["berita_tipe_file"] = $data["berita_tipe_file"];
                @unlink(realpath("_data".DIRECTORY_SEPARATOR."fileberita").DIRECTORY_SEPARATOR.$result["berita_file"]);
            }
            
            $update = $this->db->where("berita_id",$dataToChange["berita_id"])
                           ->update($this->tb_name,$dataToChange);
            return $update;
        }
        else
        {
            return FALSE;
        }
        
    }
    
//    imamsrifkan : query untuk ubah data lihat berita
    public function updateBeritaView($data)
    {
        $update = $this->db->where("berita_id",$data["berita_id"])
                           ->update($this->tb_name,$data);
        return $update;
    }
    
//    imamsrifkan : query untuk menghapus data berita berdasarkan id
    public function deleteBerita($id="")
    {
        $get = $this->db->get_where($this->tb_name,array("berita_id"=>$id));
        if($get->num_rows() > 0)
        {
            $result = $get->row_array();
            
            $delete = $this->db->where("berita_id",$id)
                           ->delete($this->tb_name);
            if($delete > 0)
            {
                if($result["berita_file"])
                {
                    @unlink(realpath("_data".DIRECTORY_SEPARATOR."fileberita").DIRECTORY_SEPARATOR.$result["berita_file"]);
                }
                return TRUE;
            }
        }
        else
        {
            return FALSE;
        }
        
    }
}