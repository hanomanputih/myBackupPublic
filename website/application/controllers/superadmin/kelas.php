<?php

class Kelas extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata("user_status") == 1)
        {
            $this->load->model("m_tahun_ajaran","ta");
            $this->load->model("m_kelas","kelas");
            $this->load->model("m_user_daftar","user_daftar");
            $this->load->model("m_responsi_kelas","responsi");
        }
        else
        {
            redirect(base_url()."superadmin/login","refresh");
            exit;
        }
    }
    
//    imamsrifkan : fungsi untuk melihat kelas tugas
    public function index()
    {
        redirect(base_url()."superadmin/kelas/tugas","refresh");
    }
    
//    imamsrifkan : fungsi untuk melihat kelas dan praktikan ai
    public function ai($menu="",$menu2="",$menu3="")
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();
        
        $dataToSend["kelas_ai"] = $this->kelas->getAllKelasAi();
        $dataToSend["jumlah"] = $this->user_daftar;
        $dataToView["content"] = $this->load->view("content/sadmin/kelas_ai/list_kelas",$dataToSend,TRUE);
        if($menu == "tambah")
        {
            $dataToView["content"] = $this->load->view("content/sadmin/kelas_ai/add_kelas","",TRUE);
        }
        else if($menu == "edit")
        {
            if(!empty($menu2))
            {
                $dataToSend["kelas_ai"] = $this->kelas->getKelasAiById($menu2);
                $dataToView["content"] = $this->load->view("content/sadmin/kelas_ai/edit_kelas",$dataToSend,TRUE);
            }
        }
        else if($menu == "hapus")
        {
            if(!empty($menu2))
            {
                $delete = $this->kelas->deleteKelasAi($menu2);
                redirect(base_url()."superadmin/kelas/ai","refresh");
                exit;
            }
            
        }
        else if($menu == "praktikan")
        {
            $dataToSend["praktikan_ai"] = $this->user_daftar->getAllUserDaftar();
            $dataToSend["kelas"] = $this->kelas->getAllKelasAi();
            $dataToView["content"] = $this->load->view("content/sadmin/praktikan_ai/list_praktikan",$dataToSend,TRUE);
            if($menu2 == "tambah")
            {
                $dataToSend["kelas"] = $this->kelas->getAllKelasAi();
                $dataToView["content"] = $this->load->view("content/sadmin/praktikan_ai/add_praktikan",$dataToSend,TRUE);
            }
            else if($menu2 == "edit")
            {
                if(!empty($menu3))
                {
                    $dataToSend["praktikan_ai"] = $this->user_daftar->getUserDaftarById($menu3);
                    $dataToSend["kelas"] = $this->kelas;
                    $dataToView["content"] = $this->load->view("content/sadmin/praktikan_ai/edit_praktikan",$dataToSend,TRUE);
                }
                else
                {
                    redirect(base_url()."superadmin/kelas/ai/praktikan","refresh");
                    exit;
                }
            }
            else if($menu2 == "hapus")
            {
                if(!empty($menu3))
                {
                    $delete = $this->user_daftar->deleteUserDaftar($menu3);
                }
                
                redirect(base_url()."superadmin/kelas/ai/praktikan","refresh");
                exit;
            }
            else
            {
                if(!empty($menu2))
                {
                    $dataToSend["praktikan_ai"] = $this->user_daftar->getUserDaftarByKelas($menu2);
                    $dataToView["content"] = $this->load->view("content/sadmin/praktikan_ai/list_praktikan",$dataToSend,TRUE);
                }
            }
        }
        else if($menu == "responsi")
        {
            $dataToSend["responsi"] = $this->responsi->getAllKelasResponsi();
            $dataToSend["kelas"] = $this->responsi->getHariResponsi();
            $dataToView["content"] = $this->load->view("content/sadmin/responsi/list_responsi",$dataToSend,TRUE);
            if($menu2 == "tambah")
            {
                $dataToView["content"] = $this->load->view("content/sadmin/responsi/add_responsi","",TRUE);
            }
            else if(!empty($menu2))
            {
                $dataToSend["responsi"] = $this->responsi->getKelasResponsiByHari($menu2);
                $dataToView["content"] = $this->load->view("content/sadmin/responsi/list_responsi",$dataToSend,TRUE);
            }
        }
        
        
        $this->load->view("template/template_sadmin",$dataToView);
    }
    
