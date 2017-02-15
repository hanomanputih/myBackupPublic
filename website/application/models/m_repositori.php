<?php

class M_repositori extends CI_Model{
    
    private $tb_name = "website_repositori";
    
//    imamrifkan : query untuk mengambil semua data repo
    public function getAllRepo()
    {
        $get = $this->db->order_by("repo_tanggal","DESC")
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

    // imamsrifkan : query mengambil data repo kategori materi
    public function getAllRepoMateri()
    {
        $get = $this->db->order_by("repo_tanggal","DESC")
                        ->get_where($this->tb_name,array("repo_kategori"=>"materi"));
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
    }
    
    public function getRepoByAttr($data)
    {
        $get = $this->db->order_by("repo_tanggal","desc")
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
    
//    imamsrifkan : query untuk mengambil data repo berdasarkan id
    public function getRepoById($id="")
    {
        $get = $this->db->get_where($this->tb_name,array("repo_id"=>$id));
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
    
//    imamsrifkan : query untuk mengambil data repo limit
    public function getRepoLimit($count)
    {
        $get = $this->db->order_by("repo_tanggal","DESC")
                        ->limit($count,0)
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
    
    public function getRepoLimitByAttr($count,$data)
    {
        $get = $this->db->order_by('repo_tanggal','desc')
                        ->limit($count,0)
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
    
//    imamsrifkan : query untuk mengambil data paling baru
    public function getLatestRepo()
    {
        $get = $this->db->order_by("repo_tanggal","DESC")
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
    
//    imamsrifkan : query untuk menambahkan data repositori
    public function insertRepo($data)
    {
        $insert = $this->db->insert($this->tb_name,$data);
        return $insert;
    }

    // imamsrifkan : query untuk update data repositori
    public function updateRepo($data)
    {
        $get = $this->db->get_where($this->tb_name,array("repo_id"=>$data["repo_id"]));
        if($get->num_rows() > 0)
        {
            $result = $get->row_array();
            @unlink(realpath("_data".DIRECTORY_SEPARATOR."filerepo").DIRECTORY_SEPARATOR.$result["repo_file"]);
            $update = $this->db->where("repo_id",$data["repo_id"])
                           ->update($this->tb_name,$data);
            return $update;
        }
        else
        {
            return FALSE;
        }
    }
    
//    imamsrifkan : query untuk update total download repo
    public function updateCountRepo($data)
    {
            $update = $this->db->where("repo_id",$data["repo_id"])
                           ->update($this->tb_name,$data);
            return $update;
    }
    
//    imamsrifkan : query untuk menghapus data repositori
    public function deleteRepo($id="")
    {
        $get = $this->db->get_where($this->tb_name,array("repo_id"=>$id));
        if($get->num_rows() > 0)
        {
            $result = $get->row_array();
            
            $delete = $this->db->delete($this->tb_name,array("repo_id"=>$id));
            if($delete > 0)
            {
                if(!empty($result["repo_file"]))
                {
                    @unlink(realpath("_data".DIRECTORY_SEPARATOR."filerepo").DIRECTORY_SEPARATOR.$result["repo_file"]);
                }
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }
}