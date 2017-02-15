<?php

class Pengaturan extends CI_Controller{
    
    public function __construct()
    {
        parent:: __construct();
        if($this->session->userdata("user_status") == 1)
        {
            $this->load->model("m_jabatan","jabatan");
            $this->load->model("m_tahun_ajaran","ta");
            $this->load->model("m_responsi_kelas","responsi");
            $this->load->model("m_modul","modul");
        }
        else
        {
            redirect(base_url()."superadmin/login","refresh");
        }
    }
    
    public function index()
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

        $dataToSend["sidebar"] = $this->load->view("content/sadmin/pengaturan/right_side","",TRUE);
        $dataToView["content"] = $this->load->view("content/sadmin/pengaturan/home_pengaturan",$dataToSend,TRUE);
        $this->load->view("template/template_sadmin",$dataToView);
    }
    
//    imamsrifkan : fungsi pengaturan jabatan
    public function jabatan($menu="",$id="")
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

        $dataToSend["sidebar"] = $this->load->view("content/sadmin/pengaturan/right_side","",TRUE);
        $dataToSend["jabatan"] = $this->jabatan->getAllJabatan();
        $dataToView["content"] = $this->load->view("content/sadmin/pengaturan/jabatan/lihat_jabatan",$dataToSend,TRUE);
        if($menu == "tambah")
        {
            if($this->session->userdata("ta_status") == "active")
            {
                $dataToView["content"] = $this->load->view("content/sadmin/pengaturan/jabatan/add_jabatan",$dataToSend,TRUE);
            }
            else
            {
                redirect(base_url()."superadmin/pengaturan/jabatan");
                exit;
            }
        }
        else if($menu == "edit")
        {
            $dataToSend["jabatan"] = $this->jabatan->getJabatanById($id);
            $dataToView["content"] =  $this->load->view("content/sadmin/pengaturan/jabatan/edit_jabatan",$dataToSend,TRUE);
        }
        else if($menu == "hapus")
        {
            if(!empty($id))
            {
                $delete = $this->jabatan->deleteJabatan($id);
            
                redirect(base_url()."superadmin/pengaturan/jabatan","refresh");
                exit;
            }
        }
        
        $this->load->view("template/template_sadmin",$dataToView);
    }
    
//    imamsrifkan : fungsi pengaturan tahun ajaran
    public function ta($menu="",$id="")
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

        $dataToSend["sidebar"] = $this->load->view("content/sadmin/pengaturan/right_side","",TRUE);
        $dataToSend["tahun_ajaran"] = $this->ta->getAllTahunAjaran();
        $dataToView["content"] = $this->load->view("content/sadmin/pengaturan/tahun_ajaran/list_tahun_ajaran",$dataToSend,TRUE);
        if($menu == "tambah")
        {
            $dataToView["content"] = $this->load->view("content/sadmin/pengaturan/tahun_ajaran/add_tahun_ajaran","",TRUE);
        }
        else if($menu == "edit")
        {
            $dataToSend["tahun_ajaran"] = $this->ta->getTahunAjaranById($id);
            $dataToView["content"] = $this->load->view("content/sadmin/pengaturan/tahun_ajaran/edit_tahun_ajaran",$dataToSend,TRUE);
        }
        else if($menu == "hapus")
        {
            if(!empty($id))
            {
                $delete = $this->ta->deleteTahunAjaran($id);
                redirect(base_url()."superadmin/pengaturan/ta","refresh");
                exit;
            }
        }
        $this->load->view("template/template_sadmin",$dataToView);
    }
    
//    imamsrifkan : fungsi pengaturan modul pertemuan
    public function modul($menu="",$id="")
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

        $dataToSend["sidebar"] = $this->load->view("content/sadmin/pengaturan/right_side","",TRUE);
        $dataToSend["modul"] = $this->modul->getModulByAtribut(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToView["content"] = $this->load->view("content/sadmin/pengaturan/modul/list_modul",$dataToSend,TRUE);
        if($menu == "tambah")
        {
            if($this->session->userdata("ta_status") == "active")
            {
                $dataToView["content"] = $this->load->view("content/sadmin/pengaturan/modul/add_modul",$dataToSend,TRUE);
            }
            else
            {
                redirect(base_url()."superadmin/pengaturan/modul");
                exit;
            }
        }
        else if($menu == "edit")
        {
            if(!empty($id))
            {
                $dataToSend["modul"] = $this->modul->getModulById($id);
                $dataToView["content"] = $this->load->view("content/sadmin/pengaturan/modul/edit_modul",$dataToSend,TRUE);
            }
        }
        else if($menu == "hapus")
        {
            if(!empty($id))
            {
                $delete = $this->modul->deleteModul($id);
                redirect(base_url()."superadmin/pengaturan/modul");
                exit;
            }
        }
        $this->load->view("template/template_sadmin",$dataToView);
    }
    
