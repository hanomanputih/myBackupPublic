<?php if(! defined('BASEPATH')) exit('No direct script accept allowed');

class Home extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata("user_status") == 2)
        {
            $this->load->model("m_tahun_ajaran","ta");
            $this->load->model('m_pesan', 'pesan');
            $this->load->model('m_kelas_pbo', 'kelas_pbo');
            $this->load->model('m_modul', 'modul');
            $this->load->model('m_kelas_praktikum_kcb', 'prkcb');
            $this->load->model('m_responsi_kelas', 'responsi');
            $this->load->model('m_user', 'user');
            $this->load->model('m_user_pbo', 'user_pbo');
            $this->load->model('m_user_kcb', 'user_kcb');
            $this->load->model('m_user_daftar', 'user_daftar');
        }
        else
        {
            redirect(base_url()."asisten/login","refresh");
            exit;
        }
    }
    
    public function index()
    {
       $datatoget["ta"] = $this->ta->getTahunAjaranByAtribut(array("ta_status"=>"active"));
       if($datatoget["ta"])
       {
            foreach($datatoget["ta"] as $result)
           {
             redirect(base_url()."asisten/home/ta/".$result["ta_id"]);
           } 
       }
       else
       {
            $datatoget["ta"] = $this->ta->getTahunAjaranByAtribut(array("ta_status"=>"inactive"));
            foreach($datatoget["ta"] as $result)
            {
                redirect(base_url()."asisten/home/ta/".$result["ta_id"]);    
            }
            
       }
       
    }

    public function ta($id="")
    {
        // imamsrifkan : buat session untuk tahun ajaran
        $datatoget["ta"] = $this->ta->getTahunAjaranById($id);
        if($datatoget["ta"])
        {
            $data = array(
                "ta_status"=>$datatoget["ta"]["ta_status"],
                "ta_id"=>$datatoget["ta"]["ta_id"],
                "ta_nama"=>$datatoget["ta"]["ta_nama"],
                );
            $this->session->set_userdata($data);
        }
        
//           imamsrifkan : statistik
        $datatosend = array(
            "asisten_jumlah" =>$this->user->countUserByAttr(array("ta_id"=>  $this->session->userdata("ta_id"))),
            "pbo_kelas"=>$this->kelas_pbo->countKelasPboByAttr(array("ta_id"=>  $this->session->userdata("ta_id"))),
            "pbo_praktikan"=>$this->user_pbo->countUserPboByAttr(array("ta_id"=>  $this->session->userdata("ta_id"))),
            "pbo_pertemuan"=>$this->modul->countModulByAttr(array("ta_id"=>  $this->session->userdata("ta_id"))),
            "kcb_kelas"=>$this->prkcb->countKelasKcbByAttr(array("ta_id"=>  $this->session->userdata("ta_id"))),
            "kcb_mahasiswa"=>$this->user_kcb->countUserKcbByAttr(array("ta_id"=>  $this->session->userdata("ta_id"))),
            "kcb_praktikan"=>$this->user_daftar->countUserDaftarByAttr(array("ta_id"=>  $this->session->userdata("ta_id"))),
            
            "kelas_pbo"=>$this->kelas_pbo->getActiveKelasPbo(),
            "modul"=>$this->modul->getActiveModul(),
            "prkcb"=>$this->prkcb->getKelasKcbByAttr(array("kelas_status"=>"aktif")),
            "responsi"=>$this->responsi->getresponsiByAttr(array("responsi_status_aktif"=>"aktif")),
            "user"=>$this->user->getUserByAttr(array("user_session"=>"active")),
            
        );
        
        // imamsrifkan : konfigurasi tahun ajaran tiap praktikum
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();
        $dataToView["ta_active"] = $this->ta->getTahunAjaranByAtribut(array("ta_status"=>"active"));
        $dataToView["ta_inactive"] = $this->ta->getTahunAjaranByAtribut(array("ta_status"=>"inactive"));
        $datatoCheck["ta_id"] = $id;
        $datatosend["pesan"] = $this->pesan->getPesanbyAttr(array("saran_status"=>"0","ta_id"=>  $this->session->userdata("ta_id")));
        $dataToView["content"] = $this->load->view("content/asisten/home/statistik",$datatosend,TRUE);
        $this->load->view("template/template_admin",$dataToView);
    }
}