//    imamsrifkan : fungsi untuk melihat kelas tugas
    public function tugas($menu="",$menu2="")
    {
        $dataToSend["kelas"] = $this->kelas->getAllKelasTugas();
        $dataToSend["aktif"] = $this->kelas->getActiveKelasTugas();
        $dataToView["content"] = $this->load->view("content/sadmin/kelas_tugas/list_kelas",$dataToSend,TRUE);
        if($menu == "tambah")
        {
            $dataToView["content"] = $this->load->view("content/sadmin/kelas_tugas/add_kelas","",TRUE);
        }
        else if($menu == "edit")
        {
            if(!empty($menu2))
            {
                $dataToSend["kelas"] = $this->kelas->getKelasTugasById($menu2);
                $dataToView["content"] = $this->load->view("content/sadmin/kelas_tugas/edit_kelas",$dataToSend,TRUE);
            }
        }
        else if($menu == "hapus")
        {
            if(!empty($menu2))
            {
                $delete = $this->kelas->deleteKelasTugas($menu2);
                redirect(base_url()."superadmin/kelas/tugas","refresh");
                exit;
            }
        }
        
        
        $this->load->view("template/template_sadmin",$dataToView);
    }
    
//    imamsrifkan : fungsi untuk menambahkan kelas tugas
    public function proses_tambah_tugas()
    {
        $dataToAdd = array(
            "kelas_nama"=>  $this->input->post("nama_kelas",TRUE),
            "kelas_keterangan"=>  $this->input->post("keterangan_kelas",TRUE),
            "kelas_status"=> "non-aktif",
        );
        $dataToCheck = array(
            "kelas_nama"=>  $this->input->post("nama_kelas",TRUE),
            "kelas_keterangan"=>  $this->input->post("keterangan_kelas",TRUE),
        );
        
        if(!empty($dataToAdd["kelas_nama"]) AND !empty($dataToAdd["kelas_keterangan"]))
        {
            $check_data = $this->kelas->getKelasTugasByAtribut($dataToCheck);
            if($check_data)
            {
                echo "duplikat";
            }
            else
            {
                $insert = $this->kelas->insertKelasTugas($dataToAdd);
                if($insert)
                {
                    echo TRUE;
                }
                else
                {
                    echo FALSE;
                }
            }
        }
        else
        {
            echo "kosong";
        }
    }
    
//    imamsrifkan : fungsi untuk proses ubah data kelas tugas
    public function proses_edit_tugas()
    {
        // imamsrifkan : data yang akan diedit
        $dataToEdit = array(
            "kelas_id"=>  $this->input->post("id_kelas",TRUE),
            "kelas_nama"=>  $this->input->post("nama_kelas",TRUE),
            "kelas_keterangan"=>  $this->input->post("keterangan_kelas",TRUE),
        );
        // imamsrifkan : data yang akan diperiksa
        $dataToCheck = array(
            "kelas_id"=> $this->input->post("id_kelas",TRUE),
            "kelas_nama"=>  $this->input->post("nama_kelas",TRUE),
            "kelas_keterangan"=>  $this->input->post("keterangan_kelas",TRUE),
        );
        if(!empty($dataToEdit["kelas_nama"]) AND !empty($dataToEdit["kelas_keterangan"]))
        {
            $check = $this->kelas->getKelasTugasExceptByAtribut($dataToCheck);
            if($check)
            {
                echo "duplikat";
            }
            else
            {
                $update = $this->kelas->updateKelasTugas($dataToEdit);
                if($update)
                {
                    echo TRUE;
                }
                else
                {
                    echo FALSE;
                } 
            }
        }
        else
        {
            echo "kosong";
        }
    }

//    imamsrifkan : fungsi untuk proses penambahan data kelas ai
    public function proses_tambah_ai()
    {
        $dataToSave = array(
            "kelas_nama"=>  $this->input->post("nama_kelas",TRUE),
            "kelas_hari"=>  $this->input->post("hari_kelas",TRUE),
            "kelas_tanggal"=>  $this->input->post("tanggal_kelas",TRUE),
            "kelas_jam"=>  $this->input->post("jam_kelas",TRUE),
            "kelas_keterangan"=>  $this->input->post("keterangan_kelas",TRUE),
            "kelas_kuota"=> $this->input->post("kuota_kelas",TRUE),
            "kelas_status"=> "non-aktif",
        );
        $dataToCheck = array(
            "kelas_nama"=>  $this->input->post("nama_kelas",TRUE),
            "kelas_hari"=>  $this->input->post("hari_kelas",TRUE),
            "kelas_tanggal"=>  $this->input->post("tanggal_kelas",TRUE),
            "kelas_jam"=>  $this->input->post("jam_kelas",TRUE),
        );
        
        
        if(empty($dataToSave["kelas_nama"]) OR empty($dataToSave["kelas_hari"]) OR empty($dataToSave["kelas_tanggal"]) OR empty($dataToSave["kelas_jam"]))
        {
            echo "kosong";
        }
        else
        {
            $check = $this->kelas->getKelasAiToCheck($dataToCheck);
            if($check)
            {
                echo "duplikat";
            }
            else
            {
                $insert = $this->kelas->insertKelasAi($dataToSave);
                if($insert > 0)
                {
                    echo TRUE;
                }
                else
                {
                    echo FALSE;
                }
            }
        }
    }
    
