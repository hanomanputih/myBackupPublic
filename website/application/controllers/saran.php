<?php

class Saran extends CI_Controller
{
    private $template = "template/template_user";

	public function __construct()
	{
		parent::__construct();
                $this->load->model('m_repositori', 'repo');
                $this->load->model('m_agenda', 'agenda');
                $this->load->model('m_berita', 'berita');
                $this->load->model('m_pesan', 'pesan');
                $this->load->model('m_tahun_ajaran', 'ta');
                
	}

	public function index()
	{
            $datatosend["title"] = "KSC Laboratory : Kritik dan Saran";
            $datatosend["side_repo"] = $this->repo->getRepoLimitByAttr(5,array('website_repositori.ta_id'=>  $this->session->userdata("ta_id")));
            $datatosend["side_agenda"] = $this->agenda->getAgendaLimitByAttr(5,array('website_berita.ta_id'=>  $this->session->userdata("ta_id")));
            $datatosend["side_berita"] = $this->berita->getBeritaLimitByAttr(5,array('website_berita.ta_id'=>  $this->session->userdata("ta_id")));
            $datatosend["sub_menu"] = $this->load->view("content/user/sub_menu/menu_beranda","",true);
            $datatoview["content"] = $this->load->view("content/user/kritik-saran/form_ks",$datatosend,true);
            $this->load->view($this->template,$datatoview);
	}
        
        public function proses()
        {
//            imamsrifkan : mengambil data tahun aktif akademik
            $getTa = $this->ta->getTahunAjaranByAttr(array("ta_status"=>"active"));
            if($getTa)
            {
                foreach($getTa as $result)
                {
                    $status = $result["ta_id"];
                }
            }
            
            $time = date("Y-m-d H:i:s",  gmt_to_local(time(), "UP7"));
            
            $datatosave = array(
                "user_id"=>  $this->input->post("nim", true),
                "saran_pesan"=>  $this->input->post("pesan", true),
                "saran_tanggal"=>$time,
                "saran_status"=>"0",
                "ta_id"=>$status,
            );
//            imamsrifkan : kode untuk informatika
            $checkKode = $datatosave["user_id"][2].$datatosave["user_id"][3].$datatosave["user_id"][4];

            
            if(empty($datatosave["user_id"]) OR empty($datatosave["saran_pesan"]))
            {
                $datatoshow = array(
                    "status"=>false,
                    "msg"=>"Data tidak lengkap",
                );
            }
            else if((strlen($datatosave["user_id"]) != 8) or ($checkKode != 523))
            {
                $datatoshow = array(
                    "status" => false,
                    "msg"=> "NIM tidak valid",
                );
            }
            else if(!preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/', $datatosave["user_id"]))
            {
                $datatoshow = array(
                    "status"=>false,
                    "msg"=>"NIM harus angka",
                );
            }
            else
            {
                $insert = $this->pesan->insertPesan($datatosave);
                if($insert > 0)
                {
                    $datatoshow = array(
                    "status"=>true,
                    "msg"=>"Pesan berhasil dikirim",
                    );
                }
                else
                {
                    $datatoshow = array(
                        "status"=>false,
                        "msg"=>"Pesan gagal dikirim",
                    );
                }
            }
            echo json_encode($datatoshow);
            
        }
}