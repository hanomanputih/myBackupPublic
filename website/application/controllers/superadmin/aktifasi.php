<?php

class Aktifasi extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata("user_status") == 1)
        {
            if($this->session->userdata("ta_status") == "active")
            {
                $this->load->model("m_tahun_ajaran","ta");
                $this->load->model("m_kelas","kelas");
                $this->load->model("m_kelas_pbo","kelas_tugas");
                $this->load->model("m_kelas_praktikum_kcb","praktikum_kcb");
                $this->load->model("m_modul","modul");
                $this->load->model("m_user_daftar","daftar");
                $this->load->model("m_responsi_kelas","kelas_responsi");
            }
            else
            {
                redirect(base_url()."superadmin/home/ta/".  $this->session->userdata("ta_id"));
                exit;
            }
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

        $dataToSend["sidebar"] = $this->load->view("content/sadmin/aktifasi/right_side","",TRUE);
        $dataToView["content"] = $this->load->view("content/sadmin/aktifasi/home_aktifasi",$dataToSend,TRUE);
        $this->load->view("template/template_sadmin",$dataToView);
    }
    
//    imamsrifkan : fungsi menampilkan tugas
    public function tugas($menu="",$id="")
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

        $dataToSend["sidebar"] = $this->load->view("content/sadmin/aktifasi/right_side","",TRUE);
        $dataToSend["kelas_tugas"] = $this->kelas->getAllKelasTugas();
        $dataToView["content"] = $this->load->view("content/sadmin/aktifasi/kelas_tugas/list_tugas",$dataToSend,TRUE);

        $this->load->view("template/template_sadmin",$dataToView);
    }

//    imamsrifkan : fungsi menampilkan kelas praktikum AI
    public function kelas($menu="",$id="")
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

        $dataToSend["sidebar"] = $this->load->view("content/sadmin/aktifasi/right_side","",TRUE);
        $dataToSend["kelas_ai"] = $this->kelas->getKelasAiByAttr(array('ta_id'=>  $this->session->userdata("ta_id")));
//        $dataToSend["hari"] = $this->kelas->getHariKelasAiByAttr(array('ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["aktifasi"] = $this->kelas->getStatusKelasAiByAttr(array('ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["total"] = $this->daftar;
        $dataToView["content"] = $this->load->view("content/sadmin/aktifasi/kelas_ai/list_kelas",$dataToSend,TRUE);
        if(!empty($menu))
        {
            $dataToSend["kelas_ai"] = $this->kelas->getKelasAiByAttr(array('kelas_hari'=>$menu,'ta_id'=>  $this->session->userdata("ta_id")));
            $dataToView["content"] = $this->load->view("content/sadmin/aktifasi/kelas_ai/list_kelas",$dataToSend,TRUE);
        }
        $this->load->view("template/template_sadmin",$dataToView);
    }

    // imamsrifkan : fungsi proses aktifasi kelas praktikum kcb
    public function aktifasiKelasPraktikumKcb()
    {
        $id = $this->session->userdata("ta_id");
        $dataToEdit = array(
            "kelas_status"=>$this->input->post("status",true),
            );
        $update = $this->praktikum_kcb->updateStatusKelasKcb($dataToEdit,$id);
        if($update > 0)
        {
            echo true;
        }
        else
        {
            echo false;
        }
    }
    
//    imamsrifkan : fungsi untuk aktifasi modul pertemuan
    public function modul($menu="",$id="")
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

        $dataToSend["sidebar"] = $this->load->view("content/sadmin/aktifasi/right_side","",TRUE);
        $dataToSend["modul"] = $this->modul->getModulByAtribut(array("ta_id"=>$this->session->userdata("ta_id")));
        $dataToView["content"] = $this->load->view("content/sadmin/aktifasi/modul/list_modul",$dataToSend,TRUE);
        $this->load->view("template/template_sadmin",$dataToView);
    }

    // imamsrifkan : fungsi untuk aktifasi responsi
    public function responsi($menu="",$id="")
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();
        
        $dataToSend["sidebar"] = $this->load->view("content/sadmin/aktifasi/right_side","",TRUE);
        $dataToSend["responsi"] = $this->kelas_responsi->getResponsiByAtribut(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToSend["aktifasi"] = $this->kelas_responsi->getStatusResponsi(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToSend["total"] = $this->kelas_responsi->countResponsiByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToSend["jumlah"] = $this->kelas_responsi->countResponsiByAttr(array("responsi_status_aktif"=>"aktif","ta_id"=>  $this->session->userdata("ta_id")));
        
            if(!empty($menu))
            {
                $dataToSend["responsi"] = $this->kelas_responsi->getResponsiByDay($menu);    
            }

        $dataToView["content"] = $this->load->view("content/sadmin/aktifasi/responsi/list_responsi",$dataToSend,TRUE);
        $this->load->view("template/template_sadmin",$dataToView);
    }

    // imamsrifkan : fungsi untuk aktifasi tahun ajaran
    public function ta($menu="",$id="")
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();
        $dataToSend["sidebar"] = $this->load->view("content/sadmin/aktifasi/right_side","",true);
        $dataToSend["ta"] = $this->ta->getAllTahunAjaran();
        $dataToView["content"] = $this->load->view("content/sadmin/aktifasi/tahun_ajaran/list_tahun_ajaran",$dataToSend,true);
        $this->load->view("template/template_admin",$dataToView);

    }

    // imamsrifkan : fungsi proses aktifasi tahun ajaran