//    imamsrifkan : fungsi untuk menyimpan proses ubah data kelas praktikum ai
    public function proses_edit_ai()
    {
        $dataToSave = array(
            "kelas_id"=>  $this->input->post("id_kelas",TRUE),
            "kelas_nama"=>  $this->input->post("nama_kelas",TRUE),
            "kelas_hari"=>  $this->input->post("hari_kelas",TRUE),
            "kelas_tanggal"=>  $this->input->post("tanggal_kelas",TRUE),
            "kelas_jam"=>  $this->input->post("jam_kelas",TRUE),
            "kelas_kuota"=> $this->input->post("kuota_kelas",TRUE),
        );
        
        $dataToCheck = array(
            "kelas_id !="=> $this->input->post("id_kelas",TRUE),
            "kelas_nama"=>  $this->input->post("nama_kelas",TRUE),
            "kelas_hari"=>  $this->input->post("hari_kelas",TRUE),
            "kelas_tanggal"=>  $this->input->post("tanggal_kelas",TRUE),
            "kelas_jam"=>  $this->input->post("jam_kelas",TRUE),
            "kelas_kuota"=> $this->input->post("kuota_kelas",TRUE),
        );
        
        if(empty($dataToSave["kelas_nama"]) AND empty($dataToSave["kelas_hari"]) AND empty($dataToSave["kelas_tanggal"]) AND empty($dataToSave["kelas_jam"]))
        {
            echo "kosong";
        }
        else
        {
            $check = $this->kelas->getKelasAiByAtribut($dataToCheck);
            if($check)
            {
                echo "duplikat";
            }
            else
            {
                $update = $this->kelas->updateKelasAi($dataToSave);
                if($update > 0)
                {
                    echo TRUE;
                }
                else
                {
                    echo FALSE;
                }
            }
        }
    }
    
//    imamsrifkan : fungsi untuk proses meyimpan data user pendaftar
    public function proses_tambah_praktikan()
    {
        $dataToSave = array(
            "daftar_nim"=>  $this->input->post("nim_praktikan",TRUE),
            "daftar_nama"=>  $this->input->post("nama_praktikan",TRUE),
            "daftar_angkatan"=>  "20".substr($this->input->post("nim_praktikan"), 0, 2),
            "kelas_id"=>  $this->input->post("id_kelas",TRUE),
        );
        $dataToCheck = array("daftar_nim"=>$this->input->post("nim_praktikan",TRUE));
        
        if(!empty($dataToSave["daftar_nim"]) AND !empty($dataToSave["daftar_nama"]) AND !empty($dataToSave["kelas_id"]))
        {
            $check = $this->user_daftar->getUserDaftarByAtribut($dataToCheck);
            if($check)
            {
                echo "duplikat";
            }
            else
            {
                $insert = $this->user_daftar->insertUserDaftar($dataToSave);
                if($insert > 0)
                {
                    echo TRUE;
                }
                else
                {
                    echo FALSE;
                }
            }
        }
        else
        {
            echo "kosong";
        }
    }
    
//    imamsrifkan : fungsi untuk proses ubah data user pendaftar
    public function proses_edit_praktikan()
    {
        $dataToSave = array(
            "daftar_id"=>  $this->input->post("id_daftar",TRUE),
            "daftar_nim"=>  $this->input->post("nim_praktikan",TRUE),
            "daftar_nama"=>  $this->input->post("nama_praktikan",TRUE),
            "daftar_angkatan"=> "20".  substr($this->input->post("nim_praktikan"), 0, 2),
            "kelas_id"=>  $this->input->post("id_kelas",TRUE),
        );
        $dataToCheck = array(
            "daftar_nim"=>  $this->input->post("nim_praktikan",TRUE),
            "daftar_nama"=>  $this->input->post("nama_praktikan",TRUE),
        );
        
        if(!empty($dataToSave["daftar_nama"]))
        {
            $update = $this->user_daftar->updateUserDaftar($dataToSave);
            if($update > 0)
            {
                echo TRUE;
            }
            else
            {
                echo FALSE;
            }
        }
        else
        {
            echo "kosong";
        }
    }
}