//    imamsrifkan : fungsi pengaturan jadwal responsi
    public function responsi($menu="",$id="")
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();
        
        $dataToSend["sidebar"] = $this->load->view("content/sadmin/pengaturan/right_side","",TRUE);
        $dataToSend["hari"] = $this->responsi->getHariResponsi();
        $dataToSend["responsi"] = $this->responsi->getAllResponsi();
        $dataToView["content"] = $this->load->view("content/sadmin/pengaturan/responsi/list_responsi",$dataToSend,TRUE);
        if($menu == "tambah")
        {
            $dataToView["content"] = $this->load->view("content/sadmin/pengaturan/responsi/add_responsi",$dataToSend,TRUE);
        }
        else if($menu == "edit")
        {
            if(!empty($id))
            {
                $dataToSend["responsi"] = $this->responsi->getResponsiById($id);
                $dataToView["content"] = $this->load->view("content/sadmin/pengaturan/responsi/edit_responsi",$dataToSend,TRUE);
            }
        }
        else if($menu == "hapus")
        {
            if(!empty($id))
            {
                $delete = $this->responsi->deleteResponsi($id);
                redirect(base_url()."superadmin/pengaturan/responsi","refresh");
                exit;
            }
        }
        else if(!empty($menu))
        {
            $dataToSend["responsi"] = $this->responsi->getResponsiByDay($menu);
            $dataToView["content"] = $this->load->view("content/sadmin/pengaturan/responsi/list_responsi",$dataToSend,TRUE);
        }
        $this->load->view("template/template_sadmin",$dataToView);
    }
    
    
    
    