//    public function aktifasita()
//    {
//        $id = $this->input->post("id",true);
//        
//        $datatosend['status'] = $id;
//        
//        echo json_encode($datatosend);
////        $update = $this->ta->updateAllTahunAjaran(array("ta_status"=>"inactive"));
////        $datatosave = array(
////            "ta_id"=>$id,
////            "ta_status"=>"active",
////            );
////        $update2 = $this->ta->updateTahunAjaran($datatosave);
////        if(($update > 0) and ($update2 > 0))
////        {
////            echo true;
////        }
////        else
////        {
////            echo false;
////        }
//    }

    // imamsrifkan : fungsi proses aktifasi responsi
    public function aktifasiResponsi()
    {
        $dataToSave = array(
            "responsi_status_aktif"=>$this->input->post("status",true),
            "ta_id"=>  $this->session->userdata("ta_id"),
            );
        $update = $this->kelas_responsi->updateAllStatusResponsi($dataToSave);
        if($update > 0)
        {
            echo true;
        }
        else
        {
            echo false;
        }
    }

    // imamsrifkan : fungsi proses aktifasi responsi berdasarkan id
    public function prosesAktifResponsi()
    {
        $dataToEdit = array(
            "responsi_id"=>$this->input->post("id",true),
            "responsi_status_aktif"=>"aktif",
            );
        $update = $this->kelas_responsi->updateStatusResponsi($dataToEdit);
        if($update > 0)
        {
            echo true;
        }
        else
        {
            echo false;
        }
    }

    // imamsrifkan : fungsi proses non-aktifasi responsi berdasarkan id
    public function prosesNonAktifResponsi()
    {
        $dataToEdit = array(
            "responsi_id"=>$this->input->post("id",true),
            "responsi_status_aktif"=>"non-aktif",
            );
        $update = $this->kelas_responsi->updateStatusResponsi($dataToEdit);
        if($update > 0)
        {
            echo true;
        }
        else
        {
            echo false;
        }
    }

     // imamsrifkan : fungsi untuk non-aktif semua kelas tugas
    public function nonAktifTugas()
    {
        $dataToEdit = array(
            "kelas_status"=>"non-aktif",
            );
        $update = $this->kelas_tugas->updateStatusKelasTugasToAttr($dataToEdit);
        if($update > 0)
        {
            echo true;
        }
        else
        {
            echo false;
        }
    }
    // imamsrifkan : fungsi untuk aktifasi kelas tugas berdasarkan id
    public function prosesAktifTugas()
    {
        $dataToEdit = array(
            "kelas_id"=>$this->input->post("id",true),
            "kelas_status"=>"aktif",
            );
        $update = $this->kelas_tugas->updateStatusKelasTugas($dataToEdit);
        if($update > 0)
        {
            echo true;
        }
        else
        {
            echo false;
        }
    }
   // imamsrifkan : fungsi untuk non-aktif kelas tugas berdasarkan id
    public function prosesNonAktifTugas()
    {
        $dataToEdit = array(
            "kelas_id"=>$this->input->post("id",true),
            "kelas_status"=>"non-aktif",
            );
        $update = $this->kelas_tugas->updateStatusKelasTugas($dataToEdit);
        if($update > 0)
        {
            echo true;
        }
        else
        {
            echo false;
        }
    }  

    // imamsrifkan : fungsi proses non-aktifasi semua modul
    public function nonAktifModul()
    {
        $dataToEdit = array("modul_status"=>"non-aktif");
        $update = $this->modul->updateAllStatusModul($dataToEdit);
        if($update > 0)
        {
            echo true;
        }
        else
        {
            echo false;
        }
    }

    // imamsrifkan : fungsi proses aktifasi modul berdasarkan id
    public function prosesAktifModul()
    {
        $dataToEdit = array(
            "modul_id"=>$this->input->post("id",true),
            "modul_status"=>"aktif",
            );
        $update = $this->modul->updateStatusModul($dataToEdit);
        if($update > 0)
        {
            echo true;
        }
        else
        {
            echo false;
        }
    }

    // imamsrifkan : fungsi proses non-aktif modul berdasarkan id
    public function prosesNonAktifModul()
    {
        $dataToEdit = array(
            "modul_id"=>$this->input->post("id",true),
            "modul_status"=>"non-aktif",
            );
        $update = $this->modul->updateStatusModul($dataToEdit);
        if($update > 0)
        {
            echo true;
        }
        else
        {
            echo false;
        }
    }  
}