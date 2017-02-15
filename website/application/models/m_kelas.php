<?php

class M_kelas extends CI_Model{
    
    private $tb_name_tugas = "website_kelas_tugas";
    private $tb_name_ai = "website_kelas_praktikum";
    
//    imamsrifkan : query untuk mengambil seluruh data kelas tugas
    public function getAllKelasTugas()
    {
        $get = $this->db->order_by("kelas_nama","ASC")
                        ->get($this->tb_name_tugas);
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
    
//    imamsrifkan : query untuk mengambil seluruh data kelas ai
    public function getAllKelasAi()
    {
        $get = $this->db->order_by("kelas_nama","ASC")
                        ->get($this->tb_name_ai);
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
    
    public function getKelasAiByAttr($data)
    {
        $get = $this->db->order_by('kelas_nama','asc')
                        ->get_where($this->tb_name_ai,$data);
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
    }
    
//    imamsrifkan : query untuk mengambil data kelas praktikum ai kecuali berdasarkan id
    public function getKelasAiExceptId($id)
    {
        $get = $this->db->order_by("kelas_nama","ASC")
                        ->where("kelas_id !=",$id)
                        ->get($this->tb_name_ai);
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
    
//    imamsrifkan : query untuk mengambil data kelas berdasarkan id
    public function getKelasTugasById($id="")
    {
        $get = $this->db->get_where($this->tb_name_tugas,array("kelas_id"=>$id));
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
    
//    imamsrifkan : query untuk mengambil data kelas praktikum ai berdasarkan id
    public function getKelasAiById($id="")
    {
        $get = $this->db->get_where($this->tb_name_ai,array("kelas_id"=>$id));
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
    
//    imamsrifkan : query untuk mengambil data kelas praktikum ai berdasarkan hari
    public function getKelasAiByHari($day="")
    {
        $get = $this->db->get_where($this->tb_name_ai,array("kelas_hari"=>$day));
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
    
//    imamsrifkan : query untuk mengambil data kelas berdasarkan atribut
    public function getKelasTugasByAtribut($data)
    {
        $get = $this->db->like("kelas_nama",$data["kelas_nama"])
                        ->or_like("kelas_keterangan",$data["kelas_keterangan"])
                        ->get($this->tb_name_tugas);
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
    
//    imamsrifkan : query untuk mengambil data kelas berdasarkan atribut
    public function getKelasTugasByAttr($data)
    {
        $get = $this->db->order_by("kelas_nama","asc")
                        ->get_where($this->tb_name_tugas,$data);
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
    }

    // imamsrifkan : query untuk mengambil data kelas tugas berdasarkan atribut kecuali id
    public function getKelasTugasExceptByAtribut($data)
    {
        $get = $this->db->where("kelas_id !=",$data["kelas_id"])
                        ->like("kelas_keterangan",$data["kelas_keterangan"])
                        ->get($this->tb_name_tugas);
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
    
//    imamsrifkan : query untuk mengambil data kelas praktikum ai berdasarkan atribut
    public function getKelasAiByAtribut($data)
    {
        $get = $this->db->get_where($this->tb_name_ai,$data);
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
    
//    imamsrifkan : query untuk mengambil data kelas praktikum untuk pemeriksaan
    public function getKelasAiToCheck($data)
    {
        $get = $this->db->where(array("kelas_hari"=>$data["kelas_hari"],"kelas_tanggal"=>$data["kelas_tanggal"],"kelas_jam"=>$data["kelas_tanggal"]))
                        ->or_where(array("kelas_nama"=>$data["kelas_nama"]))
                        ->get($this->tb_name_ai);
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
    
//    imamsrifkan : query mengambil status kelas praktikum ai
    public function getStatusKelasAi()
    {
        $get = $this->db->query("select distinct kelas_status from ".$this->tb_name_ai);
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
    
    public function getStatusKelasAiByAttr($data)
    {
        $get = $this->db->distinct()
                        ->get_where($this->tb_name_ai,$data);
        if($get->num_rows() > 0)
        {
            return $get->row_array();
        }
        else
        {
            return false;
        }
    }
    
//    imamsrifkan : query mengambil hari praktikum ai
    public function getHariKelasAi()
    {
        $get = $this->db->query("select DISTINCT kelas_hari from ".$this->tb_name_ai);
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
    
    public function getHariKelasAiByAttr($data)
    {
        $get = $this->db->distinct()
                        ->where($data)
                        ->get($this->tb_name_ai);
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
    }
    
//    imamsrifkan : query untuk menambahkan kelas
    public function insertKelasTugas($data)
    {
        $insert = $this->db->insert($this->tb_name_tugas,$data);
        return $insert;
    }
    
//    imamsrifkan : query untuk menambahkan kelas praktikum ai
    public function insertKelasAi($data)
    {
        $insert = $this->db->insert($this->tb_name_ai,$data);
        return $insert;
    }
    
//    imamsrifkan : query untuk edit kelas
    public function updateKelasTugas($data)
    {
        $edit = $this->db->where("kelas_id",$data["kelas_id"])
                        ->update($this->tb_name_tugas,$data);
        return $edit;
    }
    
//    imamsrifkan : query untuk edit data kelas praktikum ai
    public function updateKelasAi($data)
    {
        $update = $this->db->where("kelas_id",$data["kelas_id"])
                           ->update($this->tb_name_ai,$data);
        return $update;
    }
    
//    imamsrifkan : query untuk edit seluruh status kelas praktikum ai
    public function updateStatusKelasAi($status)
    {
        $update = $this->db->update($this->tb_name_ai,array("kelas_status"=>$status));
        
        return $update;
    }
//    imamsrifkan : query untuk edit seluruh status kelas
    public function updateAllStatusKelasTugas()
    {
        $edit = $this->db->update($this->tb_name_tugas,array("kelas_status"=>"non-aktif"));
        
        return $edit;
    }
    
//    imamsrifkan : query untuk edit status kelas
    public function updateStatusKelas($data="")
    {
        $edit_first = $this->db->update($this->tb_name_tugas,array("kelas_status"=>"non-aktif"));
        
        $edit_last = $this->db->where("kelas_id",$data["kelas_id"])
                         ->update($this->tb_name_tugas,$data);
        return $edit_last;
    }
    
//    imamsrifkan : query untuk menghapus kelas berdasarkan id
    public function deleteKelasTugas($id="")
    {
        $delete = $this->db->where("kelas_id",$id)
                           ->delete($this->tb_name_tugas);
        return $delete;
    }
    
//    imamsrifkan : query untuk menghapus kelas praktikum ai berdasarkan id
    public function deleteKelasAi($id="")
    {
        $delete = $this->db->where("kelas_id",$id)
                           ->delete($this->tb_name_ai);
        if($delete > 0)
        {
            $deleteUser = $this->db->where("kelas_id",$id)
                                    ->delete("website_user_daftar");
            return $deleteUser;
        }
        else
        {
            return FALSE;
        }
    }
    
//    imamsrifkan : periksa kelas yang aktif
    public function checkKelas()
    {
        $get = $this->db->get_where($this->tb_name_tugas,array("kelas_status"=>"aktif"));
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
    
//    imamsrifkan : query menghitung kelas tugas
    public function countKelasTugas()
    {
        $count = $this->db->select("count(*) as jumlah")
                          ->get($this->tb_name_tugas);
        if($count->num_rows() > 0)
        {
            $result = $count->row_array();
            return $result;
        }
        else
        {
            return FALSE;
        }
    }
    
//    imamsrifkan : query menghitung kelas praktikum ai
    public function countKelasAi()
    {
        $count = $this->db->select("count(*) as jumlah")
                          ->get($this->tb_name_ai);
        if($count->num_rows() > 0)
        {
            $result = $count->row_array();
            return $result;
        }
        else
        {
            return FALSE;
        }
    }

    // imamsrifkan : query mengambil aktif kelas tugas
    public function getActiveKelasTugas($data)
    {
        $get = $this->db->where($data)
                        ->get($this->tb_name_tugas);
        if($get->num_rows() > 0)
        {
            return $get->row_array();
        }
        else
        {
            return false;
        }
    }
}