//    imamsrifkan : fungsi untuk proses menyimpan data jabatan
    public function proses_simpan_jabatan()
    {
        $dataToSave = array(
            "jabatan_nama"=>$this->input->post("nama_jabatan",TRUE),
        );
        
        if(!empty($dataToSave["jabatan_nama"]))
        {
            $check = $this->jabatan->getJabatanByAtribut($dataToSave);
            if($check)
            {
                echo "duplikat";
            }
            else
            {
                $insert = $this->jabatan->insertJabatan($dataToSave);
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
    
//    imamsrifkan : fungsi untuk proses mengubah data jabatan
    public function proses_edit_jabatan()
    {
        $dataToSave = array(
            "jabatan_id"=>$this->input->post("id_jabatan",TRUE),
            "jabatan_nama"=>$this->input->post("nama_jabatan",TRUE),
        );
        if(!empty($dataToSave["jabatan_nama"]))
        {
            $check = $this->jabatan->getJabatanExceptByAtribut($dataToSave);
            if($check)
            {
                echo "duplikat";
            }
            else
            {
                $update = $this->jabatan->updateJabatan($dataToSave);
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
        else
        {
            echo "kosong";
        }
    }
    
//    imamsrifkan : fungsi untuk proses menyimpan tahun ajaran
    public function proses_simpan_ta()
    {
        $dataToSave = array(
            "ta_nama"=>  $this->input->post("nama_ta",TRUE),
        );
        if(!empty($dataToSave["ta_nama"]))
        {
            $check = $this->ta->getTahunAjaranByAtribut($dataToSave);
            if($check)
            {
                echo "duplikat";
            }
            else
            {
                $insert = $this->ta->insertTahunAjaran($dataToSave);
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
    
//    imamsrifkan : fungsi untuk proses mengubah tahun ajaran
    public function proses_edit_ta()
    {
        $dataToSave = array(
            "ta_id"=>  $this->input->post("id_ta",TRUE),
            "ta_nama"=>  $this->input->post("nama_ta",TRUE),
        );
        if(!empty($dataToSave["ta_nama"]))
        {
            $check = $this->ta->getTahunAjaranExceptByAtribut($dataToSave);
            if($check)
            {
                echo "duplikat";
            }
            else
            {
                $update = $this->ta->updateTahunAjaran($dataToSave);
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
        else
        {
            echo "kosong";
        }
    }
    
//    imamsrifkan : fungsi proses menyimpan modul pertemuan
    public function proses_simpan_modul()
    {
        $dataToSave = array(
            "modul_nama"=>  $this->input->post("pertemuan_nama",TRUE),
            "modul_status"=> "non-aktif",
            "ta_id"=>  $this->session->userdata("ta_id"),
        );
        if(!empty($dataToSave["modul_nama"]))
        {
            $check = $this->modul->getModulByAtribut($dataToSave);
            if($check)
            {
                echo "duplikat";
            }
            else
            {
                $getLatest = $this->modul->getLatestModulByAttr(array("ta_id"=>  $this->session->userdata("ta_id")),"modul_pertemuan");
                $dataToSave["modul_pertemuan"] = $getLatest["modul_pertemuan"]+1;
                $insert = $this->modul->insertModul($dataToSave);
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
    
//    imamsrifkan : fungsi untuk proses ubah modul pertemuan
    public function proses_edit_modul()
    {
        $dataToSave = array(
            "modul_id"=>  $this->input->post("id_modul",TRUE),
            "modul_nama"=>  $this->input->post("pertemuan_nama",TRUE),
        );
        if(!empty($dataToSave["modul_nama"]))
        {
            $check = $this->modul->getModulExceptByAtribut($dataToSave);
            if($check)
            {
                echo "duplikat";
            }
            else
            {
                $update = $this->modul->updateModul($dataToSave);
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
        else
        {
            echo "kosong";
        }
    }
    
//    imamsrifkan : fungsi untuk proses menyimpan data jadwal responsi
    public function proses_simpan_responsi()
    {
        $dataTanggal = array(
            "responsi_tanggal"=>  $this->input->post("tanggal_responsi",TRUE),
            "responsi_bulan"=>  $this->input->post("bulan_responsi",TRUE),
            "responsi_tahun"=>  $this->input->post("tahun_responsi",TRUE),
        );
        $dataToSave = array(
            "responsi_hari"=>  $this->input->post("hari_responsi",TRUE),
            "responsi_tanggal"=>  $this->input->post("tahun_responsi",TRUE)."-".$this->input->post("bulan_responsi",TRUE)."-".$this->input->post("tanggal_responsi",TRUE),
            "responsi_jam"=>  $this->input->post("jam_responsi",TRUE),
            "responsi_ruang"=>  $this->input->post("ruang_responsi",TRUE),
            "responsi_status_aktif"=>"non-aktif",
        );
        if(!empty($dataToSave["responsi_hari"]) AND !empty($dataToSave["responsi_jam"]) AND !empty($dataToSave["responsi_ruang"]) AND !empty($dataTanggal["responsi_tanggal"]) AND !empty($dataTanggal["responsi_bulan"]) AND !empty($dataTanggal["responsi_tahun"]))
        {
            $check = $this->responsi->getResponsiByAttr($dataToSave);
            if($check)
            {
                echo "duplikat";
            }
            else
            {
                $insert = $this->responsi->insertResponsi($dataToSave);
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
    
//    imamsrifkan : fungsi untuk proses ubah jadwal responsi
    public function proses_edit_responsi()
    {
        $dataTanggal = array(
            "responsi_tanggal"=>  $this->input->post("tanggal_responsi",TRUE),
            "responsi_bulan"=>  $this->input->post("bulan_responsi",TRUE),
            "responsi_tahun"=>  $this->input->post("tahun_responsi",TRUE),
        );
        $dataToSave = array(
            "responsi_id"=> $this->input->post("id_responsi",TRUE),
            "responsi_hari"=>  $this->input->post("hari_responsi",TRUE),
            "responsi_tanggal"=>  $this->input->post("tahun_responsi",TRUE)."-".$this->input->post("bulan_responsi",TRUE)."-".$this->input->post("tanggal_responsi",TRUE),
            "responsi_jam"=>  $this->input->post("jam_responsi",TRUE),
            "responsi_ruang"=>  $this->input->post("ruang_responsi",TRUE),
        );
        if(!empty($dataToSave["responsi_hari"]) AND !empty($dataToSave["responsi_jam"]) AND !empty($dataToSave["responsi_ruang"]) AND !empty($dataTanggal["responsi_tanggal"]) AND !empty($dataTanggal["responsi_bulan"]) AND !empty($dataTanggal["responsi_tahun"]))
        {
            $check = $this->responsi->getResponsiExceptByAtribut($dataToSave);
            if($check)
            {
                echo "duplikat";
            }
            else
            {
                $update = $this->responsi->updateResponsi($dataToSave);
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
        else
        {
            echo "kosong";
        }
    }
}