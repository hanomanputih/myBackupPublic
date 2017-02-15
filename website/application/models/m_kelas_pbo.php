<?php

class M_kelas_pbo extends CI_Model{

	private $tbname = "website_kelas_tugas";

	//    imamsrifkan : query untuk mengambil seluruh data kelas Pbo
    public function getAllKelasPbo()
    {
        $get = $this->db->order_by("kelas_nama","ASC")
                        ->get($this->tbname);
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return FALSE;
        }
    }

    // imamsrifkan : query mengambil aktif kelas Pbo
    public function getActiveKelasPbo()
    {
        $get = $this->db->where("kelas_status","aktif")
                        ->get($this->tbname);
        if($get->num_rows() > 0)
        {
            return $get->row_array();
        }
        else
        {
            return false;
        }
    }

    //    imamsrifkan : query untuk mengambil data kelas berdasarkan id
    public function getKelasPboById($id="")
    {
        $get = $this->db->get_where($this->tbname,array("kelas_id"=>$id));
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

    // imamsrifkan : query untuk mengambil data kelas Pbo berdasarkan atribut kecuali id
    public function getKelasPboExceptByAtribut($data)
    {
        $get = $this->db->where("kelas_id !=",$data["kelas_id"])
                        ->like("kelas_keterangan",$data["kelas_keterangan"])
                        ->get($this->tbname);
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
    public function getKelasPboByAtribut($data)
    {
        $get = $this->db->like("kelas_nama",$data["kelas_nama"])
                        ->or_like("kelas_keterangan",$data["kelas_keterangan"])
                        ->get($this->tbname);
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
    
    public function getKelasPboByAttr($data)
    {
        $get = $this->db->order_by("kelas_nama","asc")
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
    
    public function countKelasPboByAttr($data)
    {
        $get = $this->db->get_where($this->tbname,$data);
        return $get->num_rows();
    }

    //    imamsrifkan : query untuk menambahkan kelas
    public function insertKelasPbo($data)
    {
        $insert = $this->db->insert($this->tbname,$data);
        return $insert;
    }

    //    imamsrifkan : query untuk edit seluruh status kelas
    public function updateStatusKelasTugasToAttr($data)
    {
        $update = $this->db->update($this->tbname,$data);
        
        return $update;
    }

    //    imamsrifkan : query untuk edit kelas
    public function updateKelasPbo($data)
    {
        $edit = $this->db->where("kelas_id",$data["kelas_id"])
                        ->update($this->tbname,$data);
        return $edit;
    }

    //    imamsrifkan : query untuk edit status kelas
    public function updateStatusKelasTugas($data="")
    {
        $edit_first = $this->db->update($this->tbname,array("kelas_status"=>"non-aktif"));
        
        $edit_last = $this->db->where("kelas_id",$data["kelas_id"])
                         ->update($this->tbname,$data);
        return $edit_last;
    }

    //    imamsrifkan : query untuk menghapus kelas berdasarkan id
    public function deleteKelasPbo($id="")
    {
        $delete = $this->db->where("kelas_id",$id)
                           ->delete($this->tbname);
        return $delete;
    